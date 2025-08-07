@extends('layouts.admin')
@section('title', 'Daftar Account Admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ url('/assets') }}/css/dataTables.bootstrap4.min.css">
 <style>
.form-group{
    margin-bottom: 10px;
}
</style>

@endsection
@section('content')

<div class="col-12">
    <div class="row">
        <div class="col-6">
            <h5 class="black-color">Daftar Account Admin</h5>
        </div>
        <div class="col-6" style="text-align:right;">
            <button type="button" data-action="add" id="btn-add" style="float:right;margin-bottom: 10px;" class="action btn btn-primary">Tambah Account Admin</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card" style="padding:10px">
                <div class="table-body">
                    <div class="table-responsive" style="overflow-x: hidden;">
                        <table id="table-admin" class="table table-bordered" style="font-size: 11px;">
                            <thead style="background: #0ec8cf;color: white;">
                                <tr class=" text-center">
                                    <th style="color: white;">No</th>
                                    <th style="color: white;">Role</th>
                                    <th style="color: white;">Nama</th>
                                    <th style="color: white;">Email</th>
                                    <th style="color: white;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->

<!-- Modal ADD-->
<div id="modal-add" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Account Admin</h5>
            </div>
            <form id="form-add" autocomplete="off" method="POST" action="{{ route('admin.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label><b>Pilih Role</b></label>
                        <select id="role" class="form-control select2" name="role" data-placeholder="role" required="required">
                            <option value="">-- Silahkan Pilih Role --</option>
                            <option value="Super Admin">Super Admin</option>
                            <option value="Admin GSI">Admin GSI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><b>Nama</b></label>
                        <input type="text" class="form-control" placeholder="Nama" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label><b>Email</b></label>
                        <input type="text" class="form-control" placeholder="Email" name="email" id="email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal EDIT-->
<div id="modal-edit" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Account Admin</h5>
            </div>
            <form id="form-edit" autocomplete="off" method="POST" action="{{ route('admin.update', ':id') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label><b>Pilih Role</b></label>
                        <select id="role" class="form-control select2" name="role" data-placeholder="role" required="required">
                            <option value="">-- Silahkan Pilih Role --</option>
                            <option value="Super Admin">Super Admin</option>
                            <option value="Admin GSI">Admin GSI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><b>Nama</b></label>
                        <input type="text" class="form-control" placeholder="Nama" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label><b>Email</b></label>
                        <input type="text" class="form-control" placeholder="Email" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label><b>Password</b></label>
                        <input type="text" class="form-control" placeholder="Password" name="password" id="password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                </div>
            </form>
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

let tableAdmin;
$(function() {
    tableAdmin = $('#table-admin').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('/admin/list-admin') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'role', name: 'role'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action'},
        ]
    });
});

$(document).on('click', "#btn-add", function() {
    $('#modal-add').modal('show');
});

$(document).on('submit', '#form-add', function (e) {
    e.preventDefault();

    let formData = $(this).serialize();
    $.ajax({
        url: $(this).attr('action'),
        method: "POST",
        data: formData,
        success: function (response) {
            swal({
                title: "Success!",
                text: "Data berhasil disimpan",
                type: "success",
            });
            $('#modal-add').modal('hide');
            $('#form-add')[0].reset();
            tableAdmin.draw();
        },
        error: function (xhr) {
            alert('Error: ' + xhr.responseJSON.message);
        }
    });
});

$(document).on('click', '#btn-edit', function () {
    // Get data from the row or button
    const userId = $(this).data('id');
    const name = $(this).data('name');
    const email =  $(this).data('email');
    const role =  $(this).data('role');

    // Set the form action dynamically
    const url = "{{ route('admin.update', ':id') }}".replace(':id', userId);
    $('#form-edit').attr('action', url);

    // Populate the form fields with the data
    $('#form-edit #name').val(name);
    $('#form-edit #email').val(email);
    $('#form-edit #role').val(role).trigger('change'); // Use trigger for select2
    $('#form-edit #password').val(''); // Clear the password field

    // Show the modal
    $('#modal-edit').modal('show');
});

$(document).on('submit', '#form-edit', function (e) {
    e.preventDefault();

    let formData = $(this).serialize();
    $.ajax({
        url: $(this).attr('action'),
        method: "POST",
        data: formData,
        success: function (response) {
            swal({
                title: "Success!",
                text: "Data berhasil diubah!",
                type: "success",
            });
            $('#modal-edit').modal('hide');
            $('#form-edit')[0].reset();
            tableAdmin.draw();
        },
        error: function (xhr) {
            alert('Error: ' + xhr.responseJSON.message);
        }
    });
});

$(document).on('click', '#btn-delete', function () {
    swal({
      title: 'Hapus?',
      text: "Anda yakin akan menghapus Account ini ?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Hapus'
 }).then((result) => {
   if (result.value == true) {
        const userId = $(this).data('id');
        const url = "{{ route('admin.destroy', ':id') }}".replace(':id', userId);

        $.ajax({
            url: url,
            method: "DELETE",
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                swal({
                    title: "Success!",
                    text: response.success,
                    icon: "success",
                });
                tableAdmin.draw();
            },
            error: function(xhr) {
                swal({
                    title: "Error!",
                    text: "Account gagal dihapus.",
                    icon: "error",
                });
            }
        });
   }
 });
});
</script>
@endsection
