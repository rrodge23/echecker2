<?php
    if(isset($data["questionaire_duration"])){
        $Durationtime = $data["questionaire_duration"];
        $hours = floor($Durationtime / 3600);
        $mins = floor($Durationtime / 60 % 60);
        $secs = floor($Durationtime % 60);
        $timeFormat = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
    }
    
?>

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
            <div class="card-footer">
                <!-- tab start -->
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="duration" id="countdownduration" value="<?=$data["questionaire_duration"]?>">
                        <ul class="nav nav-tabs tab-nav-right tab-header" id="tab-header" role="tablist" style="margin-bottom:50px;">
                            <li role="presentation" class="active" style="width:20%;" id="tab-header-examine" data-id="0">
                                <a href="#tab-examine" data-toggle="tab">
                                    <span class="material-icons">add</span>
                                </a>
                            </li>
                            
                        </ul>

                            <!-- Tab panes -->
                        <div class="tab-content" id="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="tab-examine" data-id="0">
                                
                                
                            </div><!-- end tab panel first div -->
                            
                        
                        </div> <!-- end tab content div -->
                        
                        
                        
                    </div>
                </div>
                <!-- tab end -->
            </div>
        </div>
        <!-- content  end-->

    </div>
</div>


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
