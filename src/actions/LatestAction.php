<?php

namespace zacksleo\yii2\apprelease\actions;

use yii\base\Action;
use zacksleo\yii2\apprelease\models\AppRelease;
use yii\web\NotFoundHttpException;

class LatestAction extends Action
{
    public function run()
    {
        $model = AppRelease::find()->orderBy('updated_at DESC')->one();
        if (empty($model)) {
            throw new NotFoundHttpException('暂无新的更新');
        }
        return $model;
    }
}
