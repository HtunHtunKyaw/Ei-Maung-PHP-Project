<?php
    session_start();

    include ('../vendor/autoload.php');

    use Libs\Database\MySQL;
    use Libs\Database\UsersTable;
    use Helpers\HTTP;

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $table = new UsersTable(new MySQL());

    $user = $table->findByEmailAndPassword($email, $password);

    if ($user) {
        // if ($table->suspended($user->id)) {
        //     HTTP::redirect("/index.php", "suspended=1");
        // }

        $_SESSION['user'] = $user;
        HTTP::redirect("/profile.php");
    } else {
        HTTP::redirect("/index.php", "incorrect=1");
    }