<?php

namespace app\controllers;

use Yii;
use app\models\News;
use app\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function checkUser(){
        if (Yii::$app->user->isGuest){
            return $this->goBack();
        }
        return true;

    }


    /**
     * Lists all News models.
     * @return mixed
     */

    public function actionIndex()
    {
        $news = News::find()->orderBy('id DESC')->all();
        return $this->render('index', ['news' => $news]);
    }

    public function actionAdmin()
    {
        $this->checkUser();

        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     */
//    public function actionView($id)
//    {
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);
//    }


    public function actionView($id)
    {
        return $this->render('one', [
            'model' => $this->findModel($id),
            'imageList' => $this->getImageList(),
        ]);
    }


    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->checkUser();

        $model = new News();
        $uploadModel = new UploadForm();
        $uploadModel->imageFile = UploadedFile::getInstance($model, 'imageFile');

        if ($model->load(Yii::$app->request->post())) {
            if (!($uploadModel->upload())) {
                throw new ServerErrorHttpException('Failed to upload Files');
            }
            $model->setAttributes([
                'image_json' => 'test' //todo
            ]);


            if ($model->validate()) { //ToDO Последовательность сохранения
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    throw new ServerErrorHttpException('Failed to save model ' . $model::className());
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->checkUser();

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->checkUser();

        $this->findModel($id)->delete();

        return $this->redirect(['admin']);
    }

    public function getImageList($id = 1){
        $newsImagePath = 'img/uploads/news/' . $id;
        $ignore = array('.', '..', '.DS_Store'); //ToDO Нормальная фильтрация
        $imageList = array_diff(scandir($newsImagePath), $ignore);
        return $imageList;
    }


    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
