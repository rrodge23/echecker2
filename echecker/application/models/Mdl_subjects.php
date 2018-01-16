
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_subjects extends CI_Model {

    function __construct(){
        parent::__construct();
    }
   
    public function getAllSubjectList(){
        $query=$this->db->join('subject_scheduletbl','subjecttbl.schedule = subject_scheduletbl.idschedule','left')
                    ->get('subjecttbl');
        return $query->result_array();
    }

    public function getAvailableSubjects(){
        $query=$this->db->join('subject_scheduletbl','subjecttbl.schedule = subject_scheduletbl.idschedule','left')
                        ->where('subjecttbl.idsubject NOT IN (SELECT user_subjecttbl.idsubject FROM user_subjecttbl)',NULL,FALSE)
                        ->get('subjecttbl');
      
        return $query->result_array();
    }
    public function getallSubjectUsersById($data=false){
        $query=$this->db->join('subjecttbl','user_subjecttbl.idsubject = subjecttbl.idsubject','left')
                        ->join('subject_scheduletbl','subjecttbl.schedule = subject_scheduletbl.idschedule','left')
                        ->join('users','user_subjecttbl.UID = users.idusers','left')
                        ->join('user_departmenttbl','users.idusers = user_departmenttbl.UID','left')
                        ->join('departmenttbl','user_departmenttbl.iddepartment = departmenttbl.iddepartment','left')
                        ->join('user_coursetbl','users.idusers = user_coursetbl.iduser_course','left')
                        ->join('coursetbl','user_coursetbl.idcourse = coursetbl.idcourse','left')
                        ->where('user_subjecttbl.idsubject',$data)
                    ->get('user_subjecttbl');
                   
        $userListData = $query->result_array();
        
        if($userListData){
            foreach($userListData as $key => $value){
                
                if($value['user_level'] == "1"){
                    $studentQuery=$this->db->where('id',$value['idusers'])
                                ->get('student_informationtbl');
                    $studentData = $studentQuery->result_array();
                    
                    if($studentData){
                       
                        $userListData[$key] = array_merge($userListData[$key],$studentData[0]);    
                       
                    }
                }
                if($value['user_level'] == "2"){
                    $teacherQuery=$this->db->where('id',$value['idusers'])
                                ->get('teacher_informationtbl');
                    $teacherData = $teacherQuery->result_array();
                    
                    if($teacherData){
                        $userListData[$key] = array_merge($userListData[$key],$teacherData[0]);    
                    }

                }
                
            }
            
            return $userListData;
        }

        return false;
    }

    public function addSubject($data=false){
    
        $queryResult = $this->db->where('subject_code',$data['subject_code'])->get('subjecttbl');
        if($queryResult->row_array()){
            return array("Duplicate Subject Code",false);
        }

        $queryResult = $this->db->insert('subjecttbl',$data);
        if($queryResult){
            if(isset($data['schedule'])){
                $last_insert = $this->db->insert_id();

                $isUpdated = $this->db->set('status','unavailable')
                                    ->where('idschedule',$data['schedule'])
                                    ->update('subject_scheduletbl');
                if($isUpdated){
                    return array("",true);
                }
            }
        }else{
            return array("Error in Inserting Subject",false);
        }
        return array("",false);

    }
    
    public function getSubjectInfoById($data=false){
      
        $query=$this->db->where('idsubject',$data['id'])
                    ->join('subject_scheduletbl', 'subjecttbl.schedule = subject_scheduletbl.idschedule', 'left')
                    ->get('subjecttbl');
        $getSubject = $query->row_array();
        if($getSubject){
            return array($getSubject, true);   
        }else{
            return array("No Subject Found",false);
        }
        return array("",false);
    }

    public function updateSubject($data=false){
       
        $query=$this->db->not_like('idsubject',$data['idsubject'])
                    ->where('subject_code',$data['subject_code'])
                    ->get('subjecttbl');
         if($getSubject = $query->row_array()){
            return array("Subject Already Exist", false);   
        }else{
            $currentSubject = $this->db->where('idsubject',$data['idsubject'])->get('subjecttbl');
            $getSubject = $currentSubject->row_array();
           
            if($isUpdated = $this->db->set($data)
                                ->where('idsubject',$data['idsubject'])
                                ->update('subjecttbl')){
              
                if($getSubject['schedule'] != $data['schedule']){
                    if($this->db->set('status','available')->where('idschedule',$getSubject['schedule'])->update('subject_scheduletbl')){
                        if($this->db->set('status','unavailable')->where('idschedule',$data['schedule'])->update('subject_scheduletbl')){
                            return array("",true);
                        }else{
                            return array("Error in Updating new Schedule", false); 
                        }
                    }else{
                        return array("Error in Updating old schedule", false); 
                    }
                }
                return array($isUpdated,true);
            }else{
                return array("Failed to Update Subject", false);
            }
        }               
        return array("asdasd",false);
    }
    
    public function deleteSubject($data=false){
        $queryGetSubject = $this->db->where('idsubject',$data)->get('subjecttbl');
        if($subjectInfo = $queryGetSubject->row_array()){
            $isSchedUpdate = $this->db->set('status','available')
                                    ->where('idschedule',$subjectInfo['schedule'])
                                    ->update('subject_scheduletbl');
            if($isSchedUpdate){
                $queryDeletefrmClassSubjecttbl = $this->db->where('idsubject',$data)
                                                ->delete('class_subjecttbl');
                                                
                $query=$this->db->where('idsubject',$data)
                    ->delete('user_subjecttbl');
                $query=$this->db->where('idsubject',$data)
                ->delete('subjecttbl');
               

                if($query){
                    return array("Successfully Deleted", true);   
                }else{
                    return array("Error in Record Deletion", false);  
                }
             
            }
        }
        
        return array("",false);
    }

}


?>