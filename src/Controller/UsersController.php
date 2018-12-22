<?php
namespace App\Controller;

require_once(ROOT. DS . 'vendor' . DS  . 'recaptcha'. DS . 'recaptchalib.php');

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
            //debug($_POST["g-recaptcha-response"]);

            //$secret = "6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI";
            $secret = "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe";
            $response = null;
            $reCaptcha = new ReCaptcha($secret);
            //debug($reCaptcha);
           
            if($_POST["g-recaptcha-response"]){ //on vérifie si le captcha est présent
                $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"],$_POST["g-recaptcha-response"]); //on vérifie si le captcha est valide avec les clés
                //debug($response->success);dsd;
                if($response->success){//si le captcha est un success
                    $user = $this->Auth->identify();
                } else{
                    $user = null;
                }
                
                //debug($response);rf;
            }else{
                $user = null;
            }
		//$user = $this->Auth->identify();
		if ($user) {
			$this->Auth->setUser($user);
			return $this->redirect($this->Auth->redirectUrl());
		}
		$this->Flash->error('Votre identifiant, votre mot de passe ou le Captcha est incorrect.');
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
        $id = null; // par default
        //debug($_SESSION['Auth']['User']['id']);
        if(array_key_exists('Auth', $_SESSION)){
            if(array_key_exists('User', $_SESSION['Auth'])){
                if(array_key_exists('id', $_SESSION['Auth']['User'])){
                    $id = $_SESSION['Auth']['User']['id'];
                }  
            }
        }
		
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

?>

<?php
/**
 * This is a PHP library that handles calling reCAPTCHA.
 *    - Documentation and latest version
 *          https://developers.google.com/recaptcha/docs/php
 *    - Get a reCAPTCHA API Key
 *          https://www.google.com/recaptcha/admin/create
 *    - Discussion group
 *          http://groups.google.com/group/recaptcha
 *
 * @copyright Copyright (c) 2014, Google Inc.
 * @link      http://www.google.com/recaptcha
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * A ReCaptchaResponse is returned from checkAnswer().
 */
class ReCaptchaResponse
{
    public $success;
    public $errorCodes;
}

class ReCaptcha
{
    private static $_signupUrl = "https://www.google.com/recaptcha/admin";
    private static $_siteVerifyUrl = "https://www.google.com/recaptcha/api/siteverify?";
    private $_secret;
    private static $_version = "php_1.0";

    /**
     * Constructor.
     *
     * @param string $secret shared secret between site and ReCAPTCHA server.
     */
    
    //function ReCaptcha($secret)
    function __construct($secret)
    {
        //debug($secret);
        if ($secret == null || $secret == "") {
            die("To use reCAPTCHA you must get an API key from <a href='"
                . self::$_signupUrl . "'>" . self::$_signupUrl . "</a>");
        }
        $this->_secret=$secret;
        //$this->_secret="6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe"; //pour test
    }

    /**
     * Encodes the given data into a query string format.
     *
     * @param array $data array of string elements to be encoded.
     *
     * @return string - encoded request.
     */
    private function _encodeQS($data)
    {
        $req = "";
        foreach ($data as $key => $value) {
            $req .= $key . '=' . urlencode(stripslashes($value)) . '&';
        }

        // Cut the last '&'
        $req=substr($req, 0, strlen($req)-1);
        return $req;
    }

    /**
     * Submits an HTTP GET to a reCAPTCHA server.
     *
     * @param string $path url path to recaptcha server.
     * @param array  $data array of parameters to be sent.
     *
     * @return array response
     */
    private function _submitHTTPGet($path, $data)
    {
        $req = $this->_encodeQS($data);        
        $response = file_get_contents($path . $req);
        return $response;
    }

    /**
     * Calls the reCAPTCHA siteverify API to verify whether the user passes
     * CAPTCHA test.
     *
     * @param string $remoteIp   IP address of end user.
     * @param string $response   response string from recaptcha verification.
     *
     * @return ReCaptchaResponse
     */
    public function verifyResponse($remoteIp, $response)
    {
        
        // Discard empty solution submissions
        if ($response == null || strlen($response) == 0) {
            $recaptchaResponse = new ReCaptchaResponse();
            $recaptchaResponse->success = false;
            $recaptchaResponse->errorCodes = 'missing-input';
            return $recaptchaResponse;
        }

        $getResponse = $this->_submitHttpGet(
            self::$_siteVerifyUrl,
            array (
                'secret' => $this->_secret,
                'remoteip' => $remoteIp,
                'v' => self::$_version,
                'response' => $response
            )
        );
        
        $answers = json_decode($getResponse, true);
        $recaptchaResponse = new ReCaptchaResponse();
        //debug($answers);die;
        if (trim($answers ['success']) == true) {
            $recaptchaResponse->success = true;
        } else {
            $recaptchaResponse->success = false;
            $recaptchaResponse->errorCodes = $answers;
        }

        return $recaptchaResponse;
    }
}

?>
