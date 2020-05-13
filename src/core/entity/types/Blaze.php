<?php

declare(strict_types = 1);

namespace core\entity\types;

use pocketmine\entity\Monster;
use pocketmine\item\Item;

class Blaze extends Monster {

    /** @var int */
    public const NETWORK_ID = self::BLAZE;

    /** @var float */
    public $width = 0.6;

    /** @var float */
    public $height = 1.8;

    /**
     * @return string
     */
    public function getName(): string {
        return "Blaze";
    }

    /**
     * @return array
     */
    public function getDrops(): array {
        return [Item::get(Item::BLAZE_ROD, 0, mt_rand(0, 1))];
    }
}