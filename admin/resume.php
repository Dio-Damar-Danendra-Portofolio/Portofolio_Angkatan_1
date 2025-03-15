<?php 
    session_start();
    require_once "../koneksi.php";

    $querycontact = mysqli_query($conn, "SELECT * FROM resume");
    $rows = mysqli_fetch_all($querycontact, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<?php include "../inc/head.php"; ?>
<body>

  <!-- ======= Header ======= -->
  <?php include "../inc/navbar.php"; ?><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include "../inc/sidebar.php"; ?><!-- End Sidebar-->

  <main id="main" class="main">

  <?php include "../inc/pagetitle.php" ?><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Resume</h5>
              <div class="table table-responsive">
                <a href="add_edit_resume.php" class="btn btn-primary mb-2">Create</a>
                  <table class="table table-bordered text-center" id="myTable">
                    <thead>
                      <tr>
                        <th>No. </th>
                        <th>Tahun Awal</th>
                        <th>Tahun Akhir</th>
                        <th>Jabatan</th>
                        <th>Instansi</th>
                        <th>Deskripsi</th>
                        <th>Tindakan</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $no = 1;
                      foreach ($rows as $row) { ?>
                      <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['tahun_awal'] ?></td>
                        <td><?php echo $row['tahun_akhir'] ?></td>
                        <td><?php echo $row['jabatan'] ?></td>
                        <td><?php echo $row['instansi'] ?></td>
                        <td><?php echo $row['deskripsi'] ?></td>
                        <td>
                          <a href="add_edit_resume.php?idEdit=<?php echo $row ['id'] ?>" class="btn btn-success btn-sm">Sunting</a>
                          <a href="resume.php?idDelete=<?php echo $row['id'] ?>" 
                          class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini?')">Hapus</a>
                          <a href="print-pdf.php?idPrint=<?php echo $row['id'] ?>" class="btn btn-primary btn-sm">Cetak PDF</a>
                        </td>
                      </tr> 
                    <?php } ?>
                    </tbody>
                  </table>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include "../inc/footer.php"; ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script
        src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
<!-- Vendor JS Files -->
<script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.2.2/datatables.min.js" integrity="sha384-k90VzuFAoyBG5No1d5yn30abqlaxr9+LfAPp6pjrd7U3T77blpvmsS8GqS70xcnH" crossorigin="anonymous"></script>
    <script>
        let dataTable = new DataTable("#myTable");
    </script>

</body>

</html>