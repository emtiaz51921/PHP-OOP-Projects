<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\ContactForm;

/**
 * Class Application
 *
 * @author Shamim <emtiaz51921@gmail.com>
 * @package app\controllers;
 */

class SiteController extends Controller {

    public function contact( Request $request, Response $response ) {
        $contact = new ContactForm();

        $params = [
            'name'  => 'Contact US',
            'model' => $contact,
        ];

        if ( $request->isPost() ) {
            $contact->loadData( $request->getBody() );

            if ( $contact->validate() && $contact->send() ) {
                Application::$app->session->setFlash( 'success', 'Thanks for contacting us.' );

                return $response->redirect( '/contact' );
            }

        }

        return $this->render( 'contact', $params );
    }

    public function home() {
        $params = [
            'name' => 'Home',
        ];

        return $this->render( 'home', $params );
    }

}