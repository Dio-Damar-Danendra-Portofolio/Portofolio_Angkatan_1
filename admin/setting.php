<?php 
    session_start();
    require "../koneksi.php";

    if (empty($_SESSION['Electronic_Mail']) && empty($_SESSION['Password']) && empty($_SESSION['Remember_Me'])) {
      header("Location:../login.php");
    }

    $querySetting = mysqli_query($conn, "SELECT * FROM setting WHERE id = 1");
    $row_edit = mysqli_fetch_assoc($querySetting);
    
    if (isset($_POST["simpan"])) {
        $nama_website = $_POST["nama_website"];
        $alamat_website = $_POST["alamat_website"];
        $email = $_POST["email"];
        $telepon = $_POST["telepon"];
        $alamat_kantor = $_POST["alamat_kantor"];
        $logo = $_FILES["logo"];

        // Jika sudah mempunyai data, maka update. Selain itu, insert
        // Tampilkan / pilih dari table setting dimana nama_website = 'nilai dari nama website'
        // Tampilkan data terbaru dari table user
        
      
            if (mysqli_num_rows($querySetting) > 0) {
                //update...
                $update = mysqli_query($conn, "UPDATE setting SET nama_website = '$nama_website', alamat_website = '$alamat_website', 
                email = '$email', telepon = '$telepon', alamat_kantor = '$alamat_kantor', logo = '$logo') WHERE id = 1");
                header("Location: setting.php?ubah=berhasil");
                if ($logo['error'] == 0) {
                  $fileName = uniqid() . "_" .basename($logo['name']);
                  $filePath = "../assets/uploads/" . $fileName;
                  // move_uploaded_file($logo['tmp_name'], $filePath);
                  if (move_uploaded_file($logo['tmp_name'], $filePath)){
                    $rowLogo = $row_edit['logo'];
                    if ($rowLogo && file_exists("../assets/uploads/" . $rowLogo)) {
                        unlink("../assets/uploads/" . $rowLogo);
                    }
                  } else {
                      echo "Gagal upload... Coba lagi...";
                  }
                }
                $fillQUpdate = "logo='$fileName'";
                $update = mysqli_query($conn, "UPDATE setting SET nama_website = '$nama_website', alamat_website = '$alamat_website', 
                email = '$email', telepon = '$telepon', alamat_kantor = '$alamat', $fillQUpdate WHERE id = 1");
                header("Location: setting.php?ubah=berhasil");

            } else {
                // insert
                if ($logo['error'] == 0) {
                  $fileName = uniqid() . "_" .basename($logo['name']);
                  $filePath = "../assets/uploads/" . $fileName;
                  move_uploaded_file($logo['tmp_name'], $filePath);
                  $insert = mysqli_query($conn, "INSERT INTO setting (nama_website, alamat_website, email, telepon, alamat_kantor, logo) 
                  VALUES ('$nama_website', '$alamat_website', '$email', '$telepon', '$alamat_kantor', '$fileName')");
                  header("Location: setting.php?tambah=berhasil");
                }
                

            }
    }
    
    if (isset($_GET['idDelete'])) {
      $id = $_GET['idDelete'];
      if ($row_edit['logo']) {
        unlink("../assets/uploads" . $row_edit['logo']);
        $delete = mysqli_query($conn, "DELETE FROM setting WHERE id = $id");
        $alterAI = mysqli_query($conn, "ALTER TABLE setting AUTO_INCREMENT = 1");
        if ($delete && $alterAI) {
            header("Location: setting.php?hapus=berhasil");
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
              <h5 class="card-title">Pengaturan Umum</h5>
              <form action="" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <label for="nama_website">Nama Website: </label>
                    </div>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="nama_website" id="nama_website" placeholder="Masukkan nama website Anda!" required value="<?php echo isset($_GET['tambah']) && $_GET['tambah'] == "berhasil" || isset($_GET['sidebar']) && isset($_GET['sidebar']) == "setting" ? $row_edit['nama_website'] : (isset($_GET['ubah']) && $_GET['ubah'] == "berhasil" ? $row_edit['nama_website'] : '')?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <label for="URL_website">URL Website: </label>
                    </div>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="URL_website" id="URL_website" placeholder="Masukkan Alamat website Anda!" value="<?php echo isset($_GET['tambah']) && $_GET['tambah'] == "berhasil" || isset($_GET['sidebar']) && isset($_GET['sidebar']) == "setting" ? $row_edit['URL_website'] : (isset($_GET['ubah']) && $_GET['ubah'] == "berhasil" ? $row_edit['URL_website'] : '') ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <label for="email">E-mail: </label>
                    </div>
                    <div class="col-sm-10">
                        <input class="form-control" type="email" name="email" id="email" placeholder="Masukkan E-mail Anda!" required value="<?php echo isset($_GET['tambah']) && $_GET['tambah'] == "berhasil" || isset($_GET['sidebar']) && isset($_GET['sidebar']) == "setting"  ? $row_edit['email'] : (isset($_GET['ubah']) && $_GET['ubah'] == "berhasil" ? $row_edit['email'] : '') ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <label for="telepon">Nomor Telepon: </label>
                    </div>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="telepon" id="telepon" placeholder="Masukkan Nomor Telepon Anda!" required value="<?php echo isset($_GET['tambah']) && $_GET['tambah'] == "berhasil" || isset($_GET['sidebar']) && isset($_GET['sidebar']) == "setting" ? $row_edit['nomor_telepon'] : (isset($_GET['ubah']) && $_GET['ubah'] == "berhasil" || isset($_GET['sidebar']) ? $row_edit['nomor_telepon'] : '') ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <label for="alamat_kantor">Alamat Kantor: </label>
                    </div>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="alamat_kantor" id="alamat_kantor" placeholder="Masukkan Alamat Kantor Anda!" required><?php echo isset($_GET['tambah']) && 
                        $_GET['tambah'] == "berhasil" || isset($_GET['sidebar']) && isset($_GET['sidebar']) == "setting" 
                        ? $row_edit['alamat_kantor'] : (isset($_GET['ubah']) && $_GET['ubah'] == "berhasil" || isset($_GET['sidebar']) ? $row_edit['nomor_telepon'] : '') ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-2">
                    <label for="logo">Logo: </label>
                  </div>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" name="logo" id="logo" required>
                  </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2 offset-md-2">
                        <button class="btn btn-primary" type="submit" name="simpan">Simpan!</button>
                        <button class="btn btn-info" type="reset" name="ulang">Ulang!</button>
                        <?php if ((isset($_GET['tambah']) && $_GET['tambah'] == "berhasil") || (isset($_GET['ubah']) && $_GET['ubah'])) {?>
                        <a href="setting?idDelete=<?php echo $row_edit['id'] ?>" class="btn btn-danger" onclick="return window.confirm('Apakah Anda yakin untuk menghapus data ini?')">HAPUS</a>
                        <?php } ?>
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
    <script src="https://cdn.datatables.net/v/bs5/dt-2.2.2/datatables.min.js" integrity="sha384-k90VzuFAoyBG5No1d5yn30abqlaxr9+LfAPp6pjrd7U3T77blpvmsS8GqS70xcnH" crossorigin="anonymous"></script>
    <script>
        let dataTable = new DataTable("#myTable");
    </script>

</body>

</html>