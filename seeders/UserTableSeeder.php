<?php

namespace app\seeders;

use Yii;
use app\components\seeder\AbstractSeeder;
use yii\base\Exception as BaseException;
use yii\db\Exception as DbException;

/**
 * Class UserTableSeeder
 *
 * @package app\seeders
 */
final class UserTableSeeder extends AbstractSeeder
{
    /**
     * @var string $table
     */
    protected string $table = '{{%user}}';

    /**
     * @var array $users
     */
    protected array $users = [
        [
            'username' => 'Sihoulette',
            'email' => 'aleksandr.bytsyk@gmail.com',
            'password' => 'password'
        ]
    ];

    /**
     * @return void
     * @throws BaseException
     * @throws DbException
     */
    public function run(): void
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $this->callRun();
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * @return void
     * @throws BaseException
     * @throws DbException
     */
    private function callRun(): void
    {
        foreach ($this->users as $user) {
            $user['password_hash'] = Yii::$app->security->generatePasswordHash($user['password']);
            $user['created_at'] = time();
            $user['updated_at'] = time();
            unset($user['password']);

            Yii::$app->db->createCommand()
                ->batchInsert($this->table, array_keys($user), [$user])
                ->execute();
        }
    }
}
