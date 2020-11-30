<div class="contents">
    <div class="container-fluid">
        <div class="row">
                        <h2 class="title"></h2>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header-master">
                                    <div class="header">
                                        <h4 class="title">WILAYAH KERJA</h4>
                                        <p class="category" style="color: #AAAAAA; font-weight: 300;">Jumlah KELAS OP KSOP & KUPP</p>
                                    </div>
                                    <span class="fa fa-map-marker"></span>
                                </div>
                               
                                <div class="content">

                                    <h2 class="description">Total Wilayah Kerja : </h4> 

                                    <div class="warp-toolbar" style="margin: 1rem 0;">
                                        <form action="" style="display: contents;">
                                            <input type="text" id="searchbox" class="searchbutton" placeholder="Silahkan cari data disini" style="margin-right: 1rem;">
                                        </form>
                                        
                                        <select class="selectpicker" title="Provinsi" id="provinsi">
                                            <option value="" disabled> -- Pilih Provinsi -- </option>
                                            
                                            <?php foreach($wilayah_kerja->result() as $key => $value):?>
                                                <option value="<?php echo $value->kode;?>"><?php echo $value->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <a href="<?php echo $baseurl."kelas/create";?>" class="btn btn-success btn-fill" style="float: right;">
                                            <i class="fa fa-plus"></i>
                                            <span>Buat Kelas Baru</span>  
                                        </a>
                                    </div>

                                        <div class="material-datatables">
                                            <table id="datatables" class="table table-responsive table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                                <thead style="color: #FFFFFF;font-weight: 600;font-size: 12px;">
                                                    <tr role="row" style="background-color:#43425D;">
                                                        <th>No</th>
                                                        <th>NAMA WILAYAH KERJA</th>
                                                        <th>PROVINSI</th>
                                                        <th class="disabled-sorting">Actions</th>
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
</div>

<!-- MODAL DELETE-->
<div class="modal fade" id="delete-modal" role="dialog">
    <div class="modal-dialog modal-sm">
        <!--modal delete content start-->
        <div class="modal-content">
            <div class="modal-header" style="background-color: #43425D;color: #ffff;">
                <button type="button" class="close" data-dismiss="modal" style="color: #ffff;">&times;</button>
            </div>
            <div class="modal-body">
                <h5>Apakah anda Yakin akan Delete ?</h5>
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

<script src="<?php echo $baseurl;?>assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo $baseurl;?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $baseurl;?>assets/js/light-bootstrap-dashboard.js"></script>
<script src="<?php echo $baseurl;?>assets/js/bootstrap-select.min.js"></script>
<script src="<?php echo $baseurl;?>assets/js/jquery.datatables.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var table =  $('#datatables').DataTable({
            "processing": true, 
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            },
            "ajax": {
                "url": '<?php echo $siteurl;?>/Kelas/get_kelas',
                "type": "POST",
                "data": function(data){
                   data.searchbox = $('#searchbox').val();
                   data.provinsi = $('#provinsi').val();
                }
            },
            columns: [
                {},
                {},
                {},
                {}
            ],
            fnRowCallback: function(nRow,aData){
                //console.log(aData[2]);
                //if(aData[2] == "ACEH")
                //{
                //    $(nRow).addClass('alert alert-success');
                //}
            },
            "ordering": false,
            "scrollX": true
        });

        $("#searchbox").keyup(function() {
            table.ajax.reload();
        });    
        
        $("#provinsi").change(function(){
            table.ajax.reload();
        });
        

        $('.card .material-datatables label').addClass('form-group');

        // MODAL DELETE
        $('#delete-modal').on('show.bs.modal',function() { 
            $('.btn-del').click('.remove',function(e) {
                var id = $(".remove").attr("personal-id");
                var param = {"id" : id}

               $.ajax({
                 type: "POST",
                 url: "<?php echo $baseurl;?>Kelas/submit/delete",
                 data: param,
                 success: function(e){
                     window.location.href="<?php echo $baseurl;?>Kelas";
                   },
                 dataType: "JSON"
               });
            
            
              e.preventDefault();
            });
        });

    });

</script>
</html>