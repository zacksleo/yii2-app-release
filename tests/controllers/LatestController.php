<?php
namespace zacksleo\yii2\apprelease\tests\controllers;

use Yii;
use zacksleo\yii2\apprelease\models\AppRelease;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

/**
 * AppReleaseController implements the CRUD actions for AppRelease model.
 */
class LatestController extends Controller
{
    public function actionIndex()
    {
        $model = AppRelease::find()->orderBy('updated_at DESC')->one();
        if (empty($model)) {
            throw new NotFoundHttpException('暂无新的更新');
        }
        return $model;
    }
}
