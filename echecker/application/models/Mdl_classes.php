
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_classes extends CI_Model {

    function __construct(){
        parent::__construct();
    }
   
    public function getAllClasses(){
        $query=$this->db->get('classtbl');
        return $query->result_array();
    }

    public function addClasses($data=false){
        
        $query=$this->db->where('idsubject',$data['idsubject'])
                    ->get('class_subjecttbl');
                   
        $queryData = $query->result_array();            
        if(!empty($queryData['idclass'])){
            return array('Class Already Exist', false);   
        }else{
            $classData = array('class_name' => $data['class_name'],
                            'class_description' => $data['class_description'],
                            'room_name' => $data['room_name']
                        );

            $isClassInserted = $this->db->insert('classtbl',$classData);
            if($isClassInserted){
                   $last_insert = $this->db->insert_id();
                   $classSubjectData = array('idclass' => $last_insert, 'idsubject' => $data['idsubject']);
                   $isClassSubjectInserted = $this->db->insert('class_subjecttbl',$classSubjectData);
                   if($isClassSubjectInserted){
                        return array('Class Added', true);   
                   }
            }else{
                return array('Error in adding Class', false);
            }
            
        }
        return array("",false);
    }


    public function deleteClasses($data=false){
        
          $query=$this->db->where('idclass',$data)
                      ->delete('class_subjecttbl');
          if($query){
              $classQuery = $this->db->where('idclass',$data)
              ->delete('classtbl');
          }else{
              return array("Error in Record Deletion", false);   
          }               
          return array("",false);
      }

}


?>