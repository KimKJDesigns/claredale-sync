<?php

namespace Jaydean\Claredale\Sync;

class Manager
{
    private $eventManager;
    private $sync;

    /**
     * @param string $token
     */
    public function __construct($token)
    {
        $this->eventManager = new EventManager();
        $this->sync = new Sync($token, $this->eventManager);

    }

    /**
     * @return array
     * @throws \Exception
     */
    public function startSync()
    {
        return $this->sync->start();
    }

    /**
     * @param string $event
     * @param \Closure $closure
     */
    public function addEvent($event, $closure)
    {
        $this->eventManager->addEvent($event, $closure);
    }

    /**
     * @param EventManager $eventManager
     */
    public function setEventManager($eventManager)
    {
        if (!($eventManager instanceof EventManager)) {
            throw new \BadMethodCallException('$eventManager must be an EventManager');
        }
        $this->eventManager = $eventManager;
    }

    /**
     * @return EventManager
     */
    public function getEventManager()
    {
        return $this->eventManager;
    }

    /**
     * @param Sync $sync
     */
    public function setSync($sync)
    {
        if (!($sync instanceof Sync)) {
            throw new \BadMethodCallException('$sync must be an Sync');
        }
        $this->sync = $sync;
    }

    /**
     * @return Sync
     */
    public function getSync()
    {
        return $this->sync;
    }
}