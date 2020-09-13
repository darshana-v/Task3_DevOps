<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta name=viewport content="width=device-width, initial-scale=1">
  </head>

<body>
  <header>

      <nav>
          <a href="">
          </a>
          <ul>
              <li><a href="index.php">Dashboard</a></li>
              <li><a href="">About Me</a></li>
              <li><a href="">Contact</a></li>
          </ul>
          <div class="header-login">
              <?php
                  if (isset($_SESSION['id'])) {
                      echo '<form action="includes/logout.inc.php" method="post">
                            <button type="submit" name="logout">Logout</button>
                            </form>';
                  }
                  else {
                      echo '<form action="includes/login.inc.php" method="post">
                      <input type="text" name="username" placeholder="Username">
                      <input type="password" name="password" placeholder="Password">
                      <button type="submit" name="login">Login</button>
                      </form>
                      <a href="signup.php" class="header-signup">Signup</a>';
                        }
              ?>

          </div>
      </nav>

  </header>
</body>
</html>