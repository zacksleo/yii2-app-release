<?php
namespace zacksleo\yii2\apprelease\tests\controllers;

use Yii;
use zacksleo\yii2\apprelease\models\AppRelease;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AppReleaseController implements the CRUD actions for AppRelease model.
 */
class AppreleaseController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * Lists all AppRelease models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $dataProvider = new ActiveDataProvider([
            'query' => AppRelease::find(),
        ]);
    }

    /**
     * Displays a single AppRelease model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->findModel($id);
    }

    /**
     * Creates a new AppRelease model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $data = Yii::$app->request->bodyParams;
        $model = new AppRelease();
        $model->setScenario('insert');
        $model->load($data) && $model->save();
        return $model;
    }

    /**
     * Updates an existing AppRelease model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $data = Yii::$app->request->bodyParams;
        $model = $this->findModel($id);
        $model->setScenario('update');
        $model->load($data) && $model->save();
        return $model;
    }

    /**
     * Deletes an existing AppRelease model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        return $this->findModel($id)->delete();
    }

    /**
     * Finds the AppRelease model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AppRelease the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AppRelease::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
