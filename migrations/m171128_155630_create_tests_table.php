<?php

use yii\db\Migration;

class m171128_155630_create_tests_table extends Migration
{
    public function safeUp() {
        $this->createTable('tests', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'description' => $this->text()->notNull(),
            'categoryId' => $this->integer()->notNull(),
            'questions' => $this->integer()->notNull(),
            'activity' => $this->boolean(),
            'created' => $this->dateTime()->notNull(),
        ]);

        try {
            $this->createIndex('tests_name_categoryId', 'tests', ['name', 'categoryId'], true);
            $this->addForeignKey('tests_categoryId_fk', 'tests', 'categoryId', 'categories', 'id');
        } catch (\Exception $error) {
            $this->dropTable('tests');
            throw $error;
        }
    }

    public function safeDown()
    {
        $this->dropTable('tests');
    }
}
