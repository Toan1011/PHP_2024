<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Danh sách bán hàng</title>
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
            <h2 class="text-center">Danh sách giao dịch bán hàng</h2>
            <button class="btn btn-success float-right" data-toggle="modal" data-target="#addSaleModal">
                <i class="material-icons">&#xE147;</i> <span>Thêm giao dịch</span>
            </button>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Chọn</th>
                <th>Tên thuốc</th>
                <th>Số lượng</th>
                <th>Ngày bán</th>
                <th>Số điện thoại khách hàng</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>
                        <span class="custom-checkbox">
                            <input type="checkbox" id="checkbox{{ $sale->id }}" name="options[]" value="{{ $sale->id }}">
                            <label for="checkbox{{ $sale->id }}"></label>
                        </span>
                    </td>
                    <td>{{ $sale->medicine->name }}</td>
                    <td>{{ $sale->quantity }}</td>
                    <td>{{ $sale->sale_date }}</td>
                    <td>{{ $sale->customer_phone }}</td>
                    <td>
                        <!-- Chỉnh sửa -->
                        <a href="#editSaleModal" class="edit" data-toggle="modal"
                           data-id="{{ $sale->id }}"
                           data-medicine="{{ $sale->medicine->id }}"
                           data-quantity="{{ $sale->quantity }}"
                           data-sale_date="{{ $sale->sale_date }}"
                           data-customer_phone="{{ $sale->customer_phone }}">
                            <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                        </a>
                        <!-- Xóa -->
                        <a href="#deleteSaleModal" class="delete" data-toggle="modal" data-id="{{ $sale->id }}">
                            <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Thêm Giao Dịch -->
<div id="addSaleModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('sales.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Thêm giao dịch</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="medicine_id">Tên thuốc</label>
                        <select name="medicine_id" id="medicine_id" class="form-control">
                            @foreach($medicines as $medicine)
                                <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Số lượng</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sale_date">Ngày bán</label>
                        <input type="datetime-local" name="sale_date" id="sale_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="customer_phone">Số điện thoại khách hàng</label>
                        <input type="text" name="customer_phone" id="customer_phone" class="form-control">
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
