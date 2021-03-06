<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active"><?= $title; ?></li>
                            </ol>
                        </div>
                        <h4 class="page-title"><?= $title; ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-7">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <h4 class="header-title">Data <?= $title; ?></h4>

                            <?= $this->session->flashdata('success'); ?>
                            <?= $this->session->flashdata('error'); ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID Alternatif</th>
                                        <th>Nama Alternatif</th>
                                        <th>Bobot Alternatif</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($get_alternatif  as $data) : ?>
                                        <tr>
                                            <td><?= $data->alternatif_id ?></td>
                                            <td><?= $data->nama ?></td>
                                            <td><?= $data->bobot ?></td>
                                            <td>
                                                <a href="" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $data->id ?>"><i class="fe-edit"></i> Edit</a>
                                                <a href="<?= base_url('backend/data/hapus_alternatif/') . $data->id ?>" class="btn btn-danger hapus"><i class="fe-trash"></i> Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
                <?php if ($total_alternatif < 3) : ?>
                    <div class="col-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Tambah <?= $title; ?></h4>
                                <p class="text-muted font-13 mb-4">
                                    Tambah data alternatif, dengan cara mengisi form yang ada di bawah tanpa ada input teks yang kosong!
                                    <code>Input Teks harus terisi semua</code>.
                                </p>

                                <?php echo form_open("backend/data/tambah_alternatif/"); ?>
                                <input type="hidden" name="id_user" value="<?= $session->id ?>">
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="form-group mb-3">
                                            <label for="alternatif_id">ID Alternatif <span class="text-danger">*</span></label>
                                            <select name="alternatif_id" id="alternatif_id" class="form-control">
                                                <option value="A1">A1</option>
                                                <option value="A2">A2</option>
                                                <option value="A3">A3</option>
                                            </select>
                                            <small>Inpur ID alternatif anda A1, A2 dan A3</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="url">Nama Alternatif <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" id="nama" name="nama" class="form-control" value="<?= set_value('nama') ?>" require>
                                    </div>
                                    <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
                                </div>

                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                                <?php echo form_close(); ?>

                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                <?php endif; ?>

            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->

    <!-- sample modal content -->
    <?php foreach ($get_alternatif as $edit) : ?>
        <div id="edit<?= $edit->id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit <?= $title ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                    </div>
                    <?php echo form_open("backend/data/edit_alternatif"); ?>
                    <div class="modal-body p-4">

                        <input type="hidden" name="id_user" value="<?= $session->id ?>">
                        <input type="hidden" name="id" value="<?= $edit->id ?>">
                        <div class="form-group mb-3">
                            <label for="url">Nama Alternatif <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id="nama" name="nama" class="form-control" value="<?= $edit->nama ?>" require>
                            </div>
                            <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light">Save changes</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div><!-- /.modal -->
    <?php endforeach; ?>