<script type="text/javascript" src="<?php echo $baseurl;?>assets/js/data.js?v=<?php echo uniqid(); ?>"></script> 

        <div class="contents">
                <div class="container-fluid">
                    <div class="row">
                        <h2 class="title"></h2>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header-master">
                                    <div class="header">
                                        <h4 class="title">TUKS & TERSUS DATATABLE</h4>
                                        <p class="category" style="color: #AAAAAA; font-weight: 300;">REKAPITULASI TERSUS DAN TUKS DATATABLE </p>
                                    </div>
                                    <span class="fa fa-folder-open"></span>
                                </div>
                                <div class="card-content" style="padding-top: 100px;">

                                    <div class="warp-toolbar">
                                        <input type="text" id="searchbox" class="searchbutton" placeholder="Silahkan cari data disini">
                                    </div>
                                   

                                    <div class="toolbar">
                                        <div class="warp-toolbar">
                                        <select name="provinsi[]" id="provinsi" class="selectpicker"  multiple data-live-search="true" title="Provinsi">
                                             <?php for($i=0;$i<count($dataProvinsi);$i++){?>
                                                <option value="<?php echo trim($dataProvinsi[$i]->id); ?>"><?php echo $dataProvinsi[$i]->name; ?></option>
                                              <?php } ?>
                                        </select>

                                        <select name="kelas[]" id="kelas" class="selectpicker" multiple data-live-search="true" title="Kelas" id="box">
                                            
                                        </select>

                                        <select name="bidang_us[]" id="bidang_us" class="selectpicker" multiple data-live-search="true" title="Kategori" id="box">
                                            <?php for($k=0;$k<count($dataBdgUsaha);$k++){?>
                                                <option value="<?php echo trim($dataBdgUsaha[$k]->bdg_usaha_id); ?>"><?php echo $dataBdgUsaha[$k]->nama; ?></option>
                                              <?php } ?>
                                        </select>
                                        </div>
                                        
                                    <div class="warp-toolbar">
                                        <!-- <a href="" class="btn btn-primary btn-fill">
                                            <i class="fa fa-search"></i>
                                            <span>Cari</span>  
                                        </a> -->
                                        <a href="<?php echo $siteurl;?>/Form" class="btn btn-success btn-fill" style="margin-right: 1rem;">
                                            <i class="fa fa-plus"></i>
                                            <span>Buat Data Baru</span>  
                                        </a>
                                        <a href="" class="btn btn-info btn-fill">
                                            <i class="fa fa-download"></i>
                                            <span>Export Data Excel</span>   
                                        </a>        
                                    </div>
                                    </div>

                                    <div class="material-datatables">
                                        <table id="datatables" class="table table-responsive table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                            <thead style="color: #FFFFFF;font-weight: 600;font-size: 12px;">
                                                <tr role="row" style="background-color:#43425D;">
                                                    <th style="width:60px">No</th>
                                                    <th>NAMA</th>
                                                    <th>KELAS</th>
                                                    <th style="width:150px !important;">BIDANG USAHA</th>
                                                    <th>KATEGORI</th>
                                                    <th>LOKASI</th>
                                                    <th>DMS</th>
                                                    <th style="width:100px">TERSUS / TUSK</th>
                                                    <th >SK</th>
                                                    <th>TERBIT</th>
                                                    <th style="width:100px">STATUS</th>
                                                    <th style="width:100px">MASA BERLAKU</th>
                                                    <th class="disabled-sorting" style="width:50px">ACTIONS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>