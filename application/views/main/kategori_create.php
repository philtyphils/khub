<div class="main-panel">
    <div class="contents">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="header" style="background-color: #43425D">
                            <h4 class="title" style="color: #ffff;">Create Kategori Usaha</h4>
                        </div>
                        <?php echo $this->session->flashdata('teks'); ?>
                        <div class="card-form">
                            <form action="<?php echo $baseurl;?>Kategori/submit/create" method="POST">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="name">Nama Kategori</label>
                                        <input type="text" name="name" id="nama" class="form-control" required placeholder="Nama Kategori Usaha">
                                    </div>
                                    <button type="submit" class="btn btn-fill btn-success" style="margin-right: 1rem;">SIMPAN</button>
                                    <a href="<?php echo $baseurl."Kategori";?>"  class="btn btn-fill btn-default" >KEMBALI</a>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>