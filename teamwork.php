<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar Active Menu</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .nav-link.active {
      background-color: #495057;
      color: white !important;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Teamwork</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
        <li class="nav-item">
            <a class="nav-link active" href="allmaintanance.php" target="content-frame" data-page="page1">รายการแจ้งซ่อมทั้งหมด</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="page1.php" target="content-frame" data-page="page1">การแจ้งซ่อมบำรุง</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="page2.php" target="content-frame" data-page="page2">รายการซ่อม</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="page3.php" target="content-frame" data-page="page3">การเปิดใบงาน</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#" id="logout-link">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div id="content">
    <iframe id="content-frame" name="content-frame" src="index.php" style="width: 100%; height: calc(100vh - 120px); border: none;"></iframe>
  </div>

  <!-- Footer -->
  <footer id="footer" class="bg-dark text-white text-center py-3">
    Logged in as: <span id="user-id"><?php echo $_SESSION["EMPID"]; ?>!</span>
  </footer>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const navLinks = document.querySelectorAll('.nav-link');

      // Handle active link state
      navLinks.forEach(link => {
        link.addEventListener('click', () => {
          // Remove active class from all links
          navLinks.forEach(nav => nav.classList.remove('active'));
          // Add active class to the clicked link
          link.classList.add('active');
        });
      });

      // Handle logout
      document.getElementById('logout-link').addEventListener('click', () => {
        alert("You have been logged out!");
        window.location.href = "login.php"; // Replace with your login page
      });
    });
  </script>
</body>
</html>
