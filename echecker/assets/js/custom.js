$(document).ready(function(){

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
        alert(data.response);
    });
    //********* FILEINPUT END
    
    //********* ADD USER SUBJECT KANBAN

   function kanbanAddUserSubject(id){
    
    var url = '';
    if(id == 1){
        url = 'subjects/getAllSubjectList';
    }else if (id == 2){
        url = 'subjects/getAvailableSubjects';
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
                kanbanAddUserSubject(1);
                // END KANBAN
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
        subjectDataList.forEach(function(data){
            if(data.status == "subjectsList"){
                getClassSubjects.push(data.id);
            }
        });
        $('.input-class-subjectList').val(getClassSubjects);

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
                        kanbanUpdateUserSubject(id);
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
    alert('hide.bs.dropdown');
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

    //
    //LIST BOX
    //
    var testNo = "";
    var answerCaseInput = 0;

    var data = new Array();
    var firstNames = ["asdf"];
    var lastNames = ["fda"];
    var titles = ["fda"];
    var titleofcourtesy = ["dfsa"];
    var birthdate = ["fdf"];
    var hiredate = ["dfd"];
    var address = ["sdf"];
    var city = ["fdf"];
    var postalcode = ["sdf"];
    var country = ["sf"];
    var homephone = ["sdfs"];
    var notes = ["sdfsdf"];
    
    var updatePanel = function (index) {
        var container = $('<div style="margin: 5px;"></div>');
        var questionHtmlString = '<div class="input-group">'
                                    +'<span class="input-group-addon" id="basic-addon1">Question:</span>'
                                    +'<input type="text" style="border-bottom:1px solid black;" class="form-control use mytextarea" placeholder="" aria-describedby="basic-addon1" required="required" id="" name="question_no_'+index+'" data-testno="'+testNo+'">'
                                +'</div>';
        var question = $(questionHtmlString);
        var answerList = "";
        for(i=0;i<answerCaseInput;i++){
            answerList += '<div class="input-group">'
                                +'<span class="input-group-addon" id="basic-addon1">Answer no'+(i+1)+'</span>'
                                +'<input type="text" class="form-control use" placeholder="Enter Answer Choices '+i+'" aria-describedby="basic-addon1" required="required" id="'+testNo+'_'+index+'_'+i+'" name="'+testNo+'_'+index+'_'+i+'" data-testno="'+testNo+'">'
                            +'</div>';
        }
        container.append(question);
        container.append(answerList);
        $(".ContentPanel").html(container.html());
    }
    //********  POST UPDATE CLASSES END*/
    //listBoxInit();
    // LIST BOX FUNCTION
    function listBoxInit(){
        if(__userSessionUserLevelData == ("2") && __currentPath == 'examinations/addQuestionaire'){
            $(".splitter").jqxSplitter({  width: '100%', height: 900, panels: [{ size: '11%'}] });
            // prepare the data
            
            var k = 0;
            for (var i = 0; i < firstNames.length; i++) {
                var row = {};
                row["firstname"] = firstNames[k];
                row["lastname"] = lastNames[k];
                row["title"] = titles[k];
                row["titleofcourtesy"] = titleofcourtesy[k];
                row["birthdate"] = birthdate[k];
                row["hiredate"] = hiredate[k];
                row["address"] = address[k];
                row["city"] = city[k];
                row["postalcode"] = postalcode[k];
                row["country"] = country[k];
                row["homephone"] = homephone[k];
                row["notes"] = notes[k];
                data[i] = row;
                k++;
            }
            var source =
            {
                localdata: data,
                datatype: "array"
            };
            var dataAdapter = new $.jqx.dataAdapter(source);

            // Create jqxListBox
            $('.listbox').jqxListBox({ selectedIndex: 0,  source: dataAdapter, displayMember: "firstname", valueMember: "notes", itemHeight: 80, height: '100%', width: '100%',
                renderer: function (index, label, value) {
                    var datarecord = data[index];
                    var imgurl = '';
                    var img = '<span><i style="margin:0 auto;">Question no : '+(index+1)+'<i></span>';
                    var table = '<table><tr><td style="width: 40px;" rowspan="2">' + img + '</td><td></td></tr><tr><td></td></tr></table>';
                    return table;
                }
            });
           
            updatePanel(0);
            tinymce.init({
                    selector: '.mytextarea'
            });
        }
    }
    // LIST BOX FUNCTION END
    

    //********  ADD QUESTIONAIRE TYPE */
    
    $(document).on('click','.btn-add-question-type',function(e){
        e.preventDefault();
        var inputType= document.getElementById('select-question-type-input');
        var inputTitle = document.getElementById('category-title-input');
        var inputAnswerQuantity = document.getElementById('questionaire-case-input');
        var inputNumberOfPoints = document.getElementById('number-of-points-input');
        var inputNumerOfItems = document.getElementById('number-of-items-input');
        var inputTypeText = $('#select-question-type-input option:selected').text();
        var inputAnswerQuantityValue = inputAnswerQuantity.value;
        var inputTitleValue = inputTitle.value;
        var inputNumberOfPointsValue = inputNumberOfPoints.value;
        var inputNumerOfItemsValue = inputNumerOfItems.value;
        var panelQuantity = $('#tab-header > li').length;
        
        if( inputAnswerQuantityValue == ""){
            swal("Cancelled", "Fill Up Fields.", "error");
            return false;
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
        var tabHeader = '<li role="presentation" class="" style="width:20%;" data-id="'+nextTab+'">'
                            +'<a href="#tab-add-question'+nextTab+'" data-toggle="tab">'
                                +'<span class="">'+inputTitleValue+' - '+inputTypeText+'</span>'
                            +'</a>'
                        +'</li>';
        var tabContent = '<div role="tabpanel" class="tab-pane fade" id="tab-add-question'+nextTab+'" data-id="'+nextTab+'">'+nextTab
                            +'<div class="splitter">'
                                +'<div style="overflow: hidden;">'
                                    +'<div style="border: none;" class="listbox">'
                                    +'</div>'
                                +'</div>'
                                +'<div style="overflow: hidden;" class="ContentPanel">'
                                +'</div>'
                            +'</div>'
                        +'</div>';
        // create the tab
        $(tabHeader).appendTo('#tab-header');
        
        // create the tab content
        $(tabContent).appendTo('#tab-content');

        answerCaseInput = inputAnswerQuantityValue;
        testNo = (nextTab+1);
        // make the new tab active
        $('#select-question-type-input').val("0");
        $('#questionaire-case-input').val("");
        $('#category-title-input').val("");
        $('#number-of-points-input').val("");
        $('#number-of-items-input').val("");
        $('#total-points-input').val("");
        $('#tab-header a:last').tab('show');
        
        listBoxInit();
        
    });
    
    $(document).on('focusout', '#number-of-items-input', function(e){
        e.preventDefault();
        var inputNumberOfPoints = $('#number-of-points-input').val();
        var inputNumberOfPointsValue = $('#number-of-items-input').val();
        $('#total-points-input').val((inputNumberOfPoints*inputNumberOfPointsValue));
        
    });

    $(document).on('change', '#select-question-type-input', function(e){
        e.preventDefault();
        var selectDropdown = $(this);
        var spanAnswerCase = $('span#span-answer-case-method');
        
        if(selectDropdown.val() == 0){
            spanAnswerCase.text('Question Quantity');
            $('#questionaire-case-input').attr('placeholder','Enter Number of Answer Question');
        }else{
            spanAnswerCase.text('Answer Quantity');
            $('#questionaire-case-input').attr('placeholder','Enter number of answers per Item');
            
        }
        
    });
    // add questionnaire type end
});