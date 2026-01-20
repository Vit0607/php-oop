<?php
require_once 'init.php';

$user = new User;

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        
        $validate = new Validate();

        $validate->check($_POST, [
            'password' => ['required' => true],
            'new_password' => ['required' => true, 'min' => 2],
            'new_password_again' => ['required' => true, 'matches' => 'new_password'],
        ]);

        $is_password_verified = password_verify($_POST['password'], $user->data()->password);

        if ($validate->passed()) {

            if ($is_password_verified ) {
                $user->update($user->data()->id, ['password' => Input::get('new_password')]);

                Session::flash('success', 'Password has been changed');
                Redirect::to('index.php');
            } else {
                echo 'Current password is wrong' . '<br>';
            }

        } else {
            foreach ($validate->errors() as $error) {
                echo $error . '<br>';
            }
        }
    }
}

?>

<form action="" method="post">
    <div class="field">
        <label for="password">Current password</label>
        <input id="password" name=password type="password" value="" />
    </div>
    <div class="field">
        <label for="new_password">New password</label>
        <input id="new_password" name=new_password type="password" value="" />
    </div>
    <div class="field">
        <label for="new_password_again">New password again</label>
        <input id="new_password_again" name=new_password_again type="password" value="" />
    </div>
    <div class="field">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
    </div>
    <div class="field">
        <button type="submit">Submit</button>
    </div>
</form>