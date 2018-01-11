
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_examinations extends CI_Model {

    function __construct(){
        parent::__construct();
    }
   
    public function getAllCurrentUserSubjects($data=false){
        $query=$this->db->join('subjecttbl','user_subjecttbl.idsubject = subjecttbl.idsubject','left')
                    ->join('subject_scheduletbl','subjecttbl.schedule = subject_scheduletbl.idschedule','left')
                    ->join('class_subjecttbl','subjecttbl.idsubject = class_subjecttbl.idsubject','left')
                ->where('UID',$data)
            ->get('user_subjecttbl');
        return $query->result_array();
    }

    
    public function userQuestionaireList($data=false){
        $query=$this->db->join('subjecttbl','user_subjecttbl.idsubject = subjecttbl.idsubject','left')
                    ->join('subject_scheduletbl','subjecttbl.schedule = subject_scheduletbl.idschedule','left')
                ->where('UID',$data)
            ->get('user_subjecttbl');
        return $query->result_array();
    }
}


?>