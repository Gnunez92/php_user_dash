<div>
    <h4>Edit Information</h4>
    <form action='/users/update' method='post'>
        <label>Email Address:</label>
        <input type='text' name='email' value=<?=$to_edit['email']?>>
        <label>First Name:</label>
        <input type='text' name='first_name' value=<?=$to_edit['first_name']?>>
        <label>Last Name:</label>
        <input type='text' name='last_name' value=<?=$to_edit['last_name']?>>
        <?php if($user['user_level'] == '9'){?>
        <label>User level:</label><br>
        <select name='user_level'>
            <option value='1'>Normal</option>
            <option value='9'>Admin</option>
        </select><br>
        <?php } ?>
        <input type='hidden' name='id' value=<?=$to_edit['id']?>>
        <input type='hidden' name='update' value='info'>
        <input type='submit' value='Save'>
</div>
<div>
    <h4>Change Password</h4>
    <?=$message?>
    <form action='/users/update' method='post'>
        <label>Password:</label>
        <input type='password' name='password'>
        <label>Password Confirmation:</label>
        <input type='password' name='pass_confirm'>
        <input type='hidden' name='id' value=<?=$to_edit['id']?>>
        <input type='hidden' name='update' value='password'>
        <input type='submit' value='Update Password'>
    </form>
</div>
