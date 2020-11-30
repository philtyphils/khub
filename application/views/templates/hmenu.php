<div class="wrapper">
        <div class="sidebar">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">
                        <img src="<?php echo $baseurl;?>assets/img/logo.png" alt="logo" style="width: 100%;">
                    </a>
                </div>
    
                <ul class="nav">
                    <li class="<?php echo ($menu == 'Dashboard')?'active':'';?>" id="">
                        <a href="<?php echo $baseurl;?>Dashboard">
                            <i class="fa fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="<?php echo ($menu == 'Data')?'active':'';?>" id="">
                        <a href="<?php echo $baseurl;?>Data">
                            <i class="fa fa-folder-open"></i>
                            <p>Data</p>
                        </a>
                    </li>
                    <li class="<?php echo ($menu == 'Master')?'active':'';?>" id="">
                        <a href="<?php echo $baseurl;?>Master">
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
                    </div>

                    <div class="collapse navbar-collapse">
                       
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                    <span class="notification">4</span>
                                      <p class="hidden-md hidden-lg">
                                      Message
                                      <b class="caret"></b>
                                      </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="masaberlaku.html">Notification 1</a></li>
                                    <li><a href="masaberlaku.html">Notification 2</a></li>
                                    <li><a href="masaberlaku.html">Notification 3</a></li>
                                    <li><a href="masaberlaku.html">Notification 4</a></li>
                                </ul>
                            </li>      
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