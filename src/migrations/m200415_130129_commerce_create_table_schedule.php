<?php

use yii\db\Migration;

class m200415_130129_commerce_create_table_schedule extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%commerce_schedule}}', [
            'id' => $this->primaryKey(),
            'modelClass' => $this->string(),
            'modelId' => $this->integer(),
            'taskClass' => $this->string()->notNull(),
            'status' => $this->tinyInteger(1)->defaultValue(1),
            'attempts' => $this->integer()->notNull()->defaultValue(1),
            'try' => $this->integer()->defaultValue(0),
            'context' => $this->json(),
            'result' => $this->text(),
            'startAt' => $this->dateTime()->notNull(),
            'createdAt' => $this->dateTime(),
            'updatedAt' => $this->dateTime(),
        ], 'ENGINE=InnoDB CHARSET=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%commerce_schedule}}');
    }

}
