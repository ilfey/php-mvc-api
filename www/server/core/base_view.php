<?php

declare(strict_types=1);

namespace Core;

require_once "request.php";
require_once "context.php";


class BaseView {
    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var Response
     */
    protected Response $response;

    /**
     * @var Context
     */
    protected Context $context;

    public function __construct(Request $request, Response $response, Context $context) {
        $this->request = $request;
        $this->response = $response;
        $this->context = $context;
    }

    /**
     * @param string $key
     * @return mixed
     */
    protected function use(string $key) {
        return $this->context->$key;
    }
}