    <style>
         
         header {
          position: fixed;
          width: 100%;
         }

    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 30px 25px 30px;
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
      <center>
        <nav>
            <img src="../asset/logo.png" alt="DYROOM" style="cursor: pointer;" onclick="window.location.href='index.php?url=home'">

            <?php
           
            if ($url != "akun") {
              if (isset($_SESSION['email'])) {
                  echo '<a href="admin/admin.php" style="background: transparent; border: none; text-decoration: none;"><i class="bi bi-person-circle" id="profil"></i></a>';
              } else {
                echo '<a href="login-system/login.php" style="color: #e5a40bff; text-decoration: none; font-size: 14px;">SIGN-UP</a>';
              }

            }


            ?>
            </nav>
      </center>
    </header>