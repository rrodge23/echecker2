
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_classes extends CI_Model {

    function __construct(){
        parent::__construct();
    }
   
    public function getAllClasses(){
        $query=$this->db->join('class_subjecttbl','classtbl.idclass = class_subjecttbl.idclass')
                        ->join('subjecttbl','class_subjecttbl.idsubject = subjecttbl.idsubject')
            ->get('classtbl');
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

      public function getClassesInfoById($data=false){
         
          $query=$this->db->where('classtbl.idclass',$data['id'])
                      ->join('class_subjecttbl', 'classtbl.idclass = class_subjecttbl.idclass', 'left')
                      ->join('subjecttbl', 'class_subjecttbl.idsubject = subjecttbl.idsubject', 'left')
                      ->get('classtbl');
          $getClasses = $query->row_array();
          if($getClasses){
              return array($getClasses, true);   
          }else{
              return array("No Classes Found",false);
          }
          return array("",false);
      }

      public function updateClasses($data=false){

         $query=$this->db->not_like('idclass',$data['idclass'])
                     ->where('class_name',$data['class_name'])
                      ->get('classtbl');
          if($getClasses = $query->row_array()){
             return array("Class Already Exist", false);   
         }else{
             $currentClasses = $this->db->where('idclass',$data['idclass'])
                                ->get('classtbl');
             $getClasses = $currentClasses->row_array();
             $isClassSubjectDeleted = $this->db->where('idclass',$data['idclass'])
                            ->delete('class_subjecttbl');

             if($isClassSubjectDeleted){
                 $tempData = $data;
                 unset($tempData['idsubject']);
                if($isUpdated = $this->db->set($tempData)
                                ->where('idclass',$data['idclass'])
                                ->update('classtbl')){
                    $classSubjectIdData = array('idsubject' => $data['idsubject'], 'idclass' => $data['idclass']);               
                    $isClassSubjectUpdated = $this->db->insert('class_subjecttbl', $classSubjectIdData);
                    if($isClassSubjectUpdated){
                        return array("Sucessfully Updated",true);
                    }else{
                        return array("Failed to Insert Class Subject", false);
                    }

                    
                }else{
                    return array("Failed to Update Classes", false);
                }
             }else{
                return array("error in deleting subject class",false);
             }
             
         }               
         return array("asdasd",false);
     }

}


?>