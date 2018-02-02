
<?php
    /*
    echo '<pre>';
        print_r($data);
    echo '</pre>';
    */
    
?>

<div class="row">
    <span><b>UPDATE QUESTIONNAIRE</b></span>
</div>

<form method="post" id="frm-update-questionnaire">
<div class="row" style="height:100%; width:100%;">
    
    <div class="row">
        <input type="hidden" name="idquestionnaire" id="questionaire-idsubject" value="<?=$data["idsubject"]?>">
        <input type="hidden" name="idquestionnaire" id="questionaire-idquestionnaire" value="<?=$data["idquestionaire"]?>">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Title</span>
            <input type="text" class="form-control use" placeholder="Enter Title" aria-describedby="basic-addon1" required="required" id="questionnaire-title" name="title" value="<?=$data["questionaire_title"]?>">
        </div>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Description</span>
            <input type="text" class="form-control use" placeholder="Enter Description" aria-describedby="basic-addon1" required="required" id="questionnaire-description" name="questionaire_description" value="<?=$data["questionaire_description"]?>">
        </div>
        
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Date</span>
            <input type="text" class="form-control use datepicker-date" placeholder="Select Date" aria-describedby="basic-addon1" required="required" id="questionnaire-day" name="questionaire_date" value="<?=$data["questionaire_date"]?>">
        </div>
        
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Time</span>
            <input type="text" class="form-control use datepicker-time" placeholder="Select Time" aria-describedby="basic-addon1" required="required" id="questionnaire-time" name="questionaire_time" value="<?=$data["questionaire_time"]?>">
        </div>
        
        <div class="input-group col-md-12">
            <span class="input-group-addon" id="basic-addon1">Duration</span>
            <input type="text" class="form-control use time-hours-minute-duration" placeholder="Select Duration" aria-describedby="basic-addon1" required="required" id="questionnaire-duration" name="questionaire_duration" value="<?=$data["questionaire_duration"]?>">
        </div>
        
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Instruction</span>
            <input type="text" class="form-control use mytextarea" placeholder="" aria-describedby="basic-addon1" required="required" id="questionnaire-instruction" name="terms_and_condition" value="<?=$data["questionaire_instruction"]?>">
        </div>
        
    </div>
    
    
    <!-- end -->
    <div class="row" style="padding:10px;">
        <span><b>QUESTIONNAIRE SETTINGS</b></span>
    </div>
    <div class="row">
        <div class="col-md-12">
      
            <ul class="nav nav-tabs tab-nav-right tab-header" id="tab-header" role="tablist" style="margin-bottom:50px;">
                <li role="presentation" class="active" style="width:20%;" id="tab-header-add-question" data-id="0">
                    <a href="#tab-add-question" data-toggle="tab">
                        <span class="material-icons">add</span>
                    </a>
                </li>
                <?php
                    for($i=0;$i<count($data["questionaire_type"]);$i++){
                        echo '<li role="presentation" class="" id="tab-header-add-question'.$i.'" style="width:20%;" data-id="'.$i.'">
                            <a href="#tab-add-question'.$i.'" data-toggle="tab">
                                <span class="">'.$data["questionaire_type"][$i]["questionaire_type_title"].' - '.(($data["questionaire_type"][$i]["questionaire_type"] == 0) ? "MULTIPLE CHOICE" : "ESSAY").'</span>
                            </a>
                        </li>';
                    }
                ?>

            </ul>

                <!-- Tab panes -->
            <div class="tab-content" id="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="tab-add-question" data-id="0">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;text-align:right;">Question Type</div></span>
                        <select name="quesstion_type" data-placeholder="Select Category" class="chzn-select" id="select-question-type-input">
                            <option value="0">Multiple Choice<option>
                            <option value="1">Essay<option>
                        </select>
                    </div>
                    
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Category Title</span>
                        <input type="text" class="form-control use" placeholder="Enter Title" aria-describedby="basic-addon1" id="category-title-input" name="questionaire_type_title">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon" id="span-answer-case-method">Question Quantity</span>
                        <input type="text" class="form-control use" placeholder="Enter Number of Answer Question" aria-describedby="basic-addon1" id="questionaire-case-input" name="questionaire_answer_quantity" pattern="[0-9]+">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Item Points</span>
                        <input type="text" class="form-control use" placeholder="Enter Number of Points per item" aria-describedby="basic-addon1" id="number-of-points-input" name="questionaire_points" pattern="[0-9]+">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Item Quantity</span>
                        <input type="text" class="form-control use" placeholder="Enter Number of Items" aria-describedby="basic-addon1" id="number-of-items-input" name="number_of_items" pattern="[0-9]+">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Total Items</span>
                        <input readonly="readonly" type="text" class="form-control use" aria-describedby="basic-addon1" id="total-points-input" name="total_points">
                    </div>
                    <button rel='tooltip' data-original-title='Add' class='pull-right btn-add-question-type btn btn-success' type='button' name='create' onclick='return false;'>
                        <i class='material-icons'>add</i>
                    </button>
                    
                 </div><!-- end tab panel first div -->
                
                 <?php
                    
                    for($i=0;$i<count($data["questionaire_type"]);$i++){
                        echo '<div role="tabpanel" class="tab-pane fade" id="tab-add-question'.$i.'" data-id="'.$i.'" data-questiontype="'.$data["questionaire_type"][$i]["questionaire_type"].'">';//tab content div start
                            //    
                        echo '<div class="container">
                            <div class="row">
                            <div class="col-md-10 bhoechie-tab-container template'.$i.'">
                                <div class="col-md-2 bhoechie-tab-menu template'.$i.'">
                                    <div class="list-group">';
                                
                                for($j=0;$j<count($data["questionaire_type"][$i]["question"]);$j++){
                                    echo '<a href="#" class="list-group-item '.(($j == 0) ? 'active':'').' text-center" data-tab="'.$i.'">
                                                    <h4 class="glyphicon glyphicon-tags"></h4><br/><b>'.($j+1).'</b>
                                                </a>';
                                }
                                    
                        echo    '</div>
                            </div>';
                        echo    '<div class="col-md-8 bhoechie-tab">';
                            
                for($j=0;$j<count($data["questionaire_type"][$i]["question"]);$j++){
                    echo '<div class="btcontent-template-tab'.$i.' bhoechie-tab-content '.(($j==0) ? 'active':'').'">
                    
                    <center id="add-answer'.$i.'-'.$j.'">
                        
                        <input type="hidden" id="questionnaire-type-idquestionairetype'.$i.'" value="'.$data["questionaire_type"][$i]["idquestionairetype"].'">
                        <input type="hidden" id="question-idquestion'.$i.'-'.$j.'" value="'.$data["questionaire_type"][$i]["question"][$j]["idquestion"].'">
                        <input type="hidden" id="category-title-tabNo'.$i.'" value="'.$data["questionaire_type"][$i]["questionaire_type_title"].'">
                        <input type="hidden" id="question-quantity-tabNo'.$i.'" value="'.$data["questionaire_type"][$i]["questionaire_type_question_quantity"].'">
                        <input type="hidden" id="item-points-tabNo'.$i.'" value="'.$data["questionaire_type"][$i]["questionaire_type_item_points"].'">
                        <input type="hidden" id="item-quantity-tabNo'.$i.'" value="'.$data["questionaire_type"][$i]["questionaire_type_item_quantity"].'">
                        <input type="hidden" id="total-item-tabNo'.$i.'" value="'.$data["questionaire_type"][$i]["questionaire_type_total_item"].'">
                        <div class="col-md-12" style="margin: 5px;">
                                <h1 class="glyphicon glyphicon-question-sign" style="font-size:4em;color:#55518a"></h1>
                                <h2 style="margin-top: 0;color:#55518a">Question no. '.($j+1).'</h2>
                                <div class="form-group col-md-12">
                                    <label style="font-size:16px;">Question</label>
                                    <div class="form-group label-floating col-md-12">
                                        <label class="control-label col-md-3" style="left:0;">Write Your Question Here  . . .</label>
                                        <textarea name="question" class="col-md-9 form-control mytextarea" id="questionTabno'.$i.'-itemno-'.$j.'" rows="5" value="'.$data["questionaire_type"][$i]["question"][$j]["question_title"].'" required="required">
                                        '.$data["questionaire_type"][$i]["question"][$j]["question_title"].'
                                        </textarea>
                                    </div>
                                </div>';
                
                    if($data["questionaire_type"][$i]["questionaire_type"] != 0){
                        
                        echo '<div class="add-answer">';

                        echo   '<span class="span-add-answer'.$i.'">';
                            
                            for($k=0;$k<count($data["questionaire_type"][$i]["question"][$j]["answer"]);$k++){
                                echo '<input type="hidden" id="input-question-idanswer'.$i.'-'.$j.'-'.$k.'" name="choices" value="'.$data["questionaire_type"][$i]["question"][$j]["answer"][$k]["idquestion_answer"].'">';
                                echo '<div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Answer no '.($k+1).'</span>
                                    <input type="text" class="form-control use" placeholder="Enter Description" aria-describedby="basic-addon1" required="required" id="answerTabno-'.$i.'-itemno-'.$j.'-answerno-'.$k.'" name="answer" value="'.$data["questionaire_type"][$i]["question"][$j]["answer"][$k]["answer"].'">
                                </div>';
                            }        
                        echo        '<button class="btn-success btn pull-left btn-add-answer">
                                    <span class="material-icons">add</span>
                                </button>
                            </span>
                            <span style="margin-top:15px;" class="pull-left">Add Answer . . .</span>
                        </div>';
                    }                
                        echo '</div>';
                    if($data["questionaire_type"][$i]["questionaire_type"] == 0){
                        $selectIndexAnswer = "";
                        for($k=0;$k<count($data["questionaire_type"][$i]["question"][$j]["choices"]);$k++){
                            echo '<input type="hidden" id="input-question-idanswer'.$i.'-'.$j.'-'.$k.'" name="choices" value="'.$data["questionaire_type"][$i]["question"][$j]["answer"][$k]["idquestion_answer"].'">';
                            echo '<input type="hidden" id="input-question-idchoices'.$i.'-'.$j.'-'.$k.'" name="choices" value="'.$data["questionaire_type"][$i]["question"][$j]["choices"][$k]["idquestion_choices"].'">';
                            if($data["questionaire_type"][$i]["question"][$j]["choices"][$k]["choices_description"] == $data["questionaire_type"][$i]["question"][$j]["answer"][$k]["answer"]){
                                $selectIndexAnswer = $k;
                            }
                            echo '<div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">Answer no'.($k+1).'</span>
                                            <input type="text" class="form-control use" placeholder="Enter Answer Choices '.($k+1).'" aria-describedby="basic-addon1" required="required" id="choicesTabno-'.$i.'-itemno-'.$j.'-choicesno-'.$k.'" name="choices" data-testno="" value="'.$data["questionaire_type"][$i]["question"][$j]["choices"][$k]["choices_description"].'">
                                        </div>';
                        }
                        echo '<div class="form-group">
                            <label for="">Select Question Answer</label>
                            <select multiple name="answer" required="required" class="form-control" id="answerTabno-'.$i.'-itemno-'.$j.'-answerno-0" data-testno="" value="'.$selectIndexAnswer.'">';
                        for($k=0;$k<count($data["questionaire_type"][$i]["question"][$j]["choices"]);$k++){
                            if($selectIndexAnswer == $k){
                                echo '<option value="'.$k.'" >Choices No '.($k+1).'</option>';
                            }else{
                                echo '<option value="'.$k.'" selected="selected">Choices No '.($k+1).'</option>';
                            }
                            
                        }    
                            echo '</select>
                                </div>';
                        
                    }
                    echo '<span class="span-next-item'.$i.' item-'.$j.'">
                            <button class="btn-success btn pull-right btn-next-item'.$i.' item-'.$j.'">
                                <span class="material-icons">playlist_add_check</span>
                            </button>
                        </span>';
                            //content end
                    echo '</center>
                        </div>';
                }
                        echo '</div>';
                
                                        
                echo '      </div>
                         </div>
                        </div>
                    </div>';//tab content div
                        }//end loop i
                    ?>
                    
                
             </div> <!-- end tab content div -->
            
            
            
        </div>
    </div>
</div>

</form>
<button class="btn-information btn pull-right col-md-5" type="submit" form="frm-update-questionnaire">
    <span class="material-icons">check_circle</span>SUBMIT
</button>

<!-- samplw



Array
(
    [0] => Array
        (
            [0] => Array
                (
                    [0] => rrrrr
                    [1] => rrrrrrsrssrsrs
                    [idquestion] => 49
                    [question] => <p>arrrrr</p>
                    [answer] => rrrrr
                )

            [1] => Array
                (
                    [0] => rrr
                    [1] => rrrr
                    [idquestion] => 50
                    [question] => <p>rrrsrsrsrsr</p>
                    [answer] => rrr
                )

            [data] => Array
                (
                    [questionaire_type_title] => r
                    [questionaire_type] => 0
                    [questionaire_type_question_quantity] => 2
                    [questionaire_type_item_points] => 2
                    [questionaire_type_item_quantity] => 2
                    [questionaire_type_total_item] => 4
                )

        )

    [1] => Array
        (
            [0] => Array
                (
                    [0] => rrrr
                    [1] => rrrr
                    [idquestion] => 51
                    [question] => <p>asfasdfsdf</p>
                )

            [data] => Array
                (
                    [questionaire_type_title] => r
                    [questionaire_type] => 1
                    [questionaire_type_question_quantity] => 2
                    [questionaire_type_item_points] => 2
                    [questionaire_type_item_quantity] => 2
                    [questionaire_type_total_item] => 4
                )

        )

    [data] => Array
        (
            [questionaire_title] => rrrr
            [questionaire_description] => rrr
            [questionaire_date] => 02-03-18
            [questionaire_time] => 14:27
            [questionaire_duration] => 10800
            [questionaire_instruction] => <p>rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr</p>
            [idsubject] => 14
            [idquestionaire] => 31
        )

)
false


-->