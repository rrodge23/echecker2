
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_departments extends CI_Model {

    function __construct(){
        parent::__construct();
    }
   
    public function getAllDepartments(){
        $query=$this->db->get('departmenttbl');
        return $query->result_array();
    }

    public function addDepartment($data=false){
        
        $query=$this->db->where('department_name',$data['department_name'])
                    ->get('departmenttbl');
        if($query->num_rows > 0){
            return array('Department Already Exist', false);   
        }else{
            return array($this->db->insert('departmenttbl',$data),true);
        }
        return array("",false);
    }
    
    public function getDepartmentInfoById($data=false){
      
        $query=$this->db->where('iddepartment',$data['id'])
                    ->get('departmenttbl');
        $getDepartment = $query->row_array();
        if($getDepartment){
            return array($getDepartment, true);   
        }else{
            return array("No Found",false);
        }
        return array("",false);
    }

    public function updateDepartment($data=false){
      
        $query=$this->db->not_like('iddepartment',$data['iddepartment'])
                    ->where('department_name',$data['department_name'])
                    ->get('departmenttbl');
         if($getDepartment = $query->row_array()){
            return array("Department Already Exist", false);   
        }else{
            if($isUpdated = $this->db->set($data)->where('iddepartment',$data['iddepartment'])->update('departmenttbl')){
                return array($isUpdated,true);
            }else{
                return array("Failed to Update", false);
            }
        }               
        return array("",false);
    }
    
    public function deleteDepartment($data=false){
      
        $query=$this->db->where('iddepartment',$data)
                    ->delete('departmenttbl');
        if($query){
            return array("", true);   
        }else{
            return array("Error in Record Deletion", false);   
        }               
        return array("",false);
    }

}


?>