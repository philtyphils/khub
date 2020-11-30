<div class="contents">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="header" style="background-color: #43425D">
                        <h4 class="title" style="color: #ffff;">Edit Bidang Usaha</h4>
                    </div>
                    <div class="card-form">
                        <?php echo $this->session->flashdata('teks'); ?>
                        <form action="<?php echo $baseurl;?>bidang_usaha/submit/edit/" method="POST">
                            <div class="row">
                                <div class="form-group">
                                    <label for="name">Nama Bidang Usaha</label>
                                    <input type="hidden" name="id" value="<?php echo $bidang_usaha[0]['bdg_usaha_id'];?>" />
                                    <input type="text" name="nama" id="" value="<?php echo strtoupper($bidang_usaha[0]['nama']);?>" class="form-control" required placeholder="Nama Bidang Usaha">
                                </div>
                                <div class="form-group col-md-12" style="padding:0">
                                    <label for="kategori usaha"  style="margin-bottom: 1rem;">KATEGORI USAHA</label>
                                    <select class="form-control" id="kategori_usaha" name="kategori_id">
                                            <option value="" readonly>Pilih Kategori Usaha</option>
                                            <?php foreach($kategori->result() as $key => $value): ?>
                                                <?php if($value->kategori_id == $bidang_usaha[0]['kategori_id']):?>
                                                    <option value="<?php echo $value->kategori_id;?>" selected><?php echo $value->nama;?></option>
                                                <?php else: ?>
                                                    <option value="<?php echo $value->kategori_id;?>"><?php echo $value->nama;?></option>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                    </select>                 
                                </div>
                                <button type="submit" class="btn btn-fill btn-success" style="margin-right: 1rem;">SIMPAN</button>
                                <a href="<?php echo $baseurl;?>bidang_usaha"  class="btn btn-fill btn-default" >KEMBALI</a>
                            </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo $baseurl;?>assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo $baseurl;?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $baseurl;?>assets/js/light-bootstrap-dashboard.js"></script>
<script src="<?php echo $baseurl;?>assets/js/bootstrap-select.min.js"></script>
<script src="<?php echo $baseurl;?>assets/js/jquery.datatables.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var table =  $('#datatables').DataTable({
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
            "ordering": false,
            "scrollX": true
        });

        $("#searchbox").keyup(function() {
            table.ajax.reload();
        });    
        
        $("#provinsi").change(function(){
            table.ajax.reload();
        });
        

        // Edit record
        table.on('click', '.edit', function() {
            $tr = $(this).closest('tr');

            var data = table.row($tr).data();
            alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
        });

        // Delete a record
        // table.on('click', '.remove', function(e) {
        //     $tr = $(this).closest('tr');
        //     table.row($tr).remove().draw();
        //     e.preventDefault();
        // });

        //Like record
        table.on('click', '.like', function() {
            alert('You clicked on Like button');
        });

        $('.card .material-datatables label').addClass('form-group');

        // MODAL DELETE
        $('#delete-modal').on('show.bs.modal',function() { 
            $('.btn-del').click('.remove',function(e) {
              $tr = $(this).closest('tr');
              table.row($tr).remove().draw();
              e.preventDefault();
            });
        });

    });

</script>

</html>