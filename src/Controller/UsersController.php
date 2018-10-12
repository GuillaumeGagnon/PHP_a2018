<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
	
	public function login()
	{
		if ($this->request->is('post')) {
		$user = $this->Auth->identify();
		if ($user) {
			$this->Auth->setUser($user);
			return $this->redirect($this->Auth->redirectUrl());
		}
		$this->Flash->error('Votre identifiant ou votre mot de passe est incorrect.');
		}
	}
		
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout', 'add', 'login']);
		
		/**/
		$this->Auth->user('id'); // rend $_SESSION accessible dans le template
		/**/
	}

	public function logout()
	{
		$this->Flash->success('Vous avez été déconnecté.');
		return $this->redirect($this->Auth->logout());
	}
	
	
	public function isAuthorized($logged_user = null)
	{
		/* debug($logged_user['id']);
		debug($this->request->getParam('pass.0'));
		gr; */
		//si admin, on fait ce que l'on veut
		if($logged_user['role']  === 2){
			//debug($user);
			return true;
		}
		
		$action = $this->request->getParam('action');
		
		if (in_array($action, ['add', 'login', 'about'])) {
			return true;
		} else if(in_array($action, ['delete', 'view'])){
			if($this->request->getParam('pass.0') == $logged_user['id']){
				//debug($logged_user);
				return true;
			}
			return false;
		}
		
		
		if (!$id = $this->request->getParam('pass.0')) {
			//ded;
			//le if vérifie si le dernier parametre (le 'pass.0') est non-null
			//si c est le cas, une erreur est soulever
			
			//cela empeche l'app de crasher lors du dernier return
			return false;
		}
		//ufuejf;
		
		// On vérifie que l'article appartient à l'utilisateur connecté
		$user = $this->Users->findById($id)->first();
		//debug($user = $this->Users->findById($id)->first());
		//var_dump($passenger);
		//debug($user->id);
		//debug($user['id']);
		return $user->id === $logged_user['id'];
	}
	
	
	
	

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
	
		//$this->loadModel('Passengers');
		$this->loadModel('Trains');
		//debug($this->Users);
		//debug($this->loadModel('Passengers'));
		//debug();
        $user = $this->Users->get($id, [
            'contain' => ['Passengers']
        ]);
		
		/*$passenger = $this->Passengers->get($id+3, [
            'contain' => ['Users', 'Trains']
        ]);*/
		
		$trains = $this->Trains->find('list')->all()->toArray(); //retourne array des trains
		//$results = $query->all();
		//$data = $results->toArray();
		//debug($query);
		//debug($results);
		//debug($data);
		

        //$this->set('user', $user);
		$this->set(compact('user', 'trains'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		//debug($_SESSION['Auth']['User']['id']);
		$id = $_SESSION['Auth']['User']['id'];
		$this->loadModel('Roles');
		//$roles = $this->paginate($this->Roles);
		//debug($roles);
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved and you have been redirected to your profile.'));

                return $this->redirect(['controller' => 'Users', 'action' => 'view/'.$id]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
		; //retourne array des trains
		$roles = $this->Roles->find('list')->all()->toArray();//retourne array des roles
        //debug($roles);
		$this->set(compact('user', 'roles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->loadModel('Roles');
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['controller' => 'Users', 'action' => 'view/'.$id]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
		
		$roles = $this->Roles->find('list')->all()->toArray();//retourne array des roles
        //debug($roles);
		$this->set(compact('user', 'roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	 public function about()
    {
		
    }
}
