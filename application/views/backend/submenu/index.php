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
                            <table id="basic-datatable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Menu</th>
                                        <th>Nama Sub Menu</th>
                                        <th>Url</th>
                                        <th>Icon</th>
                                        <th>Activasi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($get_submenu as $sm) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $sm->menu ?></td>
                                            <td><?= $sm->title; ?></td>
                                            <td><i class="fe-folder"></i><br><a href="<?= $sm->url; ?>" title="<?= $sm->url; ?>" data-plugin="tippy" data-tippy-placement="top">
                                                    <?= $sm->menu; ?></a></td>
                                            <td class="text-center"><i class="<?= $sm->icon; ?>"><br></i> <?= $sm->icon; ?></td>
                                            <td>
                                                <?php if ($sm->is_active == 1) : ?>
                                                    <div class="badge badge-success"><i class="fa fa-check"></i></div>
                                                <?php else : ?>
                                                    <div class="badge badge-danger">x</div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-warning" data-target="#edit<?= $sm->id ?>" data-toggle="modal" title="Update sub menu" data-plugin="tippy" data-tippy-placement="top"><i class="fe-edit"></i></a>
                                                <a href="<?= site_url('backend/submenu/hapus/') . $sm->id ?>" class="btn btn-sm btn-danger hapus" title="Hapus sub menu" data-plugin="tippy" data-tippy-placement="top"><i class="fe-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

                <div class="col-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Tambah <?= $title; ?></h4>
                            <p class="text-muted font-13 mb-4">
                                Tambah data sub menu, dengan cara isi form yang ada di bawah tanpa ada input teks yang kosong!
                                <code>Input Teks harus terisi semua</code>.
                            </p>

                            <?php echo form_open("backend/submenu/"); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="first_name">Pilih Grup Menu <span class="text-danger">*</span></label>
                                        <select name="menu_id" id="menu_id" class="form-control">
                                            <?php foreach ($get_menu as $menu) : ?>
                                                <option value="<?= $menu->id ?>"><?= $menu->menu ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="title">Nama Sub Menu <span class="text-danger">*</span></label>
                                        <input type="text" id="title" name="title" class="form-control" aria-describedby="basic-addon1" value="<?= set_value('title') ?>" require>
                                        <?= form_error('title', '<small class="text-danger">', '</small>') ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="url">Nama Url <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fe-folder"></i></span>
                                    </div>
                                    <input type="text" id="url" name="url" class="form-control" value="<?= set_value('url') ?>" require>
                                </div>
                                <?= form_error('url', '<small class="text-danger">', '</small>') ?>
                            </div>

                            <div class="form-group mb-3">
                                <label for="icon">Pilih Icon Menu <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fe-feather"></i></span>
                                    </div>
                                    <input type="text" id="icon" name="icon" class="form-control" value="<?= set_value('icon') ?>" require>
                                </div>
                                <?= form_error('icon', '<small class="text-danger">', '</small>') ?>
                            </div>

                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                            <?php echo form_close(); ?>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->

    <!-- sample modal content -->
    <?php foreach ($get_submenu as $edit) : ?>
        <div id="edit<?= $edit->id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Sub Menu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <?php echo form_open("backend/submenu/edit"); ?>
                    <div class="modal-body p-4">
                        <div class="row">
                            <input type="hidden" name="id" value="<?= $edit->id ?>">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="first_name">Pilih Grup Menu <span class="text-danger">*</span></label>
                                    <select name="menu_id" id="menu_id" class="form-control">
                                        <?php foreach ($get_menu as $menu) : ?>
                                            <option value="<?= $menu->id ?>" <?php if ($edit->menu_id == $menu->id) : ?>selected<?php endif; ?>><?= $menu->menu ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="title">Nama Sub Menu <span class="text-danger">*</span></label>
                                    <input type="text" id="title" name="title" class="form-control" aria-describedby="basic-addon1" value="<?= $edit->title ?>" require>
                                    <?= form_error('title', '<small class="text-danger">', '</small>') ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="url">Nama Url <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fe-folder"></i></span>
                                </div>
                                <input type="text" id="url" name="url" class="form-control" value="<?= $edit->url ?>" require>
                            </div>
                            <?= form_error('url', '<small class="text-danger">', '</small>') ?>
                        </div>

                        <div class="form-group mb-3">
                            <label for="icon">Pilih Icon Menu <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fe-feather"></i></span>
                                </div>
                                <input type="text" id="icon" name="icon" class="form-control" value="<?= $edit->icon ?>" require>
                            </div>
                            <?= form_error('icon', '<small class="text-danger">', '</small>') ?>
                        </div>

                        <div class="mt-3">
                            <label for="aktifasi">Aktivasi Sub Menu</label>
                            <div class="custom-control">
                                <input type="radio" name="is_active" value="1" <?php if ($edit->is_active == 1) : ?> checked <?php endif; ?>>
                                <label>Aktivasi</label>
                            </div>
                            <div class="custom-control ">
                                <input type="radio" name="is_active" value="0" <?php if ($edit->is_active == 0) : ?> checked <?php endif; ?>>
                                <label>Non-aktivasi</label>
                            </div>
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