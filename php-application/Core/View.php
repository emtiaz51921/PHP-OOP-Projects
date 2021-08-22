<?php
namespace Core;

use Exception;

/**
 * View class
 *
 * PHP version 7.4
 */

class View {

    /**
     * Render a view file
     *
     * @param string $view The view file
     * @return void
     */
    public static function render( $view, $args = [] ) {

        if ( $args ) {
            extract( $args, EXTR_SKIP );
        }

        // relative to core directory
        $file = "../App/Views/$view";

        if ( is_readable( $file ) ) {
            require $file;
        } else {
            throw new Exception( $file . " not found" );
        }

    }

    /**
     * Render a view template using twig
     *
     * @param string $template
     * @param array $args
     * @return void
     */
    public static function renderTemplate( $template, $args = [] ) {
        static $twig = null;

        if ( null === $twig ) {
            $loader = new \Twig\Loader\FilesystemLoader( '../App/Views' );
            $twig = new \Twig\Environment( $loader );
        }

        echo $twig->render( $template, $args );
    }

}