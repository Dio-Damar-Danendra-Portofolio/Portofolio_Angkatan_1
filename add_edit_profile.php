<?php 
require_once "koneksi.php";
session_start();
session_regenerate_id();

if (!isset($_SESSION['Email'])) {
    header("Location: Login.php");
} 

if (isset($_POST['tambah_profil'])) {
    $foto = $_FILES['foto'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $deskripsi = $_POST['deskripsi'];
    var_dump($foto);

    if ($foto["error"] == 0) {
        $fillName = uniqid() . "_" . basename($foto["name"]);
        $fillPath = "assets/uploads/" . $fillName;
        move_uploaded_file($foto['tmp_name'], $fillPath);
        $q_insert = mysqli_query($conn, "INSERT INTO profiles (foto, nama, jabatan, deskripsi) VALUES ('$fillName', '$nama', '$jabatan', '$deskripsi')");
    }

    if ($q_insert) {
        header('Location: profile.php');
    } else {
        header('Location: add_edit_profile.php');
    }
}

// echo base64_decode($_GET['idEdit']);
if (isset($_GET['idEdit'])) {
    $idEdit = base64_decode($_GET['idEdit']);
    $edit = mysqli_query($conn, "SELECT * FROM profiles WHERE id = $idEdit");
    $row_edit = mysqli_fetch_assoc($edit);
    // var_dump($row_edit);
}

if (isset($_POST['edit_profil'])) {
    $idEdit = base64_decode($_GET['idEdit']);
    $foto = $_FILES['foto'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $deskripsi = $_POST['deskripsi'];


    if ($foto["error"] == 0) {
        $fillName = uniqid() . "_" . basename($foto["name"]);
        $fillPath = "assets/uploads/" . $fillName;
        $fieldPhoto = "";
 
        if (move_uploaded_file($foto['tmp_name'], $fillPath)) {
            $periksaFoto = mysqli_query($conn, "SELECT foto FROM profiles WHERE id = $idEdit");
            $rowFoto = mysqli_fetch_assoc($periksaFoto);

            if ($rowFoto && file_exists("assets/uploads/" . $rowFoto['foto'])) {
                unlink("assets/uploads/" . $rowFoto['foto']);
            }
            $fieldFoto = "photo='$fillName',";
        } else {
            echo "Foto gagal diperbarui";
        }

        // move_uploaded_file($Foto['tmp_name'], $fillPath);
        // $q_insert = mysqli_query($conn, "INSERT INTO profiles (foto, nama, jabatan, deskripsi) VALUES ('$fillName', '$nama', '$jabatan', '$deskripsi')");
    }
    $update = mysqli_query($conn, "UPDATE profiles SET $fieldFoto nama='$nama', jabatan='$jabatan', deskripsi='$deskripsi' 
    WHERE id = $idEdit"); 
    if ($update) {
        header("Location: profile.php");
    } else {
        header("Location: add_edit_profile.php?idEdit=$idEdit");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <?php require "inc/navbar.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header"><?php isset($_GET['idEdit']) ? 'Perbarui' : 'Tambahkan' ?> Profil</div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                        <div class="mt-1">
                            <label for="foto" class="form-label">Foto: </label>
                            <input type="file" name="foto" id="foto" class="form-control">
                            <?php if (isset($_GET['idEdit'])) { ?>
                                <img src="assets/uploads/<?php echo $row_edit['foto']?>" width="135" alt="">
                            <?php }?>
                        </div>
                        <div class="mt-1">
                            <label for="nama" class="form-label">Nama: </label>
                            <input type="text" name="nama" id="nama" value="<?php echo isset($_GET['idEdit']) ? $row_edit['nama'] : '' ?>" class="form-control">
                        </div>
                        <div class="mt-1">
                            <label for="jabatan" class="form-label">Jabatan: </label>
                            <input type="text" name="jabatan" id="jabatan" value="<?php echo isset($_GET['idEdit']) ? $row_edit['jabatan'] : '' ?>" class="form-control">
                        </div>
                        <div class="mt-1">
                            <label for="deskripsi" class="form-label">Deskripsi: </label>
                            <textarea  cols="30" rows="3" name="deskripsi" id="deskripsi" value="<?php echo isset($_GET['idEdit']) ? $row_edit['deskripsi'] : '' ?>" class="form-control"></textarea>
                        </div>
                        <div class="mt-1">
                            <a class="btn btn-danger" href="profile.php">Kembali</a>
                            <button class="btn btn-success" name="<?php echo isset($_GET['idEdit']) ? 'edit_profil' : 'tambah_profil'; ?>" type="submit"><?php echo isset($_GET['idEdit']) ? 'PERBARUI' : 'TAMBAH'; ?></button>
                        </div>
                        </form>
                    </div>
                    
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>