$(document).ready(function(){


    // COUNTDOWN
    
    // Set the date we're counting down to
    

    //COUNTDOWN END
    $('.time-hours-minute-duration').durationPicker({
        
          langs: 'en',
        
          formatter: function (s) {
        
            return s;
        
          },
    
          showDays: false
    
    });

       
    var langs = {
    
        en: {
            hours: 'hours',
            minutes: 'minutes',
        },
    
    };
        


    //*********** LOGIN

    $(document).on('submit','#loginform',function(){
        var form = $(this);
        var url = form.attr('action');
        var type = form.attr('method');
        $.ajax({
            url:url,
            type:type,
            dataType:"json",
            data:form.serialize(),
            success:function(data){
                if(data != false){
                    if(data['status'] == 'active'){
                        document.location.href = '/echecker/dashboard';
                    }else{
                        document.location.href = '/echecker/logout/changepassword';
                    }
                }else{
                    $('.validation-summary-errors').removeClass('hidden');
                    form.effect('bounce','slow');
                }
            }
        });
    });
    //********* LOGIN END

    //*********** CHANGEPASSWORD
    $(document).on('submit','#form-changepassword',function(){
        
        var form = $(this);
        var url = form.attr('action');
        var type = form.attr('method');
        $.ajax({
            url:url,
            type:type,
            dataType:"json",
            data:form.serialize(),
            success:function(data){
                if(data != false){
                    swal("Success", "Password Successfully Changed", "success");
                   document.location.href = '/echecker/dashboard';
                }else{
                    $('.validation-summary-errors').removeClass('hidden');
                    form.effect('bounce','slow');
                }
            }
        });
    });
    //********* CHANGEPASSWORD END

    //********* SIGN OUT
    $('#btn-signout').on('click',function(){
        document.location.href = 'logout';
    });

    //********* SIGN OUT END
    $(document).on('click','.dropdown-menu.open',function(){
        $(this).toggleClass('open');
    })
     /***************GREETINGS***************/
    var thehours = new Date().getHours();
	var themessage;
	var morning = ('Good Morning');
	var afternoon = ('Good Afternoon');
	var evening = ('Good Evening');

	if (thehours >= 0 && thehours < 12) {
        $('#morning-greetings').removeClass('hidden');
        $('#afternoon-greetings').addClass('hidden');
        $('#evening-greetings').addClass('hidden');
		themessage = morning;

	} else if (thehours >= 12 && thehours < 18) {
        $('#morning-greetings').addClass('hidden');
        $('#afternoon-greetings').removeClass('hidden');
        $('#evening-greetings').addClass('hidden');
		themessage = afternoon;

	} else if (thehours >= 18 && thehours < 24) {
        $('#morning-greetings').addClass('hidden');
        $('#afternoon-greetings').addClass('hidden');
        $('#evening-greetings').removeClass('hidden');
		themessage = evening;
	}

	$('.greeting').append(themessage);
    /***************END GREETINGS***************/
    //******** ETC */
    
        tinymce.init({
             selector: '.mytextarea'
        });
  
   
    //********* DATA TABLES
    $('#table-professorslist').DataTable();
    $('#table-courselist').DataTable();
    $('#table-studentslist').DataTable();
    $('#table-subjectList').DataTable();
    $('#table-departmentlist').DataTable();
    $('#table-scheduleList-main').DataTable();
    $('#table-examinationList').DataTable();
    $('#table-classlist').DataTable();
    
    //********* DATA TABLES END\

    //********* SELECT PICKER
    $(".chzn-select").chosen({width:"80%"});
    //********* SELECT PICKER END
    $('.datepicker-date').bootstrapMaterialDatePicker({
        time:false,
        month:true,
        date:true,
        format: 'MM-DD-YY',
        shortTime:true,
    });
    $('.datepicker-time').bootstrapMaterialDatePicker({
        time:true,
        month:false,
        date:false,
        format: 'HH:mm',
        shortTime:true,
    });
    //********* DATE PICKER
    
    //********* DATE PICKER END
    //$('#date-format').bootstrapMaterialDatePicker({ format : 'dddd DD MMMM YYYY - HH:mm' });
    
    //********* USERLIST
    
    //********* USERLIST END

    //********* BULLETIN
    $(document).on('click','#btn-update-bulletin',function(){
      
        $('#mdl-title').html('Update Message');
        var htmlbody = '<form action="pages/postMessage" method="post" onsubmit="return false;" id="mdl-frm-post-message">'
                        +'<div class="input-group">'
                        +'   <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;">Message</div></span>'
                        +'   <field type="text" class="form-control mytextarea" aria-describedby="basic-addon1" id="" required="required"></field>'
                        +'</div></form>';
        $('.modal-body').html(htmlbody);
        var footer = '<button type="submit" form="mdl-frm-post-message" class="btn btn-primary btn-post-message"><i class="material-icons">playlist_add_check</i></button>'
                    +'<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button>';
        $('.modal-footer').html(footer);
        tinymce.init({
             selector: '.mytextarea'
        });
        $('#modal-dynamic').modal('show');
    });

    $(document).on('submit','#mdl-frm-post-message',function(){
        var frm = $(this);
        var data = frm.serialize();
        var method = frm.attr('method');
        var url = frm.attr('action');
        $.ajax({
            url:url,
            method:method,
            data:data,
            dataType:"json",
            success:function(data){
                if(data == true){
                    swal("Success", "Successfully Changed !.", "success");
                    location.reload();
                }
            }
        });
    });
    //********* BULETIN END

    //********* FILEINPUT
    $("#input-import-users").fileinput({
       
        uploadUrl: "users/importusers",
        allowedFileExtensions: ["xlsx", "xlsm", "xlsb", "xltx", "xltm", "xls"
        , "xlt", "xml" , "xlam" , "xla", "xlw", "xlr", "csv"],
        previewClass: "bg-warning",
        uploadAsync:true,
        layoutTemplates: {
            main1: "{preview}\n" +
            "<div class=\'input-group {class}\'>\n" +
            "   <div class=\'input-group-btn\'>\n" +
            "       {browse}\n" +
            "       {upload}\n" +
            "       {remove}\n" +
            "   </div>\n" +
            "   {caption}\n" +
            "</div>"
        },
        uploadExtraData: function (previewId, index) {
            var fieldVal = $('#select-user-imports').val();
            var data = {"userfield": fieldVal};
            return data;
        }
       
    });

    
    $(document).on("fileuploaded","#input-import-users",function(event,data,previewId,index){
        if(data.response){
            swal("Success", "Successfully Recorded.", "success");
            location.reload();
            
        }else{
            swal("Error", "Error add Record.", "error");
            return false;
        }

    });
    

    $("#input-import-field").fileinput({
       
        uploadUrl: "imports/importfield",
        allowedFileExtensions: ["xlsx", "xlsm", "xlsb", "xltx", "xltm", "xls"
        , "xlt", "xml" , "xlam" , "xla", "xlw", "xlr", "csv"],
        previewClass: "bg-warning",
        uploadAsync:true,
        layoutTemplates: {
            main1: "{preview}\n" +
            "<div class=\'input-group {class}\'>\n" +
            "   <div class=\'input-group-btn\'>\n" +
            "       {browse}\n" +
            "       {upload}\n" +
            "       {remove}\n" +
            "   </div>\n" +
            "   {caption}\n" +
            "</div>"
        },
        uploadExtraData: function (previewId, index) {
            var fieldVal = $('.fieldList').val();
            var data = {"field": fieldVal};
            return data;
        }
       
    });
    
    $(document).on("fileuploaded","#input-import-field",function(event,data,previewId,index){
        
    });
    //********* FILEINPUT END
    
    //********* ADD USER SUBJECT KANBAN

   function kanbanAddUserSubject(id){
    
    var url = '';
    if(id == 1){
        url = 'subjects/getAllSubjectList';
    }else if (id == 2){
        url = 'subjects/getAllSubjectList';
    }
    $.ajax({
        url:url,
        dataType:"json",
        success:function(data){

            var fields = [
                { name: "id", map: "id", type: "string" },
                { name: "status", map: "state", type: "string" },
                { name: "text", map: "label", type: "string" },
                { name: "tags", type: "string" },
                { name: "color", map: "hex", type: "string" },
                { name: "resourceId", type: "number" }
            ];
            var tmpLocalData = [];
            console.log(data);
            data.forEach(function(input){
                var tmpArray = {id : input.idsubject, state:"availableSubjects", label: input.subject_code+" | " + input.subject_description, tags:[input.schedule_code,input.time_start+"-",input.time_end,input.day]};
                tmpLocalData.push(tmpArray);
               
            });
            var source =
            {
                localData: tmpLocalData,
                dataType: "array",
                dataFields: fields
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            var resourcesAdapterFunc = function () {
            var resourcesSource =
            {
                localData: [
                        {},
                        
                ],
                dataType: "array",
                dataFields: [
                        { name: "id", type: "number" },
                        { name: "name", type: "string" },
                        { name: "image", type: "string" },
                        { name: "common", type: "boolean" }
                ]
            };
            var resourcesDataAdapter = new $.jqx.dataAdapter(resourcesSource);
            return resourcesDataAdapter;
            }
            $('#kanban').jqxKanban({
            resources: resourcesAdapterFunc(),
            source: dataAdapter,
            width: '100%',
            height: '100%',
            columns: [
                { text: "Subjects", dataField: "subjectsList" },
                { text: "Available Subjects", dataField: "availableSubjects" },
            ]
            });
            
        }
    });
    
   }
   // UPDATE
   function kanbanUpdateUserSubject(id){
    $.ajax({
        url:'users/getUserAvailableSubject',
        data:{id:id},
        method:"POST",
        dataType:"json",
        
        success:function(data){
        
            var fields = [
                { name: "id", map: "id", type: "string" },
                { name: "status", map: "state", type: "string" },
                { name: "text", map: "label", type: "string" },
                { name: "tags", type: "string" },
                { name: "color", map: "hex", type: "string" },
                { name: "resourceId", type: "number" }
            ];
            var tmpLocalData = [];
            
            if(data){
                data.forEach(function(input){
                    
                    var tmpArray = {id : input.idsubject, state:input.state, label: input.subject_code+" | " + input.subject_description, tags:[input.schedule_code,input.time_start+"-",input.time_end,input.day]};
                    tmpLocalData.push(tmpArray);
                    
                });
            }
            
            var source =
            {
                localData: tmpLocalData,
                dataType: "array",
                dataFields: fields
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            var resourcesAdapterFunc = function () {
            var resourcesSource =
            {
                localData: [
                        {},
                        
                ],
                dataType: "array",
                dataFields: [
                        { name: "id", type: "number" },
                        { name: "name", type: "string" },
                        { name: "image", type: "string" },
                        { name: "common", type: "boolean" }
                ]
            };
            var resourcesDataAdapter = new $.jqx.dataAdapter(resourcesSource);
            return resourcesDataAdapter;
            }
            $('#kanban').jqxKanban({
            resources: resourcesAdapterFunc(),
            source: dataAdapter,
            width: '100%',
            height: '100%',
            columns: [
                { text: "Subjects", dataField: "subjectsList" },
                { text: "Available Subjects", dataField: "availableSubjects" },
            ]
            });
            
        }
    });
    
   }

    //********* ADD USER SUBJECT KANBAN END

    //********* ADD USERS \
    $(document).on('click','.btn-add-teacher',function(e){
        e.preventDefault();
        $.ajax({
            url:'users/modalAddTeacher',
            dataType:"json",
            success:function(data){
                $('#mdl-title').html('Add User');
                var body = data["body"];
                $('.modal-body').html(body);
                $('.modal-footer').html(data["footer"]);
                $(".chzn-select").chosen({width:"100%",
                        placeholder_text_single: "Select Options...",
                         no_results_text: "Oops, nothing found!"});

                //KANBAN
                
                kanbanAddUserSubject(2);
                // END KANBAN
                
            }   
        });
      
        $('#modal-dynamic').modal('show');
        
    });
 
    $(document).on('click','.btn-add-student',function(e){
        e.preventDefault();
        var button = $(this);
        var isAdmin = button.data('isadmin');
        var idSubject = button.data('idsubject');
        $.ajax({
            url:'users/modaladdstudent',
            dataType:"json",
            success:function(data){
                $('#mdl-title').html('Add User');
                $('.modal-body').html(data["body"]);
                $('.modal-footer').html(data["footer"]);
                $(".chzn-select").chosen({width:"100%",placeholder_text_single: "Select Project/Initiative...",
      no_results_text: "Oops, nothing found!"});
                //KANBAN
                if(isAdmin == 1){
                    kanbanAddUserSubject(1);
                }
                
                // END KANBAN
                if($('.input-class-subjectList').val() != null){
                    $('.input-class-subjectList').val(idSubject);
                }
            }
        });
        
        $('#modal-dynamic').modal('show');
    });
    
    //********* ADD USERS END
    //********* POST ADD USERS
    $(document).on('submit','.mdl-frm-add-users',function(e){
        e.preventDefault();

        var subjectDataList = $('#kanban').jqxKanban('getItems');
       
        var getClassSubjects = [];
        if(subjectDataList != null){
            subjectDataList.forEach(function(data){
                if(data.status == "subjectsList"){
                    getClassSubjects.push(data.id);
                }
            });
            $('.input-class-subjectList').val(getClassSubjects);
        }

        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to Save this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Save it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
              
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){ 
                        if(data == true){
                            swal("success", "Record Added.", "success");   
                            location.reload();
                        }else{
                            swal("cancelled", "Error In Adding Users", "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Add Canceled.", "error");
            }
        });
        
    });
    //********* POST ADD USERS END

    //********* DELETE USER
    
    $(document).on('click','.btn-delete-user',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        var url = btn.attr('href');

        swal({
            title: "Are you sure?",
            text: "Do you want to delete this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            
            if (isConfirm) {
                
                $.ajax({
                url:url,
                data:{id:id},
                dataType:"json",
                method:"POST",
                success:function(data){
                    if(data == true){
                        btn.closest("tr").remove();
                        swal("success", "Record Deleted.", "success");
                        
                    }else{
                        swal("Cancelled", "Error Delete Record.", "error");
                    }
                }
            });
            } else {
                swal("Cancelled", "Delete Canceled.", "error");
            }
        });
        
        
    });
    //********* DELETE USER END
    //********* UPDATE USER
    $(document).on('click','.btn-update-user',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        var user_level = btn.data('level');
        var isAdmin = btn.data('isadmin');
        var idSubject = btn.data('idsubject');
       
        $.ajax({
            url:'users/getuserinfobyid',
            dataType:"json",
            method:"POST",
            data:{id:id,user_level:user_level},
            success:function(data){
                $.ajax({
                    url:'users/modalUpdateUser',
                    dataType:"json",
                    method:"POST",
                    data:data,
                    success:function(data){
                        $('#mdl-title').html('Update User');
                        $('.modal-body').html(data["body"]);
                        $('.modal-footer').html(data["footer"]);
                        $(".chzn-select").chosen({width:"100%"});
                        if(isAdmin == 1){
                            kanbanUpdateUserSubject(id);
                        }
                        if($('.input-class-subjectList').val() != null){
                            $('.input-class-subjectList').val(idSubject);
                        }
                    }
                });
            }
        });
    
        $('#modal-dynamic').modal('show');
    });

    //********* POST UPDATE USER
    $(document).on('submit','#mdl-frm-update-user',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        var subjectDataList = $('#kanban').jqxKanban('getItems');
        
         var getClassSubjects = [];
         var classSubjectsAvailable = [];
         
         if(subjectDataList != null){
            subjectDataList.forEach(function(data){
                if(data){
                   if(data.status == "subjectsList"){
                       getClassSubjects.push(data.id);
                   }else if(data.status == "availableSubjects"){
                      classSubjectsAvailable.push(data.id);
                   }
                }
            });
            
            $('.input-class-subjectList').val(getClassSubjects);
            $('.input-class-available-subjectList').val(classSubjectsAvailable);
         }

        swal({
            title: "Are you sure?",
            text: "Do you want to update this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, update it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){
                        if(data == true){
                            swal("success", "Record Updated.", "success");   
                            location.reload();
                            $('#mdl-user-update').modal('hide');
                        }else{
                            swal("cancelled", "Error Update Record.", "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Update Canceled.", "error");
            }
        });
        
    });

    //********* UPDATE USER END
    
    //******** SCHEDUELES */
    
    
    $(document).on('click','.btn-schedule',function(e){
        e.preventDefault();
        $('#mdl-secondary-title').html('Schedule List');
        var htmlbody = '';
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        $.ajax({
            url:'schedules/getAllschedules',
            dataType:"json",
            method:"POST",
            success:function(data){
                htmlbody = '<table id="table-schedulelist" class="table table-striped">'
                          +'<thead>'
                          +'<tr>'
                          +'<td class="text-center font-roboto color-a2">ID</td>'
                          +'<td class="text-center font-roboto color-a2">CODE</td>'
                          +'<td class="text-center font-roboto color-a2">DAY</td>'
                          +'<td class="text-center font-roboto color-a2">TIME START</td>'
                          +'<td class="text-center font-roboto color-a2">TIME END</td>'
                          +'<td class="text-center font-roboto color-a2">ACTION</td>'
                          +'</tr>'
                          +'</thead>'
                          +'<tbody>';
                data.forEach(function(inputs){
                    var id = inputs['idschedule'];
                    var code = inputs['schedule_code'];
                    var day = inputs['day'];
                    var time_start = inputs['time_start'];
                    var time_end = inputs['time_end'];
                    var status = inputs['status'];

                    if(status == "available"){
                        htmlbody += "<tr>"
                            +"<td class='text-center font-roboto color-a2'>"+id+"</td>"
                            +"<td class='text-center font-roboto color-a2'>"+code+"</td>"
                            +"<td class='text-center font-roboto color-a2'>"+day+"</td>"
                            +"<td class='text-center font-roboto color-a2'>"+time_start+"</td>"
                            +"<td class='text-center font-roboto color-a2'>"+time_end+"</td>"
                            +"<td class='text-center font-roboto color-a2' style='text-align:center;'>"
                            +"<button data-id='"+id+"' data-code='"+code+"' rel='tooltip' data-original-title='Select' class='pull-right mdl-btn-add-schedule btn btn-success' type='button' name='create'>"
                            +"<i class='material-icons'>add</i>"
                            +"</button>"
                            +"</td>"
                            +"</tr>";   
                    }
                });
                htmlbody+= "</tbody>"
                      +"</table>";
                $('.modal-secondary-body').html(htmlbody);
                
            }
        });
        var footer = '<div style="padding:5px;" class="text-right"><button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button></div>';
        $('.modal-secondary-footer').html(footer);
        $('#table-scheduleList').DataTable();
        
        $('#modal-dynamic-secondary').modal('show');
    });


    $(document).on('click','.mdl-btn-add-schedule',function(e){
        var btn = $(this);
        var id = btn.data('id');
        var code = btn.data('code');
        $('#mdl-input-schedule').val(id);
        $('#mdl-input-temp-schedule').val(code);
        $('#modal-dynamic-secondary').modal('hide');
    });

    //******** SCHEDUELES  END*/
    
    //******** Add Subject */
    $(document).on('click','.btn-add-subject',function(e){
        e.preventDefault();
        
        $('#mdl-title').html('Add Subject');
        var inputList = ["subject_code","subject_description","units"];
        var htmlbody = '<form action="subjects/addsubject" method="post" onsubmit="return false;" id="mdl-frm-add-subject">';
        inputList.forEach(function(inputs){
            htmlbody += '<div class="input-group">'
                        +'   <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;">'+upperCaseFirstWord(inputs)+'</div></span>'
                        +'   <input type="text" class="form-control" name="'+inputs+'" aria-describedby="basic-addon1" required="required">'
                        +'</div>'
        });
        htmlbody += '<div class="input-group">'
                        +'   <span class="input-group-addon" ><div style="width:100px;float:left;">Schedule</div></span>'
                        +'   <input type="hidden" id="mdl-input-schedule" class="form-control" name="schedule" aria-describedby="basic-addon1" required="required">'
                        +'   <input type="button" id="mdl-input-temp-schedule" class="form-control btn-schedule" name="temp_schedule" aria-describedby="basic-addon1" required="required" style="text-align:left;">'
                     +'</div>'
                     +'</form>';
        $('.modal-body').html(htmlbody);
        
        var footer = '<button type="submit" form="mdl-frm-add-subject" class="btn btn-primary btn-post-add-subject"><i class="material-icons">playlist_add_check</i></button>'
                    +'<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button>';
        $('.modal-footer').html(footer);
    
    
        $('#modal-dynamic').modal('show');
    });
    //******** ADD SUBJECT END */

    //******** POST ADD SUBJECT */
    $(document).on('submit','#mdl-frm-add-subject',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to Save this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Save it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){ 
                        if(data[1] == true){
                            swal("success", "Record Added.", "success");   
                            location.reload();
                        }else{
                            swal("cancelled", data[0], "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Add Canceled.", "error");
            }
        });
        
    });

    //******** POST ADD SUBJECT END*/

    //******** UPPERCASE*/
    function upperCaseFirstWord(str) {
        var splitStr = str.toLowerCase().split(' ');
        for (var i = 0; i < splitStr.length; i++) {
            
            splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
        }

        return splitStr.join(' '); 
    }
    //******** UPPERCASE END*/

    //******** UPDATE SUBJECT*/
    $(document).on('click','.btn-update-subject',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        $.ajax({
            url:'subjects/getsubjectinfobyid',
            dataType:"json",
            method:"POST",
            data:{id:id},
            success:function(data){
                if(data[1] == true){
                    $('#mdl-title').html('Update Subject');
                    var inputList = ["subject_code","subject_description","units"];

                    var htmlbody = '<form action="subjects/updatesubject" method="POST" id="mdl-frm-update-subject" onsubmit="return false;">'
                                +'<input type="hidden" value="'+data[0]['idsubject']+'" name="idsubject">';
                    inputList.forEach(function(inputs){
                        htmlbody += '<div class="input-group">'
                                +'   <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;">'+upperCaseFirstWord(inputs)+'</div></span>'
                                +'   <input type="text" class="form-control" name="'+inputs+'" value="'+data[0][inputs]+'" aria-describedby="basic-addon1" required="required">'
                                +'</div>'
                    });
                    htmlbody += '<div class="input-group">'
                        +'   <span class="input-group-addon" ><div style="width:100px;float:left;">Schedule</div></span>'
                        +'   <input type="hidden" value="'+data[0]["idschedule"]+'" id="mdl-input-schedule" class="form-control btn-schedule" name="schedule" aria-describedby="basic-addon1" required="required">'
                        +'   <input type="button" value="'+data[0]["schedule_code"]+'" id="mdl-input-temp-schedule" class="form-control btn-schedule" name="temp_schedule" aria-describedby="basic-addon1" required="required" style="text-align:left;">'
                     +'</div>'
                     +'</form>';
                            
                    $('.modal-body').html(htmlbody);
                    
                    var footer = '<button type="submit" form="mdl-frm-update-subject" class="btn btn-primary btn-post-user-update">Save changes</button>'
                                +'<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                    $('.modal-footer').html(footer);
                }
            }
        });
    
        $('#modal-dynamic').modal('show');
    });
    
    //******** UPDATE SUBJECT END*/

    //******** POST UPDATE SUBJECT*/

    $(document).on('submit','#mdl-frm-update-subject',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to update this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, update it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){
                        if(data[1] == true){
                            swal("success", "Record Updated.", "success");   
                            location.reload();
                            $('#mdl-user-update').modal('hide');
                        }else{
                            swal("cancelled", data[0], "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Update Canceled.", "error");
            }
        });
        
    });

    //******** POST UPDATE SUBJECT END*/

    //******** POST DELETE SUBJECT*/

    $(document).on('click','.btn-delete-subject',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        var url = btn.attr('href');

        swal({
            title: "Are you sure?",
            text: "Do you want to delete this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            
            if (isConfirm) {
                
                $.ajax({
                url:url,
                data:{id:id},
                method:"POST",
                dataType:"json",
                
                success:function(data){
                    if(data[1] == true){
                        btn.closest("tr").remove();
                        swal("success", "Record Deleted.", "success");
                        
                    }else{
                        swal("Cancelled", data[0], "error");S
                    }
                }
            });
            } else {
                swal("Cancelled", "Delete Canceled.", "error");
            }
        });
        
        
    });
    //******** POST DELETE SUBJECT END*/
    
    //******** ADD DEPARTMENT */
    $(document).on('click','.btn-add-department',function(e){
        e.preventDefault();
        
        $('#mdl-title').html('Add Department');
        var inputList = ["department name","Description"];
        var htmlbody = '<form action="departments/adddepartment" method="post" onsubmit="return false;" id="mdl-frm-add-department">';
        inputList.forEach(function(inputs){
            htmlbody += '<div class="input-group">'
                        +'   <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;">'+upperCaseFirstWord(inputs)+'</div></span>'
                        +'   <input type="text" class="form-control" name="'+inputs+'" aria-describedby="basic-addon1" required="required">'
                        +'</div>'
        });
        htmlbody += '</form>';
        $('.modal-body').html(htmlbody);
        
        var footer = '<button type="submit" form="mdl-frm-add-department" class="btn btn-primary btn-post-add-department"><i class="material-icons">playlist_add_check</i></button>'
                    +'<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button>';
        $('.modal-footer').html(footer);
    
    
        $('#modal-dynamic').modal('show');
    });
    
    //******** ADD DEPARTMENT END*/

    //******** POST ADD DEPARTMENT */
    $(document).on('submit','#mdl-frm-add-department',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to Save this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Save it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){ 
                        if(data[1] == true){
                            swal("success", "Record Added.", "success");   
                            location.reload();
                        }else{
                            swal("cancelled", data[0], "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Add Canceled.", "error");
            }
        });
        
    });

    //******** POST ADD DEPARTMENT END*/



    //******** UPDATE DEPARTMENT*/
    $(document).on('click','.btn-update-department',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        $.ajax({
            url:'departments/getdepartmentinfobyid',
            dataType:"json",
            method:"POST",
            data:{id:id},
            success:function(data){
                if(data[1] == true){
                    $('#mdl-title').html('Update Department');
                    var inputList = ["department_name","description"];

                    var htmlbody = '<form action="departments/updatedepartment" method="POST" id="mdl-frm-update-department" onsubmit="return false;">'
                                +'<input type="hidden" value="'+data[0]['iddepartment']+'" name="iddepartment">';
                    inputList.forEach(function(inputs){
                        htmlbody += '<div class="input-group">'
                                +'   <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;">'+upperCaseFirstWord(inputs)+'</div></span>'
                                +'   <input type="text" class="form-control" name="'+inputs+'" value="'+data[0][inputs]+'" aria-describedby="basic-addon1" required="required">'
                                +'</div>'
                    });
                    htmlbody += '</form>';
                            
                    $('.modal-body').html(htmlbody);
                    
                    var footer = '<button type="submit" form="mdl-frm-update-department" class="btn btn-primary btn-post-department-update">Save changes</button>'
                                +'<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                    $('.modal-footer').html(footer);
                }
            }
        });
    
        $('#modal-dynamic').modal('show');
    });

    //******** UPDATE DEPARTMENT END*/

    //******** POST UPDATE DEPARTMENT*/

    $(document).on('submit','#mdl-frm-update-department',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to update this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, update it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){
                        if(data[1] == true){
                            swal("success", "Record Updated.", "success");   
                            location.reload();
                        }else{
                            swal("cancelled", data[0], "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Update Canceled.", "error");
            }
        });
        
    });

    //******** POST UPDATE DEPARTMENT END*/


    //******** POST DELETE DEPARTMENT*/

    $(document).on('click','.btn-delete-department',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        var url = btn.attr('href');

        swal({
            title: "Are you sure?",
            text: "Do you want to delete this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            
            if (isConfirm) {
                
                $.ajax({
                url:url,
                data:{id:id},
                dataType:"json",
                method:"POST",
                success:function(data){
                    if(data[1] == true){
                        btn.closest("tr").remove();
                        swal("success", "Record Deleted.", "success");
                        
                    }else{
                        swal("Cancelled", data[0], "error");S
                    }
                }
            });
            } else {
                swal("Cancelled", "Delete Canceled.", "error");
            }
        });
        
        
    });
    //******** POST DELETE DEPARTMENT END*/

    //******** ADD COURSE */
    $(document).on('click','.btn-add-course',function(e){
        e.preventDefault();
        
        $('#mdl-title').html('Add course');
        var inputList = ["course_name","course_description"];
        var htmlbody = '<form action="courses/addcourse" method="post" onsubmit="return false;" id="mdl-frm-add-course">';
        inputList.forEach(function(inputs){
            htmlbody += '<div class="input-group">'
                        +'   <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;">'+upperCaseFirstWord(inputs)+'</div></span>'
                        +'   <input type="text" class="form-control" name="'+inputs+'" aria-describedby="basic-addon1" required="required">'
                        +'</div>'
        });
        htmlbody += '</form>';
        $('.modal-body').html(htmlbody);
        
        var footer = '<button type="submit" form="mdl-frm-add-course" class="btn btn-primary btn-post-add-course"><i class="material-icons">playlist_add_check</i></button>'
                    +'<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button>';
        $('.modal-footer').html(footer);
    
    
        $('#modal-dynamic').modal('show');
    });

    //******** ADD COURSE END*/

    //******** POST ADD COURSE */
    $(document).on('submit','#mdl-frm-add-course',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to Save this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Save it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){ 
                        if(data[1] == true){
                            swal("success", "Record Added.", "success");   
                            location.reload();
                        }else{
                            swal("cancelled", data[0], "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Add Canceled.", "error");
            }
        });
        
    });

    //******** POST ADD COURSE END*/


    //******** UPDATE COURSE*/
    $(document).on('click','.btn-update-course',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        $.ajax({
            url:'courses/getcourseinfobyid',
            dataType:"json",
            method:"POST",
            data:{id:id},
            success:function(data){
                if(data[1] == true){
                    $('#mdl-title').html('Update course');
                    var inputList = ["course_name","course_description"];

                    var htmlbody = '<form action="courses/updatecourse" method="POST" id="mdl-frm-update-course" onsubmit="return false;">'
                                +'<input type="hidden" value="'+data[0]['idcourse']+'" name="idcourse">';
                    inputList.forEach(function(inputs){
                        htmlbody += '<div class="input-group">'
                                +'   <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;">'+upperCaseFirstWord(inputs)+'</div></span>'
                                +'   <input type="text" class="form-control" name="'+inputs+'" value="'+data[0][inputs]+'" aria-describedby="basic-addon1" required="required">'
                                +'</div>'
                    });
                    htmlbody += '</form>';
                            
                    $('.modal-body').html(htmlbody);
                    
                    var footer = '<button type="submit" form="mdl-frm-update-course" class="btn btn-primary btn-post-course-update">Save changes</button>'
                                +'<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                    $('.modal-footer').html(footer);
                }
            }
        });
    
        $('#modal-dynamic').modal('show');
    });

    //******** UPDATE COURSE END*/

    //******** POST UPDATE COURSE*/

    $(document).on('submit','#mdl-frm-update-course',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to update this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, update it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){
                        if(data[1] == true){
                            swal("success", "Record Updated.", "success");   
                            location.reload();
                        }else{
                            swal("cancelled", data[0], "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Update Canceled.", "error");
            }
        });
        
    });
    //******** POST UPDATE COURSE END*/

    //******** POST DELETE COURSE*/

    $(document).on('click','.btn-delete-course',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        var url = btn.attr('href');

        swal({
            title: "Are you sure?",
            text: "Do you want to delete this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            
            if (isConfirm) {
                
                $.ajax({
                url:url,
                data:{id:id},
                dataType:"json",
                method:"POST",
                success:function(data){
                    if(data[1] == true){
                        btn.closest("tr").remove();
                        swal("success", "Record Deleted.", "success");
                        
                    }else{
                        swal("Cancelled", data[0], "error");S
                    }
                }
            });
            } else {
                swal("Cancelled", "Delete Canceled.", "error");
            }
        });
        
        
    });
    //******** POST DELETE COURSE END*/
$('#selectpicker').on('hide.bs.dropdown', function () {
    
})
    
    //******** ADD SCHEDULE*/
    
    $(document).on('click','.btn-add-schedule',function(e){
        e.preventDefault();
        $.ajax({
            url:'schedules/modaladdshedule',
            dataType:"json",
            success:function(data){
                $('#mdl-title').html('Add Schedule');
                $('.modal-body').html(data["body"]);
                $('.modal-footer').html(data["footer"]);
                $('.datepicker').bootstrapMaterialDatePicker({
                        time:true,
                        month:false,
                        date:false,
                        format: 'HH:mm',
                        shortTime:true,
                });
                $(".chzn-select").chosen({width:"100%",placeholder_text_single: "Select Options...",
      no_results_text: "Oops, nothing found!"});
                $('#modal-dynamic').modal('show');
            }
        });
        
    });

    //******** ADD SCHEDULE END*/
    
    //******** POST ADD SCHEDULE*/
    $(document).on('submit','#mdl-frm-add-schedule',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to Save this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Save it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){ 
                        if(data[1] == true){
                            swal("success", "Record Added.", "success");   
                            location.reload();
                        }else{
                            swal("cancelled", data[0], "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Add Canceled.", "error");
            }
        });
        
    });
    //******** POST ADD SCHEDULE END*/

    //******** POST DELETE SCHEDULE */
    $(document).on('click','.btn-delete-schedule',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        var url = btn.attr('href');

        swal({
            title: "Are you sure?",
            text: "Do you want to delete this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            
            if (isConfirm) {
                
                $.ajax({
                url:url,
                data:{id:id},
                dataType:"json",
                method:"POST",
                success:function(data){
                    if(data[1] == true){
                        btn.closest("tr").remove();
                        swal("success", "Record Deleted.", "success");
                        
                    }else{
                        swal("Cancelled", data[0], "error");S
                    }
                }
            });
            } else {
                swal("Cancelled", "Delete Canceled.", "error");
            }
        });
        
    });
    //******** POST DELETE SCHEDULE END*/


    //******** UPDATE SCHEDULE */
    $(document).on('click','.btn-update-schedule',function(e){
        var btn = $(this);
        var id = btn.data('id');
        $.ajax({
            data:{id:id},
            url:'schedules/modalupdateschedule',
            method:"post",
            dataType:"json",
            success:function(data){
                $('#mdl-title').html('Update Schedule');
                $('.modal-body').html(data["body"]);
                $('.modal-footer').html(data["footer"]);
                $('.datepicker').bootstrapMaterialDatePicker({
                        time:true,
                        month:false,
                        date:false,
                        format: 'HH:mm',
                        shortTime:true,
                     
                });
                $(".chzn-select").chosen({width:"100%"});
                $('#modal-dynamic').modal('show');
            }
        }); 
      
    });

    //******** UPDATE SCHEDULE END*/
    //******** POST UPDATE SCHEDULE*/
    $(document).on('submit','#mdl-frm-update-schedule',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to update this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, update it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){
                        if(data[1] == true){
                            swal("success", "Record Updated.", "success");   
                            location.reload();
                        }else{
                            swal("cancelled", data[0], "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Update Canceled.", "error");
            }
        });
        
    });
    //******** POST UPDATE SCHEDULE END*/


    
    //******** MODAL ADD CLASS SUBJECT TABLE*/
    $(document).on('click','.btn-classes-subject',function(e){
        e.preventDefault();
        $('#mdl-secondary-title').html('Subject List');
        var htmlbody = '';
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        $.ajax({
            url:'subjects/getallsubjectlist',
            dataType:"json",
            method:"POST",
            success:function(data){
                htmlbody = '<table id="table-classes-subjectlist" class="table table-striped">'
                          +'<thead>'
                          +'<tr>'
                          +'<td class="text-center font-roboto color-a2">ID</td>'
                          +'<td class="text-center font-roboto color-a2">CODE</td>'
                          +'<td class="text-center font-roboto color-a2">DESCRIPTION</td>'
                          +'<td class="text-center font-roboto color-a2">SCHEDULE</td>'
                          +'<td class="text-center font-roboto color-a2">TIME</td>'
                          +'<td class="text-center font-roboto color-a2">UNITS</td>'
                          +'<td class="text-center font-roboto color-a2">ACTION</td>'
                          +'</tr>'
                          +'</thead>'
                          +'<tbody>';
                data.forEach(function(inputs){
                   
                    var id = inputs['idsubject'];
                    var code = inputs['subject_code'];
                    var description = inputs['subject_description'];
                    var schedule = inputs['day'];
                    var units = inputs['units'];
                    var time = inputs['time_start'];
               
                    htmlbody += "<tr>"
                        +"<td class='text-center font-roboto color-a2'>"+id+"</td>"
                        +"<td class='text-center font-roboto color-a2'>"+code+"</td>"
                        +"<td class='text-center font-roboto color-a2'>"+description+"</td>"
                        +"<td class='text-center font-roboto color-a2'>"+schedule+"</td>"
                        +"<td class='text-center font-roboto color-a2'>"+time+"</td>"
                        +"<td class='text-center font-roboto color-a2'>"+units+"</td>"
                        +"<td class='text-center font-roboto color-a2' style='text-align:center;'>"
                        +"<button data-id='"+id+"' data-code='"+code+"' rel='tooltip' data-original-title='Select' class='pull-right mdl-btn-add-classes-subject btn btn-success' type='button' name='create'>"
                        +"<i class='material-icons'>add</i>"
                        +"</button>"
                        +"<button data-id='"+id+"' data-code='"+code+"' rel='tooltip' data-original-title='View' class='pull-right mdl-btn-view-classes-subject btn btn-success' type='button' name='create'>"
                        +"<i class='material-icons'>remove_red_eye</i>"
                        +"</button>"
                        +"</td>"
                        +"</tr>";
                           
                    
                });
                htmlbody+= "</tbody>"
                      +"</table><div id='view-subject-users'></div>";
                $('.modal-secondary-body').html(htmlbody);
            }
        });
        var footer = '<div style="padding:5px;" class="text-right"><button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button></div>';
        $('.modal-secondary-footer').html(footer);
        $('#table-classes-subjectList').DataTable();
    
        $('#modal-dynamic-secondary').modal('show');
    });


    $(document).on('click','.mdl-btn-add-classes-subject',function(e){
        var btn = $(this);
        var id = btn.data('id');
        var code = btn.data('code');
        $('#mdl-input-classes-subject').val(id);
        $('#mdl-input-temp-classes-subject').val(code);
        $('#modal-dynamic-secondary').modal('hide');
    });
    //******** MODAL ADD CLASS SUBJECT TABLE END*/

    //******** MODAL VIEW CLASS SUBJECT TABLE */
    //back to subject list button
    $(document).on('click','.btn-view-class-subject-return',function(e){
        e.preventDefault();
        $('#table-classes-subjectlist').attr('style','display:block !important;');
        $('#view-subject-users').attr('style','display:none !important;');
        $('.modal-dialog').attr('style','width:660px !important;');
    });
    //
    $(document).on('click','.mdl-btn-view-classes-subject',function(e){
        e.preventDefault();
        $('#mdl-secondary-title').html('Subject Information');
        $('#view-subject-users').attr('style','display:block !important;');
        $('#table-classes-subjectlist').attr('style','display:none !important;');
        $('.modal-dialog').attr('style','width:80% !important;');
        var htmlbody = '';
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        $.ajax({
            url:'subjects/getallsubjectusersbyid',
            dataType:"json",
            data:{id:id},
            method:"POST",
            success:function(data){
          
                var teacherName = "";
                data.forEach(function(inputs){
                    if(inputs["user_level"] == "2"){
                        teacherName = inputs["lastname"]+", "+inputs["firstname"]+" "+inputs["middlename"];
                    }
                });
                
                htmlbody = '<div class="row"><span class="header-class-subject-information-left">Code:</span><span class="">'+data[0]['subject_code']+'</span></div>'
                +'<div class="row"><span class="header-class-subject-information-left">Description:</span><span class="">'+data[0]['subject_description']+'</span></div>'
                +'<div class="row"><span class="header-class-subject-information-left">Day:</span><span class="">'+data[0]['day']+'</span></div>'
                +'<div class="row"><span class="header-class-subject-information-left">Time:</span><span class="">'+data[0]['time_start']+'-'+data[0]['time_end']+'</span></div>'
                +'<div class="row"><span class="header-class-subject-information-left">Units:</span><span class="">'+data[0]['units']+'</span></div>'
                +'<div class="row"><span class="header-class-subject-information-left">Teacher:</span><span class="">'+teacherName+'</span></div>'
                +'<button class="btn btn-sucess pull-right btn-view-class-subject-return">Back</button>'
                +'<span style="font-size:20px;margin:30px;">Student List:</span>'
                +'<table id="table-classes-subjectlist" class="table table-striped">'
                +'<thead>'
                +'<tr>'
                +'<td class="text-center font-roboto color-a2">ID</td>'
                +'<td class="text-center font-roboto color-a2">CODE</td>'
                +'<td class="text-center font-roboto color-a2">NAME</td>'
                +'<td class="text-center font-roboto color-a2">COURSE</td>'
                +'<td class="text-center font-roboto color-a2">YEAR LEVEL</td>'
                +'<td class="text-center font-roboto color-a2">DEPARTMENT</td>'
                +'</tr>'
                +'</thead>'
                +'<tbody>';
            if(data != false){
                data.forEach(function(inputs){
                    
                    
              
                        var id = inputs['id'];
                        var code = inputs['code'];
                        var firstname = inputs['firstname'];
                        var lastname = inputs['lastname'];
                        var middlename = inputs['middlename'];
                        var course = inputs['course_name'];
                        var year_level = inputs['year_level'];
                        var department = inputs['department_name'];
                   
                          if(inputs['user_level'] == "1"){  
                              htmlbody += "<tr>"
                              +"<td class='text-center font-roboto color-a2'>"+id+"</td>"
                              +"<td class='text-center font-roboto color-a2'>"+code+"</td>"
                              +"<td class='text-center font-roboto color-a2'>"+lastname+", "+firstname+" "+middlename+"</td>"
                              +"<td class='text-center font-roboto color-a2'>"+course+"</td>"
                              +"<td class='text-center font-roboto color-a2'>"+year_level+"</td>"
                              +"<td class='text-center font-roboto color-a2'>"+department+"</td>"
                              +"<td class='text-center font-roboto color-a2' style='text-align:center;'>"
                              +"</td>"
                              +"</tr>";
                          }
                      
                                    
                            
                    });
            }
            htmlbody+= "</tbody>"
                    +"</table>";
                $('#view-subject-users').html(htmlbody);
            }
        });
        var footer = '<div style="padding:5px;" class="text-right"><button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button></div>';
        $('.modal-secondary-footer').html(footer);
    });

    //******** MODAL VIEW CLASS SUBJECT TABLE END*/
    
    //******** ADD CLASS*/
    $(document).on('click','.btn-add-classes-subject',function(e){
        e.preventDefault();
        
        $('#mdl-title').html('Add Class');
        var inputList = ["class_name","class_description","room_name"];
        var htmlbody = '<form action="classes/addclasses" method="post" onsubmit="return false;" id="mdl-frm-add-classes-subject">';
        inputList.forEach(function(inputs){
            htmlbody += '<div class="input-group">'
                        +'   <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;">'+upperCaseFirstWord(inputs)+'</div></span>'
                        +'   <input type="text" class="form-control" name="'+inputs+'" aria-describedby="basic-addon1" required="required">'
                        +'</div>'
        });
        htmlbody += '<div class="input-group">'
                        +'   <span class="input-group-addon" ><div style="width:100px;float:left;">Subject</div></span>'
                        +'   <input type="hidden" id="mdl-input-classes-subject" class="form-control" name="idsubject" aria-describedby="basic-addon1" required="required">'
                        +'   <input type="button" id="mdl-input-temp-classes-subject" class="form-control btn-classes-subject" name="tmp_idsubject" aria-describedby="basic-addon1" required="required" style="text-align:left;">'
                     +'</div>'
                     +'</form>';
        $('.modal-body').html(htmlbody);
        
        var footer = '<button type="submit" form="mdl-frm-add-classes-subject" class="btn btn-primary btn-post-add-classes-subject"><i class="material-icons">playlist_add_check</i></button>'
                    +'<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button>';
        $('.modal-footer').html(footer);
    
    
        $('#modal-dynamic').modal('show');
    });
    //******** ADD CLASS END*/

    //******** POST ADD CLASS*/
    $(document).on('submit','#mdl-frm-add-classes-subject',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to Save this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Save it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){ 
                        if(data[1] == true){
                            swal("success", "Record Added.", "success");   
                            location.reload();
                        }else{
                            swal("cancelled", data[0], "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Add Canceled.", "error");
            }
        });
        
    });
    //******** POST ADD CLASS END*/

    //******** POST DELETE CLASS*/
    $(document).on('click','.btn-delete-class-subject',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        var url = btn.attr('href');

        swal({
            title: "Are you sure?",
            text: "Do you want to delete this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            
            if (isConfirm) {
                
                $.ajax({
                url:url,
                data:{id:id},
                dataType:"json",
                method:"POST",
                success:function(data){
                    if(data[1] == true){
                        btn.closest("tr").remove();
                        swal("success", "Record Deleted.", "success");
                        
                    }else{
                        swal("Cancelled", data[0], "error");
                    }
                }
            });
            } else {
                swal("Cancelled", "Delete Canceled.", "error");
            }
        });
        
        
    });
    //******** POST DELETE CLASS END*/

    //********  UPDATE CLASS */
    
    $(document).on('click','.btn-update-class',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        $.ajax({
            url:'classes/getClassesInfoById',
            dataType:"json",
            method:"POST",
            data:{id:id},
            success:function(data){

                if(data[1] == true){
                    $('#mdl-title').html('Update classes');
                    var inputList = ["class_name","class_description","room_name"];

                    var htmlbody = '<form action="classes/updateclasses" method="POST" id="mdl-frm-update-classes" onsubmit="return false;">'
                                +'<input type="hidden" value="'+data[0]['idclass']+'" name="idclass">';
                    inputList.forEach(function(inputs){
                        htmlbody += '<div class="input-group">'
                                +'   <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;">'+upperCaseFirstWord(inputs)+'</div></span>'
                                +'   <input type="text" class="form-control" name="'+inputs+'" value="'+data[0][inputs]+'" aria-describedby="basic-addon1" required="required">'
                                +'</div>'
                    });
                    htmlbody += '<div class="input-group">'
                        +'   <span class="input-group-addon" ><div style="width:100px;float:left;">Subject</div></span>'
                        +'   <input type="hidden" value="'+data[0]["idsubject"]+'" id="mdl-input-classes-subject" class="form-control btn-classes" name="idsubject" aria-describedby="basic-addon1" required="required">'
                        +'   <input type="button" value="'+data[0]["subject_code"]+'" id="mdl-input-temp-classes-subject" class="form-control btn-classes-subject" name="temp_classes" aria-describedby="basic-addon1" required="required" style="text-align:left;">'
                     +'</div>'
                     +'</form>';
                            
                    $('.modal-body').html(htmlbody);
                    
                    var footer = '<button type="submit" form="mdl-frm-update-classes" class="btn btn-primary btn-post-classes-update">Save changes</button>'
                                +'<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                    $('.modal-footer').html(footer);
                }
            }
        });
    
        $('#modal-dynamic').modal('show');
    });
    
    //******** UPDATE CLASS END*/

    //******** POST UPDATE CLASSES*/

    $(document).on('submit','#mdl-frm-update-classes',function(e){
        e.preventDefault();
        var frm = $(this);
        var id = frm.data('id');
        var method = frm.attr('method');
        var url = frm.attr('action');
        swal({
            title: "Are you sure?",
            text: "Do you want to update this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, update it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:url,
                    data:frm.serialize(),
                    method:method,
                    dataType:"json",
                    success:function(data){
                        if(data[1] == true){
                            swal("success", "Record Updated.", "success");   
                            location.reload();
                            $('#mdl-classes-update').modal('hide');
                        }else{
                            swal("cancelled", data[0], "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "Update Canceled.", "error");
            }
        });
        
    });

    
    //********  ADD QUESTIONAIRE TYPE */
    
    $(document).on('click','.btn-add-question-type',function(e){
        e.preventDefault();
        var inputType= document.getElementById('select-question-type-input');
        var inputTitle = document.getElementById('category-title-input');
        var inputAnswerQuantity = document.getElementById('questionaire-case-input');
        var inputNumberOfPoints = document.getElementById('number-of-points-input');
        var inputNumerOfItems = document.getElementById('number-of-items-input');
        var inputTypeValue = inputType.value;
        var inputTypeText = $('#select-question-type-input option:selected').text();
        if(inputAnswerQuantity != null){
            var inputAnswerQuantityValue = inputAnswerQuantity.value;
        }else{
            var inputAnswerQuantityValue = "";
        }
        var inputTitleValue = inputTitle.value;
        var inputNumberOfPointsValue = inputNumberOfPoints.value;
        var inputNumerOfItemsValue = inputNumerOfItems.value;
        var panelQuantity = $('#tab-header > li').length;
        var totalPointsValue = $('#total-points-input').val();

        if( inputAnswerQuantityValue == ""){
            if(inputTypeValue == 0){
                swal("Cancelled", "Fill Up Fields.", "error");
                return false;
            }
        }    
        if( inputTitleValue == ""){
            swal("Cancelled", "Fill Up Fields.", "error");
            return false;
        }    
        if(inputNumberOfPointsValue == ""){
            swal("Cancelled", "Fill Up Fields.", "error");
            return false;
        }    
        if(inputNumerOfItemsValue == ""){
            swal("Cancelled", "Fill Up Fields.", "error");
            return false;
        }
        
        var nextTab = $('#tab-header li').length-1;

        var tabHeader = '<li role="presentation" class="" id="tab-header-add-question'+nextTab+'" style="width:20%;" data-id="'+nextTab+'">'
                            +'<a href="#tab-add-question'+nextTab+'" data-toggle="tab">'
                                +'<span class="">'+inputTitleValue+' - '+inputTypeText+'</span>'
                            +'</a>'
                        +'</li>';
        var tabContent = '<div role="tabpanel" class="tab-pane fade" id="tab-add-question'+nextTab+'" data-id="'+nextTab+'" data-questiontype="'+inputTypeValue+'">'
                        +'<div class="container">'
                        +'<div class="row">'
                        +'<div class="col-md-10 bhoechie-tab-container template'+nextTab+'">'
                            +'<div class="col-md-2 bhoechie-tab-menu template'+nextTab+'">'
                                +'<div class="list-group">';
                               
        for(i=0;i<inputNumerOfItemsValue;i++){
            tabContent += '<a href="#" class="list-group-item '+((i==0) ? 'active':'')+' text-center">'
                            +'<h4 class="glyphicon glyphicon-tags"></h4><br/><b>'+(i+1)+'</b>'
                        +'</a>';
        }
                                
        tabContent += '</div>'
                        +'</div>'
                        +'<div class="col-md-8 bhoechie-tab">';
                        
        for(i=0;i<inputNumerOfItemsValue;i++){
            tabContent += '<div class="bhoechie-tab-content '+((i==0) ? 'active':'')+'">'
                +'<center id="add-answer'+nextTab+'-'+i+'">'
                    //content
                    +'<input type="hidden" id="category-title-tabNo'+i+'" value="'+inputTitleValue+'">'
                    +'<input type="hidden" id="question-quantity-tabNo'+i+'" value="'+inputAnswerQuantityValue+'">'
                    +'<input type="hidden" id="item-points-tabNo'+i+'" value="'+inputNumberOfPointsValue+'">'
                    +'<input type="hidden" id="item-quantity-tabNo'+i+'" value="'+inputNumerOfItemsValue+'">'
                    +'<input type="hidden" id="total-item-tabNo'+i+'" value="'+totalPointsValue+'">'
                    
                    +'<div class="col-md-12" style="margin: 5px;">'
                            +'<h1 class="glyphicon glyphicon-question-sign" style="font-size:4em;color:#55518a"></h1>'
                            +'<h2 style="margin-top: 0;color:#55518a">Question no. '+(i+1)+'</h2>'
                            +'<div class="form-group col-md-12">'
                                +'<label style="font-size:16px;">Question</label>'
                                +'<div class="form-group label-floating col-md-12">'
                                    +'<label class="control-label col-md-3" style="left:0;">Write Your Question Here  . . .</label>'
                                    +'<textarea name="question" class="col-md-9 form-control mytextarea" id="questionTabno'+nextTab+'-itemno-'+i+'" rows="5" required="required"></textarea>'
                                +'</div>'
                            +'</div>';
            
            if(inputTypeValue != 0){
                tabContent += '<div class="add-answer">'
                    +'<span class="span-add-answer'+nextTab+'"><button class="btn-success btn pull-left btn-add-answer">'
                        +'<span class="material-icons">add</span>'
                    +'</button></span>'
                    +'<span style="margin-top:15px;" class="pull-left">Add Answer . . .</span>'
                +'</div>';
            }                
                tabContent +='</div>';
            if(inputTypeValue == 0){
                for(j=0;j<inputAnswerQuantityValue;j++){
                    tabContent += '<div class="input-group">'
                                    +'<span class="input-group-addon" id="basic-addon1">Answer no'+(j+1)+'</span>'
                                    +'<input type="text" class="form-control use" placeholder="Enter Answer Choices '+(j+1)+'" aria-describedby="basic-addon1" required="required" id="choicesTabno-'+nextTab+'-itemno-'+i+'-choicesno-'+j+'" name="choices" data-testno="">'
                                +'</div>';
                }
                   tabContent += '<div class="form-group">'
                +'<label for="">Select Question Answer</label>'
                    +'<select multiple name="answer" required="required" class="form-control" id="answerTabno-'+nextTab+'-itemno-'+i+'-answerno-0" data-testno="">';//tabno-'+nextTab+'-itemno-'+itemNo+'-answerno-'+answerQuantity+'
                for(j=0;j<inputAnswerQuantityValue;j++){
                    
                    tabContent += '<option value="'+j+'">Choices No '+(j+1)+'</option>';
                }    
                    tabContent +='</select>'    
                        +'</div>';
                
            }
            tabContent += '<span class="span-next-item'+nextTab+' item-'+i+'">'
                            +'<button class="btn-success btn pull-right btn-next-item'+nextTab+' item-'+i+'">'
                                +'<span class="material-icons">playlist_add_check</span>'
                            +'</button>'
                        +'</span>';
                    //content end
            tabContent += '</center>'
            +'</div>';
        }
                                
        tabContent += '</div>'
                        +'</div>'
                        +'</div>'
                        +'</div>';
        // create the tab
        $(tabHeader).appendTo('#tab-header');
        
        // create the tab content
        $(tabContent).appendTo('#tab-content');
        
        // make the new tab active
        
        $('#tab-header a:last').tab('show');
        
       
        $(document).on('click','div.bhoechie-tab-content.active span.span-next-item'+nextTab+' > button.btn-next-item'+nextTab+'',function(e){
            var button = $(this);
            var spanNext = button.parent();
            var resultInput = $('div.bhoechie-tab-container.template'+nextTab+' div.bhoechie-tab-content.active input[required]').filter(function () {
                return $.trim($(this).val()).length == 0
              }).length == 0;
            var resultSelect = $('div.bhoechie-tab-container.template'+nextTab+' div.bhoechie-tab-content.active select[required]').filter(function () {
                return $.trim($(this).val()).length == 0
            }).length == 0;
            if(resultInput == true && resultSelect == true){
                var activeHeader =  $('div.bhoechie-tab-container.template'+nextTab+' div.bhoechie-tab-menu.template'+nextTab+' a.list-group-item.active');
                var activeContent = $('div.bhoechie-tab-container.template'+nextTab+' div.bhoechie-tab-content.active');
                activeHeader.children('h4').removeClass('glyphicon-tags');
                activeHeader.children('h4').addClass('glyphicon-check');
                if(parseInt(activeHeader.children('b').text()) != (inputNumerOfItemsValue)){
                    
                    activeHeader.removeClass('active');
                    activeHeader.next().addClass('active');
                    activeContent.removeClass('active');
                    activeContent.next().addClass('active');
                    
                    //window.setInterval(function() {
                        
                        
                        var elem = $('div.bhoechie-tab-container.template'+nextTab+' .bhoechie-tab-content.active');
                        
                        $('body').scrollTop(elem.offset().top);
                    //}, 5000);
                }
            }else{
                swal("Cancelled", "Fill Up Fields.", "error");
                return false;
            }
        });
        
        //ADD ANSWER
        $(document).on('click','div.bhoechie-tab-content.active > center > div > div > span.span-add-answer'+nextTab+' > button.btn-add-answer',function(e){
            e.preventDefault();
            var itemNo = $('div.bhoechie-tab-menu.template'+nextTab+' a').index($('div.bhoechie-tab-menu.template'+nextTab+' a.active'));
            var answerQuantity = $('div#tab-content > div.active div.bhoechie-tab-content.active input.form-control').length;
            var input = '<div class="input-group">'
                            +'<span class="input-group-addon" id="basic-addon1">Description</span>'
                            +'<input type="text" class="form-control use" placeholder="Enter Description" aria-describedby="basic-addon1" required="required" id="answerTabno-'+nextTab+'-itemno-'+itemNo+'-answerno-'+answerQuantity+'" name="answer">'
                        +'</div>';
            $(input).insertBefore('div.bhoechie-tab-content.active > center > div > div > span.span-add-answer'+nextTab+' > button.btn-add-answer');
        });
        //ADD ANSWER END
        $(document).on("click","div.bhoechie-tab-menu.template"+nextTab+">div.list-group>a",function(e) {
            e.preventDefault();
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            
            $("div.bhoechie-tab-container.template"+nextTab+">div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
            $("div.bhoechie-tab-container.template"+nextTab+">div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
        });

        tinymce.init({
                selector: '.mytextarea'
        });
    });
    //********  ADD QUESTIONAIRE TYPE END */

    //EMPTY ADD QUESTIONNAIRE SETTINGS INPUT
    $(document).on('click','#tab-header-add-question',function(e){
        $('#select-question-type-input').val("0");
        $('#questionaire-case-input').val("");
        $('#category-title-input').val("");
        $('#number-of-points-input').val("");
        $('#number-of-items-input').val("");
        $('#total-points-input').val("");
    });
    //EMPTY ADD QUESTIONNAIRE SETTINGS INPUT END

    $(document).on('focusout', '#number-of-items-input', function(e){
        e.preventDefault();
        var inputNumberOfPoints = $('#number-of-points-input').val();
        var inputNumberOfPointsValue = $('#number-of-items-input').val();
        $('#total-points-input').val((inputNumberOfPoints*inputNumberOfPointsValue));
        
    });
    $(document).on('focusout', '#number-of-points-input', function(e){
        e.preventDefault();
        var inputNumberOfPoints = $('#number-of-points-input').val();
        var inputNumberOfPointsValue = $('#number-of-items-input').val();
        $('#total-points-input').val((inputNumberOfPoints*inputNumberOfPointsValue));
        
    });
   
    $(document).on('change', '#select-question-type-input', function(e){
        e.preventDefault();
        var selectDropdown = $(this);
        
        if(selectDropdown.val() == 0){
            var inputCase = '<div class="input-group">'
                                +'<span class="input-group-addon" id="span-answer-case-method">Question Quantity</span>'
                                +'<input type="text" class="form-control use" placeholder="Enter Number of Answer Question" aria-describedby="basic-addon1" required="required" id="questionaire-case-input" name="questionaire_answer_quantity" pattern="[0-9]+">'
                            +'</div>';
        $(inputCase).insertAfter(selectDropdown.parent().next('div'));
        }else if(selectDropdown.val() == 1){
            var spanAnswerCase = $('span#span-answer-case-method');
            spanAnswerCase.parent().remove();
        }
        
    });
    
    //tinyMCE TO SUBMIT
    $(document).on('mousedown','#frm-add-questionnaire', function() {
        tinyMCE.triggerSave();
    });
    //

    //SUBMIT ADD QUESTIONNAIRE
    $(document).on('submit','#frm-add-questionnaire',function(e){
        e.preventDefault();
        tinyMCE.triggerSave();
        if($('#tab-header li').length-1 <= 0){
            swal("Cancelled", "Add Question Item First.", "error");
            return false;
        }
        var examDate = new Date($('#questionnaire-add-day').val());
        var todayDate = new Date(Date.now());
        if(examDate < todayDate){
            swal("Date Should be greater that current date", "invalid Date Input", "error");
            return false;
        }
     
        swal({
            title: "Are you sure?",
            text: "Do you want to add this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Add it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            if (isConfirm) {
                var tabPanelCount = $('#tab-header li').length-1;
                
                var inputTitle = $('#questionnaire-add-title').val();
                var inputDescription = $('#questionnaire-add-description').val();
                var inputDate = $('#questionnaire-add-day').val();
                var inputTime = $('#questionnaire-add-time').val();
                var inputDuration = $('#questionnaire-add-duration').val();
                var inputInstruction = $('#questionnaire-add-instruction').val();
                var inputIdSubject= $('#questionaire-idsubject').val();
                
                var inputData = [];
                inputData = {
                        
                    'data' : {
                        "questionaire_title": inputTitle,
                        "questionaire_description": inputDescription,
                        "questionaire_date": inputDate,
                        "questionaire_time": inputTime,
                        "questionaire_duration": inputDuration,
                        "questionaire_instruction": inputInstruction,
                        "idsubject":inputIdSubject
                    }
                    
                };
              
                
                
                for(i=0;i<tabPanelCount;i++){
                    var itemsCount = $('div.bhoechie-tab-menu.template'+i+' a').length;
                    var questionType = $('#tab-add-question'+i).data('questiontype');
                    var categoryTitle = $('#category-title-tabNo'+i+'').val();
                    var questionQuantity = $('#question-quantity-tabNo'+i+'').val();
                    var itemPoints = $('#item-points-tabNo'+i+'').val();
                    var itemQuantity = $('#item-quantity-tabNo'+i+'').val();
                    var totalItem = $('#total-item-tabNo'+i+'').val();
                    
                    inputData[i] = [];                          
                    
                    inputData[i] = {
                        'data' : {
                            'questionaire_type_title': categoryTitle,
                            'questionaire_type': questionType,
                            'questionaire_type_question_quantity':questionQuantity,
                            'questionaire_type_item_points':itemPoints,
                            'questionaire_type_item_quantity':itemQuantity,
                            'questionaire_type_total_item':totalItem,
                        }
                    };
                    for(j=0;j<itemsCount;j++){
                        inputData[i][j] = [];
                        var question = tinymce.get("questionTabno"+i+"-itemno-"+j+"").getContent();
                        inputData[i][j] = {
                            "question": question
                        }
                        if(questionType == 0){
                            var choicesCount = $('center#add-answer0-0 > div.input-group').length;
                            
                            for(k=0;k<choicesCount;k++){
                                inputData[i][j][k] = [];
                                inputData[i][j][k] = $('#choicesTabno-'+i+'-itemno-'+j+'-choicesno-'+k+'').val();
                            }
                            var selectValue = $('#answerTabno-'+i+'-itemno-'+i+'-answerno-0').val();
                            var answer = $('#choicesTabno-'+i+'-itemno-'+j+'-choicesno-'+selectValue+'').val();
                            inputData[i][j].answer = answer;

                        }else{
                            var answerCount = $('center#add-answer'+i+'-'+j+' div.add-answer > span.span-add-answer'+i+' > div.input-group').length
                            for(k=0;k<answerCount;k++){
                                inputData[i][j][k] = [];
                                inputData[i][j][k] = $('#answerTabno-'+i+'-itemno-'+j+'-answerno-'+k+'').val();
                            }
                            
                        }


                    }
                }
                
                

                $.ajax({
                    url:"examinations/postQuestionnaireInformation",
                    data:{data:inputData},
                    method:"POST",
                    dataType:"json",
                    success:function(data){
                        if(data[1] == true){
                            swal("success", "Record Added.", "success");   
                            window.location.replace('examinations/userquestionairelist/'+data[2]+'')
                            $('#mdl-classes-update').modal('hide');
                        }else{
                            swal("cancelled", data[0], "error");
                        }
                    }
                });

            } else {
                swal("Cancelled", "Add Canceled.", "error");
            }
        });
    });
    //SUBMIT ADD QUESTIONNAIRE END 

    //SUBMIT DELETE QUESTIONNAIRE 
    
    $(document).on('click','.btn-delete-questionaire',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');

        swal({
            title: "Are you sure?",
            text: "Do you want to delete this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm){
            
            if (isConfirm) {
                
                $.ajax({
                url:'examinations/deleteQuestionaire',
                data:{id:id},
                dataType:"json",
                method:"POST",
                success:function(data){
                    if(data[1] == true){
                        btn.closest("tr").remove();
                        swal("success", "Record Deleted.", "success");
                        
                    }else{
                        swal("Cancelled", "Error Delete Record.", "error");
                    }
                }
            });
            } else {
                swal("Cancelled", "Delete Canceled.", "error");
            }
        });
        
        
    });
    //SUBMIT DELETE QUESTIONNAIRE END 

    
   

    
   
    

});// DOCUMENT READY END


//EXAMINE FULL SCREEN 
//
function goToFullScreen(){
    swal({
        title: "Are you Sure?",
        text: "Press ok to proceed",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes !",
        cancelButtonText: "No !",
        closeOnConfirm: true,
        closeOnCancel: true
        },
        function(isConfirm){
        
        if (isConfirm) {
            
            //var el = document.getElementById('examine-content');
            //fullScreenToggle(el);
            //$(el).attr('style','width:100% !important;height:100% !important;');
            
            document.body.className += " no-scroll";
            $('#agreement-container').hide();
            $('#examine-container').show();
            //COUNTDOWN TIMER
            
            var countDownDate = (new Date(Date.now()).getTime() + (parseInt($("#countdownduration").val()+2)*100));
            
            
            // Update the count down every 1 second
            var x = setInterval(function() {
        
                // Get todays date and time
                var now = new Date(Date.now()).getTime();
                
                // Find the distance between now an the count down date
                var distance = countDownDate - now;
                
                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
                // Output the result in an element with id="demo"
                document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";
                
                // If the count down is over, write some text 
                if (distance < 0) {
                    
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = "EXPIRED";

                    var contentTabHeader = $('ul > li.tab-examine');
                    var dataAnswers = [];
                    dataAnswers = {
                        'idquestionaire' : $('#input-idquestionaire').val()
                    }
                    for(i=0;i<contentTabHeader.length;i++){
                        dataAnswers[i] = [];
                        dataAnswers[i] = {};
                        var itemsCount = $('div.btmenu-template'+i+'>div.list-group > a').length;
                        for(j=0;j<itemsCount;j++){
                            if($('.answer'+i+'-'+j+'').data('type') == 0){
                                dataAnswers[i][j] = $('.answer'+i+'-'+j+':checked').val();
                            }else{
                                dataAnswers[i][j] = $('.answer'+i+'-'+j+'').val();
                            }
                            
                            
                            dataAnswers[i].idquestion = $('#input-idquestion-tabno'+i+'-'+j+'').val();
                        }
                    }
                    
                    
                    $.ajax({
                        url:'examinations/submitexamine',
                        data:{data:dataAnswers},
                        dataType:"json",
                        method:"POST",
                        success:function(data){
                            if(data[1] == true){
                                swal("success", "Your Examination Has Been Submitted.", "success");
                                window.location.replace('examinations');
                            }else{
                                swal("Cancelled", "Error Delete Record.", "error");
                            }
                        }
                        
                    });
                }
            }, 1000);
            //COUNTDOWN TIMER END
        } else {
            swal("Cancelled", "Cancelled", "error");
        }
    });
    
    $(document).on('fullscreenchange webkitfullscreenchange mozfullscreenchange MSFullscreenChange', function() {
        if(!IsFullScreenCurrently()){
            //alert('hahahha');
        }

    });

}
function IsFullScreenCurrently() {
	var full_screen_element = document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement || null;
	
	// If no element is in full-screen
	if(full_screen_element === null)
		return false;
	else
		return true;
}
function fullScreenToggle(elem) {
    if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) {
            elem.webkitRequestFullscreen();
        }
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        }
    }
}
//EXAMINE FULL SCREEN END

//

$(document).on("click","div.bhoechie-tab-menu>div.list-group>a",function(e) {
    e.preventDefault();
    $(this).siblings('a.active').removeClass("active");
    $(this).addClass("active");
    var index = $(this).index();
    var tabNo = $(this).data('tab');
    
    $("div.bhoechie-tab-container>div.bhoechie-tab>div.bhoechie-tab-content.btcontent-template-tab"+tabNo+"").removeClass("active");
    $("div.bhoechie-tab-container>div.bhoechie-tab>div.bhoechie-tab-content.btcontent-template-tab"+tabNo+"").eq(index).addClass("active");
});


$(document).on("click",".btn-next-item",function(e) {
    e.preventDefault();
    var button = $(this);
    var nextTab = button.data('tabno');
    var spanNext = button.parent();
    var inputNumerOfItemsValue = $('div.btmenu-template'+nextTab+'>div.list-group > a').length;

    var resultInput = $('div.bhoechie-tab-container.template'+nextTab+' div.bhoechie-tab-content.active input[required]:checked').filter(function () {
        return $.trim($(this).val()).length == 0
      }).length == 0;
    var resultSelect = $('div.bhoechie-tab-container.template'+nextTab+' div.bhoechie-tab-content.active textarea[required]').filter(function () {
        return $.trim($(this).val()).length == 0
    }).length == 0;
    if(resultInput == true && resultSelect == true){
        var activeHeader =  $('div.btmenu-template'+nextTab+'>div.list-group > a.active');
        var activeContent = $('div.bhoechie-tab-container.template'+nextTab+' div.bhoechie-tab-content.active');
        activeHeader.children('h4').removeClass('glyphicon-tags');
        activeHeader.children('h4').addClass('glyphicon-check');
        
        if(parseInt(activeHeader.children('b').text()) < (inputNumerOfItemsValue)){
            
        
            activeHeader.removeClass('active');
            activeHeader.next().addClass('active');
            activeContent.removeClass('active');
            activeContent.next().addClass('active');
            
            //window.setInterval(function() {
            
            
            var elem = $('div.bhoechie-tab-container.template'+nextTab+' .bhoechie-tab-content.active');
        
            //}, 5000);
        }else{
           
            var contentTabHeader = $('ul > li.tab-examine');
            var contentTabHeaderActive = $('ul li.tab-examine.tabno'+nextTab+'.active');
            var contentTabContentActive = $('#tab-examine'+nextTab+'.active');
            if(contentTabHeader.length != nextTab){
             
                if((contentTabHeader.length-1) > (contentTabHeaderActive.index())){
                    contentTabHeaderActive.removeClass('in active');
                    contentTabContentActive.removeClass('in active');
                    contentTabHeaderActive.next().addClass('in active');
                    contentTabContentActive.next().addClass('in active');
                }else{
                    swal({
                        title: "Are you sure?",
                        text: "Do you want to submit your exam?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, submit it!",
                        cancelButtonText: "No, cancel plx!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                        },
                        function(isConfirm){
                        
                        if (isConfirm) {
                            var dataAnswers = [];
                            dataAnswers = {
                                'idquestionaire' : $('#input-idquestionaire').val()
                            }
                            for(i=0;i<contentTabHeader.length;i++){
                                dataAnswers[i] = [];
                                dataAnswers[i] = {};
                                var itemsCount = $('div.btmenu-template'+i+'>div.list-group > a').length;
                                for(j=0;j<itemsCount;j++){
                                    if($('.answer'+i+'-'+j+'').data('type') == 0){
                                        dataAnswers[i][j] = $('.answer'+i+'-'+j+':checked').val();
                                    }else{
                                        dataAnswers[i][j] = $('.answer'+i+'-'+j+'').val();
                                    }
                                    
                                    
                                    dataAnswers[i].idquestion = $('#input-idquestion-tabno'+i+'-'+j+'').val();
                                }
                            }
                            
                            
                            $.ajax({
                                url:'examinations/submitexamine',
                                data:{data:dataAnswers},
                                dataType:"json",
                                method:"POST",
                                success:function(data){
                                    if(data[1] == true){
                                        swal("success", "Your Examination Has Been Submitted.", "success");
                                        window.location.replace('examinations');
                                    }else{
                                        swal("Cancelled", "Error Delete Record.", "error");
                                    }
                                }
                                
                            });
                        } else {
                            swal("Cancelled", "Delete Canceled.", "error");
                        }
                    });
                }
                
             
            }
        }
    }else{
        swal("Cancelled", "Fill Up Fields.", "error");
        return false;
    }

});

// UPDATE QUESTIONNAIRE


$(document).on('submit','#frm-update-questionnaire',function(e){
    e.preventDefault();
    tinyMCE.triggerSave();
    if($('#tab-header li').length-1 <= 0){
        swal("Cancelled", "Add Question Item First.", "error");
        return false;
    }
    var examDate = new Date($('#questionnaire-add-day').val());
    var todayDate = new Date(Date.now());
    if(examDate < todayDate){
        swal("Date Should be greater that current date", "invalid Date Input", "error");
        return false;
    }
 
    swal({
        title: "Are you sure?",
        text: "Do you want to Update this record?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Update it!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false
        },
        function(isConfirm){
        if (isConfirm) {

            var tabPanelCount = $('#tab-header li').length-1;
            var inputTitle = $('#questionnaire-title').val();
            var inputDescription = $('#questionnaire-description').val();
            var inputDate = $('#questionnaire-day').val();
            var inputTime = $('#questionnaire-time').val();
            var inputDuration = $('#questionnaire-duration').val();
            var inputInstruction = $('#questionnaire-instruction').val();
            var inputIdSubject= $('#questionaire-idsubject').val();
            var inputIdQuestionnaire= $('#questionaire-idquestionnaire').val();
            
            var inputData = [];
            inputData = {
                    
                'data' : {

                    "questionaire_title": inputTitle,
                    "questionaire_description": inputDescription,
                    "questionaire_date": inputDate,
                    "questionaire_time": inputTime,
                    "questionaire_duration": inputDuration,
                    "questionaire_instruction": inputInstruction,
                    "idsubject":inputIdSubject,
                    "idquestionaire":inputIdQuestionnaire
                }
                
            };
          
            
            
            for(i=0;i<tabPanelCount;i++){
                var questionnaireTypeId = $('#questionnaire-type-idquestionairetype'+i+'').val();
                var itemsCount = $('div.bhoechie-tab-menu.template'+i+' a').length;
                var questionType = $('#tab-add-question'+i).data('questiontype');
                var categoryTitle = $('#category-title-tabNo'+i+'').val();
                var questionQuantity = $('#question-quantity-tabNo'+i+'').val();
                var itemPoints = $('#item-points-tabNo'+i+'').val();
                var itemQuantity = $('#item-quantity-tabNo'+i+'').val();
                var totalItem = $('#total-item-tabNo'+i+'').val();
                
                inputData[i] = [];                          
                
                inputData[i] = {
                    'data' : {
                        'idquestionairetype':questionnaireTypeId,
                        'questionaire_type_title': categoryTitle,
                        'questionaire_type': questionType,
                        'questionaire_type_question_quantity':questionQuantity,
                        'questionaire_type_item_points':itemPoints,
                        'questionaire_type_item_quantity':itemQuantity,
                        'questionaire_type_total_item':totalItem,
                    }
                };
                for(j=0;j<itemsCount;j++){
                    inputData[i][j] = [];
                    var question = tinymce.get("questionTabno"+i+"-itemno-"+j+"").getContent();
                    var idquestion = $('#question-idquestion'+i+'-'+j+'').val();
                    inputData[i][j] = {
                        "data":{
                            "idquestion":idquestion,
                            "question": question
                        }
                    }
                    if(questionType == 0){
                        var choicesCount = $('center#add-answer0-0 > div.input-group').length;
                        
                        for(k=0;k<choicesCount;k++){
                            inputData[i][j][k] = [];
                            inputData[i][j][k] = {
                                'choices_description':$('#choicesTabno-'+i+'-itemno-'+j+'-choicesno-'+k+'').val(),
                                'idchoices':$('#input-question-idchoices'+i+'-'+j+'-'+k+'').val()
                            }
                        }
                        var selectValue = $('#answerTabno-'+i+'-itemno-'+j+'-answerno-0').val();
                        var answer = $('#choicesTabno-'+i+'-itemno-'+j+'-choicesno-'+selectValue+'').val();
                        var idanswer = $('#input-question-idanswer'+i+'-'+j+'-0').val();
                        inputData[i][j].data.answer = answer;
                        inputData[i][j].data.idanswer = idanswer;

                    }else{
                        var answerCount = $('center#add-answer'+i+'-'+j+' div.add-answer > span.span-add-answer'+i+' > div.input-group').length
                        
                        for(k=0;k<answerCount;k++){
                            inputData[i][j][k] = [];
                            inputData[i][j][k] = {
                                "data":{
                                    'answer':$('#answerTabno-'+i+'-itemno-'+j+'-answerno-'+k+'').val(),
                                    'idanswer':$('#input-question-idanswer'+i+'-'+j+'-'+k+'').val()
                                }
                            }
                        }
                        
                    }


                }
            }
            
            $.ajax({
                url:"examinations/postUpdateQuestionnaire",
                data:{data:inputData},
                method:"POST",
                dataType:"json",
                success:function(data){
                    if(data[1] == true){
                        swal("success", "Record Added.", "success");   
                        window.location.replace('examinations/userquestionairelist/'+data[2]+'')
                        $('#mdl-classes-update').modal('hide');
                    }else{
                        swal("cancelled", data[0], "error");
                    }
                }
            });

        } else {
            swal("Cancelled", "Add Canceled.", "error");
        }
    });
});
// UPDATE QUESTIONNAIRE END

//btn-submit-approval
$(document).on('click','#btn-submit-approval',function(e){
    e.preventDefault();
    var btn = $(this);
    var id = btn.data('id');

    swal({
        title: "Are you sure?",
        text: "Approve this Questionnaire ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Approve it!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false
        },
        function(isConfirm){
        
        if (isConfirm) {
            
            $.ajax({
            url:'notifications/approvequestionnaire',
            data:{id:id},
            dataType:"json",
            method:"POST",
            success:function(data){
                if(data[1] == true){
                    window.location.replace('notifications');
                    
                }else{
                    swal("Cancelled", "Fail to Submit Approval.", "error");
                }
            }
        });
        } else {
            swal("Cancelled", "Canceled.", "error");
        }
    });
    
    
});
//btn-submit-approval

//__userSessionUserLevelData 