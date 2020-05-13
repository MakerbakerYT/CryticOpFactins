<?php

declare(strict_types = 1);

namespace core\command\forms;

use core\CrypticPlayer;
use core\price\ShopPlace;
use libs\form\MenuForm;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class ItemListForm extends MenuForm {

    /** @var ShopPlace */
    private $place;

    /**
     * ItemListForm constructor.
     *
     * @param ShopPlace $place
     */
    public function __construct(ShopPlace $place) {
        $this->place = $place;
        $title = TextFormat::BOLD . TextFormat::AQUA . $place->getName();
        $text = "What would you like to buy/sell?";
        $options = [];
        foreach($place->getEntries() as $entry) {
            $options[] = $entry->toMenuOption();
        }
        parent::__construct($title, $text, $options);
    }

    /**
     * @param Player $player
     * @param int $selectedOption
     */
    public function onSubmit(Player $player, int $selectedOption): void {
        if(!$player instanceof CrypticPlayer) {
            return;
        }
        $option = $this->getOption($selectedOption);
        $player->sendForm(new TransactionForm($player, $this->place->getEntry($option->getText())));
    }

    /**
     * @param Player $player
     */
    public function onClose(Player $player): void {
        $player->sendForm(new ShopForm());
    }
}