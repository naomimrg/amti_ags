<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RecaptchaService
{
    private $secretKey;
    private $siteKey;
    private $minScore;

    public function __construct()
    {
        $this->secretKey = config('services.recaptcha.secret_key');
        $this->siteKey = config('services.recaptcha.site_key');
        $this->minScore = config('services.recaptcha.min_score', 0.5);
    }

    /**
     * Verify reCAPTCHA v3 token
     */
    public function verify($token, $action = null)
    {
        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $this->secretKey,
                'response' => $token,
                'remoteip' => request()->ip()
            ]);

            $result = $response->json();

            if (!$response->successful()) {
                Log::error('reCAPTCHA API request failed', ['response' => $result]);
                return [
                    'success' => false,
                    'error' => 'Failed to contact reCAPTCHA service',
                    'score' => 0
                ];
            }

            // Check if verification was successful
            if (!$result['success']) {
                Log::warning('reCAPTCHA verification failed', [
                    'error_codes' => $result['error-codes'] ?? [],
                    'token' => substr($token, 0, 10) . '...'
                ]);

                return [
                    'success' => false,
                    'error' => $this->getErrorMessage($result['error-codes'] ?? []),
                    'score' => 0,
                    'error_codes' => $result['error-codes'] ?? []
                ];
            }

            $score = $result['score'] ?? 0;
            $resultAction = $result['action'] ?? '';

            // Validate action if provided
            if ($action && $resultAction !== $action) {
                Log::warning('reCAPTCHA action mismatch', [
                    'expected' => $action,
                    'actual' => $resultAction
                ]);

                return [
                    'success' => false,
                    'error' => 'Invalid reCAPTCHA action',
                    'score' => $score
                ];
            }

            // Check score threshold
            if ($score < $this->minScore) {
                Log::info('reCAPTCHA score below threshold', [
                    'score' => $score,
                    'threshold' => $this->minScore,
                    'ip' => request()->ip()
                ]);

                return [
                    'success' => false,
                    'error' => 'reCAPTCHA score too low. Possible bot detected.',
                    'score' => $score
                ];
            }

            Log::info('reCAPTCHA verification successful', [
                'score' => $score,
                'action' => $resultAction
            ]);

            return [
                'success' => true,
                'score' => $score,
                'action' => $resultAction
            ];
        } catch (\Exception $e) {
            Log::error('reCAPTCHA verification exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'error' => 'reCAPTCHA verification failed due to system error',
                'score' => 0
            ];
        }
    }

    /**
     * Get user-friendly error message
     */
    private function getErrorMessage($errorCodes)
    {
        $messages = [
            'missing-input-secret' => 'Missing reCAPTCHA secret key',
            'invalid-input-secret' => 'Invalid reCAPTCHA secret key',
            'missing-input-response' => 'Missing reCAPTCHA token',
            'invalid-input-response' => 'Invalid reCAPTCHA token',
            'bad-request' => 'Bad reCAPTCHA request',
            'timeout-or-duplicate' => 'reCAPTCHA timeout or duplicate submission'
        ];

        foreach ($errorCodes as $code) {
            if (isset($messages[$code])) {
                return $messages[$code];
            }
        }

        return 'reCAPTCHA verification failed';
    }

    /**
     * Get site key for frontend
     */
    public function getSiteKey()
    {
        return $this->siteKey;
    }

    /**
     * Get minimum score threshold
     */
    public function getMinScore()
    {
        return $this->minScore;
    }
}

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RecaptchaService
{
    private $secretKey;
    private $siteKey;
    private $minScore;

    public function __construct()
    {
        $this->secretKey = config('services.recaptcha.secret_key');
        $this->siteKey = config('services.recaptcha.site_key');
        $this->minScore = config('services.recaptcha.min_score', 0.5);
    }

    /**
     * Verify reCAPTCHA v3 token
     */
    public function verify($token, $action = null)
    {
        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $this->secretKey,
                'response' => $token,
                'remoteip' => request()->ip()
            ]);

            $result = $response->json();

            if (!$response->successful()) {
                Log::error('reCAPTCHA API request failed', ['response' => $result]);
                return [
                    'success' => false,
                    'error' => 'Failed to contact reCAPTCHA service',
                    'score' => 0
                ];
            }

            // Check if verification was successful
            if (!$result['success']) {
                Log::warning('reCAPTCHA verification failed', [
                    'error_codes' => $result['error-codes'] ?? [],
                    'token' => substr($token, 0, 10) . '...'
                ]);

                return [
                    'success' => false,
                    'error' => $this->getErrorMessage($result['error-codes'] ?? []),
                    'score' => 0,
                    'error_codes' => $result['error-codes'] ?? []
                ];
            }

            $score = $result['score'] ?? 0;
            $resultAction = $result['action'] ?? '';

            // Validate action if provided
            if ($action && $resultAction !== $action) {
                Log::warning('reCAPTCHA action mismatch', [
                    'expected' => $action,
                    'actual' => $resultAction
                ]);

                return [
                    'success' => false,
                    'error' => 'Invalid reCAPTCHA action',
                    'score' => $score
                ];
            }

            // Check score threshold
            if ($score < $this->minScore) {
                Log::info('reCAPTCHA score below threshold', [
                    'score' => $score,
                    'threshold' => $this->minScore,
                    'ip' => request()->ip()
                ]);

                return [
                    'success' => false,
                    'error' => 'reCAPTCHA score too low. Possible bot detected.',
                    'score' => $score
                ];
            }

            Log::info('reCAPTCHA verification successful', [
                'score' => $score,
                'action' => $resultAction
            ]);

            return [
                'success' => true,
                'score' => $score,
                'action' => $resultAction
            ];
        } catch (\Exception $e) {
            Log::error('reCAPTCHA verification exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'error' => 'reCAPTCHA verification failed due to system error',
                'score' => 0
            ];
        }
    }

    /**
     * Get user-friendly error message
     */
    private function getErrorMessage($errorCodes)
    {
        $messages = [
            'missing-input-secret' => 'Missing reCAPTCHA secret key',
            'invalid-input-secret' => 'Invalid reCAPTCHA secret key',
            'missing-input-response' => 'Missing reCAPTCHA token',
            'invalid-input-response' => 'Invalid reCAPTCHA token',
            'bad-request' => 'Bad reCAPTCHA request',
            'timeout-or-duplicate' => 'reCAPTCHA timeout or duplicate submission'
        ];

        foreach ($errorCodes as $code) {
            if (isset($messages[$code])) {
                return $messages[$code];
            }
        }

        return 'reCAPTCHA verification failed';
    }

    /**
     * Get site key for frontend
     */
    public function getSiteKey()
    {
        return $this->siteKey;
    }

    /**
     * Get minimum score threshold
     */
    public function getMinScore()
    {
        return $this->minScore;
    }
}