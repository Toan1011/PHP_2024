<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .items {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
        }

        .items li {
            border: 1px solid #eee;
            border-top-width: 1px!important;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            transition: transform 0.1s ease-in-out;
        }

        .items li:hover {
            transform: scale(1.1);
        }

        .items li:not(:hover) {
            transform: scale(1);
        }

        .items a {
            color: #000;
            text-decoration: none;
        }

        .items .category {
            border-radius: 4px;
            padding: 2px 4px;
            width: fit-content;
            font-weight: 600;
            border: 1px solid #000;
        }

        .items .category-1 {
            background: rgb(240 253 250);
            color: rgb(13 148 136);
            border: 1px solid rgb(13 148 136);
        }

        .items .category-2 {
            background-color: rgb(217 249 157);
            color: rgb(21 128 61);
            border: 1px solid rgb(21 128 61);
        }

        .items .image {
            width: 100%;
            border-radius: 4px;
        }

        .items .image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .items .created-at {
            color: rgb(156 163 175);
            font-style: italic;
        }

        /* Chỉnh sửa chiều rộng của ô tìm kiếm */
        .search-input {
            width: 250px;
        }

        /* Căn chỉnh các phần tử login, input, button ngang hàng */
        .d-flex-align {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%; /* Đảm bảo phần tử chiếm hết chiều rộng */
        }

        /* Căn chỉnh ô tìm kiếm và nút search sang phải */
        .search-container {
            display: flex;
            gap: 10px;
        }
    </style>
</head>

<body>
<div class="container mt-4">
    <h1 class="text-center">Welcome to News</h1>

    <!-- Căn chỉnh các phần tử (login, input, button) ngang hàng và đẩy sang phải -->
    <div class="d-flex-align mb-4">
        <a href="index.php?controller=admin&action=login" class="btn btn-success">Login</a>

        <!-- Tạo một container chứa ô tìm kiếm và nút search, đẩy chúng sang phải -->
        <div class="search-container">
            <form action="index.php?controller=news&action=search" method="post" class="d-flex">
                <input type="text" name="keyword" class="form-control search-input" placeholder="Search news...">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>

    <?php if (!empty($news)): ?>
        <ul class="list-group items">
            <?php foreach ($news as $item): ?>
                <li class="list-group-item mb-3">
                    <a href="index.php?controller=news&action=detail&id=<?= $item->getId(); ?>">
                        <h5><?= $item->getTitle(); ?></h5>
                        <p class="category category-<?=$item->getCategoryId()?>">
                            <?php
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
                            ?>
                        </p>
                        <p class="content"> <?= $item->getContent() ?></p>
                        <p class="image"><img src="<?php echo $item->getImage(); ?>" alt="News Image" style="width: 100px;"></p>
                        <p class="created-at"> <?= $item->getCreatedAt() ?></p>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No news found.</p>
    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
