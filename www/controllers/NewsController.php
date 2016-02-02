<?php

//require_once __DIR__ . '/../models/news.php';

class NewsController
{
    private $path;

    public function __construct()
    {
        NewsModel::init();
        $this->path = $_GET['ctrl'] . '/' . $_GET['act'] . '.php';
    }

    public function actionAll()
    {
//        $news->title = 'TRY new!!!';
//        $news->text = 'I\'m trying';
//        $news->id = 15;
//        $news->insert();
//        $news->update();

        $view = new NewsView;
        $view->items = NewsModel::getAll();
        $view->display('news/all.php');
    }

    public function actionOne()
    {
        $view = new NewsView;
        $view->item = NewsModel::get($_GET['id']);
        $view->display('news/one.php');
    }

    public function actionAdd()
    {
        $article = new NewsModel;
        $article->title = $_GET['title'];
        $article->text = $_GET['text'];
        $article->save();
    }

    public function actionDel()
    {
        NewsModel::remove($_GET['id']);
    }
}
