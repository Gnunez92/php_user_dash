<form action="/reg/signup" method='post'>
    <h4>Email Address:</h4>
    <?=$errors['email_error']?>
    <input type='text' name='email'>
    <h4>First Name:</h4>
    <?=$errors['first_name_error']?>
    <input type='text' name='first_name'>
    <h4>Last Name:</h4>
    <?=$errors['last_name_error']?>
    <input type='text' name='last_name'>
    <h4>Password:</h4>
    <?=$errors['password_error']?>
    <input type='password' name='password'>
    <h4>Password Confirmation:</h4>
    <?=$errors['pass_confirm_error']?>
    <input type='password' name='pass_confirm'>
    <input type='hidden' name='from' value=<?=$from?>>
    <input class='button'type='submit' value=<?=$button_text?>>
</form>
