<?php
namespace App\Controllers;

use Core\Controller;
use Core\View;
use App\Models\Post;

/**
 * Posts Controller
 *
 * PHP version 7.4
 */

class Posts extends Controller {

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction() {
        $posts = Post::getAll();
        view::renderTemplate( 'Posts/index.html', [
            'posts' => $posts,
        ] );
    }

    /**
     * Show the add new page
     *
     * @return void
     */
    public function addNewAction() {
        echo "Add new action from Post controller \n";
    }

    public function editAction() {
        echo "Edit action from posts controller\n ";
        echo htmlspecialchars( print_r( $this->route_params, true ) );
    }

    /**
     * Before filter
     *
     * @return void
     */
    public function before() {
        // echo "(Before) \n";

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