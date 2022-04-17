<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <script>
                    document.write(new Date().getFullYear())
                </script> &copy; Sistem Pengambil Keputusan Pemilihan Lahan Mangrove Desa Pao
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->


</div>
<!-- END wrapper -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- Vendor js -->
<script src="<?= base_url() ?>assets/js/vendor.min.js"></script>

<!-- third party js -->
<script src="<?= base_url() ?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Sweet Alerts js -->
<script src="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Plugins js-->
<script src="<?= base_url() ?>assets/libs/flatpickr/flatpickr.min.js"></script>
<script src="<?= base_url() ?>assets/libs/apexcharts/apexcharts.min.js"></script>

<script src="<?= base_url() ?>assets/libs/selectize/js/standalone/selectize.min.js"></script>
<!-- Tippy js-->
<script src="<?= base_url() ?>assets/libs/tippy.js/tippy.all.min.js"></script>

<!-- App js-->
<script src="<?= base_url() ?>assets/js/app.min.js"></script>

<script>
    // delete
    $('.hapus').on('click', function(e) {

        e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
            title: "Apakah anda yakin?",
            text: "Anda ingin menghapus data ini!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Iya, hapus!",
            cancelButtonText: "Tidak, Tutup!",
            confirmButtonClass: "btn btn-danger mt-2",
            cancelButtonClass: "btn btn-secondary ml-2 mt-2",
            buttonsStyling: !1
        }).
        then(function(t) {
            t.value ? Swal.fire({
                document: location.href = href,
                title: "Dihapus!",
                text: "File anda telah di hapus.",
                type: "success"
            }) : t.dismiss === Swal.DismissReason.cancel && Swal.fire({
                title: "Batal",
                text: "File anda tidak terhapus.",
                type: "error"
            })
        })
    })

    //delete-all
    $("#hapus").hide();
    $(document).ready(function() {

        $("#chack-all").click(function() {
            if ($(this).is(":checked")) {
                $(".check-item").prop("checked", true);
                $("#hapus").show();
            } else {
                $(".check-item").prop("checked", false);
                $("#hapus").hide();
            }
        });

        $("#hapus").click(function(e) {
            e.preventDefault();
            const confirm = $("#form-delete");

            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Anda ingin menghapus data ini!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Iya, hapus!",
                cancelButtonText: "Tidak, Tutup!",
                confirmButtonClass: "btn btn-danger mt-2",
                cancelButtonClass: "btn btn-secondary ml-2 mt-2",
                buttonsStyling: !1
            }).
            then(function(t) {
                t.value ? Swal.fire({
                    document: confirm.submit(),
                    title: "Dihapus!",
                    text: "File anda telah di hapus.",
                    type: "success"
                }) : t.dismiss === Swal.DismissReason.cancel && Swal.fire({
                    title: "Batal",
                    text: "File anda tidak terhapus.",
                    type: "error"
                })
            })
        });
    });

    // datatable
    $(document).ready(function() {
        $("#basic-datatable").DataTable({
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>"
                }
            },
            drawCallback: function() {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            }
        });
    });
</script>

</body>

</html>