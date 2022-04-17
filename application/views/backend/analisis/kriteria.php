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

            <?php if ($get_total_baris_satu < 3) : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <h4 class="header-title"> <?= $title; ?></h4>
                                <?php echo form_open('backend/analisis/perbandingan') ?>
                                <input type="hidden" name="id_user" value="<?= $session->id ?>">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="id_kriteria" id="id_kriteria" class="form-control">
                                                <?php foreach ($get_kriteria as $data) : ?>
                                                    <option value="<?= $data->id ?>"><?= $data->nama ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="nilai_kriteria" id="" class="form-control">
                                                <?php foreach ($get_frekuensi as $nf1) : ?>
                                                    <option value="<?= $nf1->nilai ?>"><?= $nf1->nilai ?>. <?= $nf1->nama ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="id_kriteria_dua" id="" class="form-control">
                                                <?php foreach ($get_kriteria as $data) : ?>
                                                    <option value="<?= $data->id ?>"><?= $data->nama ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Kirim</button>
                                <?php echo form_close() ?>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->

                </div>
                <!-- end row-->
            <?php endif; ?>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="header-title"> Pairwise Comparison</h4>
                                    <p>Tabel ini digunakan untuk menentunkan nilai perbandingan dari kriteria yang telah diinputkan</p>
                                    <form action="<?= base_url('backend/analisis/hapus_all/') ?>" method="POST" id="form-delete">
                                        <button type="submit" class="btn btn-danger mb-2" id="hapus"><i class="fa fa-trash"></i> Hapus</button>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="chack-all"></th>
                                                    <th></th>
                                                    <?php foreach ($get_kriteria as $k) : ?>
                                                        <th><?= $k->kriteria_id ?></th>
                                                    <?php endforeach; ?>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php foreach ($get_kriteria as $p) : ?>
                                                    <tr>
                                                        <td style="width: 40px;"><input type="checkbox" class="check-item" name="id[]" value="<?= $p->id_user ?>"></td>
                                                        <td> <?= $p->kriteria_id ?></td>

                                                        <?php
                                                        $id_kriteria = $p->id;
                                                        $perbandingan = "SELECT *
                                                                FROM    `perbandingan` JOIN `kriteria`
                                                                ON      `perbandingan`.`id_kriteria` = `kriteria`.`id`
                                                                WHERE   `perbandingan`.`id_kriteria` = $id_kriteria";
                                                        $getperbandingan = $this->db->query($perbandingan)->result();
                                                        ?>

                                                        <?php foreach ($getperbandingan as $n) : ?>
                                                            <td><?= $n->nilai_kriteria ?></td>
                                                        <?php endforeach ?>
                                                    </tr>
                                                <?php endforeach ?>
                                                <tr>
                                                    <th colspan="2" class="text-center">Jumlah</th>
                                                    <?php foreach ($get_kriteria_dua as $j) : ?>
                                                        <?php
                                                        $id_kriteria = $j->id;
                                                        $sql = "SELECT sum(nilai_kriteria) as nilai FROM perbandingan WHERE id_kriteria='$id_kriteria'";
                                                        $result = $this->db->query($sql); ?>

                                                        <th><?= $result->row()->nilai ?></th>
                                                    <?php endforeach ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="header-title"> Tabel Pencarian Eigen Vector Normalisasi</h4>
                                    <p>Tabel ini digunakan untuk menentunkan nilai baris C1 dengan cara mengkalikan baris C1 dengan kolom yang ada pada tabel <code>Pairwise Comparison</code>.</p>
                                    <?php if ($get_total_baris_satu < 3) : ?>
                                        <a href="" class="btn btn-info mb-2" data-toggle="modal" data-target="#tambah"><i class="fe-plus"></i> Input Nilai</a>
                                    <?php endif; ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>C1</th>
                                                <th>C2</th>
                                                <th>C3</th>
                                                <th>Jmlh</th>
                                                <th>aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="baris_satu">
                                            <?php
                                            foreach ($get_baris_satu as $bsa) : ?>
                                                <tr>
                                                    <td>C1</td>
                                                    <td><?= $bsa->nilai ?></td>
                                                    <td><?= $bsa->nilai_dua ?></td>
                                                    <td><?= $bsa->nilai_tiga ?></td>
                                                    <td><?= $bsa->jumlah ?></td>
                                                    <td>
                                                        <a href="<?= base_url('backend/analisis/delete_baris_satu/') . $bsa->id ?>" class=" btn btn-sm btn-danger hapus"><i class="fa fa-trash"></i> Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tr>
                                            <th colspan="4" class="text-center">Baris Ke 1</th>
                                            <th><?= $sum_baris_satu ?></th>
                                            <th></th>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="header-title"> Tabel Pencarian Eigen Vector Normalisasi</h4>
                                    <p>Tabel ini digunakan untuk menentunkan nilai baris C2 dengan cara mengkalikan baris C2 dengan kolom yang ada pada tabel <code>Pairwise Comparison</code>.</p>
                                    <?php if ($get_total_baris_dua < 3) : ?>
                                        <a href="" class="btn btn-info mb-2" data-toggle="modal" data-target="#tambah_baris_dua"><i class="fe-plus"></i> Input Nilai</a>
                                    <?php endif; ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>C1</th>
                                                <th>C2</th>
                                                <th>C3</th>
                                                <th>Jmlh</th>
                                                <th>aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($get_baris_dua as $bd) : ?>
                                                <tr>
                                                    <td>C2</td>
                                                    <td><?= $bd->nilai ?></td>
                                                    <td><?= $bd->nilai_dua ?></td>
                                                    <td><?= $bd->nilai_tiga ?></td>
                                                    <td><?= $bd->jumlah ?></td>
                                                    <td>
                                                        <a href="<?= base_url('backend/analisis/delete_baris_dua/') . $bd->id ?>" class=" btn btn-sm btn-danger hapus"><i class="fa fa-trash"></i> Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>

                                        </tbody>
                                        <tr>
                                            <th colspan="4" class="text-center">Baris Ke 2</th>
                                            <th><?= $sum_baris_dua ?></th>
                                            <th></th>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="header-title"> Tabel Pencarian Eigen Vector Normalisasi</h4>
                                    <p>Tabel ini digunakan untuk menentunkan nilai baris C3 dengan cara mengkalikan baris C3 dengan kolom yang ada pada tabel <code>Pairwise Comparison</code>.</p>
                                    <?php if ($get_total_baris_tiga < 3) : ?>
                                        <a href="" class="btn btn-info mb-2" data-toggle="modal" data-target="#tambah_baris_tiga"><i class="fe-plus"></i> Input Nilai</a>
                                    <?php endif; ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>C1</th>
                                                <th>C2</th>
                                                <th>C3</th>
                                                <th>Jmlh</th>
                                                <th>aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($get_baris_tiga as $bt) : ?>
                                                <tr>
                                                    <td>C3</td>
                                                    <td><?= $bt->nilai ?></td>
                                                    <td><?= $bt->nilai_dua ?></td>
                                                    <td><?= $bt->nilai_tiga ?></td>
                                                    <td><?= $bt->jumlah ?></td>
                                                    <td>
                                                        <a href="<?= base_url('backend/analisis/delete_baris_tiga/') . $bt->id ?>" class=" btn btn-sm btn-danger hapus"><i class="fa fa-trash"></i> Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tr>
                                            <th colspan="4" class="text-center">Baris Ke 3</th>
                                            <th><?= $sum_baris_tiga ?></th>
                                            <th></th>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <h4 class="header-title"> Tabel EVN: Eigen Vector Normaliasai</h4>
                            <p>Tabel ini digunakan untuk menentunkan nilai eigen vector normalisasi dengan cara menginput jumlah nilai baris 1 - 3.
                                <br> Setelah selesai menginputkan jumlah nilai maka untuk mencari nilai EVN anda harus membagi total dari tiap-tiap baris 1 - 3.
                            </p>
                            <?php if ($get_total_evn_normalisasi < 3) : ?>
                                <a href="" class="btn btn-info mb-2" data-toggle="modal" data-target="#tambah_nilai_evn"><i class="fe-plus"></i> Input Nilai</a>
                            <?php endif; ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>C1</th>
                                        <th>C2</th>
                                        <th>C3</th>
                                        <th>Total</th>
                                        <th>EVN</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($get_evn_normalisasi as $en) : ?>
                                        <tr>
                                            <td>C<?= $no++ ?></td>
                                            <td><?= $en->nilai ?></td>
                                            <td><?= $en->nilai_dua ?></td>
                                            <td><?= $en->nilai_tiga ?></td>
                                            <td><?= $en->total ?></td>
                                            <td><?= $en->evn ?></td>
                                            <td>
                                                <a href="<?= base_url('backend/analisis/delete_evn_normalisasi/') . $en->id ?>" class=" btn btn-sm btn-danger hapus"><i class="fa fa-trash"></i> Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                                <tr>
                                    <th colspan="4" class="text-center">Jumlah Keseluruhan Baris 1 - 3 (<code>Jumlah Baris 1 + Jumlah Baris 2 + Jumlah Baris 3</code>)</th>
                                    <th><?= $sum_baris_satu + $sum_baris_dua + $sum_baris_tiga ?></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <h4 class="header-title"> Tabel Rasio Konsistensi</h4>
                            <p>Rasio Konsistensi digunakan untuk mengetahui tingkat konsistensi perbandingan kriteria.
                            </p>
                            <ul>
                                <li>Menentukan nilai eigen maksimal</li>
                                <p>Nilai eigen maksimal diperoleh dengan meng-kali hasil penjumlahan setiap baris pada matriks perbandingan berpasangan dengan vector eigen normalisasi.
                                    <br>(<code>M = (b1*evn1)+(b2*evn2)*(b3*evn3)</code>)
                                </p>

                                <li>Menghitung indeks konsistensi (CI)</li>
                                <p>Rumus yang digunakan: <br>
                                    (<code>CI = m - n / n -1</code>)
                                </p>
                                <li>Menghitung rasio konsistensi (CR)</li>
                                <p>Berdasarkan indeks konsistensi di peroleh IR untuk matriks 3x3 adalah 0.58. Sehingga diperoleh rumus: <br>
                                    (<code>CR = CI / IR</code>)
                                </p>
                            </ul>
                            <?php if ($get_total_rasio_konsistensi < 1) : ?>
                                <a href="" class="btn btn-info mb-2" data-toggle="modal" data-target="#tambah_nilai_rasio"><i class="fe-plus"></i> Input Nilai</a>
                            <?php endif; ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Emaks</th>
                                        <th>CI</th>
                                        <th>CR</th>
                                        <th>Bobot</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($get_rasio_konsistensi as $rk) :
                                        $persentase = $rk->cr * 100; ?>
                                        <tr>
                                            <td>C<?= $no++ ?></td>
                                            <td><?= $rk->emaks ?></td>
                                            <td><?= $rk->ci ?></td>
                                            <td>
                                                <?php if ($rk->cr < 0.1) : ?>
                                                    <div class="badge badge-outline-success"><?= $rk->cr ?></div>
                                                <?php else : ?>
                                                    <div class="badge badge-danger"><?= $rk->cr ?></div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <progress value="<?= $persentase ?>" aria-valuemin="0" max="10"></progress>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('backend/analisis/delete_rasio_konsistensi/') . $rk->id ?>" class=" btn btn-sm btn-danger hapus"><i class="fa fa-trash"></i> Hapus</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Hasil Nilai</h5>
                                            </td>
                                            <td colspan="5">
                                                <?php if ($rk->cr < 0.1) : ?>
                                                    <h4>Cocok</h4>
                                                <?php else : ?>
                                                    <h4>Tidak Cocok</h4>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>

                            <h4>Jika nilai CR < 0.1 maka reverensi pembobotan adalah Cocok</p>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->

    <div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit <?= $title ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <?php echo form_open("backend/analisis/tambah_baris_satu"); ?>
                <div class="modal-body p-3">

                    <h5>
                        <center> Baris C1 index 1 x Kolom </center>
                    </h5>
                    <input type="hidden" name="user_id" value="<?= $session->id ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Baris C1 index 1 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai" name="nilai" class="form-control" value="<?= set_value('nilai') ?>" require>
                                </div>
                                <?= form_error('nilai', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Kolom index 1 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_dua" name="nilai_dua" class="form-control" value="<?= set_value('nilai_dua') ?>" require>
                                </div>
                                <?= form_error('nilai_dua', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </div>

                    <h5>
                        <center> Baris C1 index 2 x Kolom </center>
                    </h5>
                    <input type="hidden" name="id_user" value="<?= $session->id ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Baris C1 index 2 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_tiga" name="nilai_tiga" class="form-control" value="<?= set_value('nilai_tiga') ?>" require>
                                </div>
                                <?= form_error('nilai_tiga', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Kolom index 2 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_empat" name="nilai_empat" class="form-control" value="<?= set_value('nilai_empat') ?>" require>
                                </div>
                                <?= form_error('nilai_empat', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </div>

                    <h5>
                        <center> Baris C1 index 3 x Kolom</center>
                    </h5>
                    <input type="hidden" name="id_user" value="<?= $session->id ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Baris C1 index 3 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_lima" name="nilai_lima" class="form-control" value="<?= set_value('nilai_lima') ?>" require>
                                </div>
                                <?= form_error('nilai_lima', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Kolom index 3 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_enam" name="nilai_enam" class="form-control" value="<?= set_value('nilai_enam') ?>" require>
                                </div>
                                <?= form_error('nilai_enam', '<small class="text-danger">', '</small>') ?>
                            </div>
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

    <div id="tambah_baris_dua" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit <?= $title ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <?php echo form_open("backend/analisis/tambah_baris_dua"); ?>
                <div class="modal-body p-3">

                    <h5>
                        <center> Baris C2 index 1 x Kolom </center>
                    </h5>
                    <input type="hidden" name="user_id" value="<?= $session->id ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Baris C2 index 1 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai" name="nilai" class="form-control" value="<?= set_value('nilai') ?>" require>
                                </div>
                                <?= form_error('nilai', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Kolom index 1 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_dua" name="nilai_dua" class="form-control" value="<?= set_value('nilai_dua') ?>" require>
                                </div>
                                <?= form_error('nilai_dua', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </div>

                    <h5>
                        <center> Baris C2 index 2 x Kolom </center>
                    </h5>
                    <input type="hidden" name="id_user" value="<?= $session->id ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Baris C2 index 2 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_tiga" name="nilai_tiga" class="form-control" value="<?= set_value('nilai_tiga') ?>" require>
                                </div>
                                <?= form_error('nilai_tiga', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Kolom index 2 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_empat" name="nilai_empat" class="form-control" value="<?= set_value('nilai_empat') ?>" require>
                                </div>
                                <?= form_error('nilai_empat', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </div>

                    <h5>
                        <center> Baris C2 index 3 x Kolom</center>
                    </h5>
                    <input type="hidden" name="id_user" value="<?= $session->id ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Baris C2 index 3 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_lima" name="nilai_lima" class="form-control" value="<?= set_value('nilai_lima') ?>" require>
                                </div>
                                <?= form_error('nilai_lima', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Kolom index 3 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_enam" name="nilai_enam" class="form-control" value="<?= set_value('nilai_enam') ?>" require>
                                </div>
                                <?= form_error('nilai_enam', '<small class="text-danger">', '</small>') ?>
                            </div>
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

    <div id="tambah_baris_tiga" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit <?= $title ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <?php echo form_open("backend/analisis/tambah_baris_tiga"); ?>
                <div class="modal-body p-3">

                    <h5>
                        <center> Baris C3 index 1 x Kolom </center>
                    </h5>
                    <input type="hidden" name="user_id" value="<?= $session->id ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Baris C3 index 1 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai" name="nilai" class="form-control" value="<?= set_value('nilai') ?>" require>
                                </div>
                                <?= form_error('nilai', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Kolom index 1 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_dua" name="nilai_dua" class="form-control" value="<?= set_value('nilai_dua') ?>" require>
                                </div>
                                <?= form_error('nilai_dua', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </div>

                    <h5>
                        <center> Baris C3 index 2 x Kolom </center>
                    </h5>
                    <input type="hidden" name="id_user" value="<?= $session->id ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Baris C3 index 2 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_tiga" name="nilai_tiga" class="form-control" value="<?= set_value('nilai_tiga') ?>" require>
                                </div>
                                <?= form_error('nilai_tiga', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Kolom index 2 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_empat" name="nilai_empat" class="form-control" value="<?= set_value('nilai_empat') ?>" require>
                                </div>
                                <?= form_error('nilai_empat', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </div>

                    <h5>
                        <center> Baris C3 index 3 x Kolom</center>
                    </h5>
                    <input type="hidden" name="id_user" value="<?= $session->id ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Baris C3 index 3 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_lima" name="nilai_lima" class="form-control" value="<?= set_value('nilai_lima') ?>" require>
                                </div>
                                <?= form_error('nilai_lima', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Kolom index 3 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_enam" name="nilai_enam" class="form-control" value="<?= set_value('nilai_enam') ?>" require>
                                </div>
                                <?= form_error('nilai_enam', '<small class="text-danger">', '</small>') ?>
                            </div>
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

    <div id="tambah_nilai_evn" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit <?= $title ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <?php echo form_open("backend/analisis/kirim_nilai"); ?>
                <div class="modal-body p-3">

                    <h5>
                        <center>Input jumlah nilai yang ada pada tabel baris ke 1 - 3</center>
                    </h5>
                    <input type="hidden" name="user_id" value="<?= $session->id ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="url">Nilai baris 1 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_satu" name="nilai_satu" class="form-control" value="<?= set_value('nilai_satu') ?>" require>
                                </div>
                                <?= form_error('nilai_satu', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="url">Nilai baris 2 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_dua" name="nilai_dua" class="form-control" value="<?= set_value('nilai_dua') ?>" require>
                                </div>
                                <?= form_error('nilai_dua', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="url">Nilai baris 3 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_tiga" name="nilai_tiga" class="form-control" value="<?= set_value('nilai_tiga') ?>" require>
                                </div>
                                <?= form_error('nilai_tiga', '<small class="text-danger">', '</small>') ?>
                            </div>
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

    <div id="tambah_nilai_rasio" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input Nilai Rasio Konsistensi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <?php echo form_open("backend/analisis/kirim_nilai_rasio"); ?>
                <div class="modal-body p-3">

                    <p>
                        Input jumlah nilai yang ada pada tabel <b>Pairwise Comparison</b> dan tabel EVN
                    </p>
                    <input type="hidden" name="user_id" value="<?= $session->id ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Jumlah baris 1 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_satu" name="nilai_satu" class="form-control" value="<?= set_value('nilai_satu') ?>" require>
                                </div>
                                <?= form_error('nilai_satu', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Nilai EVN baris 1<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_dua" name="nilai_dua" class="form-control" value="<?= set_value('nilai_dua') ?>" require>
                                </div>
                                <?= form_error('nilai_dua', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Jumlah baris 2 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_tiga" name="nilai_tiga" class="form-control" value="<?= set_value('nilai_tiga') ?>" require>
                                </div>
                                <?= form_error('nilai_tiga', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Nilai EVN baris 2<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_empat" name="nilai_empat" class="form-control" value="<?= set_value('nilai_empat') ?>" require>
                                </div>
                                <?= form_error('nilai_empat', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Jumlah baris 3 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_lima" name="nilai_lima" class="form-control" value="<?= set_value('nilai_lima') ?>" require>
                                </div>
                                <?= form_error('nilai_lima', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="url">Nilai EVN baris 3<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nilai_enam" name="nilai_enam" class="form-control" value="<?= set_value('nilai_enam') ?>" require>
                                </div>
                                <?= form_error('nilai_enam', '<small class="text-danger">', '</small>') ?>
                            </div>
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