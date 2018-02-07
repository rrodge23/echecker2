
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
                ->order_by('questionairetbl.idquestionaire','ASC')
                ->get('user_questionairetbl');
        }
        if($_SESSION["users"]["user_level"] == "2"){ 
            $query=$this->db->join('questionairetbl','user_questionairetbl.questionaire_id = questionairetbl.idquestionaire','left')
            ->join('subjecttbl','questionairetbl.idsubject = subjecttbl.idsubject','left')
            ->order_by('questionairetbl.idquestionaire','ASC')
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
                return $query->result_array();
        }
       
    }
    public function reportstudentquestionnaireinfo($data=false){
        
        if($_SESSION["users"]["user_level"] == "2"){ 
            $query=$this->db->join('questionairetbl','user_questionairetbl.questionaire_id = questionairetbl.idquestionaire','left')
                ->join('subjecttbl','questionairetbl.idsubject = subjecttbl.idsubject','left')
                ->where('user_questionairetbl.idusers',$data["idusers"])
                ->where('questionairetbl.idsubject',$data["idsubject"])
                ->get('user_questionairetbl');
                return $query->result_array();
        }
       
    }

    public function reportstudentlistquestionnaire($data=false){
        
        $query = $this->db->join('subjecttbl','user_subjecttbl.idsubject = subjecttbl.idsubject')
                        ->join('questionairetbl','subjecttbl.idsubject = questionairetbl.idsubject')
                        ->join('user_questionairetbl','questionairetbl.idquestionaire = user_questionairetbl.questionaire_id')
                        ->join('users','user_subjecttbl.UID = users.idusers','left')
                        ->join('student_informationtbl','users.idusers = student_informationtbl.id','left')
                        ->join('user_departmenttbl','users.idusers = user_departmenttbl.UID','left')
                        ->join('departmenttbl','user_departmenttbl.iddepartment = departmenttbl.iddepartment','left')
                        ->join('user_coursetbl','users.idusers = user_coursetbl.iduser_course','left')
                        ->join('coursetbl','user_coursetbl.idcourse = coursetbl.idcourse','left')
                        ->group_by('user_subjecttbl.UID')
                ->where('user_subjecttbl.idsubject',$data)
                ->where('users.user_level',"1")
                ->get('user_subjecttbl');

        return $query->result_array();
    }
    public function updatequestionscore($data=false){
      
        if($data["idquestionuseranswer"] !== null && $data["idquestionuseranswer"] != ""){
            $isUpdated = $this->db->set('question_score',(string)$data["newscore"])
            ->where('iduseranswer',$data["idquestionuseranswer"])
            ->update('user_answertbl');
            if($isUpdated){
                
                $query = $this->db->where('iduserquestionaire',$data["iduserquestionaire"])
                    ->get('user_questionairetbl');
                $questionaireData = $query->row_array();
                $newScore = (((int)$data["newscore"]) - ((int)$data["score"]));
                $newTotalScore = ((int)$questionaireData["user_total_score"] + $newScore);
                $isQuestionUpdated = $this->db->set('user_total_score',$newTotalScore)
                                    ->where('iduserquestionaire',$data["iduserquestionaire"])
                                    ->update('user_questionairetbl');
                if($isQuestionUpdated){
                    return array("successfully updated",true,$newTotalScore);
                }else{
                    return array("Error Updating",false);
                }
            }else{
                return array("Error Updating",false);
            }
        }else{
            
        }
        
        return array("Error Updating",false);
    }

}


?>