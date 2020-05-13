<?php

declare(strict_types = 1);

namespace core\entity\types;

use core\level\Explosion;
use core\Cryptic;
use pocketmine\event\entity\ExplosionPrimeEvent;

class PrimedTNT extends \pocketmine\entity\object\PrimedTNT {

    public function explode(): void {
        $event = new ExplosionPrimeEvent($this, 4);
        $event->call();
        if(!$event->isCancelled()) {
            Cryptic::getInstance()->getEntityManager()->getExplosionQueue()->add(new Explosion($this, $event->getForce(), $this));
        }
    }
}