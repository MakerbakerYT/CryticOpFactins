<?php

declare(strict_types = 1);

namespace core\entity\types;

use pocketmine\entity\Monster;
use pocketmine\item\Item;

class Spider extends Monster {

    /** @var int */
    public const NETWORK_ID = self::SPIDER;

    /** @var float */
    public $width = 1.4;

    /** @var float */
    public $height = 0.9;

    /**
     * @return string
     */
    public function getName(): string {
        return "Spider";
    }

    /**
     * @return array
     */
    public function getDrops(): array {
        return [
            Item::get(Item::STRING, 0, 1)
        ];
    }
}
