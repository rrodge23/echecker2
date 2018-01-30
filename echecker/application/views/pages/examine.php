<?php
    if(isset($data["questionaire_duration"])){
        $Durationtime = $data["questionaire_duration"];
        $hours = floor($Durationtime / 3600);
        $mins = floor($Durationtime / 60 % 60);
        $secs = floor($Durationtime % 60);
        $timeFormat = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
    }
    
?>
<!-- tab start -->
    <div class="row col-md-12">
        <div class="col-md-12">
            <div class="row">
                <input type="hidden" name="duration" id="countdownduration" value="<?=$data["questionaire_duration"]?>">
            </div>
            

                
            <div id="examine-content" style="height:100%;width=100% !important;">
                <div id="agreement-container">
                    <div class="card card-profile">
                        <div class="card-avatar" stlye="background-color:#9c27b0;">
                            <a href="javascript:void();">
                                <img class="img" src="assets/img/homelogo.png" style="background-color:#9c27b0;height:80%;width:100%;"/>
                            </a>
                        </div>
                        <div class="content">
                            <h4 class="card-title"><?=$data["questionaire_title"]?></h4>
                            <h4 class="card-title"><?=$data["questionaire_description"]?></h4><br><br>
                            <h2 class="card-title"><?=$timeFormat?></h2><br><br>
                            <h6 class="category text-gray"><small><?=$data["questionaire_instruction"]?></small></h6>
                            <p class="card-content">
                                <small>Once you click the button your examination time starts to countdown.</small>
                            </p>
                            <div class="card-footer">
                            
                                <button onclick="goToFullScreen()" class="btn btn-primary btn-round button-fullscreen">Start</button>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="examine-container" style="display:none;">
                <!-- content -->
                <div class="card card-stats">
                    <div class="card-header" data-background-color="blue">
                        <i class="material-icons">content_copy</i>
                    </div>
                    <div class="card-content">
                        <h3 class="title"><?=$data["questionaire_title"]?></h3>
                        <p class="category"><?=$data["questionaire_description"]?></p>
                        <p id="demo"></p>
                    </div>
                    <div class="card-footer col-md-12">
                        
                    </div>
                </div>
                <!-- tab start -->
                <div class="col-md-12">
                    <ul class="nav nav-tabs tab-nav-right" role="tablist" style="margin-bottom:50px;">
                        <!-- tab header -->
                        <?php
                            if($data["questionaire_type"]){
                                foreach($data["questionaire_type"] as $key=>$value){
                                    echo '<li role="presentation" class="tab-examine '.(($key == 0) ? "active" : "").'" style="width:20%;">
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
                                            <div class="row col-md-12">
                                                <div class="col-md-10 bhoechie-tab-container">
                                                    <div class="col-md-2 bhoechie-tab-menu btmenu-template'.$key.'">
                                                        <div class="list-group">';
                                                            //bouche tab header
                                                            foreach($data["questionaire_type"][$key]["question"] as $i => $iValue){
                                                                echo '<a href="#" class="list-group-item '.(($i == 0) ? "active" : "").' text-center" data-tab="'.$key.'">
                                                                        <h4 class="glyphicon glyphicon-tags"></h4><br/>'.($i+1).'
                                                                    </a>';
                                                            }
                                                            //bouchie tab header end
                                                    echo ' </div>
                                                    </div>
                                                    <div class="col-md-10 bhoechie-tab">';
                                                        foreach($data["questionaire_type"][$key]["question"] as $i => $iValue){
                                                            echo '<div class="btcontent-template-tab'.$key.' bhoechie-tab-content '.(($i == 0) ? "active" : "").'">
                                                                    <center>
                                                                        <h1 class="glyphicon glyphicon-question-sign" style="font-size:4em;color:#55518a"></h1>
                                                                        <h2 style="margin-top: 0;color:#55518a">Question no. '.($i+1).'</h2><br><br>
                                                                    </center>
                                                                    
                                                                        <div style="border-left:3px solid #337ab7;border-bottom:1px solid #337ab7;padding:10px" class="col-md-12">
                                                                            <h3 style="margin-top: 0;color:#55518a">'.$data["questionaire_type"][$key]["question"][$i]["question_title"].'</h3>
                                                                        </div>
                                                                    
                                                                </div>';
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
            </div>
                <!-- content  end-->



            
            
            
        </div>
        
    </div>
    <!-- tab end -->



<!-- Array





(
    [idquestionaire] => 23
    [idclass] => 0
    [idsubject] => 14
    [questionaire_title] => IT 111 MIDTERM
    [questionaire_description] => english 101 midterm exam grammar
    [questionaire_status] => 
    [approved_user] => 
    [approved_date] => 2018-01-28 11:49:04
    [questionaire_score] => 
    [questionaire_total_score] => 
    [questionaire_duration] => 7320
    [questionaire_remarks] => 
    [questionaire_date] => 01-27-18
    [questionaire_time] => 05:44
    [questionaire_instruction] => 
please dont copy the answer of your seat mate

 


    [questionaire_type_id] => 0
    [questionaire_type] => Array
        (
            [0] => Array
                (
                    [idquestionairetype] => 22
                    [idquestionaire] => 23
                    [questionaire_type_title] => test1
                    [questionaire_type] => 0
                    [questionaire_type_question_quantity] => 4
                    [questionaire_type_item_points] => 2
                    [questionaire_type_item_quantity] => 3
                    [questionaire_type_total_item] => 6
                    [questionaire_type_total_score] => 
                    [questionaire_type_score] => 
                    [idquestionaire_type_questions] => 0
                    [question] => Array
                        (
                            [0] => Array
                                (
                                    [idquestion] => 31
                                    [idquestionaire_type] => 22
                                    [question_id] => 0
                                    [question_title] => 
english is


                                    [question_points] => 
                                    [user_answer] => 
                                    [remark] => 
                                    [answer] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [idquestion_answer] => 54
                                                    [idquestion] => 31
                                                    [answer] => sample
                                                )

                                            [1] => Array
                                                (
                                                    [idquestion_answer] => 55
                                                    [idquestion] => 31
                                                    [answer] => sample
                                                )

                                            [2] => Array
                                                (
                                                    [idquestion_answer] => 56
                                                    [idquestion] => 31
                                                    [answer] => sample
                                                )

                                            [3] => Array
                                                (
                                                    [idquestion_answer] => 57
                                                    [idquestion] => 31
                                                    [answer] => sample
                                                )

                                        )

                                )

                            [1] => Array
                                (
                                    [idquestion] => 32
                                    [idquestionaire_type] => 22
                                    [question_id] => 0
                                    [question_title] => 
difference difficult and hard?


                                    [question_points] => 
                                    [user_answer] => 
                                    [remark] => 
                                    [answer] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [idquestion_answer] => 58
                                                    [idquestion] => 32
                                                    [answer] => its your problem
                                                )

                                            [1] => Array
                                                (
                                                    [idquestion_answer] => 59
                                                    [idquestion] => 32
                                                    [answer] => its your problem
                                                )

                                            [2] => Array
                                                (
                                                    [idquestion_answer] => 60
                                                    [idquestion] => 32
                                                    [answer] => its your problem
                                                )

                                            [3] => Array
                                                (
                                                    [idquestion_answer] => 61
                                                    [idquestion] => 32
                                                    [answer] => its your problem
                                                )

                                        )

                                )

                            [2] => Array
                                (
                                    [idquestion] => 33
                                    [idquestionaire_type] => 22
                                    [question_id] => 0
                                    [question_title] => 
what is English ?


                                    [question_points] => 
                                    [user_answer] => 
                                    [remark] => 
                                    [answer] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [idquestion_answer] => 62
                                                    [idquestion] => 33
                                                    [answer] => i dunno
                                                )

                                            [1] => Array
                                                (
                                                    [idquestion_answer] => 63
                                                    [idquestion] => 33
                                                    [answer] => i dunno
                                                )

                                            [2] => Array
                                                (
                                                    [idquestion_answer] => 64
                                                    [idquestion] => 33
                                                    [answer] => i dunno
                                                )

                                            [3] => Array
                                                (
                                                    [idquestion_answer] => 65
                                                    [idquestion] => 33
                                                    [answer] => i dunno
                                                )

                                        )

                                )

                        )

                )

            [1] => Array
                (
                    [idquestionairetype] => 23
                    [idquestionaire] => 23
                    [questionaire_type_title] => test1
                    [questionaire_type] => 1
                    [questionaire_type_question_quantity] => 4
                    [questionaire_type_item_points] => 2
                    [questionaire_type_item_quantity] => 3
                    [questionaire_type_total_item] => 6
                    [questionaire_type_total_score] => 
                    [questionaire_type_score] => 
                    [idquestionaire_type_questions] => 0
                    [question] => Array
                        (
                            [0] => Array
                                (
                                    [idquestion] => 34
                                    [idquestionaire_type] => 23
                                    [question_id] => 0
                                    [question_title] => 
explain what is language .


                                    [question_points] => 
                                    [user_answer] => 
                                    [remark] => 
                                    [answer] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [idquestion_answer] => 66
                                                    [idquestion] => 34
                                                    [answer] => communication
                                                )

                                            [1] => Array
                                                (
                                                    [idquestion_answer] => 67
                                                    [idquestion] => 34
                                                    [answer] => it is a word
                                                )

                                        )

                                )

                        )

                )

        )

) -->
