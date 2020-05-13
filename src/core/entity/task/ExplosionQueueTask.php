<?php

declare(strict_types = 1);

namespace core\entity\task;

use core\level\Explosion;
use pocketmine\scheduler\Task;
use SplFixedArray;
use SplQueue;

class ExplosionQueueTask extends Task {

    /**
     * Maximum amount of explosions
     * processed each tick.
     */
    const MAX_CONCURRENT_EXPLOSIONS = 4;

    /** @var SplFixedArray */
    private $ongoing;

    /** @var SplQueue */
    private $queue;

    /**
     * ExplosionQueue constructor.
     */
    public function __construct() {
        $this->ongoing = new SplFixedArray(self::MAX_CONCURRENT_EXPLOSIONS);
        $this->queue = new SplQueue();
    }

    /**
     * @param int $currentTick
     */
    public function onRun(int $currentTick) {
        if($this->queue->isEmpty()) {
            return;
        }
        $explosion = $this->queue->pop();
        if($explosion !== null) {
            $explosion->explodeA();
            $explosion->explodeB();
        }
    }

    /**
     * Add explosion to queue
     *
     * @param Explosion $explosion
     */
    public function add(Explosion $explosion): void {
        $this->queue->enqueue($explosion);
    }
}
