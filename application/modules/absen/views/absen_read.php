
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
            <a href="<?php echo base_url('absen') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
          </div>
        </div>
      </div>
      <div class="box-body">
       <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
         <table class="table">
           <tr><td>Siswa</td><td><?php echo $nama_siswa; ?></td></tr>
           <tr><td>Tanggal</td><td><?php echo $tgl; ?></td></tr>
           <tr><td>Status</td><td><?php echo $status; ?></td></tr>
           <tr><td>Lampiran</td><td><img src="<?php echo base_url('uploads/') . $lampiran ?>" alt="" class="img-responsive"></td></tr>
         </table>
       </div>
     </div>
   </div>
 </div>
</div>
</div>