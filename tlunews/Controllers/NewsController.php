<?php
require_once './models/News.php';

class NewsController {
    private $newsModel;

    public function __construct($db) {
        $this->newsModel = new News($db);
    }

    public function index() {
        $newsList = $this->newsModel->getAll();
        require_once './views/admin/news/index.php';
        return $newsList;
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':title' => $_POST['title'],
                ':content' => $_POST['content'],
                ':image' => $_POST['image'], // Cần upload file thực tế
                ':category_id' => $_POST['category_id']
            ];
            $this->newsModel->add($data);
            header("Location: /BTTH02/tlunews/admin/news");
            exit();
        }
        require 'views/admin/news/add.php';
    }

    public function edit($id) {
        $newsItem = $this->newsModel->getById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':title' => $_POST['title'],
                ':content' => $_POST['content'],
                ':image' => $_POST['image'], // Cần upload file thực tế
                ':category_id' => $_POST['category_id']
            ];
            $this->newsModel->update($id, $data);
            header("Location: /BTTH02/tlunews/admin/news");
            exit();
        }
        require 'views/admin/news/edit.php';
    }

    public function delete($id) {
        $this->newsModel->delete($id);
        header("Location: /BTTH02/tlunews/admin/news");
        exit();
    }
}
?>