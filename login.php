<?php include('navbar.php');

if ($isAuthenticated) {
  echo "<script>window.location.href='index.php';</script>";
}

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sqlQuery = "SELECT email FROM user WHERE email = '$email' AND password = '$password' LIMIT 1;";
  $result = mysqli_query($conn, $sqlQuery);

  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      session_start();
      $_SESSION['authenticated'] = true;
      $_SESSION['email'] = $email;
      echo "<script>alert('Berhasil Login.');</script>";
      header("Location: index.php");
      exit;
    } else {
      echo "<script>alert('Gagal login, silahkan login kembali.');</script>";
    }
  } else {
    echo "<script>alert('Gagal menjalankan query.');</script>";
  }
}
?>

<div class="body">
  <div class="screen-1">
    <div class="title">
      <h1>Login</h1>
    </div>

    <form method="POST" action="login.php">
      <div class="textInput">
        <label for="email">Email Address</label>
        <div class="sec-2">
          <ion-icon name="mail-outline"></ion-icon>
          <input type="email" name="email" placeholder="johndoe@gmail.com" required />
        </div>
      </div>

      <div class="textInput">
        <label for="password">Password</label>
        <div class="sec-2">
          <ion-icon name="lock-closed-outline"></ion-icon>
          <input class="pas" type="password" name="password" placeholder="············" required />
          <ion-icon class="show-hide" name="eye-outline"></ion-icon>
        </div>
      </div>

      <button type="submit" name="submit" class="button-submit">
        Submit
      </button>
    </form>

    <div class="w-full center">
      <span><a href="/register.php">Register</a></span>
    </div>
  </div>
</div>

<?php include('footer.php');
