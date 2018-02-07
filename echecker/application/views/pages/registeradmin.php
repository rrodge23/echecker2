
 <?php
    
 ?>
    
    <div class="growl" id="app-growl"></div>

    <div class="container container-mobile p-t-md">

        
<div class="text-center" style="margin-top:100px;">
    <h4>REGISTER ADMIN</h4>
</div>
<div class="col-md-offset-3 col-md-6 col-xs-12" style="padding-top:30px;">
    <div class="panel panel-default panel-profile m-b-md">
        <div class="panel-body text-center">

            <div id="Container" class="text-center" style="padding-top:20px;">
                <div class="container-fluid">
                    <br /><br />
                    <div class="container-content-middle">
                        <form id="form-registeradmin" class="m-x-auto text-center" role="form" method="POST" action="login/postregisteradmin" onsubmit="return false;">
                        
                            <div class="text-danger validation-summary-errors hidden">
                                <ul>
                                    <li>Invalid Credentials</li>
                                </ul>
                            </div>
                            
                            <div class="form-group">
                              
                                <input type="text" placeholder="Enter username" class="form-control" required="required" id="registeradmin-username" name="user">
                            </div>

                            <div class="form-group">
                                <input type="password" placeholder="Enter Password" class="form-control" required="required" id="registeradmin-password" name="pass">
                            </div>

                            <div class="form-group">
                                <input type="password" placeholder="Confirm Password" class="form-control" required="required" id="registeradmin-confirmpassword" name="confirmPass">
                            </div>
                            <div class="row">

                                <div class="m-b-lg">
                                    <div class="col-xs-6">
                                        
                                    </div>
                                    <div class="col-xs-6">
                                        <button class="btn btn-block btn-info-outline btn-registeradmin" type="submit">Change Password</button>
                                    </div>
                                </div>
                            </div>
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>

   
  
   
   
   
   
   
   
   