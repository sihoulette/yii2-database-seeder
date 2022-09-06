<?php

namespace app\components\seeder;

use app\components\seeder\interfaces\SeederInterface;

/**
 * Class SeederComponent
 *
 * @package app\components\seeder
 */
class SeederComponent extends AbstractSeeder
{
    /**
     * @var array $log
     */
    private array $log = [];

    /**
     * @var string $registrar
     */
    public string $registrar = 'app\seeders\DatabaseSeeder';

    /**
     * Register seeders in storage
     *
     * @return void
     */
    public function run(): void
    {
        if (is_a($this->registrar, SeederInterface::class, true)) {
            call_user_func([new $this->registrar(), 'run']);
        }
    }

    /**
     * @return $this
     */
    public function callAll(): static
    {
        $this->run();
        $seeders = $this->getSeeders();
        if (!empty($seeders)) {
            foreach ($seeders as $key => $class) {
                $this->callOne($key);
            }
        }

        return $this;
    }

    /**
     * @param string|null $id
     *
     * @return $this
     */
    public function callOne(string $id = null): static
    {
        $this->run();
        $this->log[$id] = ['success' => false];
        $seeder = $this->getSeeders()[$id] ?? '';
        if (is_a($seeder, SeederInterface::class, true)) {
            $this->log[$id]['success'] = true;
            call_user_func([new $seeder(), 'run']);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getLog(): array
    {
        return $this->log;
    }
}
