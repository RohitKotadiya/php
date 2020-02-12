<?php

namespace App\Controllers;
use \Core\View;

class Home extends \Core\BaseController {
    public function indexAction() {
        // echo "u r in the index method of Home Class";
        $userData = ['firstName' => 'Keyur',
                    'lastName' => 'Solanki',
                    'designation' => 'Magento Developer',
                    'company' => 'Cybercom Creation'
                    ];
        // View::renderView('Home/homeIndex.php', $userData); //replced with below line after adding Twig
        View::renderTemplate('Home/homeIndex.html', $userData);

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