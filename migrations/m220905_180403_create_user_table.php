<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m220905_180403_create_user_table extends Migration
{
    /**
     * @var string $table
     */
    public string $table = '{{%user}}';

    /**
     * @var string $tableOptions
     */
    public string $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->bigPrimaryKey()
                ->notNull()
                ->unsigned()
                ->comment('User ID'),
            'username' => $this->string()
                ->notNull()
                ->unique()
                ->comment('Username'),
            'email' => $this->string()
                ->notNull()
                ->unique()
                ->comment('Email'),
            'password_hash' => $this->string()
                ->comment('Password Hash'),
            'status' => $this->smallInteger()
                ->unsigned()
                ->defaultValue(10)
                ->comment('Active status'),
            'created_at' => $this->integer(11)
                ->unsigned()
                ->comment('Created timestamp'),
            'updated_at' => $this->integer(11)
                ->unsigned()
                ->comment('Updated timestamp'),
        ], $this->tableOptions);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);

        return true;
    }
}
