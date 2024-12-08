<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Sidebar Master Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      min-height: 100vh;
      margin: 0;
      overflow-x: hidden;
    }
    #sidebar {
      width: 250px;
      background: #343a40;
      color: white;
      padding: 15px;
      transition: transform 0.3s ease;
    }
    #sidebar.hidden {
      transform: translateX(-100%);
    }
    #content {
      flex-grow: 1;
      padding: 20px;
    }
    a.nav-link {
      color: white;
    }
    a.nav-link:hover {
      background-color: #495057;
      border-radius: 5px;
    }
    .toggle-btn {
      background: #343a40;
      color: white;
      border: none;
      margin: 10px;
      padding: 10px;
      cursor: pointer;
    }
    .toggle-btn:hover {
      background: #495057;
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div id="sidebar" class="d-flex flex-column">
    <h4>Menu</h4>
    <nav class="nav flex-column">
      <a class="nav-link active" href="page1.php" target="content-frame">Page 1</a>
      <a class="nav-link" href="page2.php" target="content-frame">Page 2</a>
      <a class="nav-link" href="page3.php" target="content-frame">Page 3</a>
    </nav>
  </div>

  <!-- Main Content -->
  <div id="content">
    <button id="toggle-menu" class="toggle-btn d-md-none">☰ Toggle Menu</button>
    <!-- Iframe to load pages -->
    <iframe id="content-frame" name="content-frame" src="page1.html" style="width: 100%; height: calc(100vh - 60px); border: none;"></iframe>
  </div>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const sidebar = document.getElementById('sidebar');
      const toggleMenuButton = document.getElementById('toggle-menu');

      // Toggle sidebar visibility
      toggleMenuButton.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
      });

      // Ensure sidebar is visible on larger screens
      window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) {
          sidebar.classList.remove('hidden');
        }
      });
    });
  </script>
</body>
</html>
