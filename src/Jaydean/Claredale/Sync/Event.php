<?php

namespace Jaydean\Claredale\Sync;

class Event
{

    private $closure;

    /**
     * @param \Closure $closure
     */
    public function __construct($closure)
    {
        $this->setClosure($closure);
    }

    /**
     * @param array $parameters
     * @return mixed
     */
    public function execute($parameters = [])
    {
        return call_user_func_array($this->closure, $parameters);
    }

    /**
     * @param \Closure $closure
     */
    public function setClosure($closure)
    {
        $this->closure = $closure;
    }

    /**
     * @return \Closure
     */
    public function getClosure()
    {
        return $this->getClosure();
    }

}