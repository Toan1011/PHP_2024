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
    <title>Edit Issue</title>
</head>
<body>

<h1 style="margin: 50px 50px">Cập nhật thông tin Issue</h1>

<form action="{{ route('issues.update', $issues->id) }}" method="POST" style="margin: 50px 50px">
    @csrf
    @method('PUT')

    <!-- Reported By -->
    <div class="form-group">
        <label for="reported_by">Người báo cáo</label>
        <input type="text" name="reported_by" class="form-control" value="{{ $issues->reported_by }}" required>
    </div>

    <!-- Reported Date -->
    <div class="form-group">
        <label for="reported_date">Ngày báo cáo</label>
        <input type="date" name="reported_date" class="form-control" value="{{ $issues->reported_date }}" required>
    </div>

    <!-- Description -->
    <div class="form-group">
        <label for="description">Mô tả</label>
        <textarea name="description" class="form-control" rows="3" required>{{ $issues->description }}</textarea>
    </div>

    <!-- Urgency -->
    <div class="form-group">
        <label for="urgency">Độ khẩn cấp</label>
        <select name="urgency" class="form-control" required>
            <option value="Low" {{ $issues->urgency == 'Low' ? 'selected' : '' }}>Thấp</option>
            <option value="Medium" {{ $issues->urgency == 'Medium' ? 'selected' : '' }}>Trung bình</option>
            <option value="High" {{ $issues->urgency == 'High' ? 'selected' : '' }}>Cao</option>
        </select>
    </div>

    <!-- Status -->
    <div class="form-group">
        <label for="status">Trạng thái</label>
        <select name="status" class="form-control" required>
            <option value="Open" {{ $issues->status == 'Open' ? 'selected' : '' }}>Mở</option>
            <option value="In Progress" {{ $issues->status == 'In Progress' ? 'selected' : '' }}>Đang xử lý</option>
            <option value="Resolved" {{ $issues->status == 'Resolved' ? 'selected' : '' }}>Đã giải quyết</option>
        </select>
    </div>

    <!-- Computer ID -->
    <div class="form-group">
        <label for="computer_id">ID Máy tính</label>
        <select name="computer_id" class="form-control" required>
            @foreach($computers as $computer)
                <option value="{{ $computer->id }}" {{ $computer->id == $issues->computer_id ? 'selected' : '' }}>
                    Máy tính {{ $computer->id }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>

</body>
</html>
