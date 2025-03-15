<?php 
    session_start();
    require_once "../koneksi.php";

    $querycontact = mysqli_query($conn, "SELECT * FROM skill");
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
              <h5 class="card-title">Skills</h5>
              <div class="table table-responsive">
                <a href="add_edit_skill.php" class="btn btn-primary mb-2">Create</a>
                  <table class="table-bordered">
                    <tr>
                      <th>No. </th>
                      <th>Skill</th>
                      <th>Persentase</th>
                      <th>Tindakan</th>
                    </tr>
                    <?php 
                      $no = 1;
                      foreach ($rows as $row) { ?>
                      <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['nama_skill'] ?></td>
                        <td><?php echo $row['persentase'] . "%"?></td>
                        <td>
                          <a href="add_edit_skill.php?idEdit=<?php echo $row['id'] ?>" class="btn btn-success btn-sm">Sunting</a>
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