<?php

namespace app\core;

/**
 * Class View
 *
 * @author Shamim <emtiaz51921@gmail.com>
 * @package app\core;
 */

class View {

    public string $title = '';

    /**
     * This function will allocation two layout and display on browser
     *
     * @param string $view
     * @return string
     */
    public function renderView( $view, $params = [] ) {

        $viewContent = $this->renderOnlyView( $view, $params );
        $layoutContent = $this->layoutContent();

        return str_replace( '{{content}}', $viewContent, $layoutContent );
    }

    /**
     * Allocate the main repetable layout
     *
     * @return string
     */
    protected function layoutContent() {

        $layout = Application::$app->layout;

        if ( Application::$app->controller ) {
            $layout = Application::$app->controller->layout;
        }

        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";

        return ob_get_clean();
    }

    /**
     * Allocate user specific page content
     *
     * @param string $view
     * @return string
     */
    protected function renderOnlyView( $view, $params ) {

        foreach ( $params as $key => $value ) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";

        return ob_get_clean();
    }

    /**
     * Render content only like 404 page
     *
     * @param string $viewContent
     * @return string
     */
    public function renderContent( $viewContent = '' ) {
        $layoutContent = $this->layoutContent();

        return str_replace( '{{content}}', $viewContent, $layoutContent );
    }

}