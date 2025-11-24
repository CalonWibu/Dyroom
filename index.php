
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/global.css">
    <?php include 'koneksi/db.php';
    
    session_start();
      $url = $_GET['url'] ?? 'home';
    $tittle = $_SESSION['tittle'] ?? "DYROOM";
    
    
    ?>
    <?php
    if ($url == "akun") {
      echo '
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
      
      ';
    }
    ?>
    <title><?= $tittle ?></title>
</head>
<body>
  <!-- navbar -->
   <?php if($url != 'home') {
        include 'components/navbar.php';
   }?>

    <!-- main -->
    <?php include 'router/routes.php'; ?>


    <!-- footer -->
    <?php include 'components/footer.php'; ?>

    <?php include 'components/animation.php'; ?>


</body>
</html>