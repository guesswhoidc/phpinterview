<?php

namespace App;

class Main {
    static function render() {
        View\Template::render(function() {
            echo "hello";
        });
    }
}
