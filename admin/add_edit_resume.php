<?php 
    session_start();
    require_once "../koneksi.php";

    if (empty($_SESSION['Electronic_Mail']) && empty($_SESSION['Password'])) {
      header("Location:../login.php");
    }

    $queryResume = mysqli_query($conn, "SELECT * FROM resume LIMIT 1");
    $row_edit = mysqli_fetch_assoc($queryResume);
    
    if (isset($_POST["simpan"])) {
      $instansi = $_POST["instansi"];
      $jabatan = $_POST["jabatan"];
      $tahun_awal = $_POST["tahun_awal"];
      $tahun_akhir = $_POST["tahun_akhir"];
      $deskripsi = $_POST["deskripsi"];

        $insert = mysqli_query($conn, "INSERT INTO resume (instansi, jabatan, tahun_awal, tahun_akhir, deskripsi) VALUES ('$instansi', '$jabatan', '$tahun_awal', '$tahun_akhir', '$deskripsi')");

        if ($insert) {
          header("Location: resume.php");
        }
        else{
          echo "";
        }
    }
    
      $idEdit = $_GET['idEdit'];

    if (isset($_GET['idEdit'])) {
      $queryEdit = mysqli_query($conn, "SELECT * FROM resume WHERE id = $idEdit;");
      $rowEdit = mysqli_fetch_assoc($queryEdit);
      echo $rowEdit['idEdit'];
    }

    if (isset($_POST['sunting'])) {
      if (isset($_GET['idEdit'])) {
        $instansi = $_POST["instansi"];
        $jabatan = $_POST["jabatan"];
        $tahun_awal = $_POST["tahun_awal"];
        $tahun_akhir = $_POST["tahun_akhir"];
        $deskripsi = $_POST["deskripsi"];

        $queryUpdate = mysqli_query($conn, "UPDATE resume SET instansi='$instansi', 
        jabatan='$jabatan', tahun_awal='$tahun_awal', tahun_akhir='$tahun_akhir', 
        deskripsi='$deskripsi' WHERE id = $idEdit;");
        header("Location: resume.php?ubah=berhasil");
      }
    }

    // if (isset($_GET['idEdit']) && $_GET['idEdit']) {
    //   $id = $_GET['idEdit'];
    //   $queryDelete = mysqli_query($conn, "DELETE FROM resume WHERE id = $id");
    //   header("Location: resume.php?hapus=berhasil");
    // }
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
              <form action="" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <label class="form-label" for="instansi">Instansi: </label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  name="instansi" id="instansi" required value="<?= isset($_GET['idEdit']) || isset($_GET['sidebar']) ? $row_edit['instansi']  : '' ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <label class="form-label" for="jabatan">Jabatan: </label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  cols="30" rows="100" name="jabatan" id="jabatan" required value="<?= isset($_GET['idEdit']) || isset($_GET['sidebar']) ? $row_edit['jabatan']  : '' ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <label class="form-label" for="tahun_awal">Tahun Awal: </label>
                    </div>
                    <div class="col-sm-10">
                        <input type="number" class="form-control"  min="1800" max="9999" name="tahun_awal" id="tahun_awal" required value="<?= isset($_GET['idEdit']) || isset($_GET['sidebar']) && isset($_GET['sidebar']) == "setting"  ? $row_edit['tahun_awal']  : '' ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <label class="form-label" for="tahun_akhir">Tahun Akhir: </label>
                    </div>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" min="1800" max="9999" name="tahun_akhir" id="tahun_akhir" required value="<?= isset($_GET['idEdit']) || isset($_GET['sidebar']) && isset($_GET['sidebar']) == "setting"  ? $row_edit['tahun_akhir']  : '' ?>">
                    </div>
                </div>
                <div class="row mb-3 mb-2">
                    <div class="col-sm-2">
                        <label class="form-label" for="deskripsi">Deskripsi: </label>
                    </div>
                    <div class="col-sm-10">
                        <textarea class="form-control" cols="30" rows="10" name="deskripsi" id="deskripsi" required value="<?= isset($_GET['idEdit']) || isset($_GET['sidebar']) && isset($_GET['sidebar']) == "setting"  ? $row_edit['deskripsi']  : '' ?>"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                <div class="col-mb-2">
                  <?php if (isset($_GET['idEdit'])) { ?>
                    <button type="submit" class="btn btn-md btn-primary" name="sunting">Sunting!</button>
                  <?php }  else { ?>
                    <button type="submit" class="btn btn-md btn-primary" name="simpan">Simpan!</button>
                    <?php }?>
                  </div>
                  <div class="col-mb-4">
                      <button class="btn btn-md btn-info" type="reset" name="ulang">Ulang!</button>
                  </div>
                </div>
              </form>
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