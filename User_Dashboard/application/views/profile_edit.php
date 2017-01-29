<!DOCTYPE html>
<html lang='en'>
<head>
    <title>Edit Profile</title>
    <link rel='stylesheet' type='text/css' href='/assets/stylesheets/header.css'>
    <link rel='stylesheet' type='text/css' href='/assets/stylesheets/edit.css'>

</head>
<body>
    <?php include_once('header2.php') ?>
    <h2>Edit Profile</h2>
    <?php include_once('edit.php') ?>
    <form class='desc' action='/users/update' method='post'>
        <h4>Edit Description:</h4>
        <textarea name='description'><?=$to_edit['description']?></textarea><br>
        <input type='hidden' name='id' value=<?=$to_edit['id']?>>
        <input type='hidden' name='update' value='description'>
        <input type='submit' value='Save'>
    </form>
</body>
</html>
