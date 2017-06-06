<?php

namespace zacksleo\yii2\apprelease\behaviors;

class UploadBehavior extends \mongosoft\file\UploadBehavior
{
    public function beforeSave()
    {
        parent::beforeSave();
        $path = $this->getUploadPath($this->attribute);
        if (file_exists($path)) {
            $model = $this->owner;
            /* @var $model \zacksleo\yii2\apprelease\models\AppRelease */
            $model->md5 = md5_file($path);
        }
    }
}
