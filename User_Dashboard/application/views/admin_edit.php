<!DOCTYPE html>
<html lang='en'>
<head>
    <title>Edit User</title>
    <link rel='stylesheet' type='text/css' href='/assets/stylesheets/header.css'>
    <link rel='stylesheet' type='text/css' href='/assets/stylesheets/edit.css'>

</head>
<body>
    <?php include_once('header2.php') ?>
    <h2>Edit User #<?=$to_edit['id']?></h2>
    <a class='admin_link' href='/dashboard/admin'>Return to Dashboard</a>
    <?php include_once('edit.php') ?>
</body>
</html>
