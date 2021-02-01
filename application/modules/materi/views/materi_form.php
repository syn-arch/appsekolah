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
                        <a href="<?php echo base_url('materi') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
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
                                <option value="">-- Pilih kelas --</option>
                                <?php foreach ($kelas as $row): ?>
                                    <option value="<?php echo $row->id_kelas ?>" <?php echo $id_kelas == $row->id_kelas ? 'selected' : '' ?>><?php echo $row->nama_kelas ?></option>
                                <?php endforeach ?>
                            </select>
                            <?php echo form_error('id_kelas', '<small style="color:red">','</small>') ?>
                        </div>
                        <div class="form-group <?php if(form_error('id_guru')) echo 'has-error'?> ">
                            <label for="int">Guru</label>
                            <select name="id_guru" id="id_guru" class="form-control">
                                <option value="">-- Pilih guru --</option>
                                <?php foreach ($guru as $row): ?>
                                    <option value="<?php echo $row->id_guru ?>" <?php echo $id_guru == $row->id_guru ? 'selected' : '' ?>><?php echo $row->nama_guru ?></option>
                                <?php endforeach ?>
                            </select>
                            <?php echo form_error('id_guru', '<small style="color:red">','</small>') ?>
                        </div>
                        <div class="form-group <?php if(form_error('id_pelajaran')) echo 'has-error'?> ">
                            <label for="int">Pelajaran</label>
                            <select name="id_pelajaran" id="id_pelajaran" class="form-control">
                                <option value="">-- Pilih pelajaran --</option>
                                <?php foreach ($pelajaran as $row): ?>
                                    <option value="<?php echo $row->id_pelajaran ?>" <?php echo $id_pelajaran == $row->id_pelajaran ? 'selected' : '' ?>><?php echo $row->nama_pelajaran ?></option>
                                <?php endforeach ?>
                            </select>

                            <?php echo form_error('id_pelajaran', '<small style="color:red">','</small>') ?>
                        </div>
                        <div class="form-group <?php if(form_error('judul')) echo 'has-error'?> ">
                            <label for="varchar">Judul</label>
                            <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" value="<?php echo $judul; ?>" />
                            <?php echo form_error('judul', '<small style="color:red">','</small>') ?>
                        </div>
                        <div class="form-group <?php if(form_error('deskripsi')) echo 'has-error'?> ">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" rows="3" name="deskripsi" id="deskripsi" placeholder="Deskripsi"><?php echo $deskripsi; ?></textarea>
                            <?php echo form_error('deskripsi', '<small style="color:red">','</small>') ?>
                        </div>
                        <div class="form-group <?php if(form_error('lampiran')) echo 'has-error'?> ">
                            <label for="varchar">Lampiran</label>
                            <input type="text" class="form-control" name="lampiran" id="lampiran" placeholder="Lampiran" value="<?php echo $lampiran; ?>" />
                            <?php echo form_error('lampiran', '<small style="color:red">','</small>') ?>
                        </div>
                        <div class="form-group <?php if(form_error('tahun_angkatan')) echo 'has-error'?> ">
                            <label for="int">Tahun Angkatan</label>
                            <input type="text" class="form-control" name="tahun_angkatan" id="tahun_angkatan" placeholder="Tahun Angkatan" value="<?php echo $tahun_angkatan; ?>" />
                            <?php echo form_error('tahun_angkatan', '<small style="color:red">','</small>') ?>
                        </div>
                        <input type="hidden" name="id_materi" value="<?php echo $id_materi; ?>" /> 
                        <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>