<?php

declare(strict_types = 1);

namespace core\command\types;

use core\command\utils\Command;
use core\item\enchantment\Enchantment;
use core\item\ItemManager;
use core\CrypticPlayer;
use core\translation\Translation;
use core\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\utils\TextFormat;

class EnchantCommand extends Command {

    /**
     * EnchantCommand constructor.
     */
    public function __construct() {
        parent::__construct("enchant", "Add an enchantment to an item", "/enchant <enchantment> <level>");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if((!$sender->isOp()) or (!$sender instanceof CrypticPlayer))  {
            $sender->sendMessage(Translation::getMessage("noPermission"));
            return;
        }
        if(!isset($args[1])) {
            $sender->sendMessage(Translation::getMessage("usageMessage", [
                "usage" => $this->getUsage()
            ]));
            return;
        }
        $enchantment = ItemManager::getEnchantment($args[0]);
        if($enchantment === null) {
            $sender->sendMessage(Translation::getMessage("invalidEnchantment"));
            return;
        }
        $level = (int)$args[1];
        if((!is_numeric($level)) or $enchantment->getMaxLevel() < $level) {
            $sender->sendMessage(Translation::getMessage("invalidAmount"));
            return;
        }
        $item = $sender->getInventory()->getItemInHand();
        if(ItemManager::canEnchant($item, $enchantment) === false) {
            $sender->sendMessage(Translation::getMessage("invalidItem"));
            return;
        }
        $enchantment = new EnchantmentInstance($enchantment, $level);
        $item->addEnchantment($enchantment);
        $lore = [];
        foreach($item->getEnchantments() as $enchantment) {
            if($enchantment->getType() instanceof Enchantment) {
                $lore[] = TextFormat::RESET . ItemManager::rarityToColor($enchantment->getType()->getRarity()) . $enchantment->getType()->getName() . " " . ItemManager::getRomanNumber($enchantment->getLevel());
            }
        }
        $item->setLore($lore);
        $sender->getInventory()->setItemInHand($item);
        $sender->sendMessage(Translation::getMessage("successAbuse"));
        return;
    }
}