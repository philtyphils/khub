<div class="contents">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="header" style="background-color: #43425D">
                        <h4 class="title" style="color: #ffff;">Create KELAS</h4>
                    </div>
                    <div class="card-form">
                        <?php echo $this->session->flashdata('teks'); ?>
                        <form action="<?php echo $baseurl."kelas/submit/create";?>" method="POST">
                            <div class="row">
                                <div class="form-group">
                                    <label for="name">Nama Kelas</label>
                                    <input type="text" name="name" id="nama_kelas" class="form-control" required placeholder="Nama Kelas">
                                </div>
                                <div class="form-group">
                                    <label for="kelas">KELAS OP KSOP & KUPP</label>
                                    <select name="kelas" class="form-control" id="wilayah_kerja" required>
                                        <option value="" disabled>Pilih OP KSOP & KUPP</option>
                                        <option value="1">OP</option>
                                        <option value="2">KSOP KELAS I</option>
                                        <option value="3">KSOP KELAS II</option>
                                        <option value="4">KSOP KELAS III</option>
                                        <option value="5">KSOP KELAS IV</option>
                                        <option value="6">KSOP KELAS V</option>
                                        <option value="100">KUPP KELAS I</option>
                                        <option value="101">KUPP KELAS II</option>
                                        <option value="102">KUPP KELAS III</option>
                                        <option value="103">KUPP KELAS IV</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="provinsi">PROVINSI</label>
                                    <select name="provinsi" class="form-control" id="provinsi" required>
                                        <option value="" disabled>Pilih Provinsi</option>
                                        <?php foreach($provinsi->result() as $key => $value): ?>
                                            <option value="<?php echo $value->kode;?>"><?php echo $value->nama;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-fill btn-success" style="margin-right: 1rem;">SIMPAN</button>
                                <a href="<?php echo $baseurl."kelas";?>"  class="btn btn-fill btn-default" >KEMBALI</a>
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