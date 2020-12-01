
            <div class="contents">
                <div class="container-fluid">

                            <div class="row">
                                <div class="col-md-12" style="padding: 0;">
                                    <div class="col-md-4">
                                        <div class="card-chart">
                                            <div class="header" style="padding: 0 15px;">
                                            <h4 class="title">TERSUS</h4>
                                            <p class="category" style="color: #AAAAAA; font-weight: 300;font-size:1.2rem;">Jumlah Total TERSUS semua Provinsi</p>
                                            </div>
                                            <div id="container-pie3"></div>  
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card-chart">
                                            <div class="header" style="padding: 0 15px;">
                                            <h4 class="title">TUKS</h4>
                                            <p class="category" style="color: #AAAAAA; font-weight: 300;font-size:1.2rem;">Jumlah Total TUKS semua Provinsi</p>
                                            </div>
                                            <div id="container-pie4"></div>  
                                        </div>
                                    </div>
                                </div>   
                            </div>  

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header-master">
                                    <div class="header">
                                        <h4 class="title">TERSUS & TUKS DATA TABLE</h4>
                                    </div>
                                    <span class="fa fa-folder-open"></span>
                                </div>
                                <div class="card-content" style="padding-top: 10px;">
                                    <div class="warp-toolbar">
                                        <form action="" class="search">
                                            <input type="text" id="searchbox" placeholder="Silahkan cari data disini..." class="searchbutton">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </form>
                                    </div>
                                   
                                   
                                    <div class="toolbar col-md-12" style="padding: 0;">
                                    <div class="wrap-toolbar">
                                        <button type="button" id="btnsearch" class="btn btn-success btn-fill" style="margin-right: 1rem">
                                                <i class="fa fa-filter" aria-hidden="true" style="margin-right: 10px;"></i>
                                                <span>FILTER DATA</span>
                                        </button>
                                        <h4 style="font-weight: 400;color: #AAAAAA;letter-spacing: 2px;font-size: 18px;display: contents;">TOTAL : <?php echo number_format($jumlah,0,',','.');?></h4>
                                    </div>
                                    <div class="wrap-toolbar" style="margin: 0;">
                                        <a href="<?php echo $baseurl."Data/create";?>" class="btn btn-success btn-fill" style="margin-right: 1rem;">
                                            <i class="fa fa-plus"></i>
                                            <span>Buat Data Baru</span>  
                                        </a>
                                        <a href="#" class="btn btn-info btn-fill export-excel">
                                            <i class="fa fa-download"></i>
                                            <span>Export Data Excel</span>   
                                        </a>
                                        
                                        <a href="#" class="btn btn-default btn-fill export-csv">
                                            <i class="fa fa-globe"></i>
                                            <span>Export Data CSV To Map</span>   
                                        </a>  
                                    </div>
                                    </div>
                                   
                                    <div class="material-datatables">

                                        <table id="datatables" class="table table-responsive  table-no-bordered table-hover" cellspacing="0" width="100%" style="font-size: 12px;">
                                            <thead style="color: #FFFFFF;font-weight: 600;font-size: 12px;">
                                                <tr role="row" style="background-color:#43425D;">
                                                    <th class="text-center">No</th>
                                                    <th class="text-center">NAMA PERUSAHAAN</th>
                                                    <th class="text-center">WILAYAH KERJA</th>
                                                    <th class="text-center">BIDANG USAHA</th>
                                                    <th class="text-center">LOKASI</th>
                                                    <th class="text-center">KOORDINAT</th>
                                                    <th class="text-center">SPESIFIKASI</th>
                                                    <th class="text-center">TERSUS / TUKS</th>
                                                    <th class="text-center">LEGALITAS</th>
                                                    <th class="text-center">TERBIT</th>
                                                    <th class="text-center">STATUS OPERASIONAL</th>
                                                    <th class="text-center">MASA BERLAKU</th>
                                                    <th class="disabled-sorting" style="width:50px">ACTIONS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $no = 1; if (isset($company)) foreach ($company as $val) : ?> 
                                                
                                                <?php if($val->tgl_terbit == '0000-00-00 00:00:00'):?>
                                                    <tr class="alert alert-warning">
                                                <?php elseif($val->ms_berlaku <= date('Y/m/d h:i:s a', time())):?>
                                                    <tr class="alert alert-danger">
                                                <?php else:?>                   
                                                    <tr>
                                                <?php endif; ?>   
                                                    <td><?php echo $no++; ?></td>
                                                    <td style="font-weight: bold;"><?php echo $val->nm_perusahaan; ?></td>
                                                   
                                                    <td class="td-status2"><?php echo $val->nmksop; ?></td>
                                                    <td><?php echo $val->nmusaha; ?></td>
                                                   
                                                    <td><?php echo $val->lokasi; ?></td>
                                                    <td><?php echo $val->koordinat; ?></td>
                                                    <td>
                                                        <div data-singlespesifikasi="<?php echo $no;?>" class="singleSpesifikasi">
                                                        <p class="namaperusahaan" style="display: none;"><?php echo $val->nm_perusahaan; ?></p>
                                                        <p class="wilayahkerja" style="display: none;"><?php echo $val->nmksop; ?></p>
                                                        <p class="lokasi" style="display: none;"><?php echo $val->lokasi; ?></p>
                                                        <p class="spesifikasi" style="display: none;">
                                                        <?php echo preg_replace("/\s\|\s/", '<br/></hr><br/>', (string) $val->spesifikasi); ?>
                                                        </p>
                                                        <a class="showspesifikasi btn btn-success btn-fill" data-target="<?php echo $no;?>">Lihat</a>
                                                        </div>
                                                    </td>
                                                    <?php if ($val->ter_tuk == 'TUKS') 
                                                    {?>
                                                        <td class="td-status" style="color: #A3A0FB;"><?php echo $val->ter_tuk; ?></td>
                                                    <?php }
                                                    else{ ?>
                                                        <td class="td-status" style="color: #649e07;"><?php echo $val->ter_tuk; ?></td>
                                                    <?php } ?>
                                                    <td><?php echo $val->sk; ?></td>
                                                    <td><?php echo date("d M Y",strtotime($val->tgl_terbit)); ?></td>
                                                    <?php if($val->status == 'Y') 
                                                    {?> 
                                                        <td class="td-status" style="color: #649e07;">AKTIF</td>
                                                    <?php }
                                                    else{ ?>
                                                        <td class="td-status" style="color: #649e07;">TIDAK AKTIF</td>
                                                    <?php } ?>
                                                    <td><?php echo date("d M Y",strtotime($val->ms_berlaku)); ?></td>
                                                    <td>
                                                        <a href="<?php echo $baseurl."Data/edit/".$val->id;?>" class="btn btn-simple btn-warning btn-icon edit">
							                                <i class="fa fa-edit"></i>
					                                    </a>
                                                        <button id="delete" personal-id="<?php echo $val->id;?>" data-toggle="modal" data-target="#delete-modal" class="btn btn-simple btn-danger btn-icon remove">
                                                            <i class="fa fa-times"></i>
					                                    </button>
                                                    </td>                         
                                                </tr>
                                                <?php endforeach; ?>
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
 
                <form role="form" id="frmcari" action="<?= base_url('Data'); ?>" method="post">
                    <div class="row">
                        <input type="hidden" value="1" name="trigger">
                        <div class="form-group col-md-8">
                            <label for="name">Nama Perusahaan</label>
                            <!-- <input id="Param01" value="nm_perusahaan"  type="hidden"> -->
                            <input type="text" name="name" id="Filt01" placeholder="Nama Perusahaan" class="form-control">
                        </div>
                    </div>

                  <div class="row">
                    <div class="form-group col-md-4" style="margin-bottom: 1rem;">
                        <label for="provinsi">Provinsi</label>
                        <!-- <input id="Param02" value="provinsi_id"  type="hidden"> -->
                        <!-- <select name="provinsi[]" class="form-control selectpicker" id="Filt02" data-live-search="true" required > -->
                        <select name="provinsi[]"  multiple data-live-search="true" class="form-control selectpicker" id="Filt02" title="Pilih Provinsi">
                          
                            <?php for($i=0;$i<count($dataProvinsi);$i++){?>
                                <option value="<?php echo trim($dataProvinsi[$i]->kode); ?>"><?php echo $dataProvinsi[$i]->nama; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-4" style="margin-bottom: 1rem;">
                        <label for="kota">Kabupaten / Kota</label>
                        <!-- <input id="Param03" value="lokasi"  type="hidden"> -->
                        <!-- <select name="kota[]" class="form-control selectpicker" id="Filt03" data-live-search="true" required > -->
                        <select name="kota" class="form-control selectpicker" id="Filt03" data-live-search="true" title="Pilih Kabupaten / Kota">
                            
                        </select>
                    </div>

                    <div class="form-group col-md-4" style="margin-bottom: 1rem;">
                        <label for="kelas">Wilayah Kerja</label>
                        <!-- <input id="Param04" value="ksop_id"  type="hidden"> -->
                        <!-- <select name="kelas[]" class="form-control" id="Filt04" required> -->
                        <select name="kelas" class="form-control selectpicker" id="Filt04" data-live-search="true" title="Pilih Wilayah Kerja">
                           
                        </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-4" style="margin-bottom: 1rem;">
                        <label for="kategori">Kategori</label>
                        <!-- <input id="Param05" value="kategori_id"  type="hidden"> -->
                        <!-- <select class="selectpicker form-control" multiple data-live-search="true" title="Kategori" name="kategori[]" id="Filt05"> -->

                        <select class="selectpicker form-control" multiple data-live-search="true" title="Kategori" name="kategori[]" id="kategori" title="Pilih Kategori">
                                <?php for($j=0;$j<count($dataKateg);$j++){?>
                                    <option value="<?php echo trim($dataKateg[$j]->kategori_id); ?>"><?php echo $dataKateg[$j]->nama; ?></option>
                                <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4" style="margin-bottom: 1rem;">
                        <label for="bidangusaha">Bidang Usaha</label>
                        <!-- <input id="Param06" value="bdgusaha_id"  type="hidden"> -->
                        <!-- <select class="selectpicker form-control" multiple data-live-search="true" title="Bidang Usaha" name="bidangusaha" id="Filt06"> -->
                        <select class="selectpicker form-control" multiple data-live-search="true" title="Bidang Usaha" name="bidangusaha[]" id="bidangusaha" title="Pilih Bidang Usaha">
                                <?php for($k=0;$k<count($dataBdgUsaha);$k++){?>
                                    <option value="<?php echo trim($dataBdgUsaha[$k]->bdg_usaha_id); ?>"><?php echo $dataBdgUsaha[$k]->nama; ?></option>
                                <?php } ?>
                        </select>
                    </div>
                    
                  </div>

                  <div class="row">
                    <div class="form-group col-md-4" style="margin-bottom: 1rem;">
                        <label for="dermaga">Type Dermaga</label>
                        <!-- <input id="Param07" value="spesifikasi"  type="hidden"> -->
                        <!-- <select class="selectpicker form-control" multiple data-live-search="true" title="Type Dermaga" id="Filt07"> -->
                        <select class="selectpicker form-control" multiple data-live-search="true" title="Type Dermaga" name="dermaga[]" title="Type Dermaga">
                           
                            <?php foreach($dermaga as $key => $value): ?>
                                <option value="<?php echo $value->type;?>"><?php echo $value->type;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group col-md-3" style="margin-bottom: 1rem;">
                        <label for="kedalaman">Kedalaman</label>
                        <!-- <input id="Param08" value="spek_kedalaman"  type="hidden"> -->
                        <div class="input-group">
                            <!-- <input type="number" name="meter" id="Filt08" class="form-control" required placeholder="Meter" aria-describedby="basic-addon1"> -->
                            <input type="text" name="meter" id="Filt08" class="form-control" placeholder="Meter" >
                            <span class="input-group-addon" id="basic-addon1">M LWS</span>
                        </div>                                                       
                    </div>
                 
                    <div class="col-md-3" style="margin-bottom: 1rem;">
                        <label for="kapasitas">Kapasitas</label>
                        <!-- <input id="Param09" value="spek_kapasitas"  type="hidden"> -->
                        <!-- <input type="number" name="kapasitas" id="Filt09" class="form-control" required placeholder="Kapasitas"> -->
                        <input type="number" name="kapasitas" id="Filt09" class="form-control" placeholder="Kapasitas">
                    </div>

                    <div class="col-md-2" style="margin-bottom: 1rem;">
                        <label for="satuan">Satuan</label>
                        <select class="selectpicker form-control" id="satuan" name="satuan[]" title="Pilih Satuan">
                            <option value="FEET" >FEET</option>
                            <option value="GT" >GT</option>
                            <option value="DWT" >DWT</option>
                            <option value="TON" >TON</option>
                        </select>    
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-4">
                        <label for="tukstersus">TERSUS / TUSK</label>
                        <!-- <input id="Param10" value="ter_tuk"  type="hidden"> -->
                        <!-- <select class="selectpicker form-control" id="Filt10" name="tuk_ter"> -->
                        <select class="selectpicker form-control" id="Filt10" name="tuk_ter" title="Pilih TUKS / TERSUS">
                            
                            <option value="TERSUS">TERSUS</option>
                            <option value="TUKS">TUKS</option>
                        </select>                       
                    </div>
                    <div class="form-group col-md-4">
                        <label for="status">STATUS OPERASIONAL</label>
                        <!-- <input id="Param11" value="status"  type="hidden">
                        <select class="selectpicker form-control" id="Filt11" name="status"> -->
                        <select class="selectpicker form-control" id="Filt11" name="status" title="Pilih Status">
                            <option value="Y">AKTIF</option>
                            <option value="N">NON AKTIF</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="akhir">Masa Berlaku</label>
                        <!-- <input id="Param12" value="tglakhir"  type="hidden"> -->
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                            <!-- <input placeholder="Masa Berlaku" type="text" class="form-control datepicker" id="Filt12" name="tgl_akhir" autocomplete="off"> -->
                            <input placeholder="Masa Berlaku" type="text" class="form-control datepicker" id="Filt12" name="tgl_akhir" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <input type="checkbox" name="expired"/> Expired
                    </div>
                    
                  </div>
                  
                  <button id="btnCari" type="submit" class="btn btn-success btn-fill">FILTER NOW</button>

              </form>

                   
            
            </div>
        </div>
    </div>
</div>
<!-- MODAL SEARCH-->



<!--======================================== MODAL SINGLE SPESIFICATION  ======================================-->

<div class="modal fade" role="dialog" id="modal-spesifikasi">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #43425D;color: #ffff;">
                <button type="button" class="close" data-dismiss="modal" style="color: #ffff;outline: none;opacity:1;">&times;</button>
            </div>
           <div class="modal-body">
                <div class="card-modal--warp">
                <h5 class="title-form" style="margin-bottom: 0;">Spesifikasi</h5>
                </div>
               
                <h4 style="font-size: 1.4rem;margin-top: 10px;">Nama Perusahaan 
                <span class="card-namaperusahaan" style="font-weight: bold;padding-left:10px;font-size:1.4rem;"></span> 
                </h4>

                <h4 style="font-size: 1.4rem;margin-top: 5px;display:inline-block;padding-right: 40px;">Wilayah Kerja</h4>
                <span class="card-wilayahkerja" style="font-weight: bold;"></span><br>

                <h4 style="font-size: 1.4rem;margin-top: 5px;display:inline-block;padding-right: 24px;">Lokasi Dermaga</h4>
                <span class="card-lokasi" style="font-size: 1.4rem;font-weight: bold;"></span>
              
                <h4 style="font-size: 1.4rem;margin-top: 0;">Spesifikasi</h4>
                <div class="textarea" style="border:1px solid #43425D; padding:10px;border-radius:5px;">
                <span class="card-desc"></span>
                </div>
               
                <div class="card-menu--room-1"></div>
           </div>
           <div class="modal-footer">
            <a href="#" type="button" class="btn btn-success btn-fill"  data-dismiss="modal" style="float: left;">Kembali</a>
          </div>
        </div>
     </div>
</div>

<!--============================================================================================================-->

</body>


<script src="<?php echo $baseurl;?>assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo $baseurl;?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $baseurl;?>assets/js/light-bootstrap-dashboard.js"></script>
<script src="<?php echo $baseurl;?>assets/js/bootstrap-select.min.js"></script>
<script src="<?php echo $baseurl;?>assets/js/jquery.datatables.js"></script>
<script src="<?php echo $baseurl;?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo $baseurl;?>assets/js/highchart/highcharts.js"></script>
<script src="<?php echo $baseurl;?>assets/js/highchart/highcharts-exporting.js"></script>
<script src="<?php echo $baseurl;?>assets/js/highchart/highcharts-export.js"></script>
<script src="<?php echo $baseurl;?>assets/js/highchart/highcharts-access.js"></script>

<script type="text/javascript" src="<?php echo $baseurl;?>assets/js/data.js?v=<?php echo uniqid(); ?>"></script> 

<script>
    $('.showspesifikasi').on('click', function (event) {
    event.preventDefault();

    const modalNamaPerusahaan   = $(this).parents('.singleSpesifikasi').find('.namaperusahaan').text();
    const modalWilayahKerja     = $(this).parents('.singleSpesifikasi').find('.wilayahkerja').text();
    const modalLokasi           = $(this).parents('.singleSpesifikasi').find('.lokasi').text();
    const modalSpefikasi        = $(this).parents('.singleSpesifikasi').find('.spesifikasi').html();
    

    $('#modal-spesifikasi .modal-body>h4>.card-namaperusahaan').text(modalNamaPerusahaan);
    $('#modal-spesifikasi .modal-body>.card-wilayahkerja').text(modalWilayahKerja);
    $('#modal-spesifikasi .modal-body>.card-lokasi').text(modalLokasi);
    $('#modal-spesifikasi .modal-body>.textarea>.card-desc').html(modalSpefikasi);

 
    $('#modal-spesifikasi').modal();
 
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    Highcharts.setOptions({
		colors: ['#A3A0FB', '#43425D']
	});
	var Total = 0;
	var chart_tusk = new Highcharts.chart({
	    chart: {
	        renderTo: 'container-pie3',
	        plotBackgroundColor: null,
	        plotBorderWidth: null,
	        plotShadow: false,
	        type: 'pie',
	        events: {
	            load: function(event) {
	            $('.highcharts-legend-item').last().append('<br/><div style="margin-left:2rem;"><hr/><span style="float:left;font-weight: bold;padding-bottom:5px;">Total</span><span style="float:left;color:#9A9A9A;font-weight: 700;"> ' + Total + '</span> </div>')
	            }
	        }  
	    },
	    title: {
	        text: ''
	    },
	    credits: {
	    enabled: false
	    },
	    plotOptions: {
	        pie: {
	            allowPointSelect: true,
	            cursor: 'pointer',
	            dataLabels: {
	                enabled: false
	            },
	            showInLegend: true
	        }
	    },
	   	legend: {
	        useHTML: true,
			labelFormatter: function() {
	            Total += this.y;
				return '<div style="width:auto"><span style="float:left">'+ this.name +' :'+'</span><span style="float:left;color:#9A9A9A;font-weight: 400;">' + this.y + '</span></div>';
			},
	        layout: 'vertical',
	        align: 'right',
	        verticalAlign: 'top',
	        x:-10,
	        itemMarginTop: 5,
	        itemMarginBottom: 5,
	        
	    },
	    series: [{
	        name: 'Status',
	        colorByPoint: true,
	        innerSize: '50%',
	        data:<?php echo $tersus; ?>
	    }],
	    navigation: {
	        buttonOptions: {
	            verticalAlign: 'top',
	            align: 'left',
	        }
	    },
	    exporting: {
	        buttons: {
	            contextButton: {
	                menuItems: ['downloadXLS','viewData']
	            }
	        }
	    } 
	});
    Highcharts.setOptions({
		colors: ['#6bd189', '#595861']
	});

	var Total = 0;
	var chart_tersus = new Highcharts.chart({
	    chart: {
	        renderTo: 'container-pie4',
	        plotBackgroundColor: null,
	        plotBorderWidth: null,
	        plotShadow: false,
	        type: 'pie',
	        events: {
	            load: function(event) {
	            $('.highcharts-legend-item').last().append('<br/><div style="margin-left:2rem;"><hr/><span style="float:left;font-weight: bold;padding-bottom:5px;">Total</span><span style="float:left;color:#9A9A9A;font-weight: 700;"> ' + Total + '</span> </div>')
	            }
	        }  
	        
	    },
	    title: {
	        text: ''
	    },
	    credits: {
	    enabled: false
	    },
	    plotOptions: {
	        pie: {
	            allowPointSelect: true,
	            cursor: 'pointer',
	            dataLabels: {
	                enabled: false
	            },
	            showInLegend: true
	        }
	    },
	    legend: {
	        useHTML: true,
			labelFormatter: function() {
	            Total += this.y;
				return '<div style="width:auto"><span style="float:left">'+ this.name +' :'+'</span><span style="float:left;color:#9A9A9A;font-weight: 400;">' + this.y + '</span></div>';
			},
	        layout: 'vertical',
	        align: 'right',
	        verticalAlign: 'top',
	        x:-10,
	        itemMarginTop: 5,
	        itemMarginBottom: 5,
	    },
	    series: [{
	        name: 'Status',
	        colorByPoint: true,
	        innerSize: '50%',
            data:<?php echo $tuks; ?>    
	    }],
	    navigation: {
	        buttonOptions: {
	            verticalAlign: 'top',
	            align: 'left',
	        }
	    },
	    exporting: {
	        buttons: {
	            contextButton: {
	                menuItems: ['downloadXLS','viewData']
	            }
	        }
	    } 
	});
});
</script> 
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
