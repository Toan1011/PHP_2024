<!-- views/admin/news/edit.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <a href="index.php?controller=admin&action=index" class="btn btn-secondary mb-3">Back to news</a>

        <h2 class="mb-4">Update News</h2>

        <form action="index.php?controller=admin&action=edit&id=<?= $news->getId(); ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input value="<?= $news->getTitle(); ?>" type="text" id="title" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea id="content" name="content" class="form-control" rows="5" required><?= $news->getContent(); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" class="form-control" id="category_id" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category->getId(); ?>" <?php echo $news->getCategoryId() == $category->getId() ? 'selected' : ''; ?>>
                            <?php echo $category->getName(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" id="image" name="image" class="form-control">
                <div class="mt-2">
                    <img src="<?= $news->getImage(); ?>" alt="Product Image" style="width: 100px;">
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Update News</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>