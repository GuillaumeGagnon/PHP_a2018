<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Passengers Controller
 *
 * @property \App\Model\Table\PassengersTable $Passengers
 *
 * @method \App\Model\Entity\Passenger[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PassengersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Trains']
        ];
        $passengers = $this->paginate($this->Passengers);
		
		/**/
		$passenger = $this->Auth->user('id'); // rend $_SESSION accessible dans le template
		/**/
		
		$this->set(compact('passengers', 'passenger'));
        //$this->set(compact('passengers'));
    }

    /**
     * View method
     *
     * @param string|null $id Passenger id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $passenger = $this->Passengers->get($id, [
            'contain' => ['Users', 'Trains']
        ]);
		$this->Auth->user('id'); // rend $_SESSION accessible dans le template
        $this->set('passenger', $passenger);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $passenger = $this->Passengers->newEntity();
        if ($this->request->is('post')) {
            $passenger = $this->Passengers->patchEntity($passenger, $this->request->getData());
			
			
			//on force le user_id a celui de la session_cache_expire
			$passenger->user_id = $this->Auth->user('id'); // rend $_SESSION accessible dans le template
			
			
            if ($this->Passengers->save($passenger)) {
                $this->Flash->success(__('The passenger has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The passenger could not be saved. Please, try again.'));
        }
        $users = $this->Passengers->Users->find('list', ['limit' => 200]);
        $trains = $this->Passengers->Trains->find('list', ['limit' => 200]);
        $this->set(compact('passenger', 'users', 'trains'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Passenger id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $passenger = $this->Passengers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is([/*'patch',*/ 'post', 'put'])) {
			
			
            //$passenger = $this->Passengers->patchEntity($passenger, $this->request->getData());
			//
			//
			/*********************************************************/
			//empeche le changement du user_id
			$this->Passengers->patchEntity($passenger, $this->request->getData(),[
				'accessibleFields' => ['user_id' => false]
			]);
			/*********************************************************/
			
			
            if ($this->Passengers->save($passenger)) {
                $this->Flash->success(__('The passenger has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The passenger could not be saved. Please, try again.'));
        }
        $users = $this->Passengers->Users->find('list', ['limit' => 200]);
        $trains = $this->Passengers->Trains->find('list', ['limit' => 200]);
        $this->set(compact('passenger', 'users', 'trains'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Passenger id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $passenger = $this->Passengers->get($id);
        if ($this->Passengers->delete($passenger)) {
            $this->Flash->success(__('The passenger has been deleted.'));
        } else {
            $this->Flash->error(__('The passenger could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	
	
	public function beforeFilter(Event $event) {

		parent::beforeFilter($event);

		//$this->Auth->allow('index');

	}
	
	
	
	
	public function isAuthorized($user = null)
	{
		
		//si admin, on fait ce que l'on veut
		if($user['role']  === 2){
			//debug($user);
			return true;
		}
		
		$action = $this->request->getParam('action');
		
		//debug(in_array($action, ['add']));
		
		if (in_array($action, ['add','index'])) {
			return true;
		}
		

		// Toutes les autres actions nécessitent un slug
		
		if (!$id = $this->request->getParam('pass.0')) {
			//le if vérifie si le dernier parametre (le 'pass.0') est non-null
			//si c est le cas, une erreur est soulever
			
			//cela empeche l'app de crasher lors du dernier return
			return false;
		}
		
		
		
		// On vérifie que l'article appartient à l'utilisateur connecté
		$passenger = $this->Passengers->findById($id)->first();
		//var_dump($passenger);
		return $passenger->user_id === $user['id'];
	}
	
	
	
}
