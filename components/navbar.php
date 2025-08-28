    <style>
          header {
      position: absolute;
      top: -100px;
      left: 0;
      width: 100%;
      z-index: 10;
    }

    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 30px;
    }

    #profil {
      color: #ffffff;
      font-size: 30px;
      cursor: pointer;
      transition: 0.2s ease-in-out;
    }

    #profil:hover {
      color: #fec91bff;
    }

    </style>
    <header>
        <nav>
            <img src="logo.png" alt="DYROOM" style="cursor: pointer;" onclick="window.location.href='view.php'">

            <?php
           

                if (isset($_SESSION['email'])) {
                    echo '<a href="admin/admin.php" style="background: transparent; border: none; text-decoration: none;"><i class="bi bi-person-circle" id="profil"></i></a>';
                } else {
                  echo '<a href="login-system/login.php" style="color: #e5a40bff; text-decoration: none; font-size: 14px;">SIGN-UP</a>';
                }


            ?>


            </nav>
    </header>