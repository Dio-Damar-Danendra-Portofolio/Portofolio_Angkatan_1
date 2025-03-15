<?php 
        include "koneksi.php";
        $kueri = mysqli_query($conn, "SELECT profiles.id AS IDPengguna, profiles.foto, profiles.nama, 
        profiles.jabatan, profiles.deskripsi, more_profiles.id_profile, more_profiles.skill, 
        more_profiles.pengalaman, GROUP_CONCAT(more_profiles.skill SEPARATOR '<br>') AS skl, 
        GROUP_CONCAT(more_profiles.pengalaman SEPARATOR '<br>') AS pgl, GROUP_CONCAT(profiles.deskripsi SEPARATOR '<br>') AS dsk 
        FROM profiles 
        RIGHT JOIN more_profiles on more_profiles.id_profile = profiles.id WHERE profiles.status = 1");
        $row = mysqli_fetch_assoc($kueri);
        $skills = ["HTML", "CSS", "JavaScript", "C", "Multimedia Skills"];
        $experiences = ["BINUS Kedaireka (09/2022 - 08/2023)", "Apprentice in Positive Republik (01/2018 - 03/2018)", "Application Developer and Product Owner in PT Spesial Karya Mandiri (08/2024 - Present)"];
        $latar_belakang = "I am Dio Damar Danendra, a Computer Science student at BINUS University, specializing in Software Engineering. I am known
                                    for my meticulous adherence to rules and my eagerness to learn about emerging technologies.
                                    My interests span HTML, CSS, editing skills, and robotics, reflecting my fluency in technology and proficiency in meeting
                                    Global Standard Technical Competencies (GSTC) requirements. I am deeply passionate about robotics, multimedia, coding,
                                    and web design, particularly in developing web-controlled robots and toys.";
        $jabatan = "Application Developer / Product Owner at PT Spesial Karya Mandiri";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Me</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="tugas_pak_tri.css">
</head>
<body>
    <?php require "inc/navbar.php"; ?>
    <main class="display-info bg-white">
        <div class="container-fluid">
            <div class="row mb-10">
                <div class="col-md-6 pr-5 pt-4">
                    <h1>About Me</h1>
                </div>
                <div class="col-md-6 pr-5 pt-4 "></div>
            </div>
        </div>
        <br>
        <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <p><?php echo isset($row['dsk']) ? $row['dsk'] : "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu imperdiet felis."; ?></p>
                </div>
            </div>
        </div>
    </main>
    <?php require "inc/footer.php"; ?>
</body>
</html>