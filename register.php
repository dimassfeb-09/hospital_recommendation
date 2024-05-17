<?php include('navbar.php');

if ($isAuthenticated) {
  echo "<script>window.location.href='index.php';</script>";
}

if (isset($_POST['submit'])) {
  $fullName = $_POST['fullName'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sqlSelectEmailIsAlreadyExists = "SELECT user_id FROM user WHERE email = '$email';";
  $resultEmailIsExists = mysqli_query($conn, $sqlSelectEmailIsAlreadyExists);
  if (mysqli_num_rows($resultEmailIsExists) > 0) {
    echo "<script>alert('Email telah digunakan.');</script>";
    echo "<script>window.location.href='register.php';</script>";
    return;
  }


  $sqlQuery = "INSERT INTO user (full_name, email, password) VALUES ('$fullName', '$email', '$password')";
  $result = mysqli_query($conn, $sqlQuery);
  if ($result) {
    echo "<script>window.location.href = 'login.php'; alert('Berhasil daftar, silahkan login.');</script>";
  } else {
    echo "<script>alert('Gagal')</script>";
  }
}
?>


<div class="body">
    <div class="screen-1">
        <div class="title">
            <h1>Register</h1>
        </div>

        <form method="POST" action="register.php">
            <div class="textInput">
                <label for="fullName">Nama Lengkap</label>
                <div class="sec-2">
                    <ion-icon name="people-outline"></ion-icon>
                    <input type="text" name="fullName" placeholder="John Doe" required />
                </div>
            </div>

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
            <span><a href="login.php">Login</a></span>
        </div>
    </div>
</div>

<?php include('footer.php');
