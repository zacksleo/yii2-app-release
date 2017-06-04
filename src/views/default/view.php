<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use zacksleo\yii2\lookup\models\Lookup;
use common\helpers\files\File;

/* @var $this yii\web\View */
/* @var $model common\models\AppRelease */
$this->title = $model->version;
$this->params['breadcrumbs'][] = ['label' => 'App发布', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-release-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
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
                    return File::getLink($model->url);
                },
            ],
            'md5',
            'status',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return Lookup::item('ReleaseStatus', $model->status);
                }
            ],
            'description',
            'created_at',
            'updated_at',
        ],
    ]) ?>
</div>
