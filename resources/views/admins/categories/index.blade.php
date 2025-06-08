@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection
@section('css')
    <style>
        .dataTables_length {
            display: none;
        }
        .tat_ca{
            margin-left: 10px;
        }

    </style>
@endsection



@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Quản lý danh mục sản phẩm</h4>
                </div>
            </div>
            <div class="row">
                <!-- Striped Rows -->
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title mb-0 align-content-center "> {{ $title }}</h5>
                            <a href="{{ route('admins.categories.create') }}" class="btn btn-primary"><i
                                    data-feather="plus-square"></i> Thêm danh mục </a>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show">
                                        <strong>{{ session('success') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <form method="GET" action="{{ route('admins.categories.index') }}" class="mb-3 d-flex justify-content-end">
                                    <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control w-25 me-2"
                                        placeholder="Tìm theo tên danh mục...">
                                    <button type="submit" class="btn btn-primary">Tìm </button>
                                    <a href="{{ route('admins.categories.index') }}" class="btn btn-primary tat_ca"> Tất cả</a>
                                </form>

                                <table id="allTable" class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            {{-- <th scope="col">#</th> --}}
                                            <th class="text-center align-middle" scope="col">Hình ảnh</th>
                                            <th class="text-center align-middle" scope="col">Tên danh mục</th>
                                            <th class="text-center align-middle" scope="col">Trạng thái</th>
                                            <th class="text-center align-middle" scope="col">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listDanhMuc as $index => $item)
                                            <tr>
                                                <td class="text-center align-middle">
                                                    <img src="{{ Storage::url($item->hinh_anh) }}"
                                                        alt="Hình ảnh {{ $item->name }}"
                                                        width="80px"
                                                        height="80px"
                                                        class="rounded" {{-- Hoặc dùng 'rounded' nếu muốn chỉ bo nhẹ --}}
                                                        style="object-fit: cover; cursor: pointer;"
                                                        title="{{ $item->name }}">
                                                </td>

                                                <td class="text-center align-middle">{{ $item->name }}</td>
                                                <td class="text-center align-middle">
                                                    <span class="badge {{ $item->trang_thai ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $item->trang_thai ? 'Hiển thị' : 'Ẩn' }}
                                                    </span>
                                                </td>

                                                <td class="text-center align-middle">
                                                    <a href="{{ route('admins.categories.edit', $item) }}" style="margin-right: 35px;">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <a class="border-0 p-0 text-danger" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#removeItemModal" data-id="{{ $item->id }}"
                                                        data-action="{{ route('admins.categories.destroy', $item) }}">
                                                        <i class="bi bi-trash3-fill"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                {{-- <div class="mt-3">
                                    {{ $listDanhMuc->links('pagination::bootstrap-5') }}
                                </div> --}}
                                <div class="mt-3 d-flex justify-content-center">
                                    {{ $listDanhMuc->appends(request()->query())->links('pagination::bootstrap-5') }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Confirm Delete -->
            <div class="modal fade" id="removeItemModal" tabindex="-1" aria-labelledby="removeItemModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="removeItemModalLabel">Xác nhận xóa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Bạn có chắc chắn muốn xóa danh mục này không? Hành động này không thể hoàn tác.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <!-- Form gửi yêu cầu xóa -->
                            <form id="deleteForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </div> <!-- container-fluid -->
    </div> <!-- content -->
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('table.datatable').each(function() {
                $(this).DataTable({
                    "paging": true, // Hiển thị phân trang
                    "searching": true, // Tìm kiếm
                    "ordering": true, // Sắp xếp
                    "info": true, // Hiển thị thông tin
                    "pageLength": 6 // Số dòng mỗi trang
                });
            });
        });

        $(document).on('click', '[data-bs-toggle="modal"]', function () {
            var actionUrl = $(this).data('action');
            var itemId = $(this).data('id');
            
            $('#removeItemModal #deleteForm').attr('action', actionUrl);
            
        });

    </script>
    
@endsection
