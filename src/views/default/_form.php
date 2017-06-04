<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use zacksleo\yii2\apprelease\models\AppRelease;
use zacksleo\yii2\apprelease\Module;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\apprelease\models\AppRelease */
/* @var $form yii\bootstrap\ActiveForm */
?>
<div class="app-release-form">
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>
    <?= $form->field($model, 'version')->textInput() ?>
    <?= $form->field($model, 'is_forced')->inline(true)->textInput()->radioList([
        '0' => Module::t('apprelease', 'No'),
        '1' => Module::t('apprelease', 'Yes'),
    ]) ?>
    <?= $form->field($model, 'url')->widget(FileInput::className(), [
        'options' => [
            'accept' => 'apk/*',
            'multiple' => false
        ],
        'pluginOptions' => [
            'initialPreview' => [
                $model->url,
            ],
            'showRemove' => true,
            'showPreview' => false,
            'initialPreviewAsData' => false,
            'initialCaption' => $model->url,
            'overwriteInitial' => false,
        ]
    ])->hint('在此上传APK文件'); ?>
    <?= $form->field($model, 'status')->inline(true)->textInput()->radioList([
        AppRelease::STATUS_UNPUBLISHED => Module::t('apprelease', 'unpublished'),
        AppRelease::STATUS_PUBLISHED => Module::t('apprelease', 'published'),
    ], [
        'default' => 1
    ]) ?>
    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
