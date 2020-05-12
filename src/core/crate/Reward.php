<?php

declare(strict_types = 1);

namespace core\crate;

use pocketmine\item\Item;

class Reward {

    /** @var string */
    private $name;

    /** @var Item */
    private $item;

    /** @var callable */
    private $callback;

    /** @var int */
    private $chance;

    /**
     * Reward constructor.
     *
     * @param string $name
     * @param Item $item
     * @param callable $callable
     * @param int $chance
     */
    public function __construct(string $name, Item $item, callable $callable, int $chance) {
        $this->name = $name;
        $this->item = $item;
        $this->callback = $callable;
        $this->chance = $chance;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return Item
     */
    public function getItem(): Item {
        return $this->item;
    }

    /**
     * @return callable
     */
    public function getCallback(): callable {
        return $this->callback;
    }

    /**
     * @return int
     */
    public function getChance(): int {
        return $this->chance;
    }
}
