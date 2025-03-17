<?php 
    session_start();
    require_once "../koneksi.php";

    if (empty($_SESSION['Electronic_Mail']) && empty($_SESSION['Password'])) {
      header("Location:../login.php");
    }

    $querySkill = mysqli_query($conn, "SELECT * FROM skill LIMIT 1");
    $rowEdit = mysqli_fetch_assoc($querySkill);
    
    if (isset($_POST["simpan"])) {
        $nama_skill = $_POST["nama_skill"];
        $persentase = $_POST["persentase"];

        $insert = mysqli_query($conn, "INSERT INTO skill (nama_skill, persentase) VALUES ('$nama_skill', '$persentase')");
        header("Location: skill.php"); 
    }

    if (isset($_GET['idEdit'])) {
      $idEdit = $_GET['idEdit'];

      $queryEdit = mysqli_query($conn, "SELECT * FROM skill WHERE id = $idEdit");
      $rowEdit = mysqli_fetch_assoc($queryEdit);

      if (isset($_POST['sunting'])) {
        if (isset($_GET['idEdit'])) {
          $idEdit = $_GET['idEdit'];
          $nama_skill = $_POST['nama_skill'];
          $persentase = $_POST['persentase'];
          
          $queryUpdate = mysqli_query($conn, "UPDATE skill SET nama_skill='$nama_skill', persentase=$persentase WHERE id = $idEdit");
          header("Location: skill.php?ubah=berhasil");
        }
      }
    }

    // if (isset($_GET['Edit']) && $_GET['Edit']) {
    //   $id = $_GET['Edit'];
    //   $queryDelete = mysqli_query($conn, "DELETE FROM skill WHERE id = $id");
    //   header("Location: skills.php?hapus=berhasil");
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
              <h5 class="card-title">Keterampilan</h5>
              <form action="" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <label class="form-label" for="nama_skill">Keterampilan: </label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  name="nama_skill" id="nama_skill" placeholder="Masukkan keterampilan Anda!" required value="<?= isset($_GET['idEdit']) || isset($_GET['sidebar']) ? $rowEdit['nama_skill']  : ''?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <label class="form-label" for="persentase">Persentase: </label>
                    </div>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" min="0" max="100" name="persentase" id="persentase" value="<?= isset($_GET['idEdit']) || isset($_GET['sidebar']) ? $rowEdit['persentase']  : ''?>">
                    </div>
                </div>
                <div class="row mb-3">
                <div class="col-md-2">
                  <?php if (isset($_GET['idEdit'])) { ?>
                    <button type="submit" class="btn btn-md btn-primary" name="sunting">Sunting!</button>
                  <?php }  else { ?>
                    <button type="submit" class="btn btn-md btn-primary" name="simpan">Simpan!</button>
                    <?php }?>
                  </div>
                  <div class="col-md-4">
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