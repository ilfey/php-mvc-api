<?php

declare(strict_types=1);

namespace Core;

require_once "request.php";


class BaseView {
    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var Response
     */
    protected Response $response;

    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;
    }
}