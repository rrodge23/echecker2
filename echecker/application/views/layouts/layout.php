
<?php
    $dashboard="";$subjects="";$users="";$reports="";$departments="";$examinations="";$courses="";$schedules="";$classes="";
    $m_subjects="";$m_users="";$m_reports="";$m_departments="";$m_courses="";$m_examination;$m_schedules="";$m_classes="";
    switch($_SESSION['users']['user_level']){
        case '1':
            $m_subjects="";
            $m_users="";
            $m_reports="";
            $m_departments="";
            $m_courses="";
            $m_examination="1";
            $m_schedules="";
            $m_classes="";
            break;
        case '2':
            $m_subjects="";
            $m_users="";
            $m_reports="1";
            $m_departments="";
            $m_courses="";
            $m_examination="1";
            $m_schedules="";
            $m_classes="";
            break;
        case '99':
            $m_subjects="1";
            $m_users="1";
            $m_reports="1";
            $m_departments="1";
            $m_courses="1";
            $m_examination="1";
            $m_schedules="1";
            $m_classes="1";
            break;
    };

    switch($currentPath){
        case 'dashboard':
            $dashboard='active';
            break;
        case 'subjects':
            $subjects='active';
            break;
        case 'users':
            $users='active';
            break;
        case 'reports':
            $reports='active';
            break;
        case 'departments':
            $departments='active';
            break; 
         case 'schedules':
            $schedules='active';
            break;   
        case 'courses':
            $courses='active';
            break;
        case 'examinations':
            $examinations='active';
            break;   
        case 'classes':
            $classes='active';
            break;   
        default:
    };
?>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebarbg.jpg" data-active-color="danger">

    	
            <div class="logo">
                <a href="dashboard" class="simple-text">
                    e Checker
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    
                    <li class="<?=$dashboard?>">
                        <a href="dashboard">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <?php
                    if($m_subjects == '1'){
                    
                    echo '<li class="'.$subjects.'">
                            <a href="subjects">
                                <i class="material-icons">subject</i>
                                <p>Subjects</p>
                            </a>
                        </li>';

                        }
            
                    if($m_schedules == '1'){
                    echo '<li class="'.$schedules.'">
                                <a href="schedules">
                                    <i class="material-icons">schedule</i>
                                    <p>Schedules</p>
                                </a>
                            </li>';
                        }
                
                        
                    if($m_departments == '1'){
                        echo '<li class="'.$departments.'">
                                    <a href="departments">
                                        <i class="material-icons">view_quilt</i>
                                        <p>Departments</p>
                                    </a>
                                </li>';
                    }
                    
                
                    if($m_courses == '1'){
                        echo '<li class="'.$courses.'">
                                <a href="courses">
                                    <i class="material-icons">book</i>
                                    <p>Courses</p>
                                </a>
                            </li>';
                    }
                    
                    if($m_classes == '1'){
                        echo '<li class="'.$classes.'">
                                <a href="classes">
                                    <i class="material-icons">apps</i>
                                    <p>Classes</p>
                                </a>
                            </li>';
                    }

                    if($m_examination == '1'){
                        
                        echo '<li class="'.$examinations.'">
                                    <a href="examinations">
                                        <i class="material-icons">library_books</i>
                                        <p>Examination</p>
                                    </a>
                                </li>';
                    }

                    if($m_users == '1'){
                        echo '<li class="'.$users.'">
                                    <a href="users">
                                        <i class="material-icons">account_box</i>
                                        <p>Users</p>
                                    </a>
                                </li>';
                    }

                    if($m_reports == '1'){
                        
                        echo '<li class="'.$reports.'">
                                    <a href="reports">
                                        <i class="material-icons">history</i>
                                        <p>Reports</p>
                                    </a>
                                </li>';
                    }
                
                    ?>
                </ul>
    	    </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-transparent navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#"><?=ucwords($currentPath);?></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="dashboard" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="material-icons">dashboard</i>
                                <p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="material-icons">person_pin</i>
								<p><?=$_SESSION['users']['user'];?></p>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="material-icons">settings</i>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="logout/changepassword"><i class="material-icons">autorenew</i>Change Password</a>
                                </li>
                                <li>
                                    <a href="logout"><i class="material-icons">exit_to_app</i>Logout</a>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                    <form class="navbar-form navbar-right" role="search">
                        <div class="form-group  is-empty">
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="material-input"></span>
                        </div>
                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">