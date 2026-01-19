<?php
require_once 'init.php';

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        
        $validate = new Validate();

        $validate->check($_POST, [
            'email' => ['required' => true, 'email' => true],
            'password' => ['required' => true]
        ]);

        if ($validate->passed()) {
            $user = new User();

            $remember = Input::get('remember') === 'on' ? true : false;

            $login = $user->login(Input::get('email'), Input::get('password'), $remember);

            if ($login) {
               Redirect::to('index.php');
            } else {
                echo 'login failed';
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
        <label for="email">Email</label>
        <input type="text" id="email" name="email" value="<?php echo Input::get('email'); ?>" />
    </div>
    <div class="field">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" />
    </div>
    <div class="field">
        <label for="remember">Remember me</label>
        <input type="checkbox" name="remember" id="remember" />
    </div>
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
    <div class="field">
        <button type="submit">Submit</button>
    </div>
</form>