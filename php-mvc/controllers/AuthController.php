<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\User;
use app\core\Session;
use app\models\LoginForm;
use app\core\middlewares\AuthMiddleware;

/**
 * Class AuthController
 *
 * @author Shamim <emtiaz51921@gmail.com>
 * @package app\controller;
 */

class AuthController extends Controller {

    public function __construct() {
        $this->registerMiddleware( new AuthMiddleware( ['profile'] ) );
    }

    public function login( Request $request, Response $response ) {

        $loginForm = new LoginForm();

        if ( $request->isPost() ) {
            $loginForm->loadData( $request->getBody() );

            if ( $loginForm->validate() && $loginForm->login() ) {
                $response->redirect( '/' );

                return;
            }

        }

        $this->setLayout( 'main' );
        $params = [
            'name'  => 'Login',
            'model' => $loginForm,
        ];

        return $this->render( 'login', $params );
    }

    public function register( Request $request ) {

        $User = new User();

        $params = [
            'name'  => 'Register',
            'model' => $User,
        ];

        if ( $request->isPost() ) {
            $User->loadData( $request->getBody() );

            if ( $User->validate() && $User->save() ) {
                Application::$app->session->setFlash( 'success', 'Thanks for your registration' );
                Application::$app->response->redirect( '/' );
                exit();
            }

            return $this->render( 'register', $params );
        }

        $this->setLayout( 'main' );

        return $this->render( 'register', $params );
    }

    public function logout( Request $request, Response $response ) {
        Application::$app->logout();
        $response->redirect( '/' );

    }

    public function profile() {
        return $this->render( 'profile' );
    }

}