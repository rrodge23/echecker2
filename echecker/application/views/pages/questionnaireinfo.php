<?php

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-chart" data-background-color="purple" style="padding-top:20px;padding-left:30px;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <h4 class="title"><p style="width:100px;" class="pull-left">TITLE:</p><p class="pull-left"><?=$data["questionaire_title"]?></p></h4>
                        </div>
                        <div class="row">
                            <div class="category">
                                <p class="pull-left" style="width:100px;">DESCRIPTION:</p><p class="pull-left"><?=$data["questionaire_description"]?></p>
                            </div>    
                        </div>    
                        <div class="row">
                            <div class="category">
                                <p class="pull-left" style="width:100px;">DURATION:</p><p class="pull-left"><?=Date('H:i:s',$data["questionaire_duration"])?></p>
                            </div>    
                        </div>    
                        <div class="row">
                            <div class="category">
                                <p class="pull-left" style="width:100px;">DATE:</p><p class="pull-left"><?=Date($data["questionaire_date"])?></p>
                            </div>    
                        </div>    
                        <div class="row">
                            <div class="category">
                                <p class="pull-left" style="width:100px;">TIME:</p><p class="pull-left"><?=$data["questionaire_time"]?></p>
                            </div>    
                        </div>    
                        <div class="row">
                            <div class="category">
                                <p class="pull-left" style="width:100px;">INSTRUCTION:</p><p class="pull-left"><?=$data["questionaire_instruction"]?></p>
                            </div>    
                        </div>    
                    </div>  
                    <div class="col-md-6">
                        <div class="row">
                            <div class="category">
                                <p class="pull-left" style="width:170px;">SUBJECT CODE:</p><p class="pull-left"><?=$data["subject_code"]?></p>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="category">
                                <p class="pull-left" style="width:170px;">SUBJECT DESCRIPTION:</p><p class="pull-left"><?=$data["subject_description"]?></p>
                            </div>
                        </div>
                    </div>  
                </div>    
                
            </div>
            <div class="card-content">
                <!-- content //////////-->
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
                                                                            echo '<div class="radio">
                                                                                    <label>
                                                                                        <h6>CHOICES:</h6>
                                                                                    </label>
                                                                                </div>';  
                                                                            foreach($data["questionaire_type"][$key]["question"][$i]["choices"] as $j => $value){
                                                                                echo '<div class="radio">
                                                                                        <label>
                                                                                            <input type="radio" class="answer'.$key.'-'.$i.'" name="answer'.$key.'-'.$i.'" value="'.$value["choices_description"].'">
                                                                                            '.$value["choices_description"].'
                                                                                        </label>
                                                                                    </div>';   
                                                                            }
                                                                            echo '<div class="radio">
                                                                                    <label>
                                                                                        <h6>ANSWER:</h6>
                                                                                    </label>
                                                                                </div>';
                                                                            for($j=0;$j<count($data["questionaire_type"][$key]["question"][$i]["answer"]);$j++){
                                                                                echo '<div class="radio">
                                                                                        <label>
                                                                                            <input type="radio" class="answer'.$key.'-'.$i.'" name="answer'.$key.'-'.$i.'" 
                                                                                            '.$data["questionaire_type"][$key]["question"][$i]["answer"][$j]["answer"].'
                                                                                        </label>
                                                                                    </div>';   
                                                                            }    
                                                                        echo '</div>';
                                                                    }

                                                                    if($data["questionaire_type"][$key]["questionaire_type"] == 1){
                                                                        echo '<div class="radio">
                                                                            <label>
                                                                                <h6>ANSWERS:</h6>
                                                                            </label>
                                                                        </div>';  
                                                                        foreach($data["questionaire_type"][$key]["question"][$i]["answer"] as $j => $value){
                                                                            echo '<div class="radio">
                                                                                    <label>
                                                                                        <input type="radio" class="answer'.$key.'-'.$i.'" name="answer'.$key.'-'.$i.'" value="'.$value["answer"].'" required="required">
                                                                                        '.$value["answer"].'
                                                                                    </label>
                                                                                </div>';   
                                                                        }
                                                                           

                                                                    }
                                                                    echo '<input type="hidden" name="idquestion" id="input-idquestion-tabno'.$key.'-'.$i.'" value="'.$data["questionaire_type"][$key]["question"][$i]["idquestion"].'">';
                                                                 
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


                <!-- content end /////////-->
            </div>
            <div class="card-footer">
                
                <button class="btn-information btn pull-right col-md-5" type="button" onclick="return false;" id="btn-submit-approval" data-id="<?=$data["idquestionaire"]?>">
                    <span class="material-icons">check_circle</span>SUBMIT APPROVAL
                </button>
            </div>
        </div>
    </div>
                       
</div>