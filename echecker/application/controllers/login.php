
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
        
        echo json_encode($query);
        
    }

    public function registeradmin(){
        
        $this->_view('registeradmin');
           
    }

    public function postregisteradmin(){
        
        $this->load->model('mdl_Users');
        $query = $this->mdl_Users->postregisteradmin($_POST);
        
        echo json_encode($query);
           
    }

}
