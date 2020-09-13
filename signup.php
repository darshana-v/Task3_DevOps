<?php
  require "header.php"
?>

<main>
<!--
    <div class="wrapper-main"
         <section class="section.default"
-->
               <h1>Signup</h1>
               <form action="includes/signup.inc.php" method="post">
                   <input type="text" name="username" placeholder="Username">
                   <input type="password" name="password" placeholder="Password">
                   <input type="password" name="password-repeat" placeholder="Repeat password">
                   <button type="submit" name="signup">Signup</button>
               </form>

</main>
