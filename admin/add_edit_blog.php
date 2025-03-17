<?php 
    session_start();
    require_once "../koneksi.php";

    if (empty($_SESSION['Electronic_Mail']) && empty($_SESSION['Password'])) {
      header("Location:../login.php");
    }

    $query_blog = mysqli_query($conn, "SELECT * FROM blog LIMIT 1");
    $row_edit = mysqli_fetch_assoc($query_blog);

    $queryCategory = mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC");
    $rowCategory = mysqli_fetch_all($queryCategory, MYSQLI_ASSOC);
    
    if (isset($_POST['simpan'])) {
        $judul = $_POST['judul'];
        $id_kategori = $_POST['id_kategori'];
        $status = $_POST['status'];
        $isi = $_POST['isi'];
        $foto = $_FILES['foto'];
        $tags = $_POST['tags'];
        $penulis = $_SESSION['Full_Name'];

        if ($foto['error'] == 0) {
          $namaFile = uniqid() . "_" .basename($foto['name']);
          $lokasiFile = "../assets/uploads/".$namaFile;
          move_uploaded_file($foto['tmp_name'], $lokasiFile);

          $insert = mysqli_query($conn, "INSERT INTO blog (judul, isi, id_kategori, tags, status, foto) 
          VALUES ('$judul', '$isi', '$id_kategori', '$tags', '$status', '$namaFile')");

          if ($insert) {
            header("Location: blog.php");
          }
        }
    }

    if (isset($_GET['idEdit'])) {
      $idEdit = $_GET['idEdit'];
      $queryEdit = mysqli_query($conn, "SELECT * FROM blog WHERE id = $idEdit");
      $rowEdit = mysqli_fetch_assoc($queryEdit);
      // echo $rowEdit['foto'];
    }

    if (isset($_POST['sunting'])) {
      if (isset($_GET['idEdit'])) {
        $id = $_GET['idEdit'];
        $judul_blog = $_POST['judul'];
        $kategori = $_POST['kategori'];
        $isi = $_POST['isi'];
        $status = $_POST['status'];

        $foto = $_FILES['foto'];
        // var_dump($foto);
  
        if ($foto['error'] == 0) {
          $namaFile = uniqid() . "_" .basename($foto['name']);
          $lokasiFile = "../assets/uploads/" . $namaFile;
          // move_uploaded_file($logo['tmp_name'], $filePath);
          if (move_uploaded_file($foto['tmp_name'], $lokasiFile)){
            $qCheck = mysqli_query($conn, "SELECT foto FROM blog WHERE id = $idEdit;");
            $rowFoto = mysqli_fetch_assoc($qCheck);
            if ($rowFoto && file_exists("../assets/uploads/" . $rowFoto['foto'])) {
                unlink("../assets/uploads/" . $rowFoto['foto']);
            }
            $fillQUpdate = "foto='$namaFile', ";
            $queryUpdate = mysqli_query($conn, "UPDATE blog SET $fillQUpdate judul='$judul_blog', kategori='$kategori', isi='$isi', 
        isi='$isi', isi='$isi', $fillQUpdate 
        WHERE id = $idEdit;");
          } else {
              echo "Gagal upload... Coba lagi...";
          }
        }
        
        header("Location: blog.php?ubah=berhasil");
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
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
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
                        <label class="form-label" for="judul">Judul Berita: </label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="judul" id="judul" placeholder="Masukkan judul blog Anda!" required value="<?= isset($_GET['idEdit']) || isset($_GET['sidebar']) ? $rowEdit['judul'] : '' ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <label class="form-label" for="isi" >Isi Berita: </label>
                    </div>
                    <div class="col-sm-10">
                        <textarea class="form-control summernote" name="isi" id="isi" required></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <label class="form-label" for="kategori" >Kategori: </label>
                    </div>
                    <div class="col-sm-10">
                        <select class="form-control" name="kategori" id="kategori" value="<?= isset($_GET['idEdit']) || isset($_GET['sidebar']) ? $rowEdit['kategori'] : '' ?>">
                          <option value="Pilih Kategori">Pilih Kategori</option>
                          <?php foreach ($rowCategory as $category) {?>
                            <option value="<?php echo $category['id'] ?>"><?php echo $category['nama_kategori'] ?></option>
                          <?php } ?>
                        </select>
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
                    <div class="col-sm-2">
                        <label class="form-label" for="tags" >Tags: </label>
                    </div>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="tags" id="tags"  value="<?= isset($_GET['idEdit']) || isset($_GET['sidebar']) ? $rowEdit['tags'] : '' ?>"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <label class="form-label" for="status" >Status: </label>
                    </div>
                    <div class="col-sm-10">
                        <select type="text" class="form-control" name="status" id="status" value="<?= isset($_GET['idEdit']) || isset($_GET['sidebar']) ? $rowEdit['status'] : '' ?>">
                          <option value="1">Publish</option>
                          <option value="0">Draft</option>
                        </select>
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
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
  <script>
    $(".summernote").summernote({
      height: 300,
    });
  </script>
</body>

</html>