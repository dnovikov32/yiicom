<?php

use yii\db\Migration;

class m171209_095813_commerce_create_table_admin_users extends Migration
{
    public function up()
    {
        $this->createTable('{{%admin_users}}', [
            'id' => $this->primaryKey(),
            'status' => $this->tinyInteger(1)->defaultValue(1),
            'login' => $this->string(),
            'password' => $this->string(),
            'authKey' => $this->string(),
            'authKeyExpireAt' => $this->dateTime(),
            'loginAt' => $this->dateTime(),
            'createdAt' => $this->dateTime(),
            'updatedAt' => $this->dateTime(),
        ], 'ENGINE=InnoDB CHARSET=utf8');
    }

    public function down()
    {
        $this->dropTable('{{%admin_users}}');
    }
}
