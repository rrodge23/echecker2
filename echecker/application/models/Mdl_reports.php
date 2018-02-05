
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
            $query=$this->db->join('user_questionairetbl','questionairetbl.idquestionaire = user_questionairetbl.questionaire_id','left')
                ->join('subjecttbl','questionairetbl.idsubject = subjecttbl.idsubject','left')
                ->where('user_questionairetbl.idusers !=',$userID)
                ->where('questionairetbl.questionaire_status','approved')
                ->where('questionairetbl.idsubject',$data)
                ->or_where("(questionairetbl.idquestionaire != user_questionairetbl.questionaire_id AND user_questionairetbl.idusers != $userID AND questionairetbl.questionaire_status = 'approved' AND questionairetbl.idsubject = $data)",NULL,FALSE)
                ->get('questionairetbl');
        }else if($_SESSION["users"]["user_level"] == "2"){
            $query=$this->db->join('user_questionairetbl','questionairetbl.idquestionaire = user_questionairetbl.questionaire_id','left')
            ->join('subjecttbl','questionairetbl.idsubject = subjecttbl.idsubject','left')
            ->where('user_questionairetbl.idusers !=',$_SESSION["users"]["idusers"])
            ->where('questionairetbl.idsubject',$data)
            ->or_where("(questionairetbl.idquestionaire NOT IN ('SELECT user_questionairetbl.questionaire_id FROM user_questionairetbl') AND questionairetbl.idsubject = $data)",NULL,FALSE)
                ->get('questionairetbl');
        } 
        return $query->result_array();
    }

}


?>