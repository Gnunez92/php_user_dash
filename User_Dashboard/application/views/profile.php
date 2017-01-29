<!DOCTYPE html>
<html lang='en'>
<head>
    <title>User Information</title>
    <link rel='stylesheet' type='text/css' href='/assets/stylesheets/header.css'>
    <link rel='stylesheet' type='text/css' href='/assets/stylesheets/profile.css'>
</head>
<body>
    <?php include_once('header2.php') ?>
    <h2><?=$first_name.' '.$last_name?></h2><br>
    <p>Registered at:</p>
    <p><?=$created_at?></p><br>
    <p>User ID:</p>
    <p><?=$id?></p><br>
    <p>Email address:</p>
    <p><?=$email?></p><br>
    <p>Description:</p>
    <p class='desc'><?=$description?></p>
    <h2>Leave a message for <?=$first_name?></h2>
    <form action='/texts/new_message' method='post'>
        <textarea name='message'></textarea>
        <input type='hidden' name='id' value=<?=$id?>>
        <input type='submit' value='Post'>
    </form>
    <?php foreach($messages as $message){
        ?>
        <div class='message'>
            <p><?=$message['first_name'] . ' ' . $message['last_name']?> wrote on <?= date("F j, Y", strtotime($message['created_at'])) ?> at <?= date("g:i a", strtotime($message['created_at']))?>
            </p>
            <p class='tab'>-<?=$message['message']?></p>
            <?php foreach($comments[$message['id']] as $comment){ ?>
                <div class='comment'>
                    <small><?=$comment['first_name'] . ' ' . $comment['last_name']?> replied on <?= date("F j, Y", strtotime($comment['created_at'])) ?> at <?= date("g:i a", strtotime($comment['created_at']))?>
                    </small>
                    <small class='tab'>-<?=$comment['comment']?></small>
                </div>
            <?php } ?>
            <form action='/texts/new_comment' method='post'>
                <textarea name='comment'>Leave a comment</textarea>
                <input type='hidden' name='message_id' value=<?=$message['id']?>>
                <input type='hidden' name='id' value=<?=$id?>>
                <input type='hidden' name='message_id' value=<?=$message['id']?>>
                <input type='submit' value='Post'>
            </form>
        </div>
    <?php } ?>
