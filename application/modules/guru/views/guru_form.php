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
                        <a href="<?php echo base_url('guru') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form action="<?php echo $action; ?>" method="post">
                         <div class="form-group <?php if(form_error('nama_guru')) echo 'has-error'?> ">
                            <label for="varchar">Nama Guru</label>
                            <input type="text" class="form-control" name="nama_guru" id="nama_guru" placeholder="Nama Guru" value="<?php echo $nama_guru; ?>" />
                            <?php echo form_error('nama_guru', '<small style="color:red">','</small>') ?>
                        </div>
                        <div class="form-group <?php if(form_error('nip')) echo 'has-error'?> ">
                            <label for="varchar">Nip</label>
                            <input type="text" class="form-control" name="nip" id="nip" placeholder="Nip" value="<?php echo $nip; ?>" />
                            <?php echo form_error('nip', '<small style="color:red">','</small>') ?>
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
                        <?php if ($button == 'Create'): ?>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" id="password" name="password" class="form-control password <?php if(form_error('password')) echo 'is-invalid'?>" placeholder="Password" value="<?php echo set_value('password') ?>">
                                <?php echo form_error('password', '<small style="color:red">','</small>') ?>
                            </div>
                        <?php endif ?>
                        <input type="hidden" name="id_guru" value="<?php echo $id_guru; ?>" /> 
                        <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>