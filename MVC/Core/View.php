<?php

namespace Core;

class View {
    public static function renderView($viewFile, $args = []) {
        $file = "../App/Views/$viewFile"; 
        extract($args);
        if(is_readable($file)) {
            require_once $file;
        }else {
            echo "$file not found!";
        }
    }
}

?>