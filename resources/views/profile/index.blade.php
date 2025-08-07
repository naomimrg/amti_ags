@extends('layouts.admin')
@section('title', 'My Profile')
@section('style')
 <style>
.form-group{
    margin-bottom: 10px;
}
</style>

@endsection
@section('content')

                    <div class="col-12">
                        <div class="row">    
                            <div class="card mb-4">
                                <h5 class="card-header">Profile Setting</h5>
                                <!-- Account -->
                                <div class="card-body">
                                <form id="form" method="POST" style="width:50%;">
                                {{ csrf_field() }}

                                    <div class="row">
                                    <div class="mb-3 col-12">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input
                                        class="form-control"
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{$profile->name}}"
                                        autofocus />
                                    </div>
                                    <div class="mb-3 col-12">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input
                                        class="form-control"
                                        type="text"
                                        id="email"
                                        name="email"
                                        value="{{$profile->email}}"
                                        placeholder="Email" disabled/>
                                    </div>
                                    <div class="mb-3 col-12">
                                        <label for="email" class="form-label">Password</label>
                                        <input
                                        class="form-control"
                                        type="password"
                                        id="password"
                                        name="password"
                                        value=""
                                        placeholder="*******" />
                                    </div>
                                    <div class="mt-2">
                                    <button id="submit_btn" type="submit" class="btn btn-primary me-2">Save changes</button>
                                    </div>
                                </form>
                                </div>
                                <!-- /Account -->
                            </div>
                        </div>
                    </div>
                </div>

@endsection
@section('script')
<script src="{{ url('/assets') }}/js/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('/assets') }}/js/datatables/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'csrftoken': '{{ csrf_token() }}'
        }
    });
    $('body').on('submit', '#form', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ url('/updateProfile') }}",
            method : 'POST',
            data : $('#form').serialize(),
            beforeSend: function() {
                $('#submit_btn').text('Loading');
                $('#submit_btn').attr('disabled', true);
            },
            success : function(data) {
                $('#submit_btn').text('Simpan');
                $('#submit_btn').attr('disabled', false);
                if ($.isEmptyObject(data.error)) {
                    swal({
                        title: "Success!",
                        text: data.success,
                        type: "success",
                    });
                } else {
                    swal({
                        title: "Error!",
                        text: data.error,
                        type: "error",
                    });
                }
            }
        });
    });
   
    $('form').bind("keypress", function(e) {
        if (e.keyCode == 13) {               
            e.preventDefault();
            return false;
        }
    });
</script>
@endsection