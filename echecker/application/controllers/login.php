
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    function __contruct(){
        parent::__contruct();
    }

	public function index()
	{
		$this->_view('login');
	}

    public function authenticateLogin(){
     
        $this->load->model('mdl_Users');
        $query = $this->mdl_Users->validateLogin($_POST);
        
        if($query){
            $_SESSION['users'] = $query[0];
            array_push($_SESSION['users'], $query[1]);
            echo json_encode($_SESSION['users']);

        }else{
            echo json_encode(false);
        }
        
    }

}
