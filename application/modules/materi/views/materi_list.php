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
                        <a href="<?php echo base_url('materi/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%">
                        <tr>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Guru</th>
                            <th>Pelajaran</th>
                            <th>Judul</th>
                            <th>Lampiran</th>
                            <th>Tahun Angkatan</th>
                            <th>Action</th>
                            </tr><?php
                            foreach ($materi_data as $materi)
                            {
                                ?>
                                <tr>
                                   <td><?php echo ++$start ?></td>
                                   <td><?php echo $materi->nama_kelas ?></td>
                                   <td><?php echo $materi->nama_guru ?></td>
                                   <td><?php echo $materi->nama_pelajaran ?></td>
                                   <td><?php echo $materi->judul ?></td>
                                   <td><?php echo $materi->lampiran ?></td>
                                   <td><?php echo $materi->tahun_angkatan ?></td><td>
                                    <a href="<?php echo site_url('materi/read/' . $materi->id_materi ) ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                    <a href="<?php echo site_url('materi/update/' . $materi->id_materi ) ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <a data-href="<?php echo site_url('materi/delete/' . $materi->id_materi ) ?>" class="btn btn-danger hapus-data"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>

                    </div>
                    <div class="col-md-6 text-right">
                        <?php echo $pagination ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
       $(document).on("click", ".hapus-data", function () {
          hapus($(this).data("href"));
      });
   });
</script>
