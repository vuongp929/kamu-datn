@extends('layouts.admin')

@section('title', 'Quản Lý Tài Khoản')

@section('css')
    <style>
        .dataTables_length {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <div class="container-xxl">

            <!-- Tiêu đề -->
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Quản lý tài khoản</h4>
                </div>
                {{-- <div class="ms-sm-auto">
                    <a href="{{ route('admins.admins.taikhoans.create') }}" class="btn btn-primary">Thêm tài khoản</a>
                </div> --}}
            </div>

            <!-- Bảng danh sách -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title mb-0">Danh sách tài khoản</h5>
                        </div>

                        <div class="card-body">

                            {{-- Thông báo thành công --}}
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table id="table" class="datatable table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Tên</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Địa chỉ</th>
                                            <th scope="col">Điện thoại</th>
                                            <th scope="col">Vai trò</th>
                                            <th scope="col">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listUser as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>
                                                    <a style="margin-right: 35px;" href="{{ route('admins.taikhoans.edit', $user->id) }}">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    
                                                    <button type="button" class="btn border-0 p-0 text-danger"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#removeItemModal"
                                                            data-url="{{ route('admins.taikhoans.destroy', $user->id) }}">
                                                        <i class="bi bi-trash3-fill"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div> <!-- end card-body -->

                        {{-- box xóa đùn chung Admin  --}}

                            <div class="modal fade" id="removeItemModal" tabindex="-1" aria-labelledby="removeItemModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="removeItemModalLabel">Xác nhận xóa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                                        </div>
                                        <div class="modal-body">
                                            Bạn có chắc chắn muốn xóa tài khoản này không? Hành động này không thể hoàn tác.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                            <form id="deleteForm" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Xóa</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- end container-xxl -->
    </div> <!-- end content -->
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                pageLength: 8
            });
        });
    </script>
   
   {{-- modal box xóa --}}

   <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('[data-bs-target="#removeItemModal"]');
            const deleteForm = document.getElementById('deleteForm');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const url = button.getAttribute('data-url');
                    deleteForm.setAttribute('action', url);
                });
            });
        });
    </script>

@endsection
