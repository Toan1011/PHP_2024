<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
          crossorigin="anonymous">
    <title>Add Issue</title>
</head>
<body>
<h1 style="margin: 50px 50px">Thêm Issue mới</h1>
<form action="{{ route('issues.store') }}" method="POST" style="margin: 50px 50px">
    @csrf
    <!-- Reported By -->
    <div class="mb-3">
        <label for="reported_by" class="form-label">Người báo cáo</label>
        <input type="text" class="form-control" id="reported_by" name="reported_by" required>
    </div>

    <!-- Reported Date -->
    <div class="mb-3">
        <label for="reported_date" class="form-label">Ngày báo cáo</label>
        <input type="date" class="form-control" id="reported_date" name="reported_date" required>
    </div>

    <!-- Description -->
    <div class="mb-3">
        <label for="description" class="form-label">Mô tả</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>

    <!-- Urgency -->
    <div class="mb-3">
        <label for="urgency" class="form-label">Độ khẩn cấp</label>
        <select class="form-control" id="urgency" name="urgency" required>
            <option value="Low">Thấp</option>
            <option value="Medium">Trung bình</option>
            <option value="High">Cao</option>
        </select>
    </div>

    <!-- Status -->
    <div class="mb-3">
        <label for="status" class="form-label">Trạng thái</label>
        <select class="form-control" id="status" name="status" required>
            <option value="Open">Mở</option>
            <option value="In Progress">Đang xử lý</option>
            <option value="Resolved">Đã giải quyết</option>
        </select>
    </div>

    <!-- Computer ID -->
    <div class="mb-3">
        <label for="computer_id" class="form-label">ID Máy tính</label>
        <select class="form-control" id="computer_id" name="computer_id" required>
            @foreach($computers as $computer)
                <option value="{{ $computer->id }}">Máy tính {{ $computer->id }}</option>
            @endforeach
        </select>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Thêm</button>
</form>
</body>
</html>
