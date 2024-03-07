<?php

require_once CORE . "/base_view.php";

class View extends Core\BaseView {
    public function get() {
        $this->response->render(__DIR__ . "/page.php");
    }
}