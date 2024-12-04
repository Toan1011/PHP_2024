<?php
// controllers/NewsController.php
require_once 'services/NewsService.php';
require_once 'services/CategoryService.php';

class NewsController
{
    private $newsService;
    private $categoryService;

    public function __construct()
    {
        $this->newsService = new NewsService();
        $this->categoryService = new CategoryService();
    }

    public function detail($id)
    {

        $news = $this->newsService->getNewsById($id);
        $categories = $this->categoryService->getAllCategories();
        require_once 'views/news/detail.php';
    }

    public function search()
    {
        $keyword = $_POST['keyword'] ?? '';
        $news = $this->newsService->searchNews($keyword);

        $categories = $this->categoryService->getAllCategories();

        require_once 'views/home/index.php';
    }
}
