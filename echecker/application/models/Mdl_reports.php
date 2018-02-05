
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_reports extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
    public function questionnairelistreports($data=false){
        $userID = $_SESSION["users"]["idusers"];
        $dateNow = Date('m-d-y');
        if($_SESSION["users"]["user_level"] == "1"){ 
            $query=$this->db->join('questionairetbl','user_questionairetbl.questionaire_id = questionairetbl.idquestionaire','left')
                ->join('subjecttbl','questionairetbl.idsubject = subjecttbl.idsubject','left')
                ->where('user_questionairetbl.idusers',$userID)
                ->where('questionairetbl.idsubject',$data)
                ->get('user_questionairetbl');
        }
        return $query->result_array();
    }

    public function reportquestionnaireinfo($data=false){
        $userID = $_SESSION["users"]["idusers"];
        $dateNow = Date('m-d-y');
        if($_SESSION["users"]["user_level"] == "1"){ 
            $query=$this->db->join('questionairetbl','user_questionairetbl.questionaire_id = questionairetbl.idquestionaire','left')
                ->join('subjecttbl','questionairetbl.idsubject = subjecttbl.idsubject','left')
                ->where('user_questionairetbl.idusers',$userID)
                ->where('questionairetbl.idsubject',$data)
                ->get('user_questionairetbl');
        }
        return $query->result_array();
    }

}


?>