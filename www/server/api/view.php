<?php

require_once CORE . "/base_view.php";

use Core\BaseView;

class View extends BaseView {
    public function get() {
        $db = $this->use("DB");

        $this->response->json([
            "hello" => "world",
            "db" => $db,
        ]);
    }

    public function post() {
        echo "post";
    }
}