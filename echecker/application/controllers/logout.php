
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends MY_Controller {

    function __contruct(){
        parent::__contruct();
        $this->load->library('session');
        
    }

	public function index()
	{
		session_destroy();
        unset($_SESSION);
        redirect('login','refresh');
	}


    public function changePassword(){
        $this->n_view('changepassword');
    }

    public function postNewPassword(){
        if($_SESSION['users']['pass'] != $_POST['oldPassword']){
            echo json_encode(false);
            return false;
        }
        if($_POST['newPassword'] != $_POST['reNewPassword']){
            echo json_encode(false);
            return false;
        }
        $this->load->model('mdl_Users');
        $query = $this->mdl_Users->changePassword($_POST);
        if($query){
            $_SESSION['users']['pass'] = $query;
            $_SESSION['users']['status'] = 'active';
            echo json_encode($query);
        }else{
            echo json_encode(false);
        }
        
    }



}
