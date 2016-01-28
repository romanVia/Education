<?php

//require_once __DIR__ . '/../models/news.php';

class NewsController
{
    public function actionAll()
    {
        NewsModel::init();
//        $news->title = 'TRY new!!!';
//        $news->text = 'I\'m trying';
//        $news->id = 15;
//        $news->insert();
//        $news->update();

//        include __DIR__ . '/../views/news/all.php';
        $view = new View();
        $view->items = NewsModel::getAll();
        $view->display('news/all.php');
    }

    public function actionOne()
    {
        $view = new View();
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
