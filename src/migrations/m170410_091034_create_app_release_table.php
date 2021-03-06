<?php

use yii\db\Migration;

/**
 * Handles the creation of table `app_release`.
 */
class m170410_091034_create_app_release_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%app_release}}', [
            'id' => $this->primaryKey(),
            'version' => $this->string()->notNull()->comment('版本号'),
            'is_forced' => $this->boolean()->notNull()->defaultValue(1)->comment('强制更新'),
            'url' => $this->string()->notNull()->comment('下载地址'),
            'md5' => $this->string()->notNull()->defaultValue('')->comment('MD5'),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(0)->comment('状态'),
            'description' => $this->string()->notNull()->comment('发布说明'),
            'created_at' => $this->integer()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer()->notNull()->comment('更新时间'),
        ], $tableOptions . ' COMMENT="发布"');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%app_release}}');
    }
}
