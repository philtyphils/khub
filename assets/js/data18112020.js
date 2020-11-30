var siteurl = $("#txtsite").val();
var baseurl = $("#txtbase").val();
var table;
var table2;

$(document).ready(function(){

table2 = $('#datatables2').DataTable({
          "scrollX": true,
          "iDisplayLength": 10,
          "responsive":false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
          "destroy":true,
          "order": [],
          "columnDefs": [
          { 
              "targets": [ -1 ], //last column
              "orderable": false, //set not orderable
          },
          ]
        });


    table = $('#datatables').dataTable({
        "responsive": false,
        "scrollX": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": siteurl+'/Data/ajax_list',
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ]
    });


    var dataTablex = $('#datatables').dataTable();
    $("#searchbox").keyup(function() {
        dataTablex.fnFilter(this.value);
    }); 


     // $('#provinsi').change(function(option, checked){

     //      var param = {'provinsi':$('[name="provinsi[]"]').val()};
     //      $.ajax({
     //          url : siteurl+'/Data/get_Kota/',
     //          type: "POST",
     //          data: param,
     //          dataType: "JSON",
     //          success: function(data)
     //          {
     //              $('#kota').html(data);
     //              $('#kota').selectpicker('refresh');

     //              setkelas($('[name="provinsi[]"]').val());
     //          },
     //          error: function (jqXHR, textStatus, errorThrown)
     //          {
     //              alert('Error get data'); 
     //          }
     //      });
     //  });

     $('#Filt02').change(function(option, checked){

          var param = {'provinsi':$('[name="provinsi[]"]').val()};
          $.ajax({
              url : siteurl+'/Data/get_Kota/',
              type: "POST",
              data: param,
              dataType: "JSON",
              success: function(data)
              {
                  $('#Filt03').html(data);
                  $('#Filt03').selectpicker('refresh');

                  setkelas($('[name="provinsi[]"]').val());
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error get data'); 
              }
          });
      });

     


    $('.datepicker').datepicker({
      format: "mm-yyyy",
      startView: "months",  
      minViewMode: "months"
    });


    $('#delete-modal').on('show.bs.modal',function() { 
        $('.btn-del').click('.remove',function(e) {
          $tr = $(this).closest('tr');
          table.row($tr).remove().draw();
          e.preventDefault();
        });
    });


    $('#btnCari').bind('click',function(){

      $('#isiData').empty();

      var gagal=0;
      var prm="";
      var isi="";
      var arrPerus = new Array();
      for(var i=1;i<=12;i++){
          var n = i.toString().trim();
          var len= n.length;
          if(len==2){
          var id=n;
          }else{
          var id='0'+n;
          }


          isi=$('#Filt'+id).val();
          prm=$('#Param'+id).val();
              arrPerus.push(id+"~"+prm+"~"+isi);
              var strPerus = arrPerus.join("|");

      }
      
      
      $.ajaxSetup({async: false});

          var postVar={'param':strPerus};
          $.post(siteurl+'/Data/getData',postVar,function (data) {
              $('#isiData').append(data);
              // $('body').removeClass('modal-open');
              //   $('.modal-backdrop').remove();
              $("#myModal").modal('hide');
          },"JSON");

      $.ajaxSetup({async:true});
    });


// $('#btnCari').bind('click',function(){

    
//  $.ajaxSetup({async: false});

//       var barisData = 0;
//       $("#isiData").html('');
//       isiantbl="";

//         var postvar = { name:$('#name').val(),
//                         provinsi:$('#provinsi').val(),
//                         kota:$('#kota').val(),
//                         kelas:$('#kelas').val(),
//                         kategori:$('#kategori').val(),
//                         bidangusaha:$('#bidangusaha').val(),
//                         dermaga:$('#dermaga').val(),
//                         meter:$('#meter').val(),
//                         kapasitas:$('#kapasitas').val(),
//                         tuk_ter:$('#tuk_ter').val(),
//                         status:$('#status').val(),
//                         tgl_akhir:$('#tgl_akhir').val()};
//         $.post(siteurl+"/Data/getData",postvar,function(dataxx){

//           var arrData = new Array();
//             arrData = eval(dataxx);


//             if(arrData.length > 0){

//                // isiantbl+="<table id='datatables2' class='table table-no-bordered table-hover' cellspacing='0' style='width:70%;font-size: 13px;'><thead style='color: #FFFFFF;font-weight: 600;font-size: 12px;'><tr role='row' style='background-color:#43425D;'><th>No</th><th>NAMA</th><th>ALAMAT</th><th>WILAYAH KERJA</th><th>BIDANG USAHA</th><th>KATEGORI</th><th>LOKASI</th><th>KOORDINAT</th><th>SPESIFIKASI</th><th>TERSUS / TUKS</th><th>LEGALITAS</th><th>TERBIT</th><th>STATUS</th><th>MASA BERLAKU</th><th class='disabled-sorting' style='width:50px'>ACTIONS</th></tr></thead><tbody>";

//               for(var j=0;j<arrData.length;j++){
//                 barisData++;
                
//                 isiantbl+="<tr role='row'>";
//                 isiantbl+="<td>"+barisData+"</td>";
//                 isiantbl+="<td>"+arrData[j]["nm_perusahaan"]+"</td>";
//                 isiantbl+="<td style='width:300px;'>"+arrData[j]["alamat"]+"</td>";
//                 isiantbl+="<td>"+arrData[j]["ksop_id"]+"</td>";
//                 isiantbl+="<td>"+arrData[j]["provinsi_id"]+"</td>";
//                 isiantbl+="<td>"+arrData[j]["bdgusaha_id"]+"</td>";
//                 isiantbl+="<td>"+arrData[j]["lokasi"]+"</td>";
//                 isiantbl+="<td>"+arrData[j]["kategori_id"]+"</td>";
//                 isiantbl+="<td>"+arrData[j]["koordinat"]+"</td>";
//                 isiantbl+="<td>"+arrData[j]["ter_tuk"]+"</td>";
//                 isiantbl+="<td>"+arrData[j]["sk"]+"</td>";
//                 isiantbl+="<td>"+arrData[j]["tgl_terbit"]+"</td>";
//                 isiantbl+="<td>"+arrData[j]["status"]+"</td>";
//                 isiantbl+="<td>"+arrData[j]["ms_berlaku"]+"</td>";
//                 isiantbl+="<td><a class='btn btn-simple btn-warning btn-icon btnedit' title='Ubah' onclick='edit_Datax("+arrData[j]['id']+")'><i class='fa fa-edit'></i></a><a class='btn btn-simple btn-danger btn-icon btndelete' title='Hapus' onclick='delete_Datax("+arrData[j]['id']+")'><i class='fa fa-times'></i></a></td></tr>";
                
//               }

//               // isiantbl+="</tbody></table>";

//               $("#isiData").html(isiantbl);
//                 $('#myModal').hide();
//                 $('body').removeClass('modal-open');
//                 $('.modal-backdrop').remove();
//             }else{
//               $("#isiData").html('');
//             }

//         });

//       $.ajaxSetup({async:true});
//     });


   $('#btnsearch').bind('click',function()
   {
      $('#frmcari')[0].reset(); // reset form on modals
      $('.selectpicker').selectpicker('refresh');
      $('#myModal').modal('show'); // show bootstrap modal
           
   });



});


function setsearch()
{
    alert(1);
      $('#frmcari')[0].reset(); // reset form on modals
    
      $('#myModal').modal('show'); // show bootstrap modal
         
    
};


// function setkelas(id){

//       var param = {'kota':id};
//       $.ajax({
//           url : siteurl+'/Data/get_Kelas/',
//           type: "POST",
//           data: param,
//           dataType: "JSON",
//           success: function(data)
//           {
//               $('#kelas').html(data);
//               $('#kelas').selectpicker('refresh');
//           },
//           error: function (jqXHR, textStatus, errorThrown)
//           {
//               alert('Error get data'); 
//           }
//       });

// }

function setkelas(id){

      var param = {'kota':id};
      $.ajax({
          url : siteurl+'/Data/get_Kelas/',
          type: "POST",
          data: param,
          dataType: "JSON",
          success: function(data)
          {
              $('#Filt04').html(data);
              $('#Filt04').selectpicker('refresh');
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data'); 
          }
      });

}
