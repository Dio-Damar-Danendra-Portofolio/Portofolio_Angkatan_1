<?php 

use Mpdf\Tag\Header;
    session_start();
    require_once "../koneksi.php";

    $query = mysqli_query($conn, "SELECT * FROM project");
    $row = mysqli_fetch_all($query, MYSQLI_ASSOC);

    if (isset($_GET['idDelete'])) {
      $id = $_GET['idDelete'];

      $queryProject = mysqli_query($conn, "SELECT * FROM project");
      $rowProject = mysqli_fetch_assoc($queryProject);
      unlink('../assets/uploads/'. $rowProject['foto']);

      $delete = mysqli_query($conn, "DELETE FROM project WHERE id = $id");
      if ($delete) {
        header("Location: projects.php?hapus=berhasil");
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
              <h5 class="card-title">Proyek</h5>
              <?php 
              if (isset($_GET['kirim']) && $_GET['kirim'] == "sukses") {?>
                <div class="alert alert-success">
                  Anda berhasil menambah/menyunting proyek!
                </div>
              <?php }
              ?>
              <div class="table table-responsive">
                <a href="add_edit_project.php" class="btn btn-primary mb-2">Tambah Proyek</a>
                <table class="table table-striped table-bordered text-center" id="myTable">
                    <thead>
                    <tr>
                      <th>No. </th>
                      <th>Nama Proyek</th>
                      <th>Kategori</th>
                      <th>Foto</th>
                      <th>Tindakan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $no = 1;
                      foreach ($row as $project) { ?>
                      <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $project['nama'] ?></td>
                        <td><?php echo $project['kategori'] ?></td>
                        <td>
                            <img width="100" src="../assets/uploads/<?php echo $project['foto'] ?>" style="min-height: 45%; max-height: 50%;" alt="Gambar tidak tersedia">
                        </td>
                        <td>
                          <a href="add_edit_project.php?idEdit=<?php echo $project['id'] ?>" class="btn btn-success btn-sm">Sunting</a>
                          <a href="projects.php?idDelete=<?php echo $project['id'] ?>" class="btn btn-danger btn-sm" onclick="return window.confirm('Apakah Anda yakin untuk menghapus data ini?')">Hapus</a>
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