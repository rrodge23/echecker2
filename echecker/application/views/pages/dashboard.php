<?php
    if($_SESSION['users']['user_level'] == "99"){
        $displayUserLevel = "admin";
    }else if($_SESSION['users']['user_level'] == "1"){
        $displayUserLevel = "Student";
    } else if($_SESSION['users']['user_level'] == "2"){
        $displayUserLevel = "teacher";
    }else{
        $displayUserLevel = "unknown";
    }

?>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                               
                                    <div id="morning-greetings">
                                        <img src="assets/images/morning.png" style="height:150px;width:150px">
                                        <h4 class="title">Goodmorning <?=ucwords($_SESSION['users']['user']);?> !</h4>
                                        <p class="category"><?=ucwords($displayUserLevel);?></p>
                                    </div>
                                    <div id="afternoon-greetings" style="display:hidden;">
                                        <img src="assets/images/afternoon.png" style="height:150px;width:150px">
                                        <h4 class="title">Goodafternoon <?=ucwords($_SESSION['users']['user']);?> !</h4>
                                        <p class="category"><?=ucwords($displayUserLevel);?></p>
                                    </div>
                                    <div id="evening-greetings" style="display:hidden;">
                                        <img src="assets/images/evening.png" style="height:150px;width:150px">
                                        <h4 class="title">Goodevening <?=ucwords($_SESSION['users']['user']);?> !</h4>
                                        <p class="category"><?=ucwords($displayUserLevel);?></p>
                                    </div>
                              
                                        <div class="row" style="margin:50px;">
                                            <?php
                                                if($_SESSION['users']['user_level'] == '99'){
                                                    echo '<button id="btn-update-bulletin" class="pull-right btn btn-success">Change Message</button>';
                                                }
                                            ?>
                                        </div>
                                        <div class="row" style="margin:50px;">
                                            <div id="tb-testimonial" class="testimonial testimonial-primary pull-right">
                                                <div class="testimonial-section">
                                                    <?=$data[0]['message'];?>
                                                </div>
                                                <div class="testimonial-desc">
                                                    <img src="assets/img/logo.jpg" alt="" />
                                                    <div class="testimonial-writer">
                                                        <div class="testimonial-writer-name">School Administrator</div>
                                                        <div class="testimonial-writer-designation">JMC Admin</div>
                                                        <a href="#" class="testimonial-writer-company">Jose Maria College</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                
                            </div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-6">
                                           
                                    </div>
                                    <div class="col-md-6">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
          
            <div class="aw">
                
            </div>
            
            
           
