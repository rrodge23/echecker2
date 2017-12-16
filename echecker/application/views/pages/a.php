if($('#oldpass').val() != session.password){
                        swal("error", "Invalid Old Password", "error");
                        return false;
                    }
                    swal({title: "Success", text: "Password has been changed successfully !", type: "success"});



                      swal({
                title: "Continue Transaction?",
                text: "Post Transaction",
                type: "info",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Post",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: false,
                allowOutsideClick: false,
                },
                function(isConfirm) {
                
                if (isConfirm) {

                    if($('#deposit_amount').val() >= 500){
                        swal({
                            title: "Maximum Amount Exceed !",
                            text: "Enter Approval Password",
                            type: "input",
                            inputType: "password",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            inputPlaceholder: "Enter Password"
                            }, function (inputValue) {
                                
                                $.ajax({
                                    type:"POST",
                                    url:"/app/controller/auth/permission.php",
                                    dataType:"json",
                                    success:function(session){
                                        
                                        if (inputValue === false) return false;
                                        if (inputValue === "") {
                                            swal.showInputError("Please Fill Out Field");
                                            return false
                                        }
                                    
                                        if (inputValue == session.cashier) {
                                            $.ajax({
                                            url:url,
                                            type:type,
                                            data:frm.serialize(),
                                            dataType:"json",
                                            success:function(data){
                                                
                                                if(data == true){
                                                    swal({title: "Success", text: "Transaction Completed !", type: "success"},
                                                        function(){ 
                                                            window.open('/mpdf/transaction.php', '_blank');
                                                            location.reload();
                                                        }
                                                    );
                                                }else{
                                                    swal("Cancelled !", "Transaction Error", "error");
                                                }
                                            }
                                            });
                                        }else
                                        {
                                            swal.showInputError("Incorrect Password");
                                            return false
                                        }
                                    }
                                });                                
                            });
                    }else{
                        $.ajax({
                        url:url,
                        type:type,
                        data:frm.serialize(),
                        dataType:"json",
                        success:function(data){
                            
                            if(data == true){
                                swal({title: "Success", text: "Transaction Completed !", type: "success"},
                                    function(){
                                        window.open('/mpdf/transaction.php', '_blank');
                                        location.reload();
                                    }
                                );
                            }else{
                                swal("Cancelled !", "Transaction Error", "error");
                            }
                        }
                        });
                    }

                    
                    
                } else {
                    swal("Cancelled", "Transaction Cancelled !", "error");
                }
            });






           
           
  <form method="post">
    <textarea id="mytextarea">Hello, World!</textarea>
  </form>