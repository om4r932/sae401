<?php //require "view_begin.php"; ?>

<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <!-- STYLESHEET -->
    <link rel="stylesheet" href="Content/css/menu.css" />

     <!-- Sidebar -->
     <div class="sidebar">
      <div class="logo-details">
          <div class="logo_name"><nobr>Perform Vision</nobr></div>
          <i class='bx bx-menu' id="btn"></i>
      </div>
      <ul class="nav-list">
          
        <!-- Dashboard -->
        <li>
            <a <?php echo ($_GET['controller'] == 'dashboard') ? 'class="actu"' : ''; ?> href="?controller=dashboard">
                <i class='bx bx-grid-alt'></i>
                <span class="links_name">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
        </li>

        <!-- Formateurs -->
        <?php if ($role == 'Client') : ?>
            <li>
                <a <?php echo ($_GET['controller'] == 'formateurs') ? 'class="actu"' : ''; ?> href="?controller=formateurs">
                    <i class='bx bx-folder'></i>
                    <span class="links_name">Formateurs</span>
                </a>
                <span class="tooltip">Formateurs</span>
            </li>
        <?php endif; ?>

        <!-- Discussions -->
        <li>
            <a <?php echo ($_GET['controller'] == 'discussion') ? 'class="actu"' : ''; ?> href="?controller=discussion">
                <i class='bx bx-chat'></i>
                <span class="links_name">Discussions</span>
            </a>
            <span class="tooltip">Discussions</span>
        </li>

        <!-- Mon Profil -->
        <li>
            <a <?php echo ($_GET['controller'] == 'profile') ? 'class="actu"' : ''; ?> href="?controller=profile">
                <i class='bx bx-user'></i>
                <span class="links_name">Profile</span>
            </a>
            <span class="tooltip">Profile</span>
        </li>

        <!-- Paramètre -->
        <!-- <li>
            <a <?php //echo ($_GET['controller'] == 'parametre') ? 'class="actu"' : ''; ?> href="?controller=parametre">
                <i class='bx bx-cog'></i>
                <span class="links_name">Paramètre</span>
            </a>
            <span class="tooltip">Paramètre</span>
        </li> -->

        <li class="profile">
            <div class="profile-details">
                <?php
                // Assuming $userDetails is an associative array containing user details
                echo '<img src="Content/img/' . $photo_de_profil . '" alt="profileImg">';
                echo '<div class="name_job">';
                echo '<div class="name">' . $prenom . '</div>';
                echo '<div class="job">' . $role . '</div>'; // Assuming "Formateur" is static
                echo '</div>';
                ?>
            </div>
            <a href="index.php?controller=auth&action=logout"><i class='bx bx-log-out' id="log_out"></i></a>
        </li>

      </ul>
  </div>

  <script src="Content/script/side.js"></script>

<?php //require "view_end.php"; ?>