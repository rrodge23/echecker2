
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_examinations extends CI_Model {

    function __construct(){
        parent::__construct();
    }
   
    public function getAllCurrentUserSubjects($data=false){
        $query=$this->db->join('subjecttbl','user_subjecttbl.idsubject = subjecttbl.idsubject')
                    ->join('subject_scheduletbl','subjecttbl.schedule = subject_scheduletbl.idschedule','left')
                ->where('UID',$data)
            ->get('user_subjecttbl');
        return $query->result_array();
    }

    
    public function userQuestionaireList($data=false){
        $query=$this->db->where('idsubject',$data)
            ->get('questionairetbl');
        return $query->result_array();
    }

    
   
    public function deleteQuestionaire($data=false){
        $query=$this->db->select('questionaire_typetbl.idquestionairetype')
                        ->where('questionaire_typetbl.idquestionaire',$data)
                ->get('questionaire_typetbl');
        
        if($questionaireTypeIdData = $query->result_array()){
           
            for($i=0;$i<count($questionaireTypeIdData);$i++){
                
                $query = $this->db->select('idquestion')
                                ->where('idquestionaire_type',$questionaireTypeIdData[$i]["idquestionairetype"])
                        ->get('questiontbl');
                if($questionIdData = $query->result_array()){
                    for($j=0;$j<count($questionIdData);$j++){

                        $query = $this->db->select('idquestion_choices')
                                ->where('idquestion',$questionIdData[$j]["idquestion"])
                                ->get('question_choicestbl');
                        if($questionChoicesIdData = $query->result_array()){
                           for($k=0;$k<count($questionChoicesIdData);$k++){
                                $isChoicesDeleted = $this->db->where('idquestion_choices',$questionChoicesIdData[$k]["idquestion_choices"])  
                                        ->delete('question_choicestbl');
                                if(!$isChoicesDeleted){
                                    return array("Error in Dropping Choices Data",false);
                                }
                           }
                        }

                        $query = $this->db->select('idquestion_answer')
                                    ->where('idquestion',$questionIdData[$j]["idquestion"])
                                    ->get('question_answertbl');
                        if($questionAnswerIdData = $query->result_array()){
                            for($k=0;$k<count($questionAnswerIdData);$k++){
                                $isAnswerDeleted = $this->db->where('idquestion_answer',$questionAnswerIdData[$k]["idquestion_answer"])  
                                        ->delete('question_answertbl');
                                if(!$isAnswerDeleted){
                                    return array("Error in Dropping Answer Data",false);
                                }
                            }
                        }

                        $isQuestionDeleted = $this->db->where('idquestion',$questionIdData[$j]["idquestion"])  
                                ->delete('questiontbl');
                        if(!$isQuestionDeleted){
                            return array("Error in Dropping Question Data",false);
                        }

                    }
                }
                
                $isQuestionTypeDeleted = $this->db->where('idquestionairetype',$questionaireTypeIdData[$i]["idquestionairetype"])  
                        ->delete('questionaire_typetbl');
                if(!$isQuestionTypeDeleted){
                    return array("Error in Dropping Question Type Data",false);
                }
            }
        }
        $isQuestionaireDeleted = $this->db->where('idquestionaire',$data)  
                ->delete('questionairetbl');
        if(!$isQuestionaireDeleted){
            return array("Error in Dropping Questionaire Data",false);
        }

        return array("",true);
    }

    

    public function subjectclassinformation($data=false){
        $query=$this->db->join('users','user_subjecttbl.UID = users.idusers','left')
                        ->join('student_informationtbl','users.idusers = student_informationtbl.id','left')
                        ->join('user_coursetbl','users.idusers = user_coursetbl.iduser_course','left')
                        ->join('coursetbl','user_coursetbl.idcourse = coursetbl.idcourse','left')
                        ->join('user_departmenttbl','users.idusers = user_departmenttbl.UID','left')
                        ->join('departmenttbl','user_departmenttbl.iddepartment = departmenttbl.iddepartment','left')
                        ->join('subjecttbl','user_subjecttbl.idsubject = subjecttbl.idsubject','left')
                        ->where('user_subjecttbl.idsubject',$data)
                        ->where('users.user_level','1')
            ->get('user_subjecttbl');
        return $query->result_array();
    }

    public function postQuestionnaireInformation($data=false){
       
        $questionnaireData = array();
        foreach($data["data"] as $key => $value){
            $questionnaireData[$key] = $value;
        }
        $dataIdSubject = $questionnaireData["idsubject"];
        $isQuestionaireDataInserted = $this->db->insert('questionairetbl',$questionnaireData);
       
            if($isQuestionaireDataInserted){
                $questionaireID = $this->db->insert_id();
                $questionnaireTypeData["idquestionaire"] = $questionaireID;
                for($i=0;$i < (count($data)-1);$i++){
                    
                    foreach($data[$i]["data"] as $key => $value){
                        $questionnaireTypeData[$key] = $value;
                    }
                    
                    $isQuestionaireTypeDataInserted = $this->db->insert('questionaire_typetbl',$questionnaireTypeData);
                    
                    if($isQuestionaireTypeDataInserted){
                        $questionaireTypeID = $this->db->insert_id();
                        
                        for($j=0;$j<(count($data[$i])-1);$j++){
                            $questionData["question_title"] = $data[$i][$j]["question"];
                            $questionData["idquestionaire_type"] = $questionaireTypeID;
                            $isQuestionDataInserted = $this->db->insert('questiontbl',$questionData);
                            if($isQuestionDataInserted){
                                $questionID = $this->db->insert_id();

                                if($data[$i]["data"]["questionaire_type"] == 0){
                                    $choicesData["idquestion"] = $questionID;
                                    for($k=0;$k<(count($data[$i][$j])-2);$k++){
                                        $choicesData["choices_description"] = $data[$i][$j][$k];
                                        $isChoicesDataInserted = $this->db->insert('question_choicestbl',$choicesData);
                                        if($isChoicesDataInserted){
                                            $answerData["idquestion"] = $questionID;
                                            $answerData["answer"] = $data[$i][$j]["answer"];
                                            $isAnswerDataInserted = $this->db->insert('question_answertbl',$answerData);
                                            if(!$isAnswerDataInserted){
                                                return array("Error in Inserting answer table",false);
                                            }
                                        }else{
                                            return array("Error in Inserting choices table",false);
                                        }
                                    }
                                    
                                    

                                }else if($data[$i]["data"]["questionaire_type"] == 1){
                                    for($k=0;$k<(count($data[$i][$j])-1);$k++){
                                        $answerData["idquestion"] = $questionID;
                                        $answerData["answer"] = $data[$i][$j][$k];

                                        $isAnswerDataInserted = $this->db->insert('question_answertbl',$answerData);
                                        if(!$isAnswerDataInserted){
                                            return array("Error in Inserting answer table",false);
                                        }
                                    }
                                }
                                
                            }else{
                                return array("Error in Inserting question table",false);
                            }

                            
                        }
                    }else{
                        return array("Error in Inserting questionaire type table",false);
                    }
                }
            }else{
                return array("Error in Inserting questionaire table",false);
                
            } // END else

         // END IF 

        
       
        return array("Record Successfully Added",true,$dataIdSubject);
        
    }


    public function getQuestionnaireInfoById($data=false){

        $examData = array();

        $query=$this->db->where('idquestionaire',$data)
            ->get('questionairetbl');
        if($questionaireData = $query->result_array()){
           
            foreach($questionaireData[0] as $key => $value){
                $examData[$key] = $value;
            }
            $query = $this->db->where('idquestionaire',$data)
                ->get('questionaire_typetbl');
            if($questionaireTypeData = $query->result_array()){ 

                foreach($questionaireTypeData as $key => $value){
                    $examData["questionaire_type"][$key] = $value;

                    $query = $this->db->where('idquestionaire_type',$examData["questionaire_type"][$key]["idquestionairetype"])
                    ->get('questiontbl');
                    if($questionData = $query->result_array()){
                        for($i=0;$i<count($questionData);$i++){
                            $examData["questionaire_type"][$key]["question"][$i] = $questionData[$i];

                            if($examData["questionaire_type"][$key]["question"][$i]["idquestionaire_type"] == "0"){
                                $query = $this->db->where('idquestion',$examData["questionaire_type"][$key]["question"][$i]["idquestion"])
                                ->get('question_choicestbl');

                                if($choicesData = $query->result_array()){
                                    for($j=0;$j<count($choicesData);$j++){
                                        $examData["questionaire_type"][$key]["question"][$i]["choices"][$j] = $choicesData[$j];

                                    }
                                }

                            }
                            
                            $query = $this->db->where('idquestion',$examData["questionaire_type"][$key]["question"][$i]["idquestion"])
                            ->get('question_answertbl');
                            if($answerData = $query->result_array()){
                                for($j=0;$j<count($answerData);$j++){
                                    $examData["questionaire_type"][$key]["question"][$i]["answer"][$j] = $answerData[$j];
                                }
                                
                            }
                        }
                    }
                }
                
            }
           
        }   
        
        return $examData;
    }
    
} 


?>