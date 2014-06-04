<?php

namespace Jaydean\Claredale\Sync;

class EventManager
{
    private $events;

    /**
     * @param string $event
     * @param \Closure $closure
     */
    public function addEvent($event, $closure)
    {
        if (!is_string($event)) {
            throw new \BadMethodCallException('$event must be a string');
        }

        $eventClosure = null;
        if ($closure instanceof \Closure) {
            $eventClosure = new Event($closure);
        } elseif ($closure instanceof Event) {
            $eventClosure = $closure;
        } else {
            throw new \BadMethodCallException('$closure must be a Closure or Event');
        }

        $this->events[$event][] = $eventClosure;
    }

    /**
     * @param string $event
     * @return mixed
     */
    public function getEvents($event = null)
    {
        if ($event === null) {
            return $this->events;
        }
        return $this->events[$event] or null;
    }

    /**
     * @param string $event
     * @param array $parameters
     */
    public function dispatchEvent($event, $parameters = [])
    {
        if (!is_string($event)) {
            throw new \BadMethodCallException('$event must be a string');
        }

        if (!is_array($parameters)) {
            $parameters = [$parameters];
        }

        if (isset($this->events[$event])) {
            /**
             * @var Event $eventHandle
             */
            foreach ($this->events[$event] as $eventHandle) {
                $eventHandle->execute($parameters);
            }
        }
    }

}