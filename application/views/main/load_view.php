
                                        <div class="row group" id="lokasi-<?php echo $id;?>-warp">
                                            <div class="wrap-3">
                                                <h4 class="headingtitle">FORM LOKASI</h4> 
                                            </div> 
                                           
                                            <div class="wrap-2">
                                                <div class="form-group col-md-5">
                                                    <label for="lokasi">Lokasi</label>
                                                    <textarea name="lokasi_f[]" id="lokasi_f"  rows="19" class="form-control"></textarea> 
                                                </div>
                                                <div class="form-group col-md-7">
                                                    <div class="form-group">
                                                        <label for="provinsi">Provinsi</label>
                                                        <select name="provinsi_f[]" class="form-control" id="provinsi_f<?php echo $id;?>" >
                                                           <option value="">Pilih Provinsi</option>
                                                            <?php for($i=0;$i<count($dataProvinsi);$i++){?>
                                                                <option value="<?php echo trim($dataProvinsi[$i]->kode);?>|<?php echo trim($dataProvinsi[$i]->nama);?>"><?php echo $dataProvinsi[$i]->nama; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6" style="margin-bottom: 1rem;">
                                                            <label for="kecamatan">Kecamatan</label>
                                                            <select name="kecamatan_f[]" class="form-control" id="kecamatan_f<?php echo $id;?>" >
                                                                <option value="">Pilih Kecamatan</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="kelurahan">Kelurahan / Desa</label>
                                                            <select name="kelurahan_f[]" class="form-control" id="kelurahan_f<?php echo $id;?>" >
                                                                <option value="">Pilih Kelurahan</option>
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="row" id="latitude">
                                                        <div class="form-group col-md-3" >
                                                            <label for="dms">Degrees</label>
                                                            <div class="input-group">
                                                                <input type="number" name="d_lat[]" id="d_lat" class="form-control" placeholder="Degrees" aria-describedby="basic-addon1">
                                                                <span class="input-group-addon" id="basic-addon1">°</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="dms">Minutes</label>
                                                            <div class="input-group">  
                                                                <input type="number" name="m_lat[]" id="m_lat" class="form-control" placeholder="Minutes" aria-describedby="basic-addon1">
                                                                <span class="input-group-addon" id="basic-addon1">'</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="dms">Seconds</label>
                                                            <div class="input-group">    
                                                                <input type="number" name="s_lat[]" id="s_lat" class="form-control" placeholder="Seconds" aria-describedby="basic-addon1">
                                                                <span class="input-group-addon" id="basic-addon1">"</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="direction">Direction</label>
                                                            <select name="direction_lat[]" id="direction_lat" class="form-control" >
                                                                <option value="">Pilih</option>
                                                                <option value="LU">LU</option>
                                                                <option value="LS">LS</option>
                                                            </select>
                                                        </div>
                                                    </div>
    
                                                    <div class="row" id="longitude">
                                                        <div class="form-group col-md-3" >
                                                            <label for="dms">Degrees</label>
                                                            <div class="input-group">
                                                                <input type="number" name="d_long[]" id="d_long" class="form-control"  placeholder="Degrees" aria-describedby="basic-addon1">
                                                                <span class="input-group-addon" id="basic-addon1">°</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="dms">Minutes</label>
                                                            <div class="input-group">
                                                                <input type="number" name="m_long[]" id="m_long" class="form-control"  placeholder="Minutes" aria-describedby="basic-addon1">
                                                                <span class="input-group-addon" id="basic-addon1">'</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="dms">Seconds</label>
                                                            <div class="input-group">
                                                                <input type="number" name="s_long[]" id="s_long" class="form-control"  placeholder="Seconds" aria-describedby="basic-addon1">
                                                                <span class="input-group-addon" id="basic-addon1">"</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="direction">Direction</label>
                                                            <select name="direction_long[]" id="direction_long" class="form-control"  disabled>
                                                                <option value="BT">BT</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div id="dermagamulti" class="wrap-2">
                                                        <div class="col-md-12">
                                                            <button type="button" id="btnTambah" class="btn btn-fill btn-primary addFields" style="margin: 10px 0 20px 0;">
                                                            Tambah Dermaga
                                                            </button>    
                                                        </div>  
                                                        <div id="groupdermaga<?php echo $id;?>">

                                                            <div class="form-group col-md-12" id="dermaga type">  
                                                                <div class="col-md-3" style="padding-left:0;margin-top: 1rem;">
                                                                    <label for="dermaga">Dermaga Tipe</label>
                                                                    <input type="text" name="dermaga[<?php echo $id;?>][]" id="dermaga" class="form-control"  placeholder="Dermaga Type">
                                                                </div>

                                                                <div class="col-md-3" style="padding-left:0;margin-top: 1rem;">
                                                                    <label for="spesifikasi">Spesifikasi</label>
                                                                    <input type="text" name="spesifikasi[<?php echo $id;?>][]" id="spesifikasi" class="form-control"  placeholder="Spesifikasi">
                                                                </div>

                                                                <div class="col-md-6" style="padding-left:0;margin-top: 1rem;">
                                                                    <label for="peruntukan">Peruntukan</label>
                                                                    <input type="text" name="peruntukan[<?php echo $id;?>][]" id="peruntukan" class="form-control"  placeholder="Peruntukan">
                                                                </div>

                                                                <div class="col-md-3" style="padding-left:0;margin-top: 1rem;">
                                                                    <label for="kedalaman">Kedalaman</label>
                                                                    <div class="input-group">
                                                                        <input type="number" name="meter[<?php echo $id;?>][]" id="meter" class="form-control"  placeholder="Meter" aria-describedby="basic-addon1">
                                                                        <span class="input-group-addon" id="basic-addon1">M LWS</span>
                                                                    </div>                  
                                                                </div>
                                                                
                                                                <div class="col-md-3" style="padding-left:0;margin-top: 1rem;">
                                                                    <label for="kapasitas">Kapasitas</label>
                                                                    <input type="number" name="kapasitas[<?php echo $id;?>][]" id="kapasitas" class="form-control"  placeholder="Kapasitas">
                                                                </div>

                                                                <div class="col-md-3"style="padding-left:0;margin-top: 1rem;">
                                                                    <label for="satuan">Satuan</label>
                                                                    <select name="satuan[<?php echo $id;?>][]" class="form-control" id="satuan" >
                                                                        <option value="">Pilih Satuan</option>
                                                                        <option value="FEET">FEET</option>
                                                                        <option value="GT">GT</option>
                                                                        <option value="DWT">DWT</option>
                                                                        <option value="TON">TON</option>
                                                                    </select>    
                                                                </div>

                                                                <!-- <button type="button" class="btn btn-fill btn-danger btnHapus" style="margin-top: 3.3rem;margin-left: 10px;">Hapus</button>   -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                 
                                                    <div class="wrap-2">
                                                        <div class="form-group col-md-6">
                                                            <label for="name">Legalitas</label>
                                                            <input type="text" name="nosk[]" id="nosk" class="form-control"  placeholder="Input No SK">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="jenissk">Jenis SK / Legalitas</label>
                                                            <select name="jenissk[]" class="form-control" id="jenissk" >
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
                                                            <select class="selectpicker form-control" data-live-search="true" title="Bidang Usaha" name="bidangusaha[]" id="bidangusaha">
                                                                    <option value="" disabled>Pilih Bidang Usaha</option>
                                                                    <?php for($k=0;$k<count($dataBdgUsaha);$k++){?>
                                                                        <option value="<?php echo trim($dataBdgUsaha[$k]->bdg_usaha_id); ?>"><?php echo $dataBdgUsaha[$k]->nama; ?></option>
                                                                    <?php } ?>
                                                            </select>
                                                        </div>
        
                                                        <div class="form-group col-md-6">
                                                            <label for="kelas">Wilayah Kerja</label>
                                                            <select name="kelas[]" class="form-control" id="kelas<?php echo $id;?>" >
                                                                <option value="">Pilih Wilayah Kerja</option>
                                                            </select>
                                                        </div>
    
                                                        <div class="form-group col-md-3" >
                                                            <label for="tersus_tuks">TERSUS / TUKS</label>
                                                            <select name="tersus_tuks[]" class="form-control" id="tersus_tuks<?php echo $id;?>" >
                                                                <option value="">Pilih</option>
                                                                <option value="TERSUS">TERSUS</option>
                                                                <option value="TUKS">TUKS</option>
                                                            </select>  
                                                        </div>
        
                                                        <div class="form-group col-md-3" >
                                                            <label for="status">STATUS OPERASIONAL</label>
                                                            <select name="status[]" class="form-control" id="status<?php echo $id;?>" >
                                                                <option value="">Pilih Status</option>
                                                                <option value="Y">AKTIF</option>
                                                                <option value="N">NON AKTIF</option>
                                                            </select>  
                                                        </div>
        
                                                        <div class="col-md-3">
                                                            <label for="terbit">Tgl Terbit</label>
                                                            <div class="input-group date" data-provide="datepicker">
                                                                <div class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-th"></span>
                                                                </div>
                                                                <input placeholder="Tanggal Terbit" type="text" class="form-control datepicker" id="tgl_terbit" name="tgl_terbit[]" autocomplete="off">
                                                            </div>
                                                        </div>
            
                                                        <div class="col-md-3">
                                                            <label for="akhir">Masa Berlaku</label>
                                                            <div class="input-group date" data-provide="datepicker">
                                                                <div class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-th"></span>
                                                                </div>
                                                                <input placeholder="Masa Berlaku" type="text" class="form-control datepicker" id="tgl_akhir" name="tgl_akhir[]" autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="wrap-3" style="padding-left: 0;">
                                                <button type="button" id="btnAdd" class="btn btn-fill btn-primary btnAdd" style="margin-right: 1rem;">
                                                <i class="fa fa-plus" style="margin-right: 5px;"></i>
                                                Tambah Lokasi
                                                </button>
                                                <button type="button" class="btn btn-fill btn-danger btnRemove" onclick="removeLokasi('<?php echo $id;?>')">Hapus</button>
                                            </div>
                                        </div>

                                        

<script type="text/javascript">



$(document).ready(function(){

    $('select').selectpicker();

    $('.datepicker').datepicker();


    $(".btnAdd").click(function(){
      
        var val = localStorage.getItem('aCounter');
        var val = eval(val) + eval(1);
        localStorage.setItem('aCounter',val);
        $.get(baseurl+"Data/load_view/"+val, function(data, status){
            $("#loadhere<?php echo $id;?>").append(data);
        });

    });

$(".addFields").click(function(){
    var idField =localStorage.getItem('aCounter');
    $('#groupdermaga<?php echo $id;?>').append('<div class="form-group col-md-12" id="'+idField+'"><div class="col-md-3" style="padding-left:0;margin-top: 1rem;"><label for="dermaga">Dermaga Tipe</label><input type="text" namame="dermaga["'+idField+'"][]" id="dermaga" class="form-control" required placeholder="Dermaga Type"></div><div class="col-md-3" style="padding-left:0;margin-top: 1rem;"><label for="spesifikasi">Spesifikasi</label><input type="text" name="spesifikasi["'+idField+'"][]" id="spesifikasi" class="form-control" required placeholder="Spesifikasi"></div><div class="col-md-6" style="padding-left:0;margin-top: 1rem;"><label for="peruntukan">Peruntukan</label><input type="text" name="peruntukan["'+idField+'"][]" id="peruntukan" class="form-control" required placeholder="Peruntukan"></div><div class="col-md-3" style="padding-left:0;margin-top: 1rem;"><label for="kedalaman">Kedalaman</label><div class="input-group"><input type="number" name="meter["'+idField+'"][]" id="meter" class="form-control" required placeholder="Meter" aria-describedby="basic-addon1"><span class="input-group-addon" id="basic-addon1">M LWS</span></div></div><div class="col-md-3" style="padding-left:0;margin-top: 1rem;"><label for="kapasitas">Kapasitas</label><input type="number" name="kapasitas["'+idField+'"][]" id="kapasitas" class="form-control" required placeholder="Kapasitas"></div><div class="col-md-3"style="padding-left:0;margin-top: 1rem;"><label for="satuan">Satuan</label><select name="satuan["'+idField+'"][]" class="form-control" id="satuan" required><option value="">Pilih Satuan</option><option>FEET</option><option>GT</option><option>DWT</option></select></div><button type="button" class="btn btn-fill btn-danger btnHapus" onclick="rmvFields('+idField+')" style="margin-top: 3.3rem;margin-left: 10px;">Hapus</button></div>');
});

   

$('#provinsi_f<?php echo $id;?>').change(function(option, checked){
        var str = $('#provinsi_f<?php echo $id;?>').val();
        var provinsi = str.split("|");
        var param = {'provinsi':provinsi[0]};
        $.ajax({
            url : siteurl+'/Data/get_Kota2/',
            type: "POST",
            data: param,
            dataType: "JSON",
            success: function(data)
            {
                $('#kecamatan_f<?php echo $id;?>').html(data).removeClass('selectpicker').addClass('selectpicker').selectpicker('refresh');;


                setKelasExtra(provinsi[0],<?php echo $id;?>);

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data'); 
            }
        });
    });

    $('#kota_f<?php echo $id;?>').change(function(option, checked){
        var str = $('#kota_f<?php echo $id;?>').val();
        var kota_f = str.split("|");
        var param = {'kota':kota_f[0]};
        $.ajax({
            url : siteurl+'/Data/get_Kecamatan/',
            type: "POST",
            data: param,
            dataType: "JSON",
            success: function(data)
            {
                $('#kecamatan_f<?php echo $id;?>').html(data);
                $('#kecamatan_f<?php echo $id;?>').selectpicker('refresh');

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data'); 
            }
        });
    });




});

$('#kecamatan_f<?php echo $id;?>').change(function(option, checked){
        var str = $(this).val();
        var kecamatan = str.split("|");
        var param = {'kecamatan':kecamatan[0]};
        $.ajax({
            url : siteurl+'/Data/get_Kelurahan/',
            type: "POST",
            data: param,
            dataType: "JSON",
            success: function(data)
            {
                $('#kelurahan_f<?php echo $id;?>').html(data);
                $('#kelurahan_f<?php echo $id;?>').selectpicker('refresh');

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data'); 
            }
        });
    });


// function addFields(){

//    var idField = Math.random();

//    $('#groupdermaga<?php echo $id;?>').append('<div class="form-group col-md-12" id="'+idField+'"><div class="col-md-3" style="padding-left:0;margin-top: 1rem;"><label for="dermaga">Dermaga Tipe</label><input type="text" namame="dermaga[]" id="dermaga" class="form-control" required placeholder="Dermaga Type"></div><div class="col-md-3" style="padding-left:0;margin-top: 1rem;"><label for="spesifikasi">Spesifikasi</label><input type="text" name="spesifikasi[]" id="spesifikasi" class="form-control" required placeholder="Spesifikasi"></div><div class="col-md-6" style="padding-left:0;margin-top: 1rem;"><label for="peruntukan">Peruntukan</label><input type="text" name="peruntukan[]" id="peruntukan" class="form-control" required placeholder="Peruntukan"></div><div class="col-md-3" style="padding-left:0;margin-top: 1rem;"><label for="kedalaman">Kedalaman</label><div class="input-group"><input type="number" name="meter[]" id="meter" class="form-control" required placeholder="Meter" aria-describedby="basic-addon1"><span class="input-group-addon" id="basic-addon1">M LWS</span></div></div><div class="col-md-3" style="padding-left:0;margin-top: 1rem;"><label for="kapasitas">Kapasitas</label><input type="number" name="kapasitas[]" id="kapasitas" class="form-control" required placeholder="Kapasitas"></div><div class="col-md-3"style="padding-left:0;margin-top: 1rem;"><label for="satuan">Satuan</label><select name="satuan[]" class="form-control" id="satuan" required><option value="">Pilih Satuan</option><option>FEET</option><option>GT</option><option>DWT</option></select></div><button type="button" class="btn btn-fill btn-danger btnHapus" onclick="rmvFields('+idField+')" style="margin-top: 3.3rem;margin-left: 10px;">Hapus</button></div>');

// }




</script>