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
                        <a href="<?php echo base_url('tugas_siswa') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group <?php if(form_error('id_siswa')) echo 'has-error'?> ">
                                <label for="int">Siswa</label>
                                <?php if ($this->session->userdata('level') == 'Admin'): ?>
                                    <select name="id_siswa" id="id_siswa" class="form-control">
                                        <option value="">-- Pilih siswa --</option>
                                        <?php foreach ($siswa as $row): ?>
                                            <option value="<?php echo $row->id_siswa ?>" <?php echo $id_siswa == $row->id_siswa ? 'selected' : '' ?>><?php echo $row->nama_siswa ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <?php else : ?>
                                        <?php $id_siswa = $this->db->get('siswa', ['id_user' => $this->session->userdata('id_user') ])->row()->id_siswa; ?>
                                        <input type="hidden" name="id_siswa" value="<?php echo $id_siswa ?>">
                                        <input type="text" class="form-control" value="<?php echo $this->session->userdata('nama_user'); ?>" readonly>
                                    <?php endif ?>
                                    <?php echo form_error('id_siswa', '<small style="color:red">','</small>') ?>
                                </div>
                                <div class="form-group <?php if(form_error('id_tugas')) echo 'has-error'?> ">
                                    <label for="int">Tugas</label>
                                    <select name="id_tugas" id="id_tugas" class="form-control">
                                        <option value="">-- pilih tugas --</option>
                                        <?php foreach ($tugas as $row): ?>
                                            <option value="<?php echo $row->id_tugas ?>" <?php echo $id_tugas == $row->id_tugas ? 'selected' : '' ?>><?php echo $row->judul ?></option>
                                        <?php endforeach ?>
                                    </select>

                                    <?php echo form_error('id_tugas', '<small style="color:red">','</small>') ?>
                                </div>
                                <div class="form-group <?php if(form_error('deskripsi')) echo 'has-error'?> ">
                                    <label for="varchar">Deskripsi</label>
                                    <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi" value="<?php echo $deskripsi; ?>" />
                                    <?php echo form_error('deskripsi', '<small style="color:red">','</small>') ?>
                                </div>
                                <div class="form-group <?php if(form_error('lampiran')) echo 'has-error'?> ">
                                    <label for="varchar">Lampiran</label>
                                    <input required="" type="file" class="form-control" name="lampiran" id="lampiran" placeholder="Lampiran" value="<?php echo $lampiran; ?>" />
                                    <?php echo form_error('lampiran', '<small style="color:red">','</small>') ?>
                                </div>
                                <input type="hidden" name="id_tugas_siswa" value="<?php echo $id_tugas_siswa; ?>" /> 
                                <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>