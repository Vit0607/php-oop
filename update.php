<?php
require_once 'init.php';

$user = new User;

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        
        $validate = new Validate();

        $validate->check($_POST, [
            'username' => [
                'required' => true,
                'min' => 2,
                'max'=> 15
            ]
        ]);

        if ($validate->passed()) {
            $user->update($user->data()->id, ['username' => Input::get('username')]);

            Redirect::to('update.php');
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
        <label for="username">Username</label>
        <input id="username" name=username type="text" value="<?php echo $user->data()->username; ?>" />
    </div>
    <div class="field">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
    </div>
    <div class="field">
        <button type="submit">Submit</button>
    </div>
</form>