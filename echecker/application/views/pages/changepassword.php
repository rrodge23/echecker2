
 <?php
    print_r($_SESSION['users']);
 ?>
    
    <div class="growl" id="app-growl"></div>

    <div class="container container-mobile p-t-md">

        
<div class="text-center" style="margin-top:100px;">
    <h4>Change Password</h4>
</div>
<div class="col-md-offset-3 col-md-6 col-xs-12" style="padding-top:30px;">
    <div class="panel panel-default panel-profile m-b-md">
        <div class="panel-body text-center">

            <div id="Container" class="text-center" style="padding-top:20px;">
                <div class="container-fluid">
                    <br /><br />
                    <div class="container-content-middle">
                        <form id="form-changepassword" class="m-x-auto text-center app-login-form" role="form" method="POST" action="logout/postnewpassword" onsubmit="return false;">
                        
                            <div class="text-danger validation-summary-errors hidden">
                                <ul>
                                    <li>Invalid Credentials</li>
                                </ul>
                            </div>
                            <input type="hidden" name="idusers" value="<?=$_SESSION['users']['idusers'];?>">
                            <div class="form-group">
                              
                                <input type="password" placeholder="Enter Current Password" class="form-control" required="required" id="changepass-oldpassword" name="oldPassword">
                            </div>

                            <div class="form-group">
                                <input type="password" placeholder="Enter New Password" class="form-control" required="required" id="changepass-newpassword" name="newPassword">
                            </div>

                            <div class="form-group">
                                <input type="password" placeholder="Re-Enter New Password" class="form-control" required="required" id="changepass-renewpassword" name="reNewPassword">
                            </div>
                            <div class="row">

                                <div class="m-b-lg">
                                    <div class="col-xs-6">
                                        
                                    </div>
                                    <div class="col-xs-6">
                                        <button class="btn btn-block btn-info-outline btn-changepassword" type="submit">Change Password</button>
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

   
  
   
   
   
   
   
   
   