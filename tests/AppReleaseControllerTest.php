<?php
/**
 * Created by PhpStorm.
 * User: graychen
 * Date: 2017/8/17
 * Time: 上午11:15
 */
namespace zacksleo\yii2\apprelease\tests;

use zacksleo\yii2\apprelease\tests\TestCase as TestCase;
use yii\web\UploadedFile;
use yii;

class AppReleaseControllerTest extends TestCase
{
    public $apprelease;
    public function setUp()
    {
        parent::setUp();
        $this->apprelease=$this->create();
    }

    public function testCreate()
    {
        $data = [
            'AppRelease'=> [
                'version' => '1.0',
                'is_forced' => 1,
                'url' => UploadedFile::getInstanceByName('Document[file]'),
                'status' => 1,
                'description' => '发布说明'
            ]
        ];
        Yii::$app->request->bodyParams= $data;
        $response = Yii::$app->runAction('apprelease/apprelease/create');
        $this->delete($response->id);
    }

    public function testUpdate()
    {
        $data = [
            'AppRelease'=> [
                'version' => '1.0',
                'is_forced' => 1,
                'url' => UploadedFile::getInstanceByName('Document[file]'),
                'status' => 1,
                'description' => '发布说明'
            ]
        ];
        Yii::$app->request->bodyParams = $data;
        $response = Yii::$app->runAction('apprelease/apprelease/create');
        $this->assertTrue($response->id > 0);
        $data['AppRelease']['id'] = $response->id;
        $data['AppRelease']['version'] = '2.0';
        Yii::$app->request->bodyParams = $data;
        $response = Yii::$app->runAction('apprelease/apprelease/update', ['id' => $response->id]);
        $this->assertTrue($response->id > 0);
        $this->view($response->id);
        $this->delete($response->id);
    }

    public function delete($id)
    {
        $response = Yii::$app->runAction('apprelease/apprelease/delete', ['id'=>$id]);
        $this->assertTrue($response > 0);
    }


    private function create()
    {
        $data = [
            'AppRelease'=> [
                'version' => '1.0',
                'is_forced' => 1,
                'url' => UploadedFile::getInstanceByName('Document[file]'),
                'md5' => '324234234234',
                'status' => 1,
                'description' => '发布说明'
            ]
        ];
        Yii::$app->request->bodyParams = $data;
        $apprelease = Yii::$app->runAction('apprelease/apprelease/create');
    }

    private function view($id)
    {
        $response = Yii::$app->runAction('apprelease/apprelease/view', ['id' => $id]);
        $this->assertTrue($response->id == $id);
    }

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $_FILES = [
            'Document[file]' => [
                'name' => 'test-file.txt',
                'type' => 'text/plain',
                'size' => 12,
                'tmp_name' => __DIR__ . '/data/test-file.txt',
                'error' => 0,
            ]
        ];
    }
}
