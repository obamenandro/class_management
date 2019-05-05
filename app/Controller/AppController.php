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
    public $components = [
        'Flash',
        'Auth' => [
            'authError'      => 'You must be logged in to view this page.',
            'loginError'     => 'Invalid Username or Password entered, please try again.',
            'authenticate'   => [
                'Form' => [
                    // 'passwordHasher' => 'Blowfish',
                    'fields' => [
                        'username' => 'username',
                        // 'password' => 'password'
                    ]
                ]
            ]
        ],
        'Session'
    ];
    /**
    * get $dataSource
    * @return $this->dataSource's name
    */
    // public function getDataSourceName(){
    //     return ConnectionManager::getSourceName($this->dataSource);
    // }
    
    /**
    * get $dataSource
    * @return $this->dataSource
    */
    // public function getDataSource(){
    //     return $this->dataSource;
    // }

    public function beforeFilter() {
        $this->Auth->allow();
        $this->autoRender = false;
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Methods', 'POST, PUT, GET, OPTIONS');
        
        //datasource for transaction
        // $this->dataSource = ConnectionManager::getDataSource('default');
    }

}
