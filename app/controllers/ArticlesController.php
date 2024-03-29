<?php

namespace app\controllers;

use yii\easyii\modules\article\api\Article;

class ArticlesController extends \yii\web\Controller
{
    public function actionIndex($tag = null)
    {
//        return $this->render('index');
		return $this->render('index',[
			'article' => Article::items(['tags' => $tag, 'pagination' => ['pageSize' => 5]])
		]);
    }

    public function actionCat($slug, $tag = null)
    {
        $cat = Article::cat($slug);
        if(!$cat){
            throw new \yii\web\NotFoundHttpException('Article category not found.');
        }

        return $this->render('index', [
            'cat' => $cat,
            'items' => $cat->items(['tags' => $tag, 'pagination' => ['pageSize' => 5]])
        ]);
    }

    public function actionView($slug)
    {
        $article = Article::get($slug);
        if(!$article){
            throw new \yii\web\NotFoundHttpException('Article not found.');
        }

        return $this->render('view', [
            'article' => $article
        ]);
    }

}
