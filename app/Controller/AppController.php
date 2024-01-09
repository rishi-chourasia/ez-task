<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    //Required Components
    public $components = [
        'Paginator',
        'Flash',
        'Session',
        'Cookie',
        'Auth' => [
            'loginAction' => [
                'controller' => 'users',
                'action' => 'signIn',
            ],
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email'),
                    'passwordHasher' => array(
                        'className' => 'Simple',
                        'hashType' => 'sha256'
                    )
                )
            )
        ]
    ];

    /**
     * function to return the json data in JSON format
     *
     * @param data | Array
     * @param statusCode | int
     */
    public function returnJsonData($data, $statusCode = 200){
        $this->autoLayout = false;
        $this->render(false);

        $this->response->body(json_encode($data));
        $this->response->statusCode($statusCode);
        $this->response->type('application/json');

        return $this->response;
    }//end returnJsonData()
}
