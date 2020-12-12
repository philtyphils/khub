<div class="contents">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="header" style="background-color: #43425D">
                        <h4 class="title" style="color: #ffff;">Edit Wilayah Kategori</h4>
                    </div>
                    <div class="card-form">
                        <?php echo $this->session->flashdata('teks'); ?>
                        <form action="<?php echo $baseurl."kelas/submit/edit/"?>" method="POST">
                            <input type="hidden" name="id" value="<?php echo (int) $kategori[0]['ksop_id']; ?>"/>
                            <div class="row">
                                <div class="form-group">
                                    <label for="name">Nama Kelas</label>
                                    <input type="text" name="name" id="nama_kelas" value="<?php echo strtoupper($kategori[0]['nama']);?>" class="form-control" required placeholder="Nama Kelas">
                                </div>
                                <div class="form-group">
                                    <label for="provinsi">PROVINSI</label>
                                    <select name="provinsi" class="form-control" id="provinsi" required>
                                        <option value="" disabled>Pilih Provinsi</option>
                                        <?php foreach($provinsi->result() as $key => $value): ?>
                                            <?php if($value->kode == $kategori[0]['provinsi_id']): ?>
                                            <option value="<?php echo htmlentities($value->kode);?>" selected><?php echo htmlentities($value->nama);?></option>
                                            <?php else: ?>
                                            <option value="<?php echo htmlentities($value->kode);?>"><?php echo htmlentities($value->nama);?></option>
                                            <?php endif; ?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-fill btn-success" style="margin-right: 1rem;">
                                <i class="fa fa-check" aria-hidden="true" style="margin-right: 4px;"></i>
                                SIMPAN</button>
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
<script src="<?php echo $baseurl;?>assets/js/sweetalert2.js" type="text/javascript"></script>

<?php if ($this->session->flashdata('success')): ?>
<script>
swal.fire({
  title: "Berhasil",
  text: "Data Berhasil Dibuat",
  button: false,
  icon: 'success',
  showCloseButton: true,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('info')): ?>
<script>
swal.fire({
  title: "Edit",
  text: "Data Berhasil Di Edit",
  button: false,
  icon: 'success',
  showCloseButton: true,
 
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('delete')): ?>
<script>
swal.fire({
  title: "Delete",
  text: "Data Berhasil Di Delete",
  button: false,
  icon: 'success',
  showCloseButton: true,
});
</script>
<?php endif; ?>

</html>