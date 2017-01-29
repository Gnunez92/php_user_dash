<!DOCTYPE html>
<html lang='en'>
<head>
    <title>Confirm Account Remove</title>
    <link rel='stylesheet' type='text/css' href='/assets/stylesheets/header.css'>
    <link rel='stylesheet' type='text/css' href='/assets/stylesheets/profile.css'>
</head>
<body>
    <?php include_once('header2.php') ?>
    <div>
        <h1>Delete this account?</h1>
        <h2><a href=<?='/users/delete/'.$id?>>Confirm</a></h2>
        <h2><a href=<?='/dashboard'?>>Cancel</a></h2>
    </div>
    <h2><?=$first_name.' '.$last_name?></h2><br>
    <p>Registered at:</p>
    <p><?=$created_at?></p><br>
    <p>User ID:</p>
    <p><?=$id?></p><br>
    <p>Email address:</p>
    <p><?=$email?></p><br>
