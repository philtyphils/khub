var siteurl = $("#txtsite").val();
var baseurl = $("#txtbase").val();
var table;
var table2;


  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }


$(document).ready(function(){


    $('#datatables').DataTable({
        "processing":true,
        "ordering": false,
        "scrollX": true,
        "pageLength" : 5,
    });

    var dataTablex = $('#datatables').dataTable();
    $("#searchbox").keyup(function() {
        dataTablex.fnFilter(this.value);
    }); 

    $('.datepicker').datepicker();


    $('#delete-modal').on('show.bs.modal',function() { 
        $('.btn-del').click('.remove',function(e) {
            var id = $(".remove").attr("personal-id");       
            var param = {"id" : parseInt(id) }

            $.ajax({
                type: "POST",
                url: siteurl+"/Data/submit/delete",
                data: param,
                success: function(e){
                  window.location.href=siteurl+"/Data";
                },
                dataType: "JSON"
            });
        
        
            e.preventDefault();
        });
    });

    $("#kategori").on('hide.bs.select',function(option, checked){
        var param = {'kategori':$(this).val()};         
        $.ajax({
            url : siteurl+'/Data/selected_kategori/',
            type: "POST",
            data: param,
            dataType: "JSON",
            success: function(data)
            {
                $('#bidangusaha').html(data.html).removeClass("selectpicker").addClass("selectpicker").selectpicker('refresh');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log("ERROR: Contact IT Consultanct - Delapan");
            }
        });
    });

    $("#bidangusaha").on('hide.bs.select',function(option, checked){
        var param = {'bidangusaha':$(this).val()};         
        $.ajax({
            url : siteurl+'/Data/selected_bidangusaha/',
            type: "POST",
            data: param,
            dataType: "JSON",
            success: function(data)
            {
                $('#kategori').html(data.html).removeClass("selectpicker").addClass("selectpicker").selectpicker('refresh');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log("ERROR: Contact IT Consultanct - Delapan");
            }
        });
    });

    var timer;
    $('#Filt02').on('hide.bs.select',function(option, checked) {
        var param = {'provinsi':$(this).val()};  
            
        $.ajax({
            url : siteurl+'/Data/get_Kota/',
            type: "POST",
            data: param,
            dataType: "JSON",
            success: function(data)
            {
                $('#Filt03').html(data).removeClass("selectpicker").addClass("selectpicker").selectpicker('refresh');


                setkelas($("#Filt02").val());

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data'); 
            }
        });

       
    });
   
   $('#btnsearch').bind('click',function()
   {
      //$('#frmcari')[0].reset(); // reset form on modals
      $('.form-control').val('');
      $('.selectpicker').selectpicker('refresh');
      $('#myModal').modal('show'); // show bootstrap modal
           
   });

   $('#btnClear').click(function() {
    $('.form-control').val('');
    $('.selectpicker').selectpicker('refresh');
   });



    /* klik button export */
    $(".export-excel").click(function(e){
        var redirect = baseurl + "Export";
        var param   = {
            nm_perusahaan   : $("#Filt01").val(),
            provinsi        : $("#Filt02").val(),
            lokasi          : $("#Filt03").val(),
            wilayah_kerja   : $("#Filt04").val(),
            kategori        : $("#Filt05").val(),
            bidangusaha     : $("#Filt06").val(),
            dermagaType     : $("#Filt07").val(),
            kedalaman       : $("#Filt08").val(),
            kapasitas       : $("#Filt09").val(),
            ter_tuk         : $("#Filt10").val(),
            status          : $("#Filt11").val(),
            ms_berlaku      : $("#Filt12").val()
        };
        $.redirectPost(redirect, param);
     });
     /* klik button export CSV */
    $(".export-csv").click(function(e){
        var redirect = baseurl + "Export/csv";
        var target  = "_BLANK";
        var param   = {
            nm_perusahaan   : $("#Filt01").val(),
            provinsi        : $("#Filt02").val(),
            lokasi          : $("#Filt03").val(),
            wilayah_kerja   : $("#Filt04").val(),
            kategori        : $("#Filt05").val(),
            bidangusaha     : $("#Filt06").val(),
            dermagaType     : $("#Filt07").val(),
            kedalaman       : $("#Filt08").val(),
            kapasitas       : $("#Filt09").val(),
            ter_tuk         : $("#Filt10").val(),
            status          : $("#Filt11").val(),
            ms_berlaku      : $("#Filt12").val()
        };
        $.redirectPost(redirect, param, target);
     });

    


});





function setsearch()
{
      ///$('#frmcari')[0].reset(); // reset form on modals
    
      $('#myModal').modal('show'); // show bootstrap modal
         
    
};


function setkelas(id){

      var param = {'kota':id};
      $.ajax({
          url : siteurl+'/Data/get_Kelas/',
          type: "POST",
          data: param,
          dataType: "JSON",
          success: function(data)
          {
              $('#Filt04').html(data).removeClass("selectpicker").addClass("selectpicker").selectpicker('refresh');
              
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data'); 
          }
      });

}
