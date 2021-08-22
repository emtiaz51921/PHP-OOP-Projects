<?php

namespace app\core;

use app\core\exception\NotFoundException;

/**
 * Class Application
 *
 * @author Shamim <emtiaz51921@gmail.com>
 * @package app\core;
 */

class Router {

    protected array $routes = [];
    public Request $request;
    public Response $response;

    /**
     * Router construction
     *
     *@param \app\core\Request $request
     *@param \app\core\Response $response
     */
    public function __construct( Request $request, Response $response ) {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * It will save the path inside $routes array
     * as per get or post method
     *
     * @param string $path
     * @param string $callback
     * @return string
     */
    public function get( $path, $callback ) {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * Handle all POST request
     *
     * @param string $path
     * @param string $callback
     * @return string
     */
    public function post( $path, $callback ) {
        $this->routes['post'][$path] = $callback;
    }

    /**
     * This function will get the path and method
     * and call user function which will display the view files
     *
     * @return string
     */
    public function resolve() {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if ( false === $callback ) {
            throw new NotFoundException();

        }

        if ( is_string( $callback ) ) {
            return Application::$app->view->renderView( $callback );
        }

        if ( is_array( $callback ) ) {

            /** @var \app\core\Controller $controller */
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach ( $controller->getMiddleware() as $middleware ) {
                $middleware->execute();
            }

        }

        return call_user_func( $callback, $this->request, $this->response );

    }

}