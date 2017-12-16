
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_dashboards extends CI_Model {

    function __construct(){
        parent::__construct();
    }
   
    public function getMessage(){
        $query=$this->db->limit(1)->get('bulletintbl');
        return $query->result_array();
    }

    public function postMessage($data=array()){
        $isQueryUpdated = $this->db->set('message',$data['mce_0'])->where('id',1)->update('bulletintbl');
        return $isQueryUpdated;
    
    }
}


?>