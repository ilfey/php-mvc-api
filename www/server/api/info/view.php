<?php

require_once CORE . "/base_view.php";

use Core\BaseView;

class View extends BaseView {
    public function get() {
        echo phpinfo();
    }

    public function post() {
        echo "post";
    }
}