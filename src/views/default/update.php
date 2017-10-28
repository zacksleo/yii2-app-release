<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AppRelease */
$this->title = '更新';
$this->params['breadcrumbs'][] = ['label' => 'App发布', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="app-release-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
