<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use zacksleo\yii2\apprelease\models\AppRelease;
use zacksleo\yii2\apprelease\Module;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\apprelease\models\AppRelease */
$this->title = $model->version;
$this->params['breadcrumbs'][] = ['label' => 'App发布', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="app-release-view">
    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'version',
            [
                'attribute' => 'is_forced',
                'value' => $model->is_forced == 1 ? '是' : '否',
            ],
            [
                'attribute' => 'url',
                'format' => 'url',
                'value' => function ($model) {
                    return $model->getUploadUrl('url');
                },
            ],
            'md5',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return AppRelease::getStatusList()[$model->status];
                }
            ],
            'description',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
</div>
