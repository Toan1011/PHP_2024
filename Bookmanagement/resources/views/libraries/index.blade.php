<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Danh sách thư viện</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        /* CSS giữ nguyên như phiên bản trước */
    </style>
</head>
<body>
<div class="container-xl">
    <div class="table-wrapper">
        <div class="table-title">
            <h2 class="text-center">Danh sách thư viện</h2>
            <button class="btn btn-success float-right" data-toggle="modal" data-target="#addBookModal">
                <i class="material-icons">&#xE147;</i> <span>Thêm sách</span>
            </button>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Chọn</th>
                <th>Tên thư viện</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach($libraries as $library)
                <tr>
                    <td>
                        <span class="custom-checkbox">
                            <input type="checkbox" id="checkbox{{ $library->id }}" name="options[]" value="{{ $library->id }}">
                            <label for="checkbox{{ $library->id }}"></label>
                        </span>
                    </td>
                    <td>{{ $library->name }}</td>
                    <td>{{ $library->address }}</td>
                    <td>{{ $library->contact_number }}</td>
                    <td>
                        <!-- Xem sách -->
                        <a href="{{ route('libraries.index', $library->id) }}" class="view">
                            <i class="material-icons" data-toggle="tooltip" title="View Books">&#xE8F4;</i>
                        </a>
                        <!-- Xóa thư viện -->
                        <a href="#deleteLibraryModal" class="delete" data-toggle="modal" data-id="{{ $library->id }}">
                            <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Thêm Sách -->
<div id="addBookModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('books.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Thêm sách</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="library_id">Thư viện</label>
                        <select name="library_id" id="library_id" class="form-control">
                            @foreach($libraries as $library)
                                <option value="{{ $library->id }}">{{ $library->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Tên sách</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <label for="publication_year">Năm xuất bản</label>--}}
{{--                        <input type="number" name="publication_year" id="publication_year" class="form-control" required>--}}
{{--                    </div>--}}
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
                    <input type="submit" class="btn btn-success" value="Thêm">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
