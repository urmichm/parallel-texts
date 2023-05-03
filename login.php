<?php
    $PAGE_TITLE = "Login";

    require_once 'model/author_db.php';
    require_once 'model/domain/Author.php';

    session_start();

    if( isset($_POST['email']) && isset($_POST['password']) ) {
        unset( $_SESSION['user_id'] );
    
        $email = $_POST['email'];
        $password = $_POST['password'];

        $author = get_author_by_email($email);
        $password_hashed = hash('sha256', $password);

        if ($author && hash_equals($password_hashed, $author->get_password())) {
            $_SESSION['user_id'] = $author->get_id();
            header('Location: account.php');
            return;
        } else {
            $_SESSION['login_error'] = true;
            header('Location: login.php');
            return;
        }
    }

?>

<!DOCTYPE html>
<html>


<head>
    <title><?php echo $PAGE_TITLE; ?></title>    
    <meta charset="utf-8">
    <meta http-equiv="X-UI-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">

    <style type="text/css">
        body {
           background-color: #DADADA;
        }
        body > .grid {
            height: 100%;
        }
        .image {
            margin-top: -100px;
        }
        .column {
            max-width: 450px;
        }

        img {
            transform: scale(1.25);
        }
    </style>

</head>

<body>

    <div class="ui middle aligned center aligned grid">
        <div class="column">

            <h2 class="ui teal image header">
            <img src="assets/images/logo-trans.png" scale="2" class="image">
            <div class="content">
                Log-in to your account
            </div>
            </h2>

            <form class="ui large form" method="POST" id="login-form" >
                <div class="ui stacked segment">
                    <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="email" placeholder="E-mail address">
                    </div>
                    </div>
                    <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                    </div>
                    <button class="ui fluid large teal submit button">Login</button>
                </div>
            </form>

            <?php if (isset($_SESSION['login_error'])) { ?>
                <div class="ui error message">
                    Incorrect password or login
                </div>
            <?php } unset($_SESSION['login_error']); ?>

            <div class="ui message">
                New to us? <a href="#">Sign Up</a>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="javascript/login.js"></script>

</body>

</html>
