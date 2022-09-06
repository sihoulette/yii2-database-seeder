<?php

namespace app\seeders;

use app\components\seeder\AbstractSeeder;

/**
 * Class DatabaseSeeder
 *
 * @package app\seeders
 */
final class DatabaseSeeder extends AbstractSeeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $this->push(UserTableSeeder::class);
    }
}
