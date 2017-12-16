
<div class="row">
    
        <div class="col-md-12">
             <ul class="nav nav-tabs tab-nav-right" role="tablist" style="margin-bottom:50px;">
                <li role="presentation" class="active" style="width:20%;">
                    <a href="#tab-professorlist" data-toggle="tab">
                        <i class="material-icons">account_circle</i>
                        <span>Professors</span>
                    </a>
                </li>
                <li role="presentation" style="width:20%;">
                    <a href="#tab-studentlist" data-toggle="tab">
                        <i class="material-icons">person_pin</i>
                        <span>Students</span>
                    </a>
                </li>
                <li role="presentation" style="width:20%;">
                    <a href="#import_users" data-toggle="tab">
                        <i class="material-icons">file_download</i>
                        <span>Import</span>
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="tab-professorlist">
                <button rel='tooltip' data-original-title='Add' class='pull-right btn-add-teacher btn btn-success' type='button' name='create' onclick='return false;'>
                    <i class='material-icons'>add</i>
                </button>
                    <table id="table-professorslist" class="table table-striped">        
                        <thead>
                            <tr>
                                <td class="text-center font-roboto color-a2">ID</td>
                                <td class="text-center font-roboto color-a2">CODE</td>
                                <td class="text-center font-roboto color-a2">NAME</td>
                                <td class="text-center font-roboto color-a2">POSITION</td>
                                <td class="text-center font-roboto color-a2">DEPARTMENT</td>
                                <td class="text-center font-roboto color-a2">ACTION</td>
                            </tr>
                        </thead>
                        <tbody class="professor-list-tablebody">
                            <?php
                                if($data[0]){
                                    foreach($data[0] as $u){
                                        
                                        $id = $u['idusers'];
                                        $code = $u['code'];
                                        $user = $u['user'];
                                        $firstname = $u['firstname'];
                                        $middlename = $u['middlename'];
                                        $lastname = $u['lastname'];
                                        $position = $u['position'];
                                        $department = $u['department_name'];
                                        $user_level = $u['user_level'];
                                        if($user_level == '2'){
                                            echo "
                                                <tr>  
                                                    <td class='text-center'>$id</td>
                                                    <td class='text-center'>$code</td>
                                                    <td class='text-center'>$lastname, $firstname $middlename</td>
                                                    <td class='text-center'>$position</td>
                                                    <td class='text-center'>$department</td>
                                                    <td class='text-center'>
                                                        <button data-id='$id' data-level='$user_level' rel='tooltip' data-original-title='Update' class='btn-update-user btn btn-info' type='button' name='update' onclick='return false;'>
                                                            <i class='material-icons'>create</i>
                                                        </button>
                                                        <button href='users/deleteuser' data-id='$id' rel='tooltip' data-original-title='Delete' class='btn-delete-user btn btn-danger' type='submit' name='deleteUser' onclick='return false;'>
                                                            <i class='material-icons'>delete</i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            ";
                                        }
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab-studentlist">
                    <div class="row">
                        <button rel='tooltip' data-original-title='Add' class='pull-right btn-add-student btn btn-success' type='button' name='create' onclick='return false;'>
                            <i class='material-icons'>add</i>
                        </button>
                        <table id="table-studentslist" class="table table-striped" style='width:100%;'>        
                            <thead>
                                <tr>
                                    <td class="text-center font-roboto color-a2">ID</td>
                                    <td class="text-center font-roboto color-a2">CODE</td>
                                    <td class="text-center font-roboto color-a2">NAME</td>
                                    <td class="text-center font-roboto color-a2">DEPARTMENT</td>
                                    <td class="text-center font-roboto color-a2">COURSE</td>
                                    <td class="text-center font-roboto color-a2">YEAR LEVEL</td>
                                    <td class="text-center font-roboto color-a2">ACTION</td>
                                </tr>
                            </thead>
                            <tbody class="student-list-tablebody">
                                <?php
                                    if($data[1]){
                                        foreach($data[1] as $u){
                                            $id = $u['idusers'];
                                            $code = $u['code'];
                                            $firstname = $u['firstname'];
                                            $middlename = $u['middlename'];
                                            $lastname = $u['lastname'];
                                            $department = $u['department_name'];
                                            $course = $u['course_name'];
                                            $user_level = $u['user_level'];
                                            $year_level = $u['year_level'];
                                            if($user_level == '1'){
                                                echo "
                                                    <tr>
                                                        <td class='text-center'>$id</td>
                                                        <td class='text-center'>$code</td>
                                                        <td class='text-center'>$lastname, $firstname $middlename</td>
                                                        <td class='text-center'>$department</td>
                                                        <td class='text-center'>$course</td>
                                                        <td class='text-center'>$year_level</td>
                                                        <td class='text-center'>
                                                            <button data-id='$id' data-level='$user_level' rel='tooltip' data-original-title='Update' class='btn-update-user btn btn-info' type='button' name='update' onclick='return false;'>
                                                                <i class='material-icons'>create</i>
                                                            </button>
                                                            <button href='users/deleteuser' data-id='$id' rel='tooltip' data-original-title='Delete' class='btn-delete-user btn btn-danger' type='submit' name='deleteUser' onclick='return false;'>
                                                                <i class='material-icons'>delete</i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                ";
                                            }
                                        }
                                    }
                                 ?>
                             </tbody>
                        </table>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="import_users">
                    <div class="row">
                        <pre>
                            student - code,user,firstname, middlename, lastname, course, year level,department
                            teacher - code,user,firstname, middlename, lastname, position,department
                        </pre>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;text-align:right;">User Level</div></span>
                            <select name="userfield" data-placeholder="Choose Fields.." class="chzn-select" required="required" id="select-user-imports">
                                <option value="1">Student<option>
                                <option value="2">Teacher<option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <label class="control-label"><h3><b>Import File</b></h3></label>
                        <input id="input-import-users" name="usersFile" type="file" multiple class="file-loading">
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="row">
  
</div>