<?php
namespace App\Controller;

use App\Controller\AppController; 
use Cake\Event\Event;
use Cake\Console\ShellDispatcher;

/**
 * Trains Controller
 *
 * @property \App\Model\Table\TrainsTable $Trains
 *
 * @method \App\Model\Entity\Train[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TrainsController extends AppController
{
	
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow('trouverTrain', 'autocompletetrains', 'autocomplete', 'display', 'view', 'index');
	}

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		
		$this->Auth->user('id'); // rend $_SESSION accessible dans le template
		
		//$stations= $this->paginate($this->Stations);
		//debug($stations);
		
		
        $trains = $this->paginate($this->Trains);
		
		$this->loadModel('Stations');
		$stations = $this->Stations->find('list')->all()->toArray();
        $this->set(compact('trains', 'stations'));
    }
	
	

    /**
     * View method
     *
     * @param string|null $id Train id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		
		$this->Auth->user('id'); // rend $_SESSION accessible dans le template
		
		
        $train = $this->Trains->get($id, [
            'contain' => []
        ]);

		$this->loadModel('Stations');
		$stations = $this->Stations->find('list')->all()->toArray();
		$this->set(compact('train', 'trains', 'stations'));
        //$this->set('train', $train);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		
		
		$this->Auth->user('id'); // rend $_SESSION accessible dans le template
		
		
        $train = $this->Trains->newEntity();
        if ($this->request->is('post')) {
            $train = $this->Trains->patchEntity($train, $this->request->getData());
            if ($this->Trains->save($train)) {
                $this->Flash->success(__('The train has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The train could not be saved. Please, try again.'));
        }
		
		$this->loadModel('Stations');
        $stations = $this->Stations->find('list')->all();
        $this->set(compact('train', 'stations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Train id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		
		$this->Auth->user('id'); // rend $_SESSION accessible dans le template
		$this->loadModel('Stations');
		
        $train = $this->Trains->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $train = $this->Trains->patchEntity($train, $this->request->getData());
            if ($this->Trains->save($train)) {
                $this->Flash->success(__('The train has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The train could not be saved. Please, try again.'));
        }
		
		$this->loadModel('Stations');
        $stations = $this->Stations->find('list', ['limit' => 200]);
        $this->set(compact('train', 'stations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Train id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $train = $this->Trains->get($id);
        if ($this->Trains->delete($train)) {
            $this->Flash->success(__('The train has been deleted.'));
        } else {
            $this->Flash->error(__('The train could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	
	public function beforeFilter(Event $event) {

		parent::beforeFilter($event);

		$this->Auth->allow('view');
		$this->Auth->allow('index');
		$this->Auth->allow('trouverTrain', 'autocompletetrains', 'autocomplete');

	}
	
	public function isAuthorized($user = null)
	{
		//si admin, on fait ce que l'on veut
		if($user['role']  === 2){
			//debug($user);
			return true;
		}
		if(in_array($action, ['autocompletetrains', 'trouverTrain'])){
            return true;
        }
		return true;
		
	}
	
	public function trouverTrain() {

        if ($this->request->is('ajax')) {
            $this->autoRender = false;
			
            $name = $this->request->query['term'];
			
            $resultats = $this->Trains->find('all', array(
                'conditions' => array('trains.name LIKE ' => '%' . $name . '%')
            ));
			
            $resultArr = array();
			
            foreach ($resultats as $resultat) {
                $resultArr[] = array('label' => $resultat['name'], 'value' => $resultat['name']);
            }
			
            echo json_encode($resultArr);
        }
    }
	
	public function toPDf($id)
    {
		$shell = new ShellDispatcher();
		$output = $shell->run(['cake', 'toPDf', 'http://localhost/PHP/trains/view/'.$id]);
	 
		if (0 === $output) {
			$this->Flash->success('Successfully printed in PDF.');
		} else {
			$this->Flash->error('Failed to print in PDF.');
		}
	 
		return $this->redirect('/');
    }
	
	
	
	
	
	
	
	
	
}
