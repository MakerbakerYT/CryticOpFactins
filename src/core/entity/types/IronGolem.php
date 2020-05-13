<?php

declare(strict_types = 1);

namespace core\entity\types;

use pocketmine\entity\Animal;
use pocketmine\item\Item;

class IronGolem extends Animal {

    /** @var int */
    public const NETWORK_ID = self::IRON_GOLEM;

    /** @var float */
    public $width = 1.4;

    /** @var float */
    public $height = 2.7;

    public function initEntity(): void {
        $this->setMaxHealth(20);
        parent::initEntity();
    }

    /**
     * @return string
     */
    public function getName(): string {
        return "Iron Golem";
    }

    /**
     * @return array
     */
    public function getDrops(): array {
        return [
            Item::get(Item::NETHER_STAR, 0, mt_rand(0, 3)),
            Item::get(Item::POPPY, 0, mt_rand(0, 1)),
        ];
    }
}
