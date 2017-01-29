<!DOCTYPE html>
<html lang='en'>
<head>
    <title>Signin Page</title>
    <link rel='stylesheet' type='text/css' href='/assets/stylesheets/header.css'>
    <link rel='stylesheet' type='text/css' href='/assets/stylesheets/sign.css'>
</head>
<body>
    <?php include_once('header.php') ?>
    <h2>Sign In</h2>
<?php
    if($this->session->flashdata("message")) {
?>
        <p class="red"><?= $this->session->flashdata("message") ?></p>
<?php
    }
 ?>
    <form action="/reg/login" method='post'>
        <h4>Email Address:</h4>
        <input type='text' name='email'>
        <h4>Password:</h4>
        <input type='password' name='password'>
        <input class='button'type='submit' value='Sign In'>
    </form>
    <a href='/register'>Don't have an account? Register.</a>
</body>
</html>
