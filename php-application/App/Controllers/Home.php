<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

/**
 * Home Controller
 *
 * PHP version 7.4
 */

class Home extends Controller {

    public function indexAction() {
        $args = [
            'name'   => 'David Jhon',
            'colors' => ['Red', 'Green', 'Blue'],
        ];
        //View::render( 'Home/index.php', $args );
        view::renderTemplate( 'Home/index.html', $args );
    }

    /**
     * Before filter
     *
     * @return void
     */
    public function before() {
        //echo "(Before) \n";
    }

    /**
     * After Filter
     *
     * @return void
     */
    public function after() {
        //echo "(After) \n";
    }
}