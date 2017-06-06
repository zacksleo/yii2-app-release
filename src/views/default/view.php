<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use zacksleo\yii2\apprelease\models\AppRelease;
use zacksleo\yii2\apprelease\Module;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\apprelease\models\AppRelease */
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
                    return $model->getUploadUrl('url');
                },
            ],
            'md5',
            'status',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->status = AppRelease::STATUS_PUBLISHED ? Module::t('apprelease', 'published') : Module::t('apprelease', 'unpublished');
                }
            ],
            'description',
            'created_at',
            'updated_at',
        ],
    ]) ?>
</div>
