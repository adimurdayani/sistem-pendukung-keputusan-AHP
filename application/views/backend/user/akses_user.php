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
                                <li class="breadcrumb-item"><a href="<?= base_url('backend/user') ?>">User Manajemen</a></li>
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
                            <p class="sub-header">
                                Tipe User: <code><?= $get_akses->description ?></code>.
                            </p>
                            <?= $this->session->flashdata('sukses'); ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th>Akses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($get_menu as $menu) : ?>
                                        <tr>
                                            <td><?= $menu->menu ?></td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" <?= check_access($get_akses->id, $menu->id); ?> data-group="<?= $get_akses->id ?>" data-menu="<?= $menu->id ?>">
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <a href="<?= base_url('backend/grup') ?>" class="btn btn-secondary"><i class="fe-arrow-left"></i> Kembali</a>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->
    <?php $this->load->view('template/footer');    ?>
    <script>
        $('.form-check-input').on('click', function() {
            const menu_id = $(this).data('menu');
            const group_id = $(this).data('group');

            $.ajax({
                url: "<?= base_url() ?>backend/akses_user/ubah_akses",
                type: 'POST',
                data: {
                    menu_id: menu_id,
                    group_id: group_id
                },
                success: function(data) {
                    // document.location.href = "<?= base_url() ?>backend/akses_user/get_akses/" + group_id;
                    if (data != null) {
                        Swal.fire({
                            type: "success",
                            title: "Akses berhasil diubah!",
                            showConfirmButton: !1,
                            timer: 1500
                        })
                        return false;
                    }
                }
            })
        })
    </script>