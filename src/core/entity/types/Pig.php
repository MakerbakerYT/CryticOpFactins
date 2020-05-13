<?php

declare(strict_types = 1);

namespace core\entity\types;

use pocketmine\entity\Animal;
use pocketmine\item\Item;

class Pig extends Animal {

    /** @var int */
    public const NETWORK_ID = self::PIG;

    /** @var float */
    public $width = 0.9;

    /** @var float */
    public $height = 0.9;

    /**
     * @return string
     */
    public function getName(): string {
        return "Pig";
    }

    /**
     * @return array
     */
    public function getDrops(): array {
        return [
            Item::get(Item::RAW_PORKCHOP, 0, mt_rand(1, 3)),
        ];
    }
}
