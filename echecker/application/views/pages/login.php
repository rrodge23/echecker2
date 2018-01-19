

<div class="card card-nav-tabs" style="width:40%;margin:0 auto;display:flex;margin-top:13%;">
	<div class="card-header" data-background-color="purple" style="margin-top:0px;">
		<div class="nav-tabs-navigation">
			<div class="nav-tabs-wrapper">
				<span class="nav-tabs-title"><h4 style="text-align:center !important;">Login to your account</h4></span>
                <span class="nav-tabs-title">
                    <div class="validation-summary-errors hidden">
                        <h4 style="text-align:center;">Invalid Credential</h4> 
                    </div>
                </span>
				<ul class="nav nav-tabs" data-tabs="tabs">
					
				</ul>
			</div>
		</div>
	</div>

	<div class="card-content">
		<div class="tab-content">
        <form id="loginform" class="m-x-auto text-center app-login-form" role="form" method="POST" action="login/authenticateLogin" onsubmit="return false;">
                        
            
            <div class="col-md-12" style="padding:5px;">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons" style="padding:0;">mail_outline</i>
                    </span>
                    <input type="text" class="form-control" placeholder="Enter Email Address" id="login-username" name="username" required="required">
                </div>
            </div>
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons" style="padding:0;">lock_outline</i>
                    </span>
                    <input type="password" class="form-control pass" id="login-password" name="password" placeholder="Enter Password" required="required">
                </div>
            </div>

            <div class="row">

                <div class="m-b-lg">
                    <div class="col-xs-6">
                        
                    </div>
                    <div class="col-xs-6">
                        <button class="btn btn-block btn-info-outline btn-login btn" type="submit">LOGIN</button>
                    </div>
                    
                    <div class="text-center pad-top-20 got" style="padding-bottom:1px;">
                            
                    </div>
                </div>
            </div>
         </form>
		</div>
	</div>

 </div><!-- end card -->


   
  
   
   
   
   
   
   
   