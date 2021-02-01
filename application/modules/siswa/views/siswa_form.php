<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-left">
                    <div class="box-title">
                        <h4><?php echo $judul ?></h4>
                    </div>
                </div>
                <div class="pull-right">
                    <div class="box-title">
                        <a href="<?php echo base_url('siswa') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form action="<?php echo $action; ?>" method="post">
                           <div class="form-group <?php if(form_error('id_kelas')) echo 'has-error'?> ">
                            <label for="int">Kelas</label>
                            <select name="id_kelas" id="id_kelas" class="form-control">
                               <option value="">-- pilih kelas --</option>
                               <?php foreach ($kelas as $row): ?>
                                   <option value="<?php echo $row->id_kelas ?>" <?php echo $id_kelas == $row->id_kelas ? 'selected' : '' ?>><?php echo $row->nama_kelas ?></option>
                               <?php endforeach ?>
                           </select>

                           <?php echo form_error('id_kelas', '<small style="color:red">','</small>') ?>
                       </div>
                       <div class="form-group <?php if(form_error('nama_siswa')) echo 'has-error'?> ">
                        <label for="varchar">Nama Siswa</label>
                        <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" placeholder="Nama Siswa" value="<?php echo $nama_siswa; ?>" />
                        <?php echo form_error('nama_siswa', '<small style="color:red">','</small>') ?>
                    </div>
                    <div class="form-group <?php if(form_error('nis')) echo 'has-error'?> ">
                        <label for="varchar">Nis</label>
                        <input type="text" class="form-control" name="nis" id="nis" placeholder="Nis" value="<?php echo $nis; ?>" />
                        <?php echo form_error('nis', '<small style="color:red">','</small>') ?>
                    </div>
                    <div class="form-group <?php if(form_error('alamat')) echo 'has-error'?> ">
                        <label for="varchar">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
                        <?php echo form_error('alamat', '<small style="color:red">','</small>') ?>
                    </div>
                    <div class="form-group <?php if(form_error('no_telepon')) echo 'has-error'?> ">
                        <label for="varchar">No Telepon</label>
                        <input type="text" class="form-control" name="no_telepon" id="no_telepon" placeholder="No Telepon" value="<?php echo $no_telepon; ?>" />
                        <?php echo form_error('no_telepon', '<small style="color:red">','</small>') ?>
                    </div>
                    <div class="form-group <?php if(form_error('email')) echo 'has-error'?> ">
                        <label for="varchar">Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
                        <?php echo form_error('email', '<small style="color:red">','</small>') ?>
                    </div>
                    <div class="form-group <?php if(form_error('tahun_angkatan')) echo 'has-error'?> ">
                        <label for="int">Tahun Angkatan</label>
                        <input type="text" class="form-control" name="tahun_angkatan" id="tahun_angkatan" placeholder="Tahun Angkatan" value="<?php echo $tahun_angkatan; ?>" />
                        <?php echo form_error('tahun_angkatan', '<small style="color:red">','</small>') ?>
                    </div>
                    <input type="hidden" name="id_siswa" value="<?php echo $id_siswa; ?>" /> 
                    <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>