<?php

declare(strict_types=1);

namespace Core;

class Request {

    /**
     * @var array $_REQUEST
     */
    public array $request;

    /**
     * @var array Cleaned $_COOKIE
     */
    public array $cookie;

    public function __construct() {
        $this->request = $_REQUEST;
        $this->cookie = $this->clean($_COOKIE);
    }

    public function get_method() {
        return $this->server("REQUEST_METHOD");
    }

    /**
     *  Get client remote address
     *
     * @return string
     * */
    public function get_address() {
        return $this->server("REMOTE_ADDR");
    }

    /**
     *  Script Name
     *
     * @return string
     * */
    public function get_url() {
        return $this->server("REQUEST_URI");
    }

    /**
     *  Get value from $_SERVER
     *
     * @param string $key
     * @return string|null
     */
    protected function server(string $key) {
        $key = strtoupper($key);
        $value = $_SERVER[$key];

        return isset($value) ? $this->clean($value) : $value;
    }

    /**
     * Clean data
     * 
     * @param array|string $data
     * @return array|string
     * */
    protected function clean($data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                unset($data[$key]);

                $data[$this->clean($key)] = $this->clean($value);
            }
        } else {
            $data = htmlspecialchars($data, ENT_COMPAT, "UTF-8");
        }

        return $data;
    }
}