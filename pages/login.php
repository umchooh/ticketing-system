<?php
// Start or resume a session
session_start();
//require '../model/Nav.php';

$xmlDoc = new DOMDocument();
//make sure the XML is nicely formatted
$xmlDoc->preserveWhiteSpace = false;
$xmlDoc->formatOutput = true;
$xmlDoc->load("../xml_xsd/users.xml");
$usersElement = $xmlDoc->documentElement;

if (isset($_POST['submit'])) {
    $flag = true;
    //Get Data from Form
    $password = md5($_POST['password']);
    $success = false;
    $err_message = "";


    //Form Validation
    //email
    if (empty($_POST['email'])) {
        $email_err = " please enter your email !";
        $flag = false;
    } else {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    }
    //password
    if (empty($_POST['password'])) {
        $pw_err = "please enter your password !";
        $flag = false;
    }
    if ($flag) {
        foreach ($usersElement->childNodes as $element) {
            if (strcmp($element->nodeName, "user") === 0) {
                $userEmail = $element->getElementsByTagName("email")[0]->textContent;
                $userPassword = $element->getElementsByTagName("password")[0]->textContent;

                if (strcmp($email, $userEmail) === 0 && strcmp($password, $userPassword) === 0) {

                    session_start();
                    $userId = $element->getElementsByTagName("userId")[0]->textContent;
                    $userType = $element->getElementsByTagName("userType")[0]->textContent;

                    $userNameElements = $element->getElementsByTagName("name")[0];
                    $userFirst = $userNameElements->getElementsByTagName("first");
                    $user_first_name = $userFirst[0]->textContent;
                    $userLast = $userNameElements->getElementsByTagName("last");
                    $user_last_name = $userLast[0]->textContent;

                    $_SESSION['timeout'] = time();
                    $_SESSION['email'] = $email;
                    $_SESSION['userId'] = $userId;
                    $_SESSION['userType'] = $userType;
                    $_SESSION['first'] = $user_first_name;
                    $_SESSION['last'] = $user_last_name;
                    $_SESSION['isLoggedIn'] = true;

                    header('Location: list-tickets.php');
                    $success = true;
                    break;
                } else {
                    $err_login = "Invalid Username or Password!";
                }
            }
        }
    }
}
?>
<?php require './view/header.php'; ?>

    <main class=" flex-grow-1 p-2 ">
        <h2 class="text-center my-3 pt-3">Log In</h2>
        <div class="container mt-5 my-5">
            <div class="row justify-content-center align-items-center">
                <form id="login_form" name="login_form" class="form" action="" method="POST">
                    <span style="color:#ff0000;"><?= isset($err_login) ? $err_login : ''; ?></span>
                    <div class="mb-3 form-group">
                        <label for="email" class="form-label">Email address :</label>
                        <input class="form-control" type="email" name="email" id="email"
                               value="<?= isset($email) ? $email : ''; ?>" placeholder="Type your email address"/>
                        <span style="color:#ff0000;"><?= isset($email_err) ? $email_err : ''; ?></span>
                    </div>
                    <div class="mb-3 pt-2 form-group">
                        <label for="password" class="form-label">Password :</label>
                        <input class="form-control" type="password" name="password" id="password"
                               placeholder="Type your password"/>
                        <span style="color:#ff0000;"><?= isset($pw_err) ? $pw_err : ''; ?></span>
                    </div>
                    <div class="form-group pt-3">
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Log In</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
<?php require './view/footer.php'; ?>
