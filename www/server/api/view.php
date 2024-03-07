<?php

require_once CORE . "/base_view.php";

use Core\BaseView;

class View extends BaseView {
    public function get() {
        $this->response->json([
            "hello" => "world"
        ]);
    }

    public function post() {
        echo "post";
    }
}