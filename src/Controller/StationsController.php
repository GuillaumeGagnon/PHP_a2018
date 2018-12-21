<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Stations Controller
 *
 * @property \App\Model\Table\StationsTable $Stations
 *
 * @method \App\Model\Entity\Station[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StationsController extends AppController
{
	
	
	public function beforeFilter(Event $event) {

		parent::beforeFilter($event);

		$this->Auth->allow('view');
		$this->Auth->allow('index');

	}
	
	public function filtreListeLiees() {
        /*$station_types_id = $this->request->query('type');

        $stations = $this->Stations->find('all', [
            'conditions' => ['Stations.type' => $station_types_id],
        ]);
        $this->set('stations', $stations);
        $this->set('_serialize', ['stations']);*/
        $category_id = $this->request->query('type');

        $subcategories = $this->Stations->find('all', [
            'conditions' => ['Stations.type' => $category_id],
        ]);
        $this->set('subcategories', $subcategories);
        $this->set('_serialize', ['subcategories']);
    }


    
	

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		
		$this->Auth->user('id'); // rend $_SESSION accessible dans le template
        $stations = $this->paginate($this->Stations);

		$this->loadModel('StationTypes');
		$stationTypes = $this->StationTypes->find('list')->all()->toArray();
		//debug($stationTypes);

        $this->set(compact('stations' ,'stationTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Station id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		
		$this->Auth->user('id'); // rend $_SESSION accessible dans le template
        $station = $this->Stations->get($id, [
            'contain' => []
        ]);
		
		$this->loadModel('StationTypes');
		$stationTypes = $this->StationTypes->find('list')->all();
		

        $this->set(compact('station', 'stationTypes'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->Auth->user('id'); // rend $_SESSION accessible dans le template
		
        $station = $this->Stations->newEntity();
        if ($this->request->is('post')) {
            $station = $this->Stations->patchEntity($station, $this->request->getData());
            if ($this->Stations->save($station)) {
                $this->Flash->success(__('The station has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The station could not be saved. Please, try again.'));
        }
		
		$this->loadModel('StationTypes');
		$stationTypes = $this->StationTypes->find('list')->all();
		
		
        $this->set(compact('station', 'stationTypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Station id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->Auth->user('id'); // rend $_SESSION accessible dans le template
		
        $station = $this->Stations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $station = $this->Stations->patchEntity($station, $this->request->getData());
            if ($this->Stations->save($station)) {
                $this->Flash->success(__('The station has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The station could not be saved. Please, try again.'));
        }
       
	   
	   $this->loadModel('StationTypes');
		$stationTypes = $this->StationTypes->find('list')->all();
		
		
        $this->set(compact('station', 'stationTypes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Station id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $station = $this->Stations->get($id);
        if ($this->Stations->delete($station)) {
            $this->Flash->success(__('The station has been deleted.'));
        } else {
            $this->Flash->error(__('The station could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function isAuthorized($user = null)
	{
		//si admin, on fait ce que l'on veut
		if($user['role']  === 2){
			//debug($user);
			return true;
		}		
		
	}
	
}
