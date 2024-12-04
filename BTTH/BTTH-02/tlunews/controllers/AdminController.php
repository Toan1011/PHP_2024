<?php
// controllers/AdminController.php

require_once 'services/NewsService.php';
require_once 'services/CategoryService.php';
require_once 'services/UserService.php';
class AdminController
{
    private $newsService;

    public function __construct()
    {
        $this->newsService = new NewsService();
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $userService = new UserService();
            $user = $userService->login($username, $password);

            if ($user) {
                $_SESSION['user'] = [
                    'id' => $user->getId(),
                    'username' => $user->getUsername(),
                    'role' => $user->getRole(),
                ];
                header("Location: index.php?controller=admin&action=dashboard");
                exit();
            } else {
                $error_message = "Invalid username or password!";
            }
        }

        require_once 'views/admin/login.php';
    }


    public function dashboard()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=admin&action=login");
            exit();
        }

        require_once 'views/admin/dashboard.php';
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: index.php?controller=admin&action=login");
        exit();
    }

    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=admin&action=login");
            exit();
        }

        $newsService = new NewsService();
        $newsList = $newsService->getAllNews();
        $categoryService = new CategoryService();
        $categories = $categoryService->getAllCategories();
        require_once 'views/admin/news/index.php';
    }

    public function add()
    {
        $errorMessages = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];

            if (empty($title) || empty($content) || empty($category_id)) {
                $errorMessages[] = "All fields are required!";
            }

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $imageUploadResult = $this->uploadImage($_FILES['image']);
                if (strpos($imageUploadResult, 'Error') === false && strpos($imageUploadResult, 'Invalid') === false && strpos($imageUploadResult, 'too large') === false) {
                    $image = $imageUploadResult;
                } else {
                    $errorMessages[] = $imageUploadResult;
                }
            } else {
                $errorMessages[] = "Image is required!";
            }

            if (empty($errorMessages)) {
                $news = new News(null, $title, $content, $image, date("Y-m-d H:i:s"), $category_id);
                if ($this->newsService->addNews($news)) {
                    header("Location: index.php?controller=admin&action=index&success=true");
                    exit();
                } else {
                    $errorMessages[] = "Error adding product!";
                }
            }
        }

        $categoryService = new CategoryService();
        $categories = $categoryService->getAllCategories();
        include 'views/admin/news/add.php';
    }

    private function uploadImage($file)
    {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($file['name']);
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $maxFileSize = 2000000;

        if ($file['size'] > $maxFileSize) {
            return "File is too large. Maximum size is 2MB.";
        }

        $fileExtension = pathinfo($uploadFile, PATHINFO_EXTENSION);
        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            return "Invalid file format. Only JPG, JPEG, PNG, and GIF are allowed.";
        }

        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            return $uploadFile;
        } else {
            return "Error uploading file.";
        }
    }

    public function edit($id)
    {
        $news = $this->newsService->getNewsById($id);
        $currentImage = $news->getImage();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $news->setTitle($_POST['title']);
            $news->setContent($_POST['content']);
            $news->setCategoryId($_POST['category_id']);

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $imageUploadResult = $this->uploadImage($_FILES['image']);
                if (strpos($imageUploadResult, 'Error') === false && strpos($imageUploadResult, 'Invalid') === false && strpos($imageUploadResult, 'too large') === false) {
                    $news->setImage($imageUploadResult);
                } else {
                    $errorMessages[] = $imageUploadResult;
                }
            } else {
                $news->setImage($currentImage);
            }

            if (empty($errorMessages)) {
                if ($this->newsService->updateNews($news)) {
                    header("Location: index.php?controller=admin&action=index&success=true");
                    exit();
                } else {
                    $errorMessages[] = "Error updating product!";
                }
            }
        }

        $categoryService = new CategoryService();
        $categories = $categoryService->getAllCategories();
        include 'views/admin/news/edit.php';
    }

    public function delete($id)
    {
        if ($this->newsService->deleteNews($id)) {
            header("Location: index.php?controller=admin&action=index&success=true");
            exit();
        } else {
            echo "Error deleting product!";
        }
    }
}
