<?php 
    session_start();
    require_once "../koneksi.php";

    $queryService = mysqli_query($conn, "SELECT * FROM service");
    $rows = mysqli_fetch_all($queryService, MYSQLI_ASSOC);

    if (isset($_GET['del'])) {
      $id = $_GET['del'];
    
      $periksaFoto = mysqli_query($conn, "SELECT foto FROM service WHERE id = $id");
      $row_delete = mysqli_fetch_assoc($periksaFoto);
      if ($row_delete['foto']) {
        unlink("../assets/uploads/" . $row_delete['foto']);
        $delete = mysqli_query($conn, "DELETE FROM service WHERE id = $id");
        if ($delete) {
          header("Location: services.php");
        }
      }
    }
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
              <h5 class="card-title">Services</h5>
              <div class="table table-responsive">
                <a href="add_edit_service.php" class="btn btn-primary mb-2">Create</a>
                  <table class="table-bordered">
                    <tr>
                      <th>No. </th>
                      <th>Nama Service</th>
                      <th>Foto</th>
                      <th>Tindakan</th>
                    </tr>
                    <?php 
                      $no = 1;
                      foreach ($rows as $row) { ?>
                      <tr>
                      <td><?= $no++ ?></td>
                        <td><?= $row['nama_service'] ?></td>
                        <td><img style="min-width: 30%; max-width: 50%;" src="../assets/uploads/<?php echo $row['foto'] ?>" alt=""></td>
                        <td>
                          <a href="add_edit_service.php?idEdit=<?php echo $row['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                          <a href="services.php?idDelete=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
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