<?php 
    session_start();
    require_once "../koneksi.php";

    if (empty($_SESSION['Electronic_Mail']) && empty($_SESSION['Password'])) {
      header("Location:../login.php");
    }

    $query_project = mysqli_query($conn, "SELECT * FROM project LIMIT 1");
    $row_edit = mysqli_fetch_assoc($query_project);
    
    if (isset($_POST['simpan'])) {
        $nama_project = $_POST['nama'];
        $kategori = $_POST['kategori'];
        $foto = $_FILES['foto'];

        if ($foto['error'] == 0) {
          $namaFile = uniqid() . "_" .basename($foto['name']);
          $lokasiFile = "../assets/uploads/".$namaFile;
          move_uploaded_file($foto['tmp_name'], $lokasiFile);

          $insert = mysqli_query($conn, "INSERT INTO project (nama, kategori, foto) VALUES ('$nama_project', '$kategori', '$namaFile')");

          if ($insert) {
            header("Location: projects.php"); 
          }
        }

    }

    if (isset($_GET['idEdit'])) {
      $idEdit = $_GET['idEdit'];
      $queryEdit = mysqli_query($conn, "SELECT * FROM project WHERE id = $idEdit");
      $rowEdit = mysqli_fetch_assoc($queryEdit);
      // echo $rowEdit['foto'];
    }

    if (isset($_POST['sunting'])) {
      if (isset($_GET['idEdit'])) {
        $id = $_GET['idEdit'];
        $nama_project = $_POST['nama'];
        $kategori = $_POST['kategori'];
        $foto = $_FILES['foto'];
        // var_dump($foto);
  
        if ($foto['error'] == 0) {
          $namaFile = uniqid() . "_" .basename($foto['name']);
          $lokasiFile = "../assets/uploads/" . $namaFile;
          // move_uploaded_file($logo['tmp_name'], $filePath);
          if (move_uploaded_file($foto['tmp_name'], $lokasiFile)){
            $qCheck = mysqli_query($conn, "SELECT foto FROM project WHERE id = $idEdit;");
            $rowFoto = mysqli_fetch_assoc($qCheck);
            if ($rowFoto && file_exists("../assets/uploads/" . $rowFoto['foto'])) {
                unlink("../assets/uploads/" . $rowFoto['foto']);
            }
            $fillQUpdate = "foto='$namaFile', ";
          } else {
              echo "Gagal upload... Coba lagi...";
          }
        }
        $queryUpdate = mysqli_query($conn, "UPDATE project SET $fillQUpdate nama='$nama_project', kategori='$kategori' WHERE id = $idEdit;");
        header("Location: projects.php?ubah=berhasil");
      }
    }

    // if (isset($_GET['Edit']) && $_GET['Edit']) {
    //   $id = $_GET['Edit'];
    //   $queryDelete = mysqli_query($conn, "DELETE FROM service WHERE id = $id");
    //   header("Location: services.php?hapus=berhasil");
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
              <h5 class="card-title">Proyek</h5>
              <form action="" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <label class="form-label" for="nama">Nama Proyek: </label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama proyek Anda!" required value="<?= isset($_GET['idEdit']) || isset($_GET['sidebar']) ? $rowEdit['nama'] : '' ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <label class="form-label" for="kategori" >Kategori: </label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="kategori" id="kategori" placeholder="Masukkan kategori proyek Anda!" value="<?= isset($_GET['idEdit']) || isset($_GET['sidebar']) ? $rowEdit['kategori'] : '' ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <label class="form-label" for="foto" >Foto: </label>
                    </div>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="foto" id="foto">
                    </div>
                    <?php if (isset($_GET['idEdit'])) { ?>
                      <div class="mt-2">
                      <img src="../assets/uploads/<?php echo $rowEdit['foto'] ?>" alt="">
                    </div>
                      <?php } ?>
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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow up-short"></i></a>

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