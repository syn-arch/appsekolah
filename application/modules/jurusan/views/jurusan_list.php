
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
                        <a href="<?php echo base_url('jurusan/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%">
                        <tr>
                            <th>No</th>
                            <th>Nama Jurusan</th>
                            <th>Action</th>
                            </tr><?php
                            foreach ($jurusan_data as $jurusan)
                            {
                                ?>
                                <tr>
                                 <td><?php echo ++$start ?></td>
                                 <td><?php echo $jurusan->nama_jurusan ?></td><td>
                                    <a href="<?php echo site_url('jurusan/read/' . $jurusan->id_jurusan ) ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                    <a href="<?php echo site_url('jurusan/update/' . $jurusan->id_jurusan ) ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <a data-href="<?php echo site_url('jurusan/delete/' . $jurusan->id_jurusan ) ?>" class="btn btn-danger hapus-data"><i class="fa fa-trash"></i></a>
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
