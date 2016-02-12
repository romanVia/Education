<?php

use Application\Models\News as NewsModel;

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
//        $new = new NewsModel;
//        $new->title = 'New';
//        $new->text = 'New text';
//        $new->id = 25;
//        $new->update();
//        $new->delete();

        $view = new NewsView;
        $view->items = NewsModel::getAll();
        $view->display($this->path);
    }

    public function actionOne()
    {
        $view = new NewsView;
        $view->item = NewsModel::get($_GET['id']);
        $view->display($this->path);
    }

    public function actionAdd()
    {
        $article = new NewsModel;
        $article->title = $_GET['title'];
        $article->text = $_GET['text'];
        $article->insert();
        // TODO: $article->save();
    }

    public function actionDel()
    {
        NewsModel::remove($_GET['id']);
    }
}
