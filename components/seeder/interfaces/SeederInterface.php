<?php

namespace app\components\seeder\interfaces;

/**
 * Interface SeederInterface
 *
 * @package app\components\seeder\interfaces
 */
interface SeederInterface
{
    /**
     * Push seeder class to storage
     *
     * @param string $class
     *
     * @return $this
     */
    public function push(string $class): static;

    /**
     * Execute seeding
     *
     * @return void
     */
    public function run(): void;
}
