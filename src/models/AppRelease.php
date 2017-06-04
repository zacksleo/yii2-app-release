<?php

namespace zacksleo\yii2\apprelease\models;

use common\helpers\files\File;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;
use zacksleo\yii2\apprelease\Module;
use mongosoft\file\UploadBehavior;

/**
 * This is the model class for table "{{%app_release}}".
 *
 * @property integer $id
 * @property integer $version
 * @property integer $is_forced
 * @property string $url
 * @property string $md5
 * @property integer $status
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 * @property UploadedFile $releaseFile
 */
class AppRelease extends \yii\db\ActiveRecord
{
    public $file;
    const STATUS_PUBLISHED = 1;
    const STATUS_UNPUBLISHED = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%app_release}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['version', 'description'], 'required'],
            [['is_forced', 'status'], 'integer'],
            [['is_forced', 'status'], 'default', 'value' => 1],
            [['md5', 'description', 'version'], 'string', 'max' => 255],
            [['url'], 'file',
                //'extensions' => 'apk',
                'skipOnEmpty' => true,
                'tooBig' => 'app文件大小不超过20M',
                'maxFiles' => 1,
                'maxSize' => 200000000,
                'on' => ['insert', 'update']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('apprelease', 'ID'),
            'version' => Module::t('apprelease', 'version'),
            'is_forced' => Module::t('apprelease', 'is forced'),
            'url' => Module::t('apprelease', 'url'),
            'md5' => Module::t('apprelease', 'MD5'),
            'status' => Module::t('apprelease', 'status'),
            'description' => Module::t('apprelease', 'description'),
            'created_at' => Module::t('apprelease', 'created at'),
            'updated_at' => Module::t('apprelease', 'updated at'),
            'file' => Module::t('apprelease', 'File'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'url',
                'scenarios' => ['insert', 'update'],
                'path' => '@webroot/web/uploads/apps',
                'url' => '@web/uploads/apps'
            ],
        ];
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields['url'] = function () {
            $url = Url::to(['file/view', 'filepath' => $this->url], true);
            return str_replace('api', 'health', $url);
        };
        unset($fields['id'], $fields['created_at'], $fields['status'], $fields['updated_at']);
        return $fields;
    }


    public function afterSave($insert, $changedAttributes)
    {
        // $this->md5 = md5_file($this->url);
        parent::afterSave($insert, $changedAttributes);
    }
}
