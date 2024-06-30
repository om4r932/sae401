<?php require "view_begin.php"; ?>

<link
      href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="Content/css/dashboard.css" />
    <div class="container">
      <aside class="left-column">
        <div class="top">
          
          <div class="close" id="close-btn">
            <span class="material-icons-sharp">close</span>
          </div>
        </div>

        <?php require "view_menu.php"; ?>

        </aside>

      <!------------------ END OF ASIDE ------------------>
      <main>
        <h1>Mes Formations</h1>

        <!-- <div class="date">
          <input type="date" />
        </div> -->

        <div class="insights">
          <div class="sales">
            <span class="material-icons-sharp">stacked_line_chart</span>
            <div class="middle">
              <div class="left">
                <h3>En Cours</h3>
                <h1>2</h1>
              </div>
              <div class="progress">
                <svg>
                  <circle cx="38" cy="38" r="36"></circle>
                </svg>
                <div class="number">
                  <p>81%</p>
                </div>
              </div>
            </div>
            <small class="text-muted">Dernier Mois</small>
          </div>
          <!------------ END OF SALES -------------->
          <div class="expenses">
            <span class="material-icons-sharp">bar_chart</span>
            <div class="middle">
              <div class="left">
                <h3>Formations Fini</h3>
                <h1>4</h1>
              </div>
              <div class="progress">
                <svg>
                  <circle cx="38" cy="38" r="36"></circle>
                </svg>
                <div class="number">
                  <p>62%</p>
                </div>
              </div>
            </div>
            <small class="text-muted">Dernier Mois</small>
          </div>
          <!------------ END OF EXPENSES -------------->
          <div class="income">
            <span class="material-icons-sharp">account_circle</span>
            <div class="middle">
              <div class="left">
                <h3>Mon Profil</h3>
                <a href="?controller=profile"><button class="button4">
                  Accéder à mon profil
                </button></a>
              </div>
              <div class="progress">
                <svg>
                  <circle cx="38" cy="38" r="36"></circle>
                </svg>
                <div class="number">
                  <p>44%</p>
                </div>
              </div>
            </div>
          </div>
          <!------------ END OF INCOME -------------->
        </div>
        <!------------ END OF INSIGHTS -------------->

        <div class="recent-orders">
    <h2>Mes discussions</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Dernier message</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($discussions as $discussion): ?>
                <tr>
                    <td><?= htmlspecialchars($discussion['nom_interlocuteur']) ?></td>
                    <td><?= htmlspecialchars($discussion['prenom_interlocuteur']) ?></td>
                    <?php if ($discussion['lastMessage']): ?>
                        <td><?= htmlspecialchars($discussion['lastMessage']['date_heure']) ?></td>
                        <td><?= ($discussion['lastMessage']['lu']) ? 'Lu' : 'Pas Lu' ?></td>
                    <?php else: ?>
                        <td colspan="2">Aucun dernier message disponible</td>
                    <?php endif; ?>
                    <td>
                        <a href="?controller=discussion&action=discussion&id=<?= $discussion['discussion_id'] ?>">
                            <button class="butto">
                                <span>Voir discussions</span>
                            </button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="#">Show All</a>
</div>


      </main>
      <!----------------- END OF MAIN -------------------->

      <div class="right">
        <div class="top">
          <button id="menu-btn">
            <span class="material-icons-sharp">menu</span>
          </button>
          <div class="theme-toggler">
            <span class="material-icons-sharp active">light_mode</span>
            <span class="material-icons-sharp">dark_mode</span>
          </div>
          <div class="profile">
            <div class="info">
              <p>Salut, <b><?= $prenom ?></b></p>
              <small class="text-muted"><?= $role ?></small>
            </div>
            <div class="profile-photo">
              <img src="Content/img/<?= $photo_de_profil ?>" />
            </div>
          </div>
        </div>

        <!----------------- END OF RECENT UPDATES -------------------->
      </div>
    </div>


    <script src="Content/script/dashboard.js"></script>

<?php require "view_end.php"; ?>