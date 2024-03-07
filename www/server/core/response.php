<?php

declare(strict_types=1);

namespace Core;

class Response {
    /**
     * @var array Array of `Status code` => `Text representation of status code`
     */
    protected $statusTexts = [
        // INFORMATIONAL CODES
        100 => "Continue",
        101 => "Switching Protocols",
        102 => "Processing",

        // SUCCESS CODES
        200 => "OK",
        201 => "Created",
        202 => "Accepted",
        203 => "Non-Authoritative Information",
        204 => "No Content",
        205 => "Reset Content",
        206 => "Partial Content",
        207 => "Multi-status",
        208 => "Already Reported",

        // REDIRECTION CODES
        300 => "Multiple Choices",
        301 => "Moved Permanently",
        302 => "Found",
        303 => "See Other",
        304 => "Not Modified",
        305 => "Use Proxy",
        306 => "Switch Proxy", // Deprecated
        307 => "Temporary Redirect",

        // CLIENT ERROR
        400 => "Bad Request",
        401 => "Unauthorized",
        402 => "Payment Required",
        403 => "Forbidden",
        404 => "Not Found",
        405 => "Method Not Allowed",
        406 => "Not Acceptable",
        407 => "Proxy Authentication Required",
        408 => "Request Time-out",
        409 => "Conflict",
        410 => "Gone",
        411 => "Length Required",
        412 => "Precondition Failed",
        413 => "Request Entity Too Large",
        414 => "Request-URI Too Long",
        415 => "Unsupported Media Type",
        416 => "Requested range not satisfiable",
        417 => "Expectation Failed",
        418 => "I'm a teapot",
        422 => "Unprocessable Entity",
        423 => "Locked",
        424 => "Failed Dependency",
        425 => "Unordered Collection",
        426 => "Upgrade Required",
        428 => "Precondition Required",
        429 => "Too Many Requests",
        431 => "Request Header Fields Too Large",

        // SERVER ERROR
        500 => "Internal Server Error",
        501 => "Not Implemented",
        502 => "Bad Gateway",
        503 => "Service Unavailable",
        504 => "Gateway Time-out",
        505 => "HTTP Version not supported",
        506 => "Variant Also Negotiates",
        507 => "Insufficient Storage",
        508 => "Loop Detected",
        511 => "Network Authentication Required",
    ];

    /**
     * @var array 
     */
    protected array $headers = [];

    /**
     *  Get status code text
     *
     * @param int $code
     * @return string|null
     */
    public function get_status_code_text(int $code){
        return $this->statusTexts[$code];
    }

    /**
     *  Set response Headers
     *
     * @param $header
     */
    public function set_header(String $header) {
        $this->headers[] = $header;
    }

    /**
     *  Get response Headers
     *
     * @return array
     */
    public function get_header() {
        return $this->headers;
    }

    /**
     *  Get content response.
     *
     * @return mixed
     */
    public function get_content() {
        return $this->content;
    }


    /**
     * @param string $url
     */
    public function redirect($url) {
        if (empty($url)) {
            trigger_error('Cannot redirect to an empty URL.');
            exit;
        }

        header('Location: ' . str_replace(array('&amp;', "\n", "\r"), array('&','', ''), $url), true, 302);
        exit();
    }

    /**
     * Check status code is valid
     *
     * @return bool
     */
    public function is_valid(int $statusCode) {
        return $statusCode >= 100 && $statusCode <= 600;
    }

    public function send_status($code) {
        if ($this->is_valid($code)) {
            $this->set_header(sprintf('HTTP/1.1 ' . $code . ' %s' , $this->get_status_code_text($code)));
        }
    }

    /**
     *  Send content
     */
    public function json($content) {
        // Headers
        if (!headers_sent()) {
            foreach ($this->headers as $header) {
                header($header, true);
            }
        }
        
        header("Content-Type: application/json", true);

        echo json_encode($content);
    }

    /**
     * Render page
     * @param string $file Absolute path to page file
     */
    public function render(string $file) {
        if (!file_exists($file)) {
            send_status(500);
        }

        require_once $file;
    }
}