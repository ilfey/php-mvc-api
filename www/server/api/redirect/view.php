<?php

require_once CORE . "/base_view.php";

use Core\BaseView;

class View extends BaseView {
    public function get() {
        $this->response->redirect("/");
    }
}