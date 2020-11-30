<body>
    <div class="wrapper">
        <div class="sidebar">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">
                        LOGO
                    </a>
                </div>
    
                <ul class="nav">
                    <li class="<?php echo ($menu == 'Dashboard')?'active':'';?>" id="">
                        <a href="<?php echo $siteurl;?>/Dashboard">
                            <i class="fa fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="<?php echo ($menu == 'Data')?'active':'';?>" id="">
                        <a href="<?php echo $siteurl;?>/Data">
                            <i class="fa fa-folder-open"></i>
                            <p>Data</p>
                        </a>
                    </li>
                    <li class="<?php echo ($menu == 'Master')?'active':'';?>" id="">
                        <a href="<?php echo $siteurl;?>/Master">
                            <i class="fa fa-tags"></i>
                            <p>Master</p>
                        </a>
                    </li>
                    <li class="active-pro">
                        <a href="">
                            <i class="fa fa-cogs"></i>
                            <p>Setting</p>
                        </a>
                    </li>
                </ul>
            </div>          
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default nabvar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- <a class="navbar-brand" href="#">Dashboard</a> -->
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                   
                                    <p class="hidden-lg hidden-md">Dashboard</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">      
                            <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <p>
                                            Administrator
                                        <b class="caret"></b>
                                        </p>
                                  </a>
                                  <ul class="dropdown-menu">
                                    <li><a href="#">Logout</a></li>
                                  </ul>
                            </li>
                            <li class="separator hidden-lg"></li>
                        </ul>
                    </div>
                </div>
            </nav>