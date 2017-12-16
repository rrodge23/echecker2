
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_courses extends CI_Model {

    function __construct(){
        parent::__construct();
    }
   
    public function getAllcourses(){
        $query=$this->db->get('coursetbl');
        return $query->result_array();
    }

    public function addcourse($data=false){
        
        $query=$this->db->where('course_name',$data['course_name'])
                    ->get('coursetbl');
        if($query->num_rows > 0){
            return array('course Already Exist', false);   
        }else{
            return array($this->db->insert('coursetbl',$data),true);
        }
        return array("",false);
    }
    
    public function getcourseInfoById($data=false){
      
        $query=$this->db->where('idcourse',$data['id'])
                    ->get('coursetbl');
        $getcourse = $query->row_array();
        if($getcourse){
            return array($getcourse, true);   
        }else{
            return array("No Found",false);
        }
        return array("",false);
    }

    public function updatecourse($data=false){
      
        $query=$this->db->not_like('idcourse',$data['idcourse'])
                    ->where('course_name',$data['course_name'])
                    ->get('coursetbl');
         if($getcourse = $query->row_array()){
            return array("course Already Exist", false);   
        }else{
            if($isUpdated = $this->db->set($data)->where('idcourse',$data['idcourse'])->update('coursetbl')){
                return array($isUpdated,true);
            }else{
                return array("Failed to Update", false);
            }
        }               
        return array("",false);
    }
    
    public function deletecourse($data=false){
        $queryResult = $this->db->where('idcourse',$data)->delete('user_coursetbl');
        if(!($queryResult)){
            return array("Error in Record Deletion", false);   
        }

        $query=$this->db->where('idcourse',$data)
                    ->delete('coursetbl');
        if($query){
            return array("", true);   
        }else{
            return array("Error in Record Deletion", false);   
        }               
        return array("",false);
    }

}


?>