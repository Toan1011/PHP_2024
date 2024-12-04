<!-- views/admin/dashboard.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .description{
        }
    </style>
</head>

<body>
    <div class="bg-primary text-white text-center py-3">
        <h1>Welcome to the Admin Dashboard</h1>
    </div>

    <div class="container">
        <?php
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=admin&action=login");
            exit();
        }    

        $user = $_SESSION['user'];
        ?>

        <div class="my-4">
            <p class="h4 text-center mb-3">Hello, <?php echo htmlspecialchars($user['username']); ?>!</p>
            <p class="description">Here is the admin dashboard. You can manage your website, view statistics, and more!</p>

            <a href="index.php?controller=admin&action=index" class="btn btn-primary">News</a>
            <a href="index.php?controller=admin&action=logout" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>