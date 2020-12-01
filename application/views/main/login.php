<?php
  header("Cache-Control: no-cache, must-revalidate");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $baseurl;?>assets/sass/main.css">
    <link href="<?php echo $baseurl;?>assets/css/font-awesome.css" rel="stylesheet" />
    <link href="<?php echo $baseurl;?>assets/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="<?php echo $baseurl;?>assets/css/google-roboto-300-700.css" rel="stylesheet" />
    <link href="<?php echo $baseurl;?>assets/img/logo-icon.png" rel="icon" >

</head>
<body>
<input type="hidden" id="txtsite" value="<?php echo $siteurl;?>" />
<input type="hidden" id="txtbase" value="<?php echo $baseurl;?>" />
    <div class="main-panel">
        <div class="page-holder">
            <div class="container" style="padding: 50px;">
                <div class="row" style="display: flex;align-items: center;flex-wrap: wrap;">
                    <div class="col-5 col-lg-7 mx-auto mb-5 mb-lg-0">
                      <div class="pr-lg-5"><img src="<?php echo $baseurl;?>assets/img/illustration.svg" alt="" class="img-fluid"></div>
                    </div>
                    <div class="col-lg-5 px-lg-4">
                      <h1 class="title-h1">Selamat Datang</h1>
                      <p class="text-muted">Database Terminal Khusus & Terminal Untuk Kepentingan Sendiri</p>

                      <form id="loginForm" method="post" action="<?= base_url('Login/ceklogin'); ?>" name="loginForm" style="margin-top: 3rem;">
                        <div class="form-group mb-4">
                          <input type="text" id="user" name="username" placeholder="Username or Email address" class="form-control" autofocus>
                        </div>
                        <div class="form-group mb-4">
                          <input type="password" id="pwd" name="passowrd" placeholder="Password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-fill btn-primary">Log in</button>
                      
                      </form>
                        <div id="msg">
                    </div>
                  </div>
            </div>
           
        </div>
    </div>
    
</body>



<script src="<?php echo $baseurl;?>assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>


<!-- <script type="text/javascript" src="<?php echo $baseurl;?>assets/js/login.js?v=<?php echo uniqid(); ?>"></script>  -->

<script type="text/javascript">

$(document).ready(function(){ 
  var baseurl = $("#txtbase").val();
  var siteurl = $("#txtsite").val();

  $('#loginForm').submit(function(e){
$.ajaxSetup({async:false});
      var user = $('#user').val();
      var pwd = $('#pwd').val();
      var postvars = {username:user,password:pwd};

      // $('#msg').html("<img src=\""+baseurl+"images/ajax-loader.gif\" width=\"40\" height=\"40\" alt=\"ajax-loader\" />");
      
      $.post(baseurl+'/Login/cekLogin/',postvars,function(data){
          var arrHasil = new Array();
              arrHasil = eval(data);
              if(arrHasil[0]['msg']!=''){
                if(arrHasil[0]['msg']=="LOL"){
                  window.location.replace(siteurl+'/Login');
                  e.preventDefault();
                }else{
                  $('#msg').html(arrHasil[0]['msg']);
                }
              }else{
                window.location.replace(siteurl+'/Data');
                e.preventDefault();
              }
      });
      $.ajaxSetup({async:true});
    
  });
  $('#user').focus();
});

</script>
</html>
