
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
        $query=$this->db->where('idclass',$data)
            ->get('questionairetbl');
        return $query->result_array();
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
        $isQuestionaireDataInserted = $this->db->insert('questionairetbl',$questionnaireData);
       
            if(isQuestionaireDataInserted){
                $questionaireID = $this->db->insert_id();
                $questionnaireTypeData["idquestionaire"] = $questionaireID;
                for($i=0;$i < (count($data)-1);$i++){
                    $questionnaireTypeData = array();
                    foreach($data[$i]["data"] as $key => $value){
                        $questionnaireTypeData[$key] = $value;
                    }
                    $isQuestionaireTypeDataInserted = $this->db->insert('questionaire_typetbl',$questionnaireTypeData);
                    
                    if($isQuestionaireTypeDataInserted){
                        $questionaireTypeID = $this->db->insert_id();
                        
                        for($j=0;$j<(count($data[$i])-1);j++){
                            $questionData["question_title"] = $data[$i][$j]["question"];
                            $questionData["idquestionaire_type"] = $questionaireTypeID;
                            $isQuestionDataInserted = $this->db->insert('questiontbl',$questionData);
                            if($isQuestionDataInserted){
                                $questionID = $this->db->insert_id();

                                if($data[$i]["data"]["questionaire_type"] == 0){
                                    $choicesData["idquestion"] = $questionID;
                                    for($k=0;$k<(count($data[$i][$j])-2);$k++){
                                        $choicesData[$k] = $data[$i][$j][$k];
                                    }
                                    $isChoicesDataInserted = $this->db->insert('question_choicestbl',$choicesData)
                                    if(isChoicesDataInserted){
                                        $answerData["answwer"] = $data[$i][$j]["answer"];
                                        $answerData["idquestion"] = $questionID;
                                        $isAnswerDataInserted = $this->db-insert('question_answertbl',$answerData);
                                        if(!$isAnswerDataInserted){
                                            return array("Error in Inserting answer table",false);
                                        }
                                    }else{
                                        return array("Error in Inserting choices table",false);
                                    }
                                    

                                }else if($data[$i]["data"]["questionaire_type"] == 1){
                                    for($k=0;$k<(count($data[$i][$j])-1);$k++){
                                        $answerData["answer"] = $data[$i][$j]["answer"];
                                        $answerData["idquestion"] = $questionID;

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

        
       
        return array("Record Successfully Added",true);
        
    }


    /*
            "questionaire_type": questionType,
                        'questionaire_type_title': categoryTitle,
                        'questionaire_type_question_quantity':questionQuantity,
                        'questionaire_type_item_points':itemPoints,
                        'questionaire_type_item_quantity':itemQuantity,
                        'questionaire_type_total_item':totalItem,
    Array
(
    [0] => Array
        (
            [0] => Array
                (
                    [0] => hahah
                    [1] => hehehe
                    [question] => <p>asdfasf</p>
                    [answer] => hahah
                )

            [1] => Array
                (
                    [0] => hehehe
                    [1] => hahahaha
                    [question] => <p>qwer</p>
                    [answer] => hehehe
                )

            [type] => 0
        )

    [1] => Array
        (
            [0] => Array
                (
                    [0] => answe1
                    [1] => answer2
                    [question] => <p>question</p>
                )

            [type] => 1
        )

    [header] => Array
        (
            [title] => 1
            [description] => 1
            [date] => 01-26-18
            [time] => 08:04
            [duration] => 3660
            [instruction] => <p>1</p>
        )

)
    */

    
} 


?>