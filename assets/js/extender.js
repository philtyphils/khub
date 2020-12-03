var siteurl = $("#txtsite").val();
var baseurl = $("#txtbase").val();

$("#yellow-notif").click(function(e){
 
    var redirect = baseurl + "Data";
    var target  = "_SELF";
    var param   = {
        trigger: true,
        YN  : "delapan.id - IT Konsultan"
    };
    $.redirectPost(redirect, param, target);
 });

$("#red-notif").click(function(e){
 
   var redirect = baseurl + "Data";
   var target  = "_SELF";
   var param   = {
       trigger: true,
       expired  : "delapan.id - IT Konsultan"
   };
   $.redirectPost(redirect, param, target);
});

/* Extender for posting Export Excel */
$.extend(
{
    redirectPost: function(location, args, target)
    {
        var form = '';
        $.each( args, function( key, value ) {
            //value = value.split('"').join('\"')
            form += '<input type="hidden" name="'+key+'" value="'+value+'">';
        });
        $('<form action="' + location + '" method="POST" target="'+target+'">' + form + '</form>').appendTo($(document.body)).submit();
    }

});