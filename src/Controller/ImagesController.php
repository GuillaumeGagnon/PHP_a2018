<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Images Controller
 *
 * @property \App\Model\Table\ImagesTable $Images
 *
 * @method \App\Model\Entity\Image[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ImagesController extends AppController
{


    public function initialize()
	{
		parent::initialize();
        $this->Auth->allow(['index','view']);
        // les utilisateurs et les anonyme peuvent voir la liste et les enregistrements seulement
    }
    public function isAuthorized($logged_user = null)
	{
		
		if($logged_user['role']  === 2){
			//debug($user);
			return true; //les admins ont acces a 100%
		}
	}


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $images = $this->paginate($this->Images);
        $fichiers = $this->Images->find('all');
        $fichiersRangerNumero = $fichiers->count();
        $this->set('fichiers',$fichiers);
        $this->set('fichiersRangerNumero',$fichiersRangerNumero);
        $this->set(compact('images'));
    }
    
    public function dropZone()
    {
        if ($this->request->is(array('post', 'put','ajax'))) 
        {
            $this->log($_FILES); dede;
            if(!empty($_FILES))
            {
                
                $fileName = $_FILES['file']['name']; //Get the image
                $file_full = '/PHP/webroot/img/';     //Image storage path        
                $file=basename($fileName);
                $ext=pathinfo($file,PATHINFO_EXTENSION); 
                $file_temp_name= $_FILES['file']['tmp_name'];            
                $new_file_name = time().'.'.$ext;
                if(move_uploaded_file($file_temp_name, $file_full.$new_file_name))
                {
                    echo "File Uploaded successfully";die;
                }
                else
                {
                    echo "Error";die;
                }
            }
        }
    }

    public function drop()
    {
    if ($this->request->is(array('post', 'put'))) 
    {
        if(!empty($_FILES))
        {
            $fileName = $_FILES['file']['name']; //Get the image
            $file_full = WWW_ROOT.'img/';     //Image storage path
            $file=basename($fileName);
            $ext=pathinfo($file,PATHINFO_EXTENSION); 
            $file_temp_name= $_FILES['file']['tmp_name'];
            $new_file_name = $fileName;
            if(move_uploaded_file($file_temp_name, $file_full.$new_file_name))
            {
                $image = $this->Images->newEntity();

                $image = $this->Images->patchEntity($image, $this->request->data());

                $image->emplacement = $new_file_name;

                $this->log($this->request->data());
                $this->log($image);

                if ($this->Images->save($image)) {
                    $this->Flash->success(('Image has been uploaded and inserted successfully.'));
                } else {
                    $this->Flash->error(('Erreur de telechargement, veuillez reessayer'));
                }
                echo "Image Uploaded successfully";die;
            }
            else
            {
                echo "Error";die;
            }
        }
    }
}




    /**
     * View method
     *
     * @param string|null $id Image id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $image = $this->Images->get($id, [
            'contain' => []
        ]);

        $this->set('image', $image);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $image = $this->Images->newEntity();
        //debug($_POST);efef;
        //$this->log($_POST);
        if ($this->request->is('post')or $this->request->is('ajax')) {
            if (!empty($this->request->data['Image']['name'])) {

                $emplacement_image = $this->request->data['Image'];
                //$uploadFile = 'img/'.$emplacement_image['name'];
                //debug($emplacement_image);fef;
                $imageName = $this->request->data['Image']['name'];
                $uploadPath = 'img/';
                $uploadFile = $uploadPath . $imageName;
                
                if (move_uploaded_file($emplacement_image['tmp_name'], $uploadFile)) {
                    //$image = $this->Images->patchEntity($image, $this->request->data());
                    //$images = $this->Images->patchEntity($images, $this->request->getData());
					
                    $image->emplacement = $emplacement_image['name'];
                    //debug($image);
                    if ($this->Images->save($image)) {
                        $this->Flash->success(__('L\'image a été téléchargée avec succès.'));
                        return $this->redirect(['action' => 'index']);
                    }else {
                        $this->Flash->error(__('Erreur de telechargement, veuillez reessayer'));
                    }
                }else {
					$this->Flash->error(__('Unable to upload file, please try again.'));
				}

            }else {
                //debug($this->request->data);ef;
				$this->Flash->error(__('Please choose a file to upload.'));   																			
			}

            /*$image = $this->Images->patchEntity($image, $this->request->getData());
            if ($this->Images->save($image)) {
                $this->Flash->success(__('The image has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The image could not be saved. Please, try again.'));*/
        }
        $this->set(compact('image'));
		$this->set('_serialize', ['image']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Image id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    /*public function edit($id = null)
    {
        $image = $this->Images->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $image = $this->Images->patchEntity($image, $this->request->getData());
            if ($this->Images->save($image)) {
                $this->Flash->success(__('The image has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The image could not be saved. Please, try again.'));
        }
        $this->set(compact('image'));
    }*/

    /**
     * Delete method
     *
     * @param string|null $id Image id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $image = $this->Images->get($id);
        if ($this->Images->delete($image)) {
            $this->Flash->success(__('The image has been deleted.'));
        } else {
            $this->Flash->error(__('The image could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


}
