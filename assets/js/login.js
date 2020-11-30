var siteurl = $("#txtsite").val();
var baseurl = $("#txtbase").val();
var table;

$(document).ready(function(){

  $('#loginForm').submit(function(){

      var user = $('#user').val();
      var pwd = $('#pwd').val();
      var postvars = {username:user,password:pwd};

      // $('#msg').html("<img src=\""+baseurl+"image/ajax-loader.gif\" width=\"40\" height=\"40\" alt=\"ajax-loader\" />");

      $.ajaxSetup({async:false});
      $.post(siteurl+'/Login/cekLogin',postvars,function(data){
          var arrHasil = new Array();
              arrHasil = eval(data);
              if(arrHasil[0]['msg']!=''){
                if(arrHasil[0]['msg']=="LOL"){
                  window.location.replace(siteurl+'/Login');
                }else{
                  $('#msg').html(arrHasil[0]['msg']);
                }
              }else{
                window.location.replace(siteurl+'/Dashboard');
              }
      });
      $.ajaxSetup({async:true});

  });
  $('#user').focus();
});

