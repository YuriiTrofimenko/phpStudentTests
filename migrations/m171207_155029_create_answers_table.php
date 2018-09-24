<?php

use yii\db\Migration;

/**
 * Handles the creation of table `answers`.
 */
class m171207_155029_create_answers_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('answers', [
            'id' => $this->primaryKey(),
            'questionId' => $this->integer()->notNull(),
            'text_' => $this->string(300)->notNull(),
            'isTrue' => $this->boolean()
        ]);

        try {
            $this->addForeignKey('answer_questionId_fk', 'answers', 'questionId', 'questions', 'id');
        } catch (\Exception $error) {
            $this->dropTable('answers');
            throw $error;
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('answers');
    }
}
