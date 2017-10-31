<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use zacksleo\yii2\apprelease\Module;
use zacksleo\yii2\apprelease\models\AppRelease;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Module::t('apprelease', 'app-release');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-release-index">
    <p>
        <?= Html::a(Module::t('apprelease', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'version',
            [
                'attribute' => 'is_forced',
                'value' => function ($model) {
                    return $model->is_forced == 1 ? '是' : '否';
                }
            ],
            [
                'attribute' => 'url',
                'format' => 'url',
                'value' => function ($model) {
                    return $model->getUploadUrl('url');
                },
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return AppRelease::getStatusList()[$model->status];
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
