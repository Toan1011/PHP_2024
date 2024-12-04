<!-- views/news/detail.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($news->getTitle()) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing: border-box
        }


        body{
        }

        .header{
            display: flex;
            align-items: center;
            justify-content: space-between
        }

        .header h1{
            margin-bottom:0;
        }

        .content{
            display: flex;
            gap: 32px;
            align-items: center;
            margin:  64px 0;
        }

        .content .image{
            flex: 1;
        }

        .content .image img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .content .right{
            flex: 1;
        }

        .content  .category{
            border: 1px solid #000;
            width: fit-content;
            border-radius: 8px;
            padding: 2px 4px;
            font-weight: 700;
            font-size: 18px;
        }

        .content .created-at{
            font-style: italic;
            color: rgb(156 163 175);
        }

    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="header">

            <a href="index.php"><svg fill="#000000" height="64px" width="64px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26.676 26.676" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="1.227096"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M26.105,21.891c-0.229,0-0.439-0.131-0.529-0.346l0,0c-0.066-0.156-1.716-3.857-7.885-4.59 c-1.285-0.156-2.824-0.236-4.693-0.25v4.613c0,0.213-0.115,0.406-0.304,0.508c-0.188,0.098-0.413,0.084-0.588-0.033L0.254,13.815 C0.094,13.708,0,13.528,0,13.339c0-0.191,0.094-0.365,0.254-0.477l11.857-7.979c0.175-0.121,0.398-0.129,0.588-0.029 c0.19,0.102,0.303,0.295,0.303,0.502v4.293c2.578,0.336,13.674,2.33,13.674,11.674c0,0.271-0.191,0.508-0.459,0.562 C26.18,21.891,26.141,21.891,26.105,21.891z"></path> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </g> </g></svg></a>
            
            <h1><?= $news->getTitle(); ?></h1>
            <div style="width: 64px;"></div>
        </div>
        <div class="content">
            <div class="image">
                <img src="<?= $news->getImage() ?>" alt="Image" class="img-fluid">
            </div>

            <div class="right">

                <p class="category">
                    <?php
            $category = null;
            if (!empty($categories)) {
                foreach ($categories as $cat) {
                    if ($cat->getId() == $news->getCategoryId()) {
                        $category = $cat;
                        break;
                    }
                }
            }
            echo $category ? $category->getName() : 'N/A';
            ?>
        </p>
        <p class="created-at"> <?= $news->getCreatedAt() ?></p>
    </div>
</div>
<p class="content"><?= $news->getContent() ?></p>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>