<?php

declare(strict_types = 1);

namespace core\entity\types;

use pocketmine\entity\Animal;
use pocketmine\item\Item;

class Cow extends Animal {

    public const NETWORK_ID = self::COW;

    /** @var float */
    public $width = 0.9;

    /** @var float */
    public $height = 1.3;

    /**
     * @return string
     */
    public function getName(): string {
        return "Cow";
    }

    /**
     * @return array
     */
    public function getDrops(): array {
        return [
            Item::get(Item::RAW_BEEF, 0, mt_rand(1, 3)),
            Item::get(Item::LEATHER, 0, mt_rand(0, 2)),
        ];
    }

    /**
     * @return int
     */
    public function getXpDropAmount(): int {
        return 5;
    }
}