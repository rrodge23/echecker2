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
<form method="POST" id="frm-examine">
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
                            
                                <button type="button" onclick="goToFullScreen();" class="btn btn-primary btn-round button-fullscreen">Start</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="examine-container" style="display:none;">
                <!-- content -->
                <div class="card card-stats">
                    <div class="card-header" data-background-color="blue">
                        <i class="material-icons">clock</i><p id="demo" style=""></p>
                    </div>
                    <div class="card-content">
                        <h3 class="title"><?=$data["questionaire_title"]?></h3>
                        <p class="category"><?=$data["questionaire_description"]?></p>
                        
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
                                                                        echo '<div>';
                                                                        foreach($data["questionaire_type"][$key]["question"][$i]["choices"] as $j => $value){
                                                                            echo '<div class="radio">
                                                                                    <label>
                                                                                        <input type="radio" class="answer'.$key.'-'.$i.'" name="answer'.$key.'-'.$i.'" value="'.$value["choices_description"].'" required="required" data-type="'.$data["questionaire_type"][$key]["questionaire_type"].'">
                                                                                        '.$value["choices_description"].'
                                                                                    </label>
                                                                                </div>';   
                                                                        }
                                                                        echo '</div>';
                                                                    }

                                                                    if($data["questionaire_type"][$key]["questionaire_type"] == 1){
                                                                        
                                                                            echo '<div class="form-group col-md-12">
                                                                                    <label>Answer:</label>
                                                                                    <div class="form-group label-floating">
                                                                                        <label class="control-label">Enter your answer here. . . .</label>
                                                                                        <textarea class="form-control answer'.$key.'-'.$i.'" rows="5" required="required" data-type="'.$data["questionaire_type"][$key]["questionaire_type"].'"></textarea>
                                                                                    </div>
                                                                                </div>';

                                                                    }
                                                                    echo '<input type="hidden" name="idquestion" id="input-idquestion-tabno'.$key.'-'.$i.'" value="'.$data["questionaire_type"][$key]["question"][$i]["idquestion"].'">';
                                                                    
                                                                    echo '<span class="span-next-item'.$key.' item-'.$i.'">
                                                                            <button class="btn-success btn pull-right btn-next-item" form="frm-examine" data-tabno="'.$key.'" data-item="'.$i.'">
                                                                                <span class="material-icons">playlist_add_check</span>
                                                                            </button>
                                                                        </span>';   
                                                            echo '</div>';
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
</form>
    
<!-- Array




Array
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
    [questionaire_instruction] => <p>please dont copy the answer of your seat mate</p><p>&nbsp;</p>
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
                                    [question_title] => <p>english is</p>
                                    [question_points] => 
                                    [user_answer] => 
                                    [remark] => 
                                    [choices] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [idquestion_choices] => 36
                                                    [idquestion] => 31
                                                    [choices_description] => sample
                                                )

                                            [1] => Array
                                                (
                                                    [idquestion_choices] => 37
                                                    [idquestion] => 31
                                                    [choices_description] => being
                                                )

                                            [2] => Array
                                                (
                                                    [idquestion_choices] => 38
                                                    [idquestion] => 31
                                                    [choices_description] => tiger
                                                )

                                            [3] => Array
                                                (
                                                    [idquestion_choices] => 39
                                                    [idquestion] => 31
                                                    [choices_description] => mouse
                                                )

                                        )

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
                                    [question_title] => <p>difference difficult and hard?</p>
                                    [question_points] => 
                                    [user_answer] => 
                                    [remark] => 
                                    [choices] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [idquestion_choices] => 40
                                                    [idquestion] => 32
                                                    [choices_description] => its your problem
                                                )

                                            [1] => Array
                                                (
                                                    [idquestion_choices] => 41
                                                    [idquestion] => 32
                                                    [choices_description] => not my problem
                                                )

                                            [2] => Array
                                                (
                                                    [idquestion_choices] => 42
                                                    [idquestion] => 32
                                                    [choices_description] => ask someone for that
                                                )

                                            [3] => Array
                                                (
                                                    [idquestion_choices] => 43
                                                    [idquestion] => 32
                                                    [choices_description] => im hungry
                                                )

                                        )

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
                                    [question_title] => <p>what is <strong>English</strong> ?</p>
                                    [question_points] => 
                                    [user_answer] => 
                                    [remark] => 
                                    [choices] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [idquestion_choices] => 44
                                                    [idquestion] => 33
                                                    [choices_description] => i dunno
                                                )

                                            [1] => Array
                                                (
                                                    [idquestion_choices] => 45
                                                    [idquestion] => 33
                                                    [choices_description] => nevermind
                                                )

                                            [2] => Array
                                                (
                                                    [idquestion_choices] => 46
                                                    [idquestion] => 33
                                                    [choices_description] => language
                                                )

                                            [3] => Array
                                                (
                                                    [idquestion_choices] => 47
                                                    [idquestion] => 33
                                                    [choices_description] => ignore
                                                )

                                        )

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
                                    [question_title] => <p>explain what is language .</p>
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

)


////



<div class="row">
    <div class="col-xs-12">
      <hr> Vertical checkbox:
      <br>
      <div class="btn-group btn-group-vertical" data-toggle="buttons">
        <label class="btn active">
          <input type="checkbox" name='email1' checked><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i> <span> Marketing Email</span>
        </label>
        <label class="btn">
          <input type="checkbox" name='email2'><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span> Alert Email</span>
        </label>
        <label class="btn">
          <input type="checkbox" name='email3'><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span> Account Email</span>
        </label>
      </div>


    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <hr> Horizontal radio:
      <br>
      <div class="btn-group" data-toggle="buttons">
        <label class="btn active">
          <input type="radio" name='gender2' checked><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-check-circle-o fa-2x"></i><span> Male</span>
        </label>
        <label class="btn">
          <input type="radio" name='gender2'><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-check-circle-o fa-2x"></i><span> Female</span>
        </label>
      </div>


    </div>
  </div>
  <hr> Horizontal checkbox:
  <br>

  <div class="btn-group btn-group" data-toggle="buttons">
    <label class="btn active">
      <input type="checkbox" name='email1' checked><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span> Marketing Email
    </label>
    <label class="btn">
      <input type="checkbox" name='email2'><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span> Alert Email</span>
    </label>
    <label class="btn">
      <input type="checkbox" name='email3'><i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span> Account Email</span>
    </label>
  </div>

</div>
</div>

<br>
</div>
) -->
