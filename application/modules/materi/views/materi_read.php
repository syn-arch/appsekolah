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
                 <table class="table">
                     <tr><td>Kelas</td><td><?php echo $nama_kelas; ?></td></tr>
                     <tr><td>Guru</td><td><?php echo $nama_guru; ?></td></tr>
                     <tr><td>Pelajaran</td><td><?php echo $nama_pelajaran; ?></td></tr>
                     <tr><td>Judul</td><td><?php echo $judul; ?></td></tr>
                     <tr><td>Deskripsi</td><td><?php echo $deskripsi; ?></td></tr>
                     <tr><td>Lampiran</td><td><img src="<?php echo base_url('uploads/') . $lampiran ?>" alt="" class="img-responsive"></td></tr>
                     <tr><td>Download</td><td><a href="<?php echo base_url('uploads/' . $lampiran) ?>" download class="btn btn-success">Download Lampiran</a></td></tr>
                     <tr><td>Tahun Angkatan</td><td><?php echo $tahun_angkatan; ?></td></tr>
                 </table>
             </div>
         </div>
     </div>
 </div>
</div>
</div>