<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * StationTypes Controller
 *
 * @property \App\Model\Table\StationTypesTable $StationTypes
 *
 * @method \App\Model\Entity\StationType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StationTypesController extends AppController
{
	
	
	
	public function beforeFilter(Event $event) {

		parent::beforeFilter($event);

		$this->Auth->allow('view');
		$this->Auth->allow('index');

	}
	

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		
		$this->Auth->user('id'); // rend $_SESSION accessible dans le template
        $stationTypes = $this->paginate($this->StationTypes);

        $this->set(compact('stationTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Station Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		
		$this->Auth->user('id'); // rend $_SESSION accessible dans le template
		
        $stationType = $this->StationTypes->get($id, [
            'contain' => []
        ]);

        $this->set('stationType', $stationType);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		
		$this->Auth->user('id'); // rend $_SESSION accessible dans le template
		
		
        $stationType = $this->StationTypes->newEntity();
        if ($this->request->is('post')) {
            $stationType = $this->StationTypes->patchEntity($stationType, $this->request->getData());
            if ($this->StationTypes->save($stationType)) {
                $this->Flash->success(__('The station type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The station type could not be saved. Please, try again.'));
        }
        $this->set(compact('stationType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Station Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		
		$this->Auth->user('id'); // rend $_SESSION accessible dans le template
		
		
        $stationType = $this->StationTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stationType = $this->StationTypes->patchEntity($stationType, $this->request->getData());
            if ($this->StationTypes->save($stationType)) {
                $this->Flash->success(__('The station type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The station type could not be saved. Please, try again.'));
        }
        $this->set(compact('stationType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Station Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $stationType = $this->StationTypes->get($id);
        if ($this->StationTypes->delete($stationType)) {
            $this->Flash->success(__('The station type has been deleted.'));
        } else {
            $this->Flash->error(__('The station type could not be deleted. Please, try again.'));
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
