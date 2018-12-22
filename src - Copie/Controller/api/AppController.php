<?php
namespace App\Controller\Api;
use Cake\Controller\Controller;
use Cake\Event\Event;
class AppController extends Controller {
    

    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        
        $this->loadComponent('Auth', [
            

            'authenticate' => [

                'Form' => [

                    'scope' => [
                        'Users.active' => 1
                        ]

                ]
                ,
                'ADmad/JwtAuth.Jwt' => [

                    'parameter' => 'token', 'userModel' => 'Users', 'scope' => ['Users.active' => 1], 'fields' => [
                        'username' => 'id'
                    ], 'queryDatasource' => true
                ]
            ],
            'unauthorizedRedirect' => false,
            'checkAuthIn' => 'Controller.initialize'
        ]);
    }
}