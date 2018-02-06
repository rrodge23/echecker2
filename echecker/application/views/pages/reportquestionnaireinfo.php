<?php
    /*echo "<pre>";
    print_r($data);
    echo "</pre>";*/
?>



<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-chart" data-background-color="purple">
                <h5 class="title" style="padding:15px;">
                    <div class="row">
                        <div class="col-md-2">
                        <p class="category">
                                TITLE
                            </p>
                        </div>
                        <div class="col-md-10">
                            <p class="category">
                                <?=$data["questionaire_title"]?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                        <p class="category">
                                DESCRIPTION
                            </p>
                        </div>
                        <div class="col-md-10">
                            <p class="category">
                                <?=$data["questionaire_description"]?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                        <p class="category">
                                DATE
                            </p>
                        </div>
                        <div class="col-md-10">
                            <p class="category">
                                <?=$data["questionaire_date"]?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                        <p class="category">
                                TIME
                            </p>
                        </div>
                        <div class="col-md-10">
                            <p class="category">
                                <?=$data["questionaire_time"]?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                        <p class="category">
                                DURATION
                            </p>
                        </div>
                        <?php
                            $seconds = $data["questionaire_duration"];
                            $hours = sprintf("%02d", (floor($seconds / 3600)));
                            $minutes = sprintf("%02d", (floor(($seconds / 60) % 60)));
                            $seconds = sprintf("%02d", ($seconds % 60));
                        ?>
                        <div class="col-md-10">
                            <p class="category">
                                <?="$hours:$minutes:$seconds"?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                        <p class="category">
                                TOTAL SCORE
                            </p>
                        </div>
                        <div class="col-md-10">
                            <p class="category">
                                <?=$data["questionaire_total_score"]?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                        <p class="category">
                               SCORE
                        </p>
                        </div>
                        <div class="col-md-10">
                            <p class="category">
                                <?=$data["user_total_score"]?>
                            </p>
                        </div>
                    </div>
                </h5>
            
            </div>
            <div class="card-content">
                <!-- tab content start    -->

                <div class="col-md-12">
                    <ul class="nav nav-tabs tab-nav-right" role="tablist" style="margin-bottom:50px;">
                        <!-- tab header -->
                        
                       
                        <?php
                            if($data["questionaire_type"]){
                                foreach($data["questionaire_type"] as $key=>$value){
                                    echo '<li role="presentation" class="tab-examine tabno'.$key.' '.(($key == 0) ? "active" : "").'" style="width:20%;">
                                            <a href="#tab-examine'.$key.'" data-toggle="tab">
                                                <span>'.$value["questionaire_type_title"].' - '.(($value["questionaire_type"] == 0) ? "MULTIPLE CHOICE" : "ESSAY").'</span>
                                            </a>
                                        </li>';
                                }
                            }
                            
                        ?>

                        
                        
                        <!-- tab header end -->
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content col-md-12">
                        
                        <!-- tab content -->
                        <?php
                            if($data["questionaire_type"]){
                                foreach($data["questionaire_type"] as $key=>$value){
                                    
                                    echo '<div role="tabpanel" class="tab-pane fade in '.(($key == 0) ? "active" : "").'" id="tab-examine'.$key.'">';
                                        //bouchie tabpanel start
                                    echo '
                                        <div class="container col-md-12">
                                        <span class="title">CATEGORY TOTAL SCORE:</span><span class="category">'.($data["questionaire_type"][$key]["questionaire_type_total_item"]).'</span>
                                        <input type="hidden" name="idquestionaire" id="input-idquestionaire" value="'.$data["idquestionaire"].'">

                                            <div class="row col-md-12">
                                                <div class="col-md-10 bhoechie-tab-container template'.$key.'">
                                                    <div class="col-md-2 bhoechie-tab-menu btmenu-template'.$key.'">
                                                        <div class="list-group">';
                                                            //bouche tab header
                                                            foreach($data["questionaire_type"][$key]["question"] as $i => $iValue){
                                                                echo '<a href="#" class="list-group-item '.(($i == 0) ? "active" : "").' text-center" data-tab="'.$key.'">
                                                                        <h4 class="glyphicon glyphicon-tags"></h4><br/><b>'.($i+1).'</b>
                                                                    </a>';
                                                            }
                                                            //bouchie tab header end
                                                    echo ' </div>
                                                    </div>
                                                    <div class="col-md-10 bhoechie-tab">';
                                                        foreach($data["questionaire_type"][$key]["question"] as $i => $iValue){
                                                            echo '
                                                            
                                                                ';

                                                            echo '<div class="btcontent-template-tab'.$key.' bhoechie-tab-content '.(($i == 0) ? "active" : "").'">
                                                                    <center>
                                                                        <h1 class="glyphicon glyphicon-question-sign" style="font-size:4em;color:#55518a"></h1>
                                                                        <h2 style="margin-top: 0;color:#55518a">Question no. '.($i+1).'</h2><br><br>
                                                                    </center>
                                                                    
                                                                    <div style="border-left:3px solid #337ab7;border-bottom:1px solid #337ab7;padding:10px" class="col-md-12">
                                                                        <h3 style="margin-top: 0;color:#55518a">'.$data["questionaire_type"][$key]["question"][$i]["question_title"].'</h3>
                                                                    </div><br><br>
                                                                    ';
                                                                    if($data["questionaire_type"][$key]["questionaire_type"] == 0){
                                                                        if(count($iValue["user_answer"]) > 0 && !empty($iValue["user_answer"])){
                                                                            if($iValue["user_answer"][0]["answer"] != null){
                                                                                $answer = $iValue["user_answer"][0]["answer"];
                                                                            }else{
                                                                                $answer = "No Answer";
                                                                            }
                                                                        }else{
                                                                            $answer = "No Answer";
                                                                        }
                                                                        echo '<div>
                                                                            <div class="row">';
                                                                         echo'   <div class="col-md-6">
                                                                                    <h5 class="title">
                                                                                        CHOICES:
                                                                                    </h5>';
                                                                                    foreach($data["questionaire_type"][$key]["question"][$i]["choices"] as $j => $jValue){
                                                                                        echo '<div class="category">
                                                                                                '.$jValue["choices_description"].'
                                                                                            </div>';   
                                                                                    }
                                                                                    echo '    
                                                                                    <h5 class="title">
                                                                                        CORRECT ANSWER:
                                                                                    </h5>
                                                                               
                                                                             
                                                                                    <p class="category">
                                                                                        '.$iValue["answer"][0]["answer"].'
                                                                                    </p>
                                                                               
                                                                             
                                                                                    <h5 class="title">
                                                                                        YOUR ANSWER:
                                                                                    </h5>
                                                                              
                                                                          
                                                                                    <p class="category">
                                                                                        '.$answer.'
                                                                                    </p>
                                                                                ';
                                                                        echo'    </div>';
                                                                        
                                                                        
                                                                        echo '
                                                                        <div class="col-md-6">
                                                                            <div>
                                                                                <h5 class="title">
                                                                                    MARK:
                                                                                </h5>
                                                                            </div>
                                                                            <div>
                                                                                <p class="category">
                                                                                    <span class="pull-left">
                                                                                        <i class="material-icons">'.(($iValue["answer"][0]["answer"] == $answer) ? "circle_check":"close").'</i>
                                                                                    </span>'.(($iValue["answer"][0]["answer"] == $answer) ? "Correct !":"Wrong !").'
                                                                                </p>
                                                                            </div>
                                                                            <div><h5 class="title">
                                                                            POINT/S:
                                                                            </h5>
                                                                            </div>
                                                                            <div class="category">
                                                                                '.(($iValue["answer"][0]["answer"] == $answer) ? $data["questionaire_type"][$key]["questionaire_type_item_points"]:"0").'
                                                                            </div>
                                                                        </div>


                                                                        </div>
                                                                        </div>';
                                                                    }

                                                                    if($data["questionaire_type"][$key]["questionaire_type"] == 1){
                                                                            echo '  <div class="col-md-12">
                                                                                    <div class="row">
                                                                                    <div class="title">
                                                                                        HINT SENTENCE / WORD:
                                                                                    </div>';
                                                                                    
                                                                                    $userAnswer = $data["questionaire_type"][$key]["question"][$i]["user_answer"][0]["answer"];           
                                                                                  
                                                                                    foreach($data["questionaire_type"][$key]["question"][$i]["answer"] as $j => $jValue){
                                                                                        $answer = $jValue["answer"];
                                                                                        echo '<div class="category">
                                                                                                '.$jValue["answer"].' = '. preg_match_all("/\b($answer)\b/",$userAnswer) . ' found' . '
                                                                                            </div>';
                                                                                    }
                                                                                
                                                                                

                                                                                echo '
                                                                                    </div>';
                                                                                    
                                                                                
                                                                                 echo'<div class="row">

                                                                                        <div class="title">
                                                                                            YOUR ANSWER:
                                                                                        </div>
                                                                                        
                                                                                        <div class="col-md-12">';
                                                                                $userAnswer = $data["questionaire_type"][$key]["question"][$i]["user_answer"][0]["answer"];            
                                                                                $arrGivenAnswer = $data["questionaire_type"][$key]["question"][$i]['answer'];
                                                                                
                                                                                for($j=0;$j<count($arrGivenAnswer);$j++){
                                                                                    $givenAnswer = $arrGivenAnswer[$j]["answer"];
                                                                                    $userAnswer = preg_replace("/\b($givenAnswer)\b/",'<span style="background-color:yellow;">$1</span>',$userAnswer);
                                                                                }
                                                                                echo $userAnswer;           
                                                                                echo '        </div>
                                                                                        
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                ';


                                                                                
                                                                                    
                                                                                echo '<div class="form-group col-md-12">
                                                                                
                                                                                </div>';
                                                                            

                                                                    }
                                                                    echo '<input type="hidden" name="idquestion" id="input-idquestion-tabno'.$key.'-'.$i.'" value="'.$data["questionaire_type"][$key]["question"][$i]["idquestion"].'">';
                                                                    
                                                                    
                                                            echo '<br></div>';
                                                        }   
                                                        
                                                    
                                                echo '    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    
                                        //bouchie tabpanel start end
                                    echo '</div>';
                                    
                                }
                            }
                            
                        ?>
                        
                        <!-- tab content end  -->
                    </div>
                </div>





                <!-- tab content end    -->
            </div>
            <div class="card-footer">
               
            </div>
        </div>
    </div>
                       
</div>










<?php
/*
Array
(
    [idquestionaire] => 39
    [idclass] => 0
    [idsubject] => 14
    [questionaire_title] => aaaaa
    [questionaire_description] => aaa
    [questionaire_status] => approved
    [approved_user] => 
    [approved_date] => 2018-02-05 22:59:53
    [questionaire_score] => 
    [questionaire_total_score] => 
    [questionaire_duration] => 3600
    [questionaire_remarks] => 
    [questionaire_date] => 02-05-18
    [questionaire_time] => 22:57
    [questionaire_instruction] => 
aaaaaaaaaaaaaaaaaaaaaaaaaaaaa

a

a

a

a

a

aaaaaaaaaaaaa

 


    [questionaire_type_id] => 0
    [iduserquestionaire] => 10
    [idusers] => 69
    [questionaire_id] => 39
    [user_total_score] => 21
    [questionaire_type] => Array
        (
            [0] => Array
                (
                    [idquestionairetype] => 42
                    [idquestionaire] => 39
                    [questionaire_type_title] => a
                    [questionaire_type] => 0
                    [questionaire_type_question_quantity] => 2
                    [questionaire_type_item_points] => 5
                    [questionaire_type_item_quantity] => 3
                    [questionaire_type_total_item] => 15
                    [questionaire_type_total_score] => 
                    [questionaire_type_score] => 
                    [idquestionaire_type_questions] => 0
                    [question] => Array
                        (
                            [0] => Array
                                (
                                    [idquestion] => 70
                                    [idquestionaire_type] => 42
                                    [question_id] => 0
                                    [question_title] => 
aaa


                                    [question_points] => 
                                    [user_answer] => 
                                    [remark] => 
                                    [choices] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [idquestion_choices] => 99
                                                    [idquestion] => 70
                                                    [choices_description] => aaa
                                                )

                                            [1] => Array
                                                (
                                                    [idquestion_choices] => 100
                                                    [idquestion] => 70
                                                    [choices_description] => a
                                                )

                                        )

                                    [answer] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [idquestion_answer] => 137
                                                    [idquestion] => 70
                                                    [answer] => aaa
                                                )

                                        )

                                )

                            [1] => Array
                                (
                                    [idquestion] => 71
                                    [idquestionaire_type] => 42
                                    [question_id] => 0
                                    [question_title] => 
aa


                                    [question_points] => 
                                    [user_answer] => 
                                    [remark] => 
                                    [choices] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [idquestion_choices] => 101
                                                    [idquestion] => 71
                                                    [choices_description] => aa
                                                )

                                            [1] => Array
                                                (
                                                    [idquestion_choices] => 102
                                                    [idquestion] => 71
                                                    [choices_description] => a
                                                )

                                        )

                                    [answer] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [idquestion_answer] => 138
                                                    [idquestion] => 71
                                                    [answer] => aa
                                                )

                                        )

                                )

                            [2] => Array
                                (
                                    [idquestion] => 72
                                    [idquestionaire_type] => 42
                                    [question_id] => 0
                                    [question_title] => 
aaaa


                                    [question_points] => 
                                    [user_answer] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [idquestionuseranswer] => 23
                                                    [idquestion] => 72
                                                    [iduseranswer] => 23
                                                    [iduser] => 69
                                                    [answer] => aaa
                                                    [question_score] => 5
                                                )

                                            [1] => Array
                                                (
                                                    [idquestionuseranswer] => 24
                                                    [idquestion] => 72
                                                    [iduseranswer] => 24
                                                    [iduser] => 69
                                                    [answer] => aa
                                                    [question_score] => 5
                                                )

                                            [2] => Array
                                                (
                                                    [idquestionuseranswer] => 25
                                                    [idquestion] => 72
                                                    [iduseranswer] => 25
                                                    [iduser] => 69
                                                    [answer] => aaaa
                                                    [question_score] => 5
                                                )

                                        )

                                    [remark] => 
                                    [choices] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [idquestion_choices] => 103
                                                    [idquestion] => 72
                                                    [choices_description] => aaaa
                                                )

                                            [1] => Array
                                                (
                                                    [idquestion_choices] => 104
                                                    [idquestion] => 72
                                                    [choices_description] => a
                                                )

                                        )

                                    [answer] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [idquestion_answer] => 139
                                                    [idquestion] => 72
                                                    [answer] => aaaa
                                                )

                                        )

                                )

                        )

                )

            [1] => Array
                (
                    [idquestionairetype] => 43
                    [idquestionaire] => 39
                    [questionaire_type_title] => a
                    [questionaire_type] => 1
                    [questionaire_type_question_quantity] => 2
                    [questionaire_type_item_points] => 5
                    [questionaire_type_item_quantity] => 3
                    [questionaire_type_total_item] => 15
                    [questionaire_type_total_score] => 
                    [questionaire_type_score] => 
                    [idquestionaire_type_questions] => 0
                    [question] => Array
                        (
                            [0] => Array
                                (
                                    [idquestion] => 73
                                    [idquestionaire_type] => 43
                                    [question_id] => 0
                                    [question_title] => 
baba


                                    [question_points] => 
                                    [user_answer] => 
                                    [remark] => 
                                    [answer] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [idquestion_answer] => 140
                                                    [idquestion] => 73
                                                    [answer] => baba
                                                )

                                            [1] => Array
                                                (
                                                    [idquestion_answer] => 141
                                                    [idquestion] => 73
                                                    [answer] => bababa
                                                )

                                            [2] => Array
                                                (
                                                    [idquestion_answer] => 142
                                                    [idquestion] => 73
                                                    [answer] => b
                                                )

                                        )

                                )

                            [1] => Array
                                (
                                    [idquestion] => 74
                                    [idquestionaire_type] => 43
                                    [question_id] => 0
                                    [question_title] => 
b


                                    [question_points] => 
                                    [user_answer] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [idquestionuseranswer] => 26
                                                    [idquestion] => 74
                                                    [iduseranswer] => 26
                                                    [iduser] => 69
                                                    [answer] => baba asfuasfuh baba jasfkjasdfhj b
                                                    [question_score] => 3.3333333333333
                                                )

                                            [1] => Array
                                                (
                                                    [idquestionuseranswer] => 27
                                                    [idquestion] => 74
                                                    [iduseranswer] => 27
                                                    [iduser] => 69
                                                    [answer] => asfasfhsjfhasjf b asfkgasodf ;alf;afkj;sldfj;asfjk
                                                    [question_score] => 1.6666666666667
                                                )

                                        )

                                    [remark] => 
                                    [answer] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [idquestion_answer] => 143
                                                    [idquestion] => 74
                                                    [answer] => baba
                                                )

                                            [1] => Array
                                                (
                                                    [idquestion_answer] => 144
                                                    [idquestion] => 74
                                                    [answer] => baba
                                                )

                                            [2] => Array
                                                (
                                                    [idquestion_answer] => 145
                                                    [idquestion] => 74
                                                    [answer] => b
                                                )

                                        )

                                )

                        )

                )

        )

)
*/ 
?>