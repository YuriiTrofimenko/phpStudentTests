<?php

use yii\db\Migration;

class m170730_102718_create_categories_table extends Migration
{
    public function safeUp() {
        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'parentId' => $this->integer(),
            'created' => $this->dateTime()
        ]);

        try {
            $this->createIndex('categories_name_parentId', 'categories', ['name', 'parentId'], true);
            $this->addForeignKey('categories_parentId_FK', 'categories', 'parentId', 'categories', 'id');
        } catch (\Exception $error) {
            $this->dropTable('categories');
        }
    }

    public function safeDown()
    {
        $this->dropTable('categories');
    }
}
