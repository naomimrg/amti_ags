<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\RecaptchaService;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $recaptchaService;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RecaptchaService $recaptchaService)
    {
        $this->middleware('guest')->except('logout');
        $this->recaptchaService = $recaptchaService;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login', [
            'recaptchaSiteKey' => $this->recaptchaService->getSiteKey()
        ]);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Validasi reCAPTCHA v3
        $recaptchaToken = $request->input('g-recaptcha-response');

        if (empty($recaptchaToken)) {
            return $this->sendFailedLoginResponse($request, [
                'recaptcha' => 'reCAPTCHA verification is required'
            ]);
        }

        // Verify reCAPTCHA v3
        $recaptchaResult = $this->recaptchaService->verify($recaptchaToken, 'login');

        if (!$recaptchaResult['success']) {
            Log::warning('reCAPTCHA verification failed', [
                'ip' => $request->ip(),
                'email' => $request->input('email'),
                'error' => $recaptchaResult['error'],
                'score' => $recaptchaResult['score'] ?? 0
            ]);

            return $this->sendFailedLoginResponse($request, [
                'recaptcha' => $recaptchaResult['error']
            ]);
        }

        // Log successful reCAPTCHA verification
        Log::info('reCAPTCHA verification successful', [
            'ip' => $request->ip(),
            'email' => $request->input('email'),
            'score' => $recaptchaResult['score']
        ]);

        // Check for too many login attempts
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        // Attempt login
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Send failed login response with custom errors
     */
    protected function sendFailedLoginResponse(Request $request, $customErrors = [])
    {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed',
                'errors' => array_merge([
                    $this->username() => [trans('auth.failed')]
                ], $customErrors)
            ], 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors(array_merge([
                $this->username() => trans('auth.failed'),
            ], $customErrors));
    }

    /**
     * Override sendLoginResponse to handle AJAX requests
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful',
                    'redirect_url' => $response->getTargetUrl()
                ]);
            }
            return $response;
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'redirect_url' => $this->redirectPath()
            ]);
        }

        return redirect()->intended($this->redirectPath());
    }

    public function authenticated(Request $request, $user)
    {
        $userRole = \Auth::user()->role;

        Log::info('User authenticated', [
            'user_id' => $user->id,
            'email' => $user->email,
            'role' => $userRole,
            'ip' => $request->ip()
        ]);

        if ($userRole == 'Super Admin') {
            return redirect('dashboard');
        } elseif ($userRole == 'Admin GSI') {
            return redirect('dashboard');
        } elseif ($userRole == 'Admin Vendor') {
            return redirect('profile');
        } elseif ($userRole == 'User') {
            return redirect('profile');
        }

        // Default redirect
        return redirect('dashboard');
    }

    /**
     * Test reCAPTCHA endpoint for debugging
     */
    public function testRecaptcha(Request $request)
    {
        $token = $request->input('token');
        $action = $request->input('action', 'test');

        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Token is required'
            ]);
        }

        $result = $this->recaptchaService->verify($token, $action);

        return response()->json($result);
    }
}