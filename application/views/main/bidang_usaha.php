<div class="contents">
                <div class="container-fluid">
                    <div class="row">
                        <h2 class="title"></h2>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header-master">
                                    <div class="header">
                                        <h4 class="title">BIDANG USAHA</h4>
                                        <p class="category" style="color: #AAAAAA; font-weight: 300;"><?php echo $total;?> Bidang Usaha </p>
                                    </div>
                                    <span class="fa fa-bar-chart"></span>
                                </div>
                               
                                <div class="content">

                                    <h2 class="description">Total Bidang Usaha : <?php echo $total;?></h4> 

                                    <div class="warp-toolbar" style="margin: 1rem 0;">
                                        <form action="" style="display: contents;">
                                            <input type="text" id="searchbox" class="searchbutton" placeholder="Silahkan cari data disini">
                                        </form>
                                      
                                        <a href="<?php echo $baseurl;?>bidang_usaha/create" class="btn btn-success btn-fill" style="float: right;">
                                            <i class="fa fa-plus"></i>
                                            <span>Buat Bidang Usaha Baru</span>  
                                        </a>
                                    </div>

                                        <div class="material-datatables">
                                            <table id="datatables" class="table table-responsive table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                                <thead style="color: #FFFFFF;font-weight: 600;font-size: 12px;">
                                                    <tr role="row" style="background-color:#43425D;">
                                                        <th>No</th>
                                                        <th>NAMA BIDANG USAHA</th>
                                                        <th>KATEGORI</th>
                                                        <th>TOTAL PERUSAHAAN</th>
                                                        <th class="disabled-sorting">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr role="row">
                                                        <td>1</td>
                                                        <td>GALANGAN KAPAL</td>
                                                        <td>DOK DAN GALANGAN</td>
                                                        <td>200 Perusahaan</td> 
                                                        <td>
                                                            <a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                                            <button id="delete" data-toggle="modal" data-target="#delete-modal" class="btn btn-simple btn-danger btn-icon remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr role="row">
                                                        <td>2</td>
                                                        <td>INDUSTRI BETON</td>
                                                        <td>INDUSTRI</td>
                                                        <td>200 Perusahaan</td>          
                                                        <td>
                                                            <a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                                            <button id="delete" data-toggle="modal" data-target="#delete-modal" class="btn btn-simple btn-danger btn-icon remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr role="row">
                                                        <td>3</td>
                                                        <td>PEMANFAATAN HASIL HUTAN KAYU</td>
                                                        <td>KEHUTANAN</td>
                                                        <td>200 Perusahaan</td> 
                                                        <td>
                                                            <a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                                            <button id="delete" data-toggle="modal" data-target="#delete-modal" class="btn btn-simple btn-danger btn-icon remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr role="row">
                                                        <td>4</td>
                                                        <td>PERTAMBANGAN BATUBARA</td>
                                                        <td>PERTAMBANGAN</td>
                                                        <td>200 Perusahaan</td> 
                                                        <td>
                                                            <a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                                            <button id="delete" data-toggle="modal" data-target="#delete-modal" class="btn btn-simple btn-danger btn-icon remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr role="row">
                                                        <td>4</td>
                                                        <td>INDUSTRI PEMBUATAN KAPAL</td>
                                                        <td>INDUSTRI</td>
                                                        <td>200 Perusahaan</td> 
                                                        <td>
                                                            <a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                                            <button id="delete" data-toggle="modal" data-target="#delete-modal" class="btn btn-simple btn-danger btn-icon remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr role="row">
                                                        <td>4</td>
                                                        <td>PENYEDIA TENAGA LISTRIK</td>
                                                        <td>ENERGI</td>
                                                        <td>200 Perusahaan</td> 
                                                        <td>
                                                            <a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                                            <button id="delete" data-toggle="modal" data-target="#delete-modal" class="btn btn-simple btn-danger btn-icon remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
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
        $('#datatables').DataTable({
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
                "url": '<?php echo $siteurl;?>/bidang_usaha/gets',
                "type": "POST"
                
            },
            "ordering": false,
            "scrollX": true,
            columns : [
                { width : '5%' },
                { width : '40%' },
                { },
                { className : "text-center"},        
                { }
            ],
            });

   
        var dataTable = $('#datatables').dataTable();
        $("#searchbox").keyup(function() {
            dataTable.fnFilter(this.value);
        });    
    

        $('.card .material-datatables label').addClass('form-group');

         // MODAL DELETE
         $('#delete-modal').on('show.bs.modal',function() { 
            $('.btn-del').click('.remove',function(e) {
                var id = $(".remove").attr("personal-id");
                var param = {"id" : id}
                $.ajax({
                    type: "POST",
                    url: "<?php echo $baseurl;?>bidang_usaha/submit/delete",
                    data: param,
                    success: function(e){
                      window.location.href="<?php echo $baseurl;?>bidang_usaha";
                    },
                    dataType: "JSON"
                });
            
            
              e.preventDefault();
            });
        });

    });
</script>

</html>
