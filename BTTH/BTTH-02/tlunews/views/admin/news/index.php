<!-- views/admin/news/index.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - News Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">News Management</h2>
        <a href="index.php?controller=admin&action=dashboard" class="btn btn-secondary mb-3">Back to dashboard</a>

        <?php if (isset($_GET['success']) && $_GET['success'] == 'true'): ?>
            <div class="alert alert-success" id="success-message">
                Action completed successfully!
            </div>
        <?php endif; ?>
        <!-- Table for listing news -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Content</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($newsList as $item): ?>
                    <tr>
                        <td><?= $item->getId(); ?></td>
                        <td><img src="<?php echo $item->getImage(); ?>" alt="News Image" style="width: 100px;"></td>
                        <td><?= $item->getTitle(); ?></td>
                        <td><?php
                            $category = null;
                            if (!empty($categories)) {
                                foreach ($categories as $cat) {
                                    if ($cat->getId() == $item->getCategoryId()) {
                                        $category = $cat;
                                        break;
                                    }
                                }
                            }
                            echo $category ? $category->getName() : 'N/A';
                            ?></td>
                        <td><?= $item->getContent() ?></td>
                        <td>
                            <a href="index.php?controller=admin&action=edit&id=<?= $item->getId(); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="index.php?controller=admin&action=delete&id=<?= $item->getId(); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this news item?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="index.php?controller=admin&action=add" class="btn btn-primary">Add New News</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        <?php if (isset($_GET['success']) && $_GET['success'] == 'true'): ?>
            setTimeout(function() {
                var successMessage = document.getElementById('success-message');
                if (successMessage) {
                    successMessage.style.display = 'none';
                }
            }, 3000); // 3 giây
        <?php endif; ?>
    </script>
</body>

</html>