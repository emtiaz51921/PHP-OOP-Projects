<?php

namespace app\core;
use app\core\Controller;
use app\core\db\Database;
use app\core\db\DbModel;

/**
 * Class Application
 *
 * @author Shamim <emtiaz51921@gmail.com>
 * @package app\core;
 */

class Application {

    public static string $ROOT_DIR;
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;
    public  ? Controller $controller;
    public Database $db;
    public Session $session;
    public  ? UserModel $user;
    public View $view;
    public string $layout = 'main';

    public function __construct( $rootPath, array $config ) {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router( $this->request, $this->response );
        $this->db = new Database( $config['db'] );
        $this->session = new Session();
        $this->view = new View();

        $primaryValue = $this->session->get( 'user' );

        if ( $primaryValue ) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne( [$primaryKey => $primaryValue] );
        } else {
            $this->user = null;
        }

    }

    /**
     * This function will run the resolve method from
     * router object which will dispaly the views.
     *
     * @return void
     */
    public function run() {
        try {
            echo $this->router->resolve();
        } catch ( \Exception $e ) {
            $this->response->setStatusCode( $e->getCode() );
            echo $this->view->renderView( '_error', [
                'exception' => $e,
            ] );
        }

    }

    /**
     * Get controller
     *
     * @return object
     */
    public function getController() {
        return $this->controller;
    }

    /**
     * Set controller
     *
     * @param \app\core\Controller $controller
     * @return void
     */
    public function setController( Controller $controller ) {
        $this->controller = $controller;
    }

    /**
     * Login method
     *
     * @param DbModel $user
     * @return void
     */
    public function login( DbModel $user ) {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set( 'user', $primaryValue );

        return true;
    }

    /**
     * Logout method
     *
     * @return void
     */
    public function logout() {
        $this->user = null;
        $this->session->remove( 'user' );
    }

    /**
     * Check the user status
     *
     * @return boolean
     */
    public static function isGuest() {
        return !self::$app->user;
    }

}