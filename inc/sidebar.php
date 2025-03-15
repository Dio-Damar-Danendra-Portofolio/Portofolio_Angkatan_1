<?php 
    // include "../koneksi.php";
    // session_start();

    // if (!isset($_SESSION["Electronic_Mail"])) {
    //   header('location:../login.php');
    // }
?>
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="setting.php">
          <i class="bi bi-person"></i>
          <span>Pengaturan Umum</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="services.php">
          <i class="bi bi-question-circle"></i>
          <span>Services</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="contact.php">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="resume.php">
          <i class="bi bi-archive-fill"></i>
          <span>Resume</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="skill.php">
          <i class="bi bi-clipboard-data-fill"></i>
          <span>Skill</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="projects.php">
          <i class="bi bi-clipboard-data"></i>
          <span>Project</span>
        </a>
      </li>
    </ul>
  </aside>