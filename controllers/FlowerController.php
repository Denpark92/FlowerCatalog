<?php

namespace app\controllers;

use Yii;
use app\models\Flower;
use app\models\FlowerImage;
use app\models\FlowerSearch;
use app\models\Genus;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FlowerController implements the CRUD actions for Flower model.
 */
class FlowerController extends Controller
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

    /**
     * Lists all Flower models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FlowerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $genuses = Genus::find()->orderBy('name ASC')->all();

        foreach ($genuses as $genus) {
            $genusList[$genus->id] = $genus->name;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'genusList' => $genusList,
        ]);
    }

    /**
     * Displays a single Flower model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $flowerImages = FlowerImage::find()->where(['flower_id' => $id])->all();

        foreach ($flowerImages as $flowerImage) {
            $images[] = $flowerImage->path;
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'images' => $images,
        ]);
    }

    /**
     * Creates a new Flower model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Flower();

        if ($model->load(Yii::$app->request->post())) {

            $model->date_create = date('Y-m-d h:i:s');
            $model->date_update = date('Y-m-d h:i:s');
            $model->save(false);

            $this->saveImages($model->id);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Flower model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->date_update = date('Y-m-d h:i:s');
            $model->save(false);

            $this->saveImages($model->id);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $images = FlowerImage::find()->where(['flower_id' => $id])->all();

            return $this->render('update', [
                'model' => $model,
                'images' => $images,
            ]);
        }
    }

    /**
     * Deletes an existing Flower model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Flower model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Flower the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Flower::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function getRandomFileName($path, $extension='') {
        $extension = $extension ? '.' . $extension : '';
        $path = $path ? $path . '/' : '';

        do {
            $name = md5(microtime() . rand(0, 9999));
            $file = $path . $name . $extension;
        } while (file_exists($file));

        return $name . $extension;
    }

    private function saveImages($flowerId) {
        if ($_FILES['FlowerImage']) {
            $paths = UploadedFile::getInstances(new FlowerImage(), 'path');
            foreach ($paths as $path) {
                $fileName = $this->getRandomFileName(Yii::getAlias('@app/web/upload/catalog/'), $path->extension);
                $path->saveAs(Yii::getAlias('@app/web/upload/catalog/') . $fileName);
                $flowerImage = new FlowerImage();
                $flowerImage->path = $fileName;
                $flowerImage->main_image = false;
                $flowerImage->flower_id = $flowerId;
                $flowerImage->save(false);
            }
        }
    }

    public function actionDeleteImage($id) {
        $image = FlowerImage::findOne($id);
        $flowerId = $image->flower_id;
        //$imgName = $image->path;
        //unlink(Yii::getAlias('@web/upload/catalog/').$imgName);
        if ($image) {
            $image->delete();
        }

        return $this->redirect(['update', 'id' => $flowerId]);
    }

    public function actionMainImage($id, $main = false) {
        $image = FlowerImage::find()
            ->andWhere(
                ['flower_id' => FlowerImage::find()
                    ->select('flower_id')
                    ->where(['id' => $id])
                    ->one()
                ])
            ->andWhere(['main_image' => 1])
            ->one();
        if ($image) {
            $image->main_image = 0;
            $image->update();
        }

        $image = FlowerImage::findOne($id);
        $flowerId = $image->flower_id;
        if ($main) {
            if ($image) {
                $image->main_image = 1;
            }
            $image->update();
        }

        return $this->redirect(['update', 'id' => $flowerId]);
    }
}
