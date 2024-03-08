<?php

declare(strict_types=1);

namespace Core;

/**
 * Immutable object
 */
class Context {
    /**
     * @var array Context array
     */
    protected array $ctx = [];

    /**
     * 
     */
    public function __set(string $key, mixed $value) {
        if (!isset($this->ctx[$key])) {
            $this->ctx[$key] = $value;
        }
    }

    /**
     * @param string $key 
     * @return mixed
     */
    public function __get(string $key) {
        return $this->ctx[$key];
    }
}