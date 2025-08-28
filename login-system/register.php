<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: sans-serif;
}

body {
  background-color: #0d0d0d;
  color: white;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}

.form-container {
  background: #111;
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
  width: 350px;
  text-align: center;
}

.form-container h2 {
  margin-bottom: 20px;
  font-weight: normal;
  letter-spacing: 1px;
}

.form-container label {
  display: block;
  text-align: left;
  margin-bottom: 5px;
  font-size: 14px;
  color: #ccc;
}

.form-container input {
  width: 100%;
  padding: 12px;
  margin-bottom: 15px;
  border: none;
  border-radius: 8px;
  background: #e0e0e0;
  font-size: 14px;
}

.form-container button {
  width: 100%;
  padding: 12px;
  background: #1a73e8;
  border: none;
  border-radius: 8px;
  color: white;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s;
}

.form-container button:hover {
  background: #0d47a1;
}

a {
  color: #ffffff;
  text-decoration: none;
  background-color: #f5b800;
  padding: 10px 20px;
  border-radius: 10px;
  position: absolute;
  left: 10px;
  top: 10px;
}
</style>

<?php include '../koneksi/db.php'; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama  = $_POST["nama"];
    $email = $_POST["email"];
    $telp  = $_POST["telp"];
    $pass  = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (nama, email, telp, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $nama, $email, $telp, $pass);

    if ($stmt->execute()) {
        $_SESSION["email"] = $email;
        $_SESSION["nama"]  = $nama;

        // $redirect = isset($_SESSION["redirect_url"]) ? $_SESSION["redirect_url"] : "../view.php";
        // unset($_SESSION["redirect_url"]);
        header("Location: ../view.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<a href="login.php">LOGIN</a>

<div class="form-container">
  <h2>Register</h2>
  <form method="POST" action="register.php">
    <label for="nama">Nama</label>
    <input type="text" id="nama" name="nama" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <label for="telp">Telepon</label>
    <input type="text" id="telp" name="telp" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">SUBMIT</button>
  </form>
</div>


</body>
</html>