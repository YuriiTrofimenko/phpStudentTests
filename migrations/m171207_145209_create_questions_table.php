<?php

use yii\db\Migration;

/**
 * Handles the creation of table `questions`.
 */
class m171207_145209_create_questions_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('questions', [
            'id' => $this->primaryKey(),
            'testId' => $this->integer()->notNull(),
            'text_' => $this->text()->notNull()
        ]);

        try {
            $this->addForeignKey('questions_testId', 'questions', 'testId', 'tests', 'id');
        } catch (\Exception $error) {
            $this->dropTable('questions');
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('questions');
    }
}
