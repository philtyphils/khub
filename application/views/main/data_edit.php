        <div class="contents">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="header" style="background-color: #43425D">
                                <h4 class="title" style="color: #ffff;">Edit Data</h4>
                            </div>
                                <div class="card-form">
                                <?php echo $this->session->flashdata('teks'); ?>
                                <form action="<?php echo $baseurl."Data/submit/edit";?>" method="POST">
                                    <div id="multifield" class="col" style="margin-bottom: 2rem;">
                                        <input type="hidden" value="<?php echo $data['data']->id;?>" name="_id"/>
                                        <div class="row">
                                            <div class="form-group col-md-12" style="padding:0">
                                                <label for="name" class="label-font" style="margin-bottom: 1rem;">Nama Perusahaan</label>
                                                <input type="text" name="name" value="<?php echo $data['data']->nm_perusahaan;?>" id="name" class="form-control" placeholder="Nama Perusahaan" >
                                            </div>

                                            <div class="wrap">
                                               
                                                <div class="form-group col-md-6 border-right">
                                                    <label for="alamat">Alamat Kantor</label>
                                                    <textarea name="alamat" id="alamat" rows="11" class="form-control"><?php echo $data['data']->alamat;?></textarea> 
                                                </div>
                                                <div class="form-group col-md-6" >
                                                    <div class="form-group">
                                                        <label for="provinsi">Provinsi</label>
                                                        <select name="provinsi" class="form-control" id="provinsi" >
                                                           <option value="" readonly>Pilih Provinsi</option>
                                                            <?php for($i=0;$i<count($dataProvinsi);$i++){?>
                                                                <?php if($dataProvinsi[$i]->kode == $data['data']->alamat_provinsi_id):?>
                                                                    <option value="<?php echo trim($dataProvinsi[$i]->kode);?>|<?php echo trim($dataProvinsi[$i]->nama);?>" selected><?php echo $dataProvinsi[$i]->nama; ?></option>
                                                                <?php else: ?>
                                                                    <option value="<?php echo trim($dataProvinsi[$i]->kode);?>|<?php echo trim($dataProvinsi[$i]->nama);?>"><?php echo $dataProvinsi[$i]->nama; ?></option>
                                                                <?php endif;?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-4">
                                                            <label for="kecamatan">Kecamatan</label>
                                                            <select name="kecamatan" class="form-control" id="kecamatan" >
                                                                <option value="" readonly>Pilih Kecamatan</option>
                                                                <?php foreach ($data['alamat_kecamatan'] as $key => $value):?>
                                                                    <?php if($value->kode == $data['data']->alamat_kecamatan):?>
                                                                        <option value="<?php echo trim($value->kode);?>" selected><?php echo trim($value->nama);?></option>
                                                                    <?php else:?>
                                                                        <option value="<?php echo trim($value->kode);?>"><?php echo trim($value->nama);?></option>
                                                                    <?php endif;?>
                                                                <?php endforeach;?>
            
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="kelurahan">Kelurahan</label>
                                                            <select name="kelurahan" class="form-control" id="kelurahan" >
                                                                <option value="">Pilih Kelurahan</option>
                                                                <?php foreach ($data['kelurahan'] as $key => $value):?>
                                                                    <?php if($value->kode == $data['data']->alamat_kelurahan):?>
                                                                        <option value="<?php echo trim($value->kode);?>" selected><?php echo trim($value->nama);?></option>
                                                                    <?php else:?>
                                                                        <option value="<?php echo trim($value->kode);?>"><?php echo trim($value->nama);?></option>
                                                                    <?php endif;?>
                                                                <?php endforeach;?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="kodepos">KodePos</label>
                                                            <input type="number" name="kodepos" value="<?php echo $data['data']->alamat_kodepos;?>" id="kodepos" class="form-control" placeholder="KodePos">  
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="contactperson">Contact Person</label>
                                                            <input type="number" name="contactperson" value="<?php echo $data['data']->no_tlp;?>" id="contactperson" class="form-control" placeholder="Contact Person"> 
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="email">Email</label>
                                                            <input type="email" name="email" id="email"  value="<?php echo $data['data']->alamat_email;?>" class="form-control" placeholder="Email">
                                                        </div>
                                                    </div>  
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row group">
                                            <div class="wrap-3">
                                                <h4 class="headingtitle">FORM LOKASI</h4> 
                                            </div> 
                                           
                                            <div class="wrap-2">
                                                <div class="form-group col-md-5">
                                                    <label for="lokasi">Lokasi</label>
                                                    <textarea name="lokasi_f" id="lokasi_f"  rows="19" class="form-control"><?php echo $data['data']->lokasi;?></textarea> 
                                                </div>
                                                <div class="form-group col-md-7">
                                                    <div class="form-group">
                                                        <label for="provinsi">Provinsi</label>
                                                        <select name="provinsi_f" class="form-control selectpicker" id="provinsi_f" data-live-search="true">
                                                           <option value="">Pilih Provinsi</option>
                                                            <?php for($i=0;$i<count($dataProvinsi);$i++){?>
                                                                <?php if($dataProvinsi[$i]->kode == $data['data']->provinsi_id):?>
                                                                    <option value="<?php echo trim($dataProvinsi[$i]->kode);?>|<?php echo trim($dataProvinsi[$i]->nama);?>" selected><?php echo $dataProvinsi[$i]->nama; ?></option>
                                                                    <?php else: ?>
                                                                    <option value="<?php echo trim($dataProvinsi[$i]->kode);?>|<?php echo trim($dataProvinsi[$i]->nama);?>"><?php echo $dataProvinsi[$i]->nama; ?></option>
                                                                <?php endif;?>                                                                
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6" style="margin-bottom: 1rem;">
                                                            <label for="kecamatan">Kecamatan</label>
                                                            <select name="kecamatan_f" class="form-control selectpicker" id="kecamatan_f" data-live-search="true">
                                                                <option value="">Pilih Kecamatan</option>
                                                                <?php foreach ($data['kecamatan'] as $key => $value):?>
                                                                    <?php if($value->kode == $data['data']->lokasi_kecamatan):?>
                                                                        <option value="<?php echo trim($value->kode);?>" selected><?php echo trim($value->nama);?></option>
                                                                    <?php else:?>
                                                                        <option value="<?php echo trim($value->kode);?>"><?php echo trim($value->nama);?></option>
                                                                    <?php endif;?>
                                                                <?php endforeach;?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="kelurahan">Kelurahan / Desa</label>
                                                            <select name="kelurahan_f" class="form-control" id="kelurahan" >
                                                                <option value="">Pilih Kelurahan</option>
                                                                <?php foreach ($data['kelurahan'] as $key => $value):?>
                                                                    <?php if($value->kode == $data['data']->lokasi_kelurahan):?>
                                                                        <option value="<?php echo trim($value->kode);?>" selected><?php echo trim($value->nama);?></option>
                                                                    <?php else:?>
                                                                        <option value="<?php echo trim($value->kode);?>"><?php echo trim($value->nama);?></option>
                                                                    <?php endif;?>
                                                                <?php endforeach;?>
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="row" id="latitude">
                                                        <div class="form-group col-md-3" >
                                                            <label for="dms">Degrees</label>
                                                            <div class="input-group">
                                                                <input type="number" value="<?php echo (array_key_exists(0,$data['data']->koordinat)) ? trim($data['data']->koordinat[0]) : "";?>" name="d_lat" id="d_lat" class="form-control" placeholder="Degrees" aria-describedby="basic-addon1">
                                                                <span class="input-group-addon" id="basic-addon1">°</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="dms">Minutes</label>
                                                            <div class="input-group">  
                                                                <input type="number" value="<?php echo (array_key_exists(1,$data['data']->koordinat)) ? trim($data['data']->koordinat[1]) : "";?>" name="m_lat" id="m_lat" class="form-control" placeholder="Minutes" aria-describedby="basic-addon1">
                                                                <span class="input-group-addon" id="basic-addon1">'</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="dms">Seconds</label>
                                                            <div class="input-group">    
                                                                <input type="number" value="<?php echo (array_key_exists(2,$data['data']->koordinat)) ? trim($data['data']->koordinat[2]) : "";?>" name="s_lat" id="s_lat" class="form-control" placeholder="Seconds" aria-describedby="basic-addon1">
                                                                <span class="input-group-addon" id="basic-addon1">"</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="direction">Direction</label>
                                                            <select name="direction_lat" id="direction_lat" class="form-control" >
                                                                <option value="" readonly>Pilih</option>
                                                                <option value="LU" <?php echo (array_key_exists(3,$data['data']->koordinat) && trim($data['data']->koordinat[3]) == "LU") ? "selected" : ""; ?>>LU</option>
                                                                <option value="LS" <?php echo (array_key_exists(3,$data['data']->koordinat) && trim($data['data']->koordinat[3]) == "LS") ? "selected" : ""; ?>>LS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                                
                                                    <div class="row" id="longitude">
                                                        <div class="form-group col-md-3" >
                                                            <label for="dms">Degrees</label>
                                                            <div class="input-group">
                                                                <input type="number" value="<?php echo (array_key_exists(4,$data['data']->koordinat)) ? trim($data['data']->koordinat[4]) : "";?>" name="d_long" id="d_long" class="form-control"  placeholder="Degrees" aria-describedby="basic-addon1">
                                                                <span class="input-group-addon" id="basic-addon1">°</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="dms">Minutes</label>
                                                            <div class="input-group">
                                                                <input type="number"value="<?php echo (array_key_exists(5,$data['data']->koordinat)) ? trim($data['data']->koordinat[5]) : "";?>"  name="m_long" id="m_long" class="form-control"  placeholder="Minutes" aria-describedby="basic-addon1">
                                                                <span class="input-group-addon" id="basic-addon1">'</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="dms">Seconds</label>
                                                            <div class="input-group">
                                                                <input type="number" value="<?php echo (array_key_exists(6,$data['data']->koordinat)) ? trim($data['data']->koordinat[6]) : "";?>" name="s_long" id="s_long" class="form-control"  placeholder="Seconds" aria-describedby="basic-addon1">
                                                                <span class="input-group-addon" id="basic-addon1">"</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="direction">Direction</label>
                                                            <select name="direction_long" id="direction_long" class="form-control"  disabled>
                                                                <option value="BT" readonly>BT</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div id="dermagamulti" class="wrap-2"> 
                                                        <div class="col-md-12">
                                                            <button type="button" id="btnTambah" onclick="addFields()" class="btn btn-fill btn-primary" style="margin: 10px 0 20px 0;">
                                                            Tambah Dermaga
                                                            </button>    
                                                        </div>
                                                       
                                                        <div id="groupdermaga">
                                                            <?php $no =1; ?>
                                                            <?php foreach($dermaga as $key => $value):?>
                                                            <div class="form-group col-md-12" id="dermaga-<?php echo $no;?>-type">  
                                                                <div class="col-md-3" style="padding-left:0;margin-top: 1rem;">
                                                                    <label for="dermaga">Dermaga Tipe</label>
                                                                    <input type="text" value="<?php echo $value['tipe'];?>" name="dermaga[]" id="dermaga" class="form-control"  placeholder="Dermaga Type">
                                                                </div>

                                                                <div class="col-md-3" style="padding-left:0;margin-top: 1rem;">
                                                                    <label for="spesifikasi">Spesifikasi</label>
                                                                    <input type="text" value="<?php echo $value['spesifikasi'];?>" name="spesifikasi[]" id="spesifikasi" class="form-control"  placeholder="Spesifikasi">
                                                                </div>

                                                                <div class="col-md-6" style="padding-left:0;margin-top: 1rem;">
                                                                    <label for="peruntukan">Peruntukan</label>
                                                                    <input type="text" value="<?php echo $value['peruntukan'];?>" name="peruntukan[]" id="peruntukan" class="form-control"  placeholder="Peruntukan">
                                                                </div>

                                                                <div class="col-md-3" style="padding-left:0;margin-top: 1rem;">
                                                                    <label for="kedalaman">Kedalaman</label>
                                                                    <div class="input-group">
                                                                        <input type="text" value="<?php echo $value['kedalaman'];?>" name="meter[]" id="meter" class="form-control"  placeholder="Meter" aria-describedby="basic-addon1">
                                                                        <span class="input-group-addon" id="basic-addon1">M LWS</span>
                                                                    </div>                  
                                                                </div>
                                                                
                                                                <div class="col-md-3" style="padding-left:0;margin-top: 1rem;">
                                                                    <label for="kapasitas">Kapasitas</label>
                                                                    <input type="text" value="<?php echo trim($value['kapasitas']);?>" name="kapasitas[]" id="kapasitas" class="form-control"  placeholder="Kapasitas">
                                                                </div>

                                                                <div class="col-md-3" style="padding-left:0;margin-top: 1rem;">
                                                                    <label for="satuan">Satuan</label>
                                                                    <select name="satuan[]" class="form-control" id="satuan" >
                                                                        <option value="">Pilih Satuan</option>
                                                                        <option value="FEET" <?php echo (trim($value['satuan']) == "FEET") ? "selected" : ""; ?>>FEET</option>
                                                                        <option value ="GT" <?php echo (trim($value['satuan']) == "GT") ? "selected" : ""; ?>>GT</option>
                                                                        <option value="DWT" <?php echo (trim($value['satuan']) == "DWT") ? "selected" : ""; ?>>DWT</option>
                                                                        <option value="TON" <?php echo (trim($value['satuan']) == "TON") ? "selected" : ""; ?>>TON</option>
                                                                    </select>    
                                                                </div>

                                                                <button type="button" class="btn btn-fill btn-danger btnHapus" attr-dermaga-id="<?php echo $no;?>" style="margin-top: 3.3rem;margin-left: 10px;">Hapus</button> 
                                                            </div>
                                                            <?php $no++;endforeach;?>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                 
                                                    <div class="wrap-2">
                                                        <div class="form-group col-md-6">
                                                            <label for="name">Legalitas</label>
                                                            <input type="text" value="<?php echo trim($data['data']->sk);?>" name="nosk" id="nosk" class="form-control"  placeholder="Input No SK">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="jenissk">Jenis SK / Legalitas</label>
                                                            <select name="jenissk" class="form-control" id="jenissk" >
                                                                <option value="">Pilih Jenis SK / Legalitas</option>
                                                                <option value="7">Pembangunan</option>
                                                                <option value="1">Pengembangan</option>
                                                                <option value="2">Pengoperasian</option>
                                                                <option value="3">Perpajangan / Pembangunan / Pengembangan</option>
                                                                <option value="4">Perpanjangan Pengoperasian</option>
                                                                <option value="5">Penyesuaian</option>
                                                                <option value="6">Pendaftaran</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="bidang usaha">BIDANG USAHA</label>
                                                            <select class="selectpicker form-control" data-live-search="true" title="Bidang Usaha" name="bidangusaha" id="bidangusaha">
                                                                    <option value="" disabled>Pilih Bidang Usaha</option>
                                                                    <?php for($k=0;$k<count($dataBdgUsaha);$k++){?>
                                                                        <?php if($data['data']->bdgusaha_id == $dataBdgUsaha[$k]->bdg_usaha_id ):?>
                                                                            <option value="<?php echo trim($dataBdgUsaha[$k]->bdg_usaha_id); ?>" selected><?php echo $dataBdgUsaha[$k]->nama; ?></option>
                                                                        <?php else: ?>
                                                                            <option value="<?php echo trim($dataBdgUsaha[$k]->bdg_usaha_id); ?>"><?php echo $dataBdgUsaha[$k]->nama; ?></option>
                                                                        <?php endif;?>
                                                                    <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="kelas">Wilayah Kerja</label>
                                                            <select name="wilayah_kerja" class="form-control" id="kelas" >
                                                                <option value="">Pilih Wilayah Kerja</option>
                                                                <?php foreach($data['wilayah_kerja'] as $key => $value):?>
                                                                    <?php if($value->ksop_id == $data['data']->ksop_id):?>
                                                                        <option value="<?php echo trim($value->ksop_id); ?>" selected><?php echo $value->nama; ?></option>
                                                                    <?php else:?>    
                                                                        <option value="<?php echo trim($value->ksop_id); ?>" ><?php echo $value->nama; ?></option>
                                                                    <?php endif;?>
                                                                <?php endforeach;?>
                                                            </select>
                                                        </div>
    
                                                        <div class="form-group col-md-3" >
                                                            <label for="tersus_tuks">TERSUS / TUKS</label>
                                                            <select name="ter_tuk" class="form-control" id="tersus_tuks" >
                                                                <?php if($data['data']->ter_tuk == "TERSUS"): ?>
                                                                    <option value="" readonly>Pilih</option>
                                                                    <option value="TERSUS" selected>TERSUS</option>
                                                                    <option value="TUKS">TUKS</option>
                                                                <?php elseif($data['data']->ter_tuk == "TUKS"):?>
                                                                    <option value="" readonly>Pilih</option>
                                                                    <option value="TERSUS" >TERSUS</option>
                                                                    <option value="TUKS" selected>TUKS</option>
                                                                <?php else: ?>
                                                                    <option value="" readonly>Pilih</option>
                                                                    <option value="TERSUS">TERSUS</option>
                                                                    <option value="TUKS">TUKS</option>
                                                                <?php endif;?>
                                                            </select>  
                                                        </div>
        
                                                        <div class="form-group col-md-3" >
                                                            <label for="status">STATUS OPERASIONAL</label>
                                                            <select name="status" class="form-control" id="status">
                                                                <?php if($data['data']->status == "Y"):?>
                                                                    <option value="">Pilih Status</option>
                                                                    <option value="Y" selected>AKTIF</option>
                                                                    <option value="N">NON AKTIF</option>
                                                                <?php elseif($data['data']->status == "N"):?>
                                                                    <option value="">Pilih Status</option>
                                                                    <option value="Y" >AKTIF</option>
                                                                    <option value="N" selected>NON AKTIF</option>
                                                                <?php else: ?>
                                                                    <option value="" selected readonly>Pilih Status</option>
                                                                    <option value="Y" >AKTIF</option>
                                                                    <option value="N" >NON AKTIF</option>
                                                                <?php endif; ?>
                                                                
                                                            </select>  
                                                        </div>
        
                                                        <div class="col-md-3">
                                                            <label for="terbit">Tgl Terbit</label>
                                                            <div class="input-group date" data-provide="datepicker">
                                                                <div class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-th"></span>
                                                                </div>
                                                                <input placeholder="Tanggal Terbit" value="<?php echo date("m/d/Y",strtotime($data['data']->tgl_terbit));?>" type="text" class="form-control datepicker" id="tgl_terbit" name="tgl_terbit" autocomplete="off">
                                                            </div>
                                                        </div>
            
                                                        <div class="col-md-3">
                                                            <label for="akhir">Masa Berlaku</label>
                                                            <div class="input-group date" data-provide="datepicker">
                                                                <div class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-th"></span>
                                                                </div>
                                                                <input placeholder="Masa Berlaku"  value="<?php echo date("m/d/Y",strtotime($data['data']->ms_berlaku));?>" type="text" class="form-control datepicker" id="tgl_akhir" name="tgl_akhir" autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <button type="submit" class="btn btn-fill btn-success" style="margin-right: 1rem;margin-left: -15px;">SIMPAN DATA</button>
                                    <a href="<?php echo $baseurl;?>Data"  class="btn btn-fill btn-default" >KEMBALI</a> 
                                </form>

                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="<?php echo $baseurl;?>assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo $baseurl;?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $baseurl;?>assets/js/light-bootstrap-dashboard.js"></script>
<script src="<?php echo $baseurl;?>assets/js/bootstrap-select.min.js"></script>
<script src="<?php echo $baseurl;?>assets/js/jquery.multifield.js"></script>
<script src="<?php echo $baseurl;?>assets/js/bootstrap-datepicker.js"></script>
<!--  -->
<script type="text/javascript">

var siteurl = $("#txtsite").val();
var baseurl = $("#txtbase").val();


$(document).ready(function(){


    $('select').selectpicker();

    $('.datepicker').datepicker();


    $(".btnAdd").click(function(){
      
        var val = $("#count").val();
        var val = eval(val) + 1;
        $("#count").val(val);

        $.get(baseurl+"Data/load_view/"+val, function(data, status){
            $("#loadhere").append(data);
        });

    });
    //$('#multifield').multifield({
    //    section: '.group',
    //    btnAdd:'#btnAdd',
    //    btnRemove:'.btnRemove',
    //});

    // $('#dermagamulti').multifield({
    //     section: '.groupdermaga',
    //     btnAdd:'#btnTambah',
    //     btnRemove:'.btnHapus',
    // });


    $('#provinsi').change(function(option, checked){
        var str = $('[name="provinsi"]').val();
        var provinsi = str.split("|");
        var param = {'provinsi':provinsi[0]};
        $.ajax({
            url : siteurl+'/Data/get_Kecamatan2/',
            type: "POST",
            data: param,
            dataType: "JSON",
            success: function(data)
            {
                $('#kecamatan').html(data);
                $('#kecamatan').selectpicker('refresh');

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data'); 
            }
        });
    });


    $('#provinsi_f').change(function(option, checked){
        var str = $('[name="provinsi_f[]"]').val();
        var provinsi = str.split("|");
        var param = {'provinsi':provinsi[0]};
        $.ajax({
            url : siteurl+'/Data/get_Kota2/',
            type: "POST",
            data: param,
            dataType: "JSON",
            success: function(data)
            {
                $('#kota_f').html(data);
                $('#kota_f').selectpicker('refresh');

                setkelas(provinsi[0]);

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data'); 
            }
        });
    });

    $('#kota_f').change(function(option, checked){
        var str = $('[name="kota_f[]"]').val();
        var kota_f = str.split("|");
        var param = {'kota':kota_f[0]};
        $.ajax({
            url : siteurl+'/Data/get_Kecamatan/',
            type: "POST",
            data: param,
            dataType: "JSON",
            success: function(data)
            {
                $('#kecamatan_f').html(data);
                $('#kecamatan_f').selectpicker('refresh');

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data'); 
            }
        });
    });

    $('#kecamatan').change(function(option, checked){
        var str = $('[name="kecamatan"]').val();
        var kecamatan = str.split("|");
        var param = {'kecamatan':kecamatan[0]};
        $.ajax({
            url : siteurl+'/Data/get_Kelurahan/',
            type: "POST",
            data: param,
            dataType: "JSON",
            success: function(data)
            {
                $('#kelurahan').html(data);
                $('#kelurahan').selectpicker('refresh');

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data'); 
            }
        });
    });

    $(".btnHapus").click(function(e){
        id = $(this).attr('attr-dermaga-id');
        if(confirm('Remove fields?'))
        {
            var x = document.getElementById("dermaga-"+id+"-type"); 
            x.remove(); 
        }
        e.PreventDefault();
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

function addFields(){

   var idField = Math.random();

   $('#groupdermaga').append('<div class="form-group col-md-12" id="'+idField+'"><div class="col-md-3" style="padding-left:0;margin-top: 1rem;"><label for="dermaga">Dermaga Tipe</label><input type="text" name="dermaga[]" id="dermaga" class="form-control" required placeholder="Dermaga Type"></div><div class="col-md-3" style="padding-left:0;margin-top: 1rem;"><label for="spesifikasi">Spesifikasi</label><input type="text" name="spesifikasi[]" id="spesifikasi" class="form-control" required placeholder="Spesifikasi"></div><div class="col-md-6" style="padding-left:0;margin-top: 1rem;"><label for="peruntukan">Peruntukan</label><input type="text" name="peruntukan[]" id="peruntukan" class="form-control" required placeholder="Peruntukan"></div><div class="col-md-3" style="padding-left:0;margin-top: 1rem;"><label for="kedalaman">Kedalaman</label><div class="input-group"><input type="number" name="meter[]" id="meter" class="form-control" required placeholder="Meter" aria-describedby="basic-addon1"><span class="input-group-addon" id="basic-addon1">M LWS</span></div></div><div class="col-md-3" style="padding-left:0;margin-top: 1rem;"><label for="kapasitas">Kapasitas</label><input type="number" name="kapasitas[]" id="kapasitas" class="form-control" required placeholder="Kapasitas"></div><div class="col-md-3"style="padding-left:0;margin-top: 1rem;"><label for="satuan">Satuan</label><select name="satuan[]" class="form-control" id="satuan" required><option value="">Pilih Satuan</option><option value="FEET">FEET</option><option value="GT">GT</option><option>DWT</option></select></div><button type="button" class="btn btn-fill btn-danger btnHapus" onclick="rmvFields('+idField+')" style="margin-top: 3.3rem;margin-left: 10px;">Hapus</button></div>');

}

function rmvFields(id){
    if(confirm('Remove fields?'))
    {
        var x = document.getElementById(id); 
        x.remove(); 
    }
}



</script>


</html>