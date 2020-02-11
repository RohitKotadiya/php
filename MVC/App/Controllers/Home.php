<?php

namespace App\Controllers;

class Home extends \Core\BaseController {
    public function indexAction() {
        echo "u r in the index method of Home Class";
    }
    protected function after() {    // why this two here and in controller also
        echo " (After) <br> ";
    }
    protected function before() {
        echo "<br>  (Before) ";
        // return false;   // if return false - actual action never performs
    }
}
?>