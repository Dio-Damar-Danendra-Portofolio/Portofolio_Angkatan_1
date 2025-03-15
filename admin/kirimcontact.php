<?php 
    session_start();
    require_once "../koneksi.php";

    if (empty($_SESSION['Electronic_Mail']) && empty($_SESSION['Password'])) {
      header("Location:../login.php");
    }
    $id = $_GET['idPesan'];
    $select_contact = mysqli_query($conn, "SELECT * FROM contact WHERE id = $id");
    $row = mysqli_fetch_assoc($select_contact);
    var_dump($row);
    
    if (isset($_POST['kirim'])) {
      $id = $_GET['idPesan'];
      $email = $_POST['email'];
      $subjek = $_POST['subjek'];
      $pesan = $_POST['pesan'];

      $headers = "From: diodamar14102000@gmail.com" . "\r\n" .
      "Reply-To: diodamar14102000@gmail.com" . "\r\n" .
      "Content-Type: text/plain; charset=UTF-8" . "\r\n" .
      "MIME-Version: 1.0" . "\r\n";

      if (mail($email, $subjek, $pesan, $headers)) {
         echo "<script>window.alert('Pesan Anda Sudah Dibalas!');</script>";
         header("Location:contact.php");
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
              <h5 class="card-title">Service</h5>
              <form action="" method="post" enctype="multipart/form-data">
                <div class="row-mb-3">
                    <div class="col-sm-8">
                        <pre>Nama Lengkap: <?php echo $row['nama_lengkap'] ?></pre>
                        <pre>Email       : <?php echo $row['email'] ?></pre>
                        <pre>Subjek      : <?php echo $row['subjek'] ?></pre>
                        <pre>Pesan       : <?php echo $row['pesan'] ?></pre>
                    </div>
                </div>
                <div class="row-mb-3">
                    <div class="col-sm-8">
                      <label for="" class="form-label">Subjek: </label>
                      <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['email']?>">
                      <input type="text" class="form-control" name="subjek" id="subjek" placeholder="Masukkan Judul" required>
                    </div>
                </div>
                <div class="row-mb-3">
                    <div class="col-sm-8">
                      <label for="" class="form-label">Pesan Balasan: </label>
                      <textarea type="text" class="form-control" name="pesan" id="pesan" cols="30" rows="3"></textarea>
                    </div>
                </div>
                <div class="row-mb-3">
                  <div class="col-md-8 offset-md-2">
                    <button type="submit" class="btn btn-primary" name="kirim">Kirim!</button>
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