<?php

namespace App\Controllers;

class Posts extends \Core\BaseController {
    public function indexAction() {
        echo "hello u r on index action of post controller";
        echo "<br> Query String  variables : <pre>". 
                htmlspecialchars(print_r($_GET, true)) . "</pre><br>";
    }
    public function addNewAction() {
        echo "u r on add new method of post class";
    }
    public function editAction() {
        echo "hello u r on edit action of post controller";
        echo "<br> Route Parameters : <pre> " . 
                    htmlspecialchars(print_r($this->routeParams, true)) . "</pre><br>";
    }
}
?>