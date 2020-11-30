
            <div class="contents">
                <div class="container-fluid">
                    <div class="row">
                        <h2 class="title"></h2>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header-master">
                                    <div class="header">
                                        <h4 class="title">TUKS & TERSUS DATATABLE</h4>
                                        <p class="category" style="color: #AAAAAA; font-weight: 300;">REKAPITULASI TERSUS & TUKS DATATABLE </p>
                                    </div>
                                    <span class="fa fa-folder-open"></span>
                                </div>
                                <div class="card-content" style="padding-top: 60px;">
                                    <div class="warp-toolbar">
                                        <form action="" class="search">
                                            <input type="text" id="searchbox" placeholder="Silahkan cari data disini..." class="searchbutton">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </form>
                                    </div>
                                   
                                    <div class="wrap-toolbar col-md-6">
                                        <button type="button" id="btnsearch" class="btn btn-success btn-fill" style="margin-right: 1rem">
                                            <i class="fa fa-search" aria-hidden="true" style="margin-right: 10px;"></i>
                                            <span>Cari Data</span>
                                        </button>
                                    </div>

                                    <div class="toolbar col-md-12" style="padding: 0;">
                                       
                                    <h4 style="font-weight: 400;color: #AAAAAA;letter-spacing: 2px;font-size: 20px;margin-top: 2rem;">TOTAL : 80000</h4>
                                    <div class="wrap-toolbar" style="margin: 0;">
                                        <a href="<?php echo $baseurl;?>Form" class="btn btn-success btn-fill" style="margin-right: 1rem;">
                                            <i class="fa fa-plus"></i>
                                            <span>Buat Data Baru</span>  
                                        </a>
                                        <a href="" class="btn btn-info btn-fill">
                                            <i class="fa fa-download"></i>
                                            <span>Export Data Excel</span>   
                                        </a>
                                        
                                        <a href="" class="btn btn-default btn-fill">
                                            <i class="fa fa-globe"></i>
                                            <span>Export Data CSV To Map</span>   
                                        </a>  
                                    </div>
                                    </div>
                                   

                                    <div class="material-datatables">

                                            
                                        <table id="datatables" class="table table-responsive  table-no-bordered table-hover" cellspacing="0" width="100%" style="font-size: 13px;">
                                            <thead style="color: #FFFFFF;font-weight: 600;font-size: 12px;">
                                                <tr role="row" style="background-color:#43425D;">
                                                    <th>No</th>
                                                    <th>NAMA</th>
                                                    <th>ALAMAT</th>
                                                    <th>WILAYAH KERJA</th>
                                                    <th>BIDANG USAHA</th>
                                                    <th>KATEGORI</th>
                                                    <th>LOKASI</th>
                                                    <th>KOORDINAT</th>
                                                    <th>SPESIFIKASI</th>
                                                    <th>TERSUS / TUKS</th>
                                                    <th>LEGALITAS</th>
                                                    <th>TERBIT</th>
                                                    <th>STATUS</th>
                                                    <th>MASA BERLAKU</th>
                                                    <th class="disabled-sorting" style="width:50px">ACTIONS</th>
                                                </tr>
                                            </thead>
                                            <tbody id="isiData">

                                            </tbody>
                                        </table>

                                        
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<!-- MODAL DELETE-->
        <div class="modal fade" id="delete-modal" role="dialog">
            <div class="modal-dialog">
                <!--modal delete content start-->
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #43425D;color: #ffff;">
                        <button type="button" class="close" data-dismiss="modal" style="color: #ffff;outline: none;opacity: 1;">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h5>Apakah anda nyakin akan Delete ?</h5>
                    </div>
                    <div class="modal-footer" style="border-top: none;">
                        <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Cancel</button>
                        <button id="del-alert" class="btn btn-danger btn-fill btn-del remove">Delete</button>
                    </div>
                </div>
                <!--modal delete content end-->
            </div>
        </div>
<!-- MODAL DELETE-->



<!-- MODAL SEARCH-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header" style="background-color: #43425D;color: #ffff;">
                <button type="button" class="close" data-dismiss="modal" style="color: #ffff;outline: none;opacity: 1;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 50px;">
                <h5 class="title-form">Cari Data</h5>
 
                <form role="form" id="frmcari">
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="name">Nama Perusahaan</label>
                            <input id="Param01" value="nm_perusahaan"  type="hidden">
                            <input type="text" name="name" id="Filt01" placeholder="Nama Perusahaan" class="form-control">  
                            <!-- <input type="text" name="name" id="name" placeholder="Nama Perusahaan" class="form-control"> -->
                        </div>
                    </div>

                  <div class="row">
                    <div class="form-group col-md-4" style="margin-bottom: 1rem;">
                        <label for="provinsi">Provinsi</label>
                        <input id="Param02" value="provinsi_id"  type="hidden">
                        <select name="provinsi[]" class="form-control selectpicker" id="Filt02" data-live-search="true" required >
                        <!-- <select name="provinsi[]" class="form-control selectpicker" id="provinsi" data-live-search="true" required > -->
                            <option value="">Pilih Provinsi</option>
                            <?php for($i=0;$i<count($dataProvinsi);$i++){?>
                                <option value="<?php echo trim($dataProvinsi[$i]->kode); ?>"><?php echo $dataProvinsi[$i]->nama; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-4" style="margin-bottom: 1rem;">
                        <label for="kota">Kabupaten / Kota</label>
                        <input id="Param03" value="lokasi"  type="hidden">
                        <select name="kota[]" class="form-control selectpicker" id="Filt03" data-live-search="true" required >
                        <!-- <select name="kota[]" class="form-control selectpicker" id="kota" data-live-search="true" required > -->
                            <option value="">Pilih Kabupaten / Kota</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4" style="margin-bottom: 1rem;">
                        <label for="kelas">Wilayah Kerja</label>
                        <input id="Param04" value="ksop_id"  type="hidden">
                        <select name="kelas[]" class="form-control" id="Filt04" required>
                        <!-- <select name="kelas[]" class="form-control" id="kelas" required> -->
                           <option value="">Pilih Wilayah Kerja</option>
                        </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-4" style="margin-bottom: 1rem;">
                        <label for="kategori">Kategori</label>
                        <input id="Param05" value="kategori_id"  type="hidden">
                        <select class="selectpicker form-control" multiple data-live-search="true" title="Kategori" name="kategori" id="Filt05">
                        <!-- <select class="selectpicker form-control" multiple data-live-search="true" title="Kategori" name="kategori" id="kategori"> -->
                                <option value="">Pilih Kategori</option>
                                <?php for($j=0;$j<count($dataKateg);$j++){?>
                                    <option value="<?php echo trim($dataKateg[$j]->kategori_id); ?>"><?php echo $dataKateg[$j]->nama; ?></option>
                                <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4" style="margin-bottom: 1rem;">
                        <label for="bidangusaha">Bidang Usaha</label>
                        <input id="Param06" value="bdgusaha_id"  type="hidden">
                        <select class="selectpicker form-control" multiple data-live-search="true" title="Bidang Usaha" name="bidangusaha" id="Filt06">
                        <!-- <select class="selectpicker form-control" multiple data-live-search="true" title="Bidang Usaha" name="bidangusaha" id="bidangusaha"> -->
                                <option value="">Pilih Bidang Usaha</option>
                                <?php for($k=0;$k<count($dataBdgUsaha);$k++){?>
                                    <option value="<?php echo trim($dataBdgUsaha[$k]->bdg_usaha_id); ?>"><?php echo $dataBdgUsaha[$k]->nama; ?></option>
                                <?php } ?>
                        </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-4" style="margin-bottom: 1rem;">
                        <label for="dermaga">Type Dermaga</label>
                        <input id="Param07" value="spesifikasi"  type="hidden">
                        <select class="selectpicker form-control" multiple data-live-search="true" title="Type Dermaga" id="Filt07">
                        <!-- <select class="selectpicker form-control" multiple data-live-search="true" title="Type Dermaga" id="dermaga"> -->
                            <option value="">Pilih Dermaga</option>
                            <option>DERMAGA I TIPE MARGINAL</option>
                            <option>DERMAGA TIPE FINGER</option>
                            <option>DERMAGA TIPE JETTY HEAD</option>
                            <option>DERMAGA A TIPE JETTY</option>
                            <option>DERMAGA TIPE CONVENTIONAL BUOY MOORING (CBM)</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4" style="margin-bottom: 1rem;">
                        <label for="kedalaman">Kedalaman</label>
                        <input id="Param08" value="spek_kedalaman"  type="hidden">
                        <div class="input-group">
                            <input type="number" name="meter" id="Filt08" class="form-control" required placeholder="Meter" aria-describedby="basic-addon1">
                            <!-- <input type="number" name="meter" id="meter" class="form-control" required placeholder="Meter" aria-describedby="basic-addon1"> -->
                            <span class="input-group-addon" id="basic-addon1">M LWS</span>
                        </div>                                                       
                    </div>
                    <div class="col-md-4" style="margin-bottom: 1rem;">
                        <label for="kapasitas">Kapasitas</label>
                        <input id="Param09" value="spek_kapasitas"  type="hidden">
                        <input type="number" name="kapasitas" id="Filt09" class="form-control" required placeholder="Kapasitas">
                        <!-- <input type="number" name="kapasitas" id="kapasitas" class="form-control" required placeholder="Kapasitas"> -->
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-4">
                        <label for="tukstersus">TUKS /  TERSUS</label>
                        <input id="Param10" value="ter_tuk"  type="hidden">
                        <select class="selectpicker form-control" id="Filt10" name="tuk_ter">
                        <!-- <select class="selectpicker form-control" id="tuk_ter" name="tuk_ter"> -->
                            <option value="">Pilih TUKS / TERSUS</option>
                            <option value="TUKS">TUKS</option>
                            <option value="TERSUS">TERSUS</option>
                        </select>                       
                    </div>
                    <div class="form-group col-md-4">
                        <label for="status">STATUS</label>
                        <input id="Param11" value="status"  type="hidden">
                        <select class="selectpicker form-control" id="Filt11" name="status">
                        <!-- <select class="selectpicker form-control" id="status" name="status"> -->
                            <option value="">Pilih Status</option>
                            <option value="Y">AKTIF</option>
                            <option value="N">NON AKTIF</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="akhir">Masa Berlaku</label>
                        <input id="Param12" value="tglakhir"  type="hidden">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                            <input placeholder="Masa Berlaku" type="text" class="form-control datepicker" id="Filt12" name="tgl_akhir" autocomplete="off">
                            <!-- <input placeholder="Masa Berlaku" type="text" class="form-control datepicker" id="tgl_akhir" name="tgl_akhir" autocomplete="off"> -->
                        </div>
                    </div>
                  </div>
              </form>

                    <button id="btnCari" type="button" class="btn btn-success btn-fill">Cari Data</button>
            
            </div>
        </div>
    </div>
</div>
<!-- MODAL SEARCH-->

<!-- MODAL SEARCH-->
<div class="modal fade" id="myModalLain" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #43425D;color: #ffff;">
                <button type="button" class="close" data-dismiss="modal" style="color: #ffff;outline: none;">&times;</button>
            </div>
            <div class="modal-body">
                <h5 class="title-form">Cari Data Berdasarkan Dermaga</h5>
                <form  role="search">
                    <div class="form-group col-md-12" style="padding-left: 0;margin-bottom: 1rem;">
                        <label for="dermaga">Dermaga Tipe</label>
                        <input type="text" name="dermaga" id="dermaga" class="form-control" required placeholder="Dermaga Type">
                    </div>
                    <div class="form-group col-md-6" style="padding-left: 0;margin-bottom: 1rem;">
                        <label for="kedalaman">Kedalaman</label>
                        <div class="input-group">
                            <input type="number" name="meter[]" id="meter" class="form-control" required placeholder="Meter" aria-describedby="basic-addon1">
                            <span class="input-group-addon" id="basic-addon1">M LWH</span>
                        </div>  
                    </div>
                    <div class="form-group col-md-6" style="padding-left: 0;margin-bottom: 1rem;">
                        <label for="kapasitas">Kapasitas</label>
                        <input type="number" name="dermaga" id="kapasitas" class="form-control" required placeholder="Kapasitas">
                    </div>
                    
                    <div class="form-group col-md-12" style="padding-left: 0;margin-bottom: 1rem;">
                        <label for="satuan">Satuan</label>
                        <select class="form-control" id="satuan" name="satuan[]" required>
                            <option value="">Pilih Satuan</option>
                            <option>FIT</option>
                            <option>GT</option>
                            <option>DWT</option>
                        </select>                      
                    </div>
                    <button type="submit" class="btn btn-success btn-fill">Cari Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- MODAL SEARCH-->

</body>


<script src="<?php echo $baseurl;?>assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo $baseurl;?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $baseurl;?>assets/js/light-bootstrap-dashboard.js"></script>
<script src="<?php echo $baseurl;?>assets/js/bootstrap-select.min.js"></script>
<script src="<?php echo $baseurl;?>assets/js/jquery.datatables.js"></script>
<script src="<?php echo $baseurl;?>assets/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="<?php echo $baseurl;?>assets/js/data.js?v=<?php echo uniqid(); ?>"></script> 
<!-- 
<script type="text/javascript">
var siteurl = $("#txtsite").val();
var baseurl = $("#txtbase").val();
var table;

$(document).ready(function(){

    table = $('#datatables').DataTable({
        "responsive": false,
        "scrollX": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "pagingType": "full_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
 
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
        ],
        "createdRow": function( row, data, dataIndex){
                if( data[2] ==  `someVal`){
                    $(row).addClass('redClass');
                }
            }
    });
        var dataTable = $('#datatables').dataTable();
            $("#searchbox").keyup(function() {
                dataTable.fnFilter(this.value);
            }); 
        });


     $('#provinsi').change(function(option, checked){

          var param = {'provinsi':$('[name="provinsi[]"]').val()};
          $.ajax({
              url : siteurl+'/Data/get_Kota/',
              type: "POST",
              data: param,
              dataType: "JSON",
              success: function(data)
              {
                  $('#kota').html(data);
                  $('#kota').selectpicker('refresh');

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

   $('select').selectpicker();


    $('#delete-modal').on('show.bs.modal',function() { 
       $('.btn-del').click('.remove',function(e) {
          $tr = $(this).closest('tr');
          table.row($tr).remove().draw();
          e.preventDefault();
       });

$('#btnCari').bind('click',function(){
      alert(1)
      $.ajaxSetup({async:false});
        var postvar = { name:$('#name').val(),
                        provinsi:$('#provinsi').val(),
                        kota:$('#kota').val(),
                        kelas:$('#kelas').val(),
                        kategori:$('#kategori').val(),
                        bidangusaha:$('#bidangusaha').val(),
                        dermaga:$('#dermaga').val(),
                        meter:$('#meter').val(),
                        kapasitas:$('#kapasitas').val(),
                        tuk_ter:$('#tuk_ter').val(),
                        status:$('#status').val(),
                        tgl_akhir:$('#tgl_akhir').val()};
        $.post(siteurl+"/Data/getData",postvar,function(data){
          var arrData = new Array();
            arrData = eval(data);

            alert(arrData[0]["html"]);
            $("#isiData").html(arrData[0]["html"]);
            $('#myModal').hide();
        });
      $.ajaxSetup({async:true});
    });

    

    
});



function setkelas(id){

          var param = {'kota':id};
          $.ajax({
              url : siteurl+'/Data/get_Kelas/',
              type: "POST",
              data: param,
              dataType: "JSON",
              success: function(data)
              {
                  $('#kelas').html(data);
                  $('#kelas').selectpicker('refresh');
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error get data'); 
              }
          });

}

</script> -->

</html>
