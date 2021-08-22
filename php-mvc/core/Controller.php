<?php

namespace app\core;

use app\core\middlewares\BaseMiddleware;

/**
 * Class Controller
 *
 * @author Shamim <emtiaz51921@gmail.com>
 * @package app\core;
 */

class Controller {

    /**
     * Site layout
     *
     * @var string
     */
    public string $layout = 'main';
    public string $action = '';

    /**
     * @var \app\core\middlewares\BaseMiddleware[]
     */
    protected array $middlewares = [];

    /**
     * Set layout
     *
     * @param string $layout
     * @return void
     */
    public function setLayout( $layout ) {
        $this->layout = $layout;
    }

    /**
     * Render view
     *
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render( $view, $params = [] ) {
        return Application::$app->view->renderView( $view, $params );
    }

    /**
     * Register middleware
     *
     * @param \app\core\middlewares\BaseMiddleware $middleware
     * @return void
     */
    public function registerMiddleware( BaseMiddleware $middleware ) {
        $this->middlewares[] = $middleware;
    }

    /**
     * Geter for middlewares
     *
     * @return array
     */
    public function getMiddleware(): array{
        return $this->middlewares;
    }
}