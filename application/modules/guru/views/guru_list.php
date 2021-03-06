
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
                        <a href="<?php echo base_url('guru/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%">
                        <tr>
                            <th>No</th>
                            <th>Nama Guru</th>
                            <th>Nip</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th>Email</th>
                            <th>Action</th>
                            </tr><?php
                            foreach ($guru_data as $guru)
                            {
                                ?>
                                <tr>
                                 <td><?php echo ++$start ?></td>
                                 <td><?php echo $guru->nama_guru ?></td>
                                 <td><?php echo $guru->nip ?></td>
                                 <td><?php echo $guru->alamat ?></td>
                                 <td><?php echo $guru->no_telepon ?></td>
                                 <td><?php echo $guru->email ?></td><td>
                                    <a href="<?php echo site_url('guru/read/' . $guru->id_guru ) ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                    <a href="<?php echo site_url('guru/update/' . $guru->id_guru ) ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <a data-href="<?php echo site_url('guru/delete/' . $guru->id_guru ) ?>" class="btn btn-danger hapus-data"><i class="fa fa-trash"></i></a>
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
