
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(isset($_SESSION['users'])){
            if($this->uri->segment(1) == 'login' || $this->uri->segment(1) == '' || $this->uri->segment(1) == 'home'){
                redirect('dashboard','refresh');
            }
            if($this->uri->segment(1) != 'changepassword'){
                if($this->uri->segment(1) != 'logout'){
                    if($_SESSION['users']['status'] != 'active'){
                        redirect('changepassword','refresh');
                    }
                }
                
            }
            
        }else{
            if($this->uri->segment(1) != ''){
                if($this->uri->segment(1) != 'login'){
                    redirect('login','refresh');
                }
            }
            if($this->uri->segment(1) != 'login'){
                if($this->uri->segment(1) != ''){
                    redirect('login','refresh');
                }
            }
            
        }
    }

    public function _view($pages='login',$data=array()){
        if(!file_exists(APPPATH . 'views/pages/' . $pages . '.php')){
            show_404();
        }
        $datas['data'] = $data;
        $path['currentPath'] = $this->uri->segment(1);
        $this->load->view('layouts/header',$path);
        if($this->uri->segment(1) != 'login'){
            $this->load->view('layouts/layout',$path);
        }
        $this->load->view('pages/'. $pages,$datas);
        $this->load->view('layouts/footer',$path);

    }

    public function n_view($pages='home',$data=array()){
        if(!file_exists(APPPATH . 'views/pages/' . $pages . '.php')){
            show_404();
        }
        $datas['data'] = $data;
        $path['currentPath'] = $this->uri->segment(1);
        $this->load->view('layouts/header',$path);
        $this->load->view('pages/'. $pages,$datas);
        $this->load->view('layouts/footer',$path);

    }

}
