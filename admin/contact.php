<?php 
    session_start();
    require_once "../koneksi.php";

    $querycontact = mysqli_query($conn, "SELECT * FROM contact");
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
              <h5 class="card-title">Contacts</h5>
              <div class="table table-responsive">
                <a href="../index.php#contact-section" class="btn btn-primary mb-2">Create</a>
                  <table class="table-bordered">
                    <tr>
                      <th>No. </th>
                      <th>Nama Lengkap</th>
                      <th>E-mail</th>
                      <th>Subjek</th>
                      <th>Pesan</th>
                      <th>Tindakan</th>
                    </tr>
                    <?php 
                      $no = 1;
                      foreach ($rows as $row) { ?>
                      <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['nama_lengkap'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['subjek'] ?></td>
                        <td><?php echo $row['pesan'] ?></td>
                        <td>
                          <a href="kirimcontact.php?idPesan=<?php echo $row ['id'] ?>" class="btn btn-success btn-sm">Balas Pesan</a>
                          <a href="contact.php?idDelete=<?php echo $row['id'] ?>" 
                          class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini?')">Hapus</a>
                        </td>
                      </tr>
                    <?php } ?>
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

</body>

</html>