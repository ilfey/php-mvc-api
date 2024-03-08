<?php

declare(strict_types=1);

namespace Core;

require_once "context.php";
require_once "request.php";
require_once "response.php";
require_once "base_view.php";


class App {
    /**
     * @var Context Context array
     */
    protected Context $context;

    public function __construct() {
        $this->context = new Context;
    }

    /**
     * Set context value
     */
    public function use(string $key, mixed $value) {
        $this->context->$key = $value;
    }

    /**
     * Start app
     */
    public function run() {
        
        // Trim url
        $path = trim(explode("?", $_SERVER["REQUEST_URI"])[0], '/');

        // If url is empty then set url home
        if (!$path) {
            $path = "/";
        }

        $path = ROOT . "/api/$path/view.php";

        // Create response
        $response = new Response();

        // Check route
        if (!file_exists($path)) {
            $response->send_status(404);
        }

        // Create request
        $request = new Request();

        // echo "path: " . $path;

        include_once $path;

        // Create view
        $view = new \View($request, $response, $this->context);

        // Execute view
        $this->execute_view($view, $request, $response);
    }

    /**
     * Execute view
     * 
     * @param BaseView $view
     */
    private function execute_view(BaseView $view, Request $request, Response $response) {
        $method = strtolower($request->get_method());

        if (!method_exists($view, $method)){
            $response->send_status(405);
        }
        
        $view->$method();
    }
}