<?php

namespace app\components\seeder;

use yii\base\Component;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use app\components\seeder\interfaces\SeederInterface;

/**
 * Class AbstractSeeder
 *
 * @package app\components\seeder
 */
abstract class AbstractSeeder extends Component implements SeederInterface
{
    /**
     * @var array $seeders
     */
    private static array $seeders = [];

    /**
     * @param string $class
     *
     * @return $this
     */
    final public function push(string $class): static
    {
        if (is_a($class, SeederInterface::class, true)) {
            self::$seeders[self::getSeederId($class)] = $class;
        }

        return $this;
    }

    /**
     * @param string $class
     *
     * @return string
     */
    public static function getSeederId(string $class = ''): string
    {
        $class = is_a($class, SeederInterface::class, true)
            ? $class : get_called_class();

        return Inflector::camel2id(StringHelper::basename($class));
    }

    /**
     * @return array
     */
    final public function getSeeders(): array
    {
        return self::$seeders;
    }
}
