<?php
//controllers/HomeController.php
require_once 'services/NewsService.php';
require_once 'services/CategoryService.php';

class HomeController
{
    public function index()
    {
        $newsService = new NewsService();
        $news = $newsService->getAllNews();

        $categoryService = new CategoryService();
        $categories = $categoryService->getAllCategories();
        require_once 'views/home/index.php';
    }
}
