<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Article;
use app\models\CommentForm;
use app\models\Comment;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $articles = Article::find()->all();
        
        return $this->render('index',[
            'articles' => $articles
        ]);
    }
    
    public function actionView($id)
    {
       $article = Article::findOne($id);
       $comments = $article->comments;
       $commentForm = new CommentForm();
       
       return $this->render('view',[
           'article' => $article,
           'comments' => $comments,
           'commentForm' => $commentForm
       ]);
    }        

    public function actionCreate($id)
    {
        $model = new CommentForm();
        
        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if($model->saveComment($id))
            {
                return $this->redirect(['site/view', 'id'=>$id]);
            }    
        }    
    } 
    
    public function actionUpdate($id)
    {    
       $model = $this->findModel($id);
       $article_id = $model->article->id;
       
       if(Yii::$app->request->isPost)
       {
            $model->load(Yii::$app->request->post());
            if($model->save())
            {
                return $this->redirect(['site/view', 'id' => $article_id]);
            }    
       }
       else
       {
           return $this->render('update',[
               'model' => $model
           ]);        
       }
    }              
    
    public function actionDelete($id, $article_id)
    {
        $this->findModel($id)->delete();
            return $this->redirect(['site/view', 'id'=>$article_id]);
            
    }        
    
     protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
