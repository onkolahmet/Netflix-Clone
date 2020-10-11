<?php
require_once("includes/classes/FormSanitizer.php");
require_once("includes/config.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");

    $account = new Account($con);

    if(isset($_POST["submitButton"])) {
        
        $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
        $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
        $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
        $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
        $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
        $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);


        
        $success = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);
        
        
        if($success) {
            $_SESSION["userLoggedIn"] = $username ;
            // var_dump($_SESSION);
            header("Location: index.php");
        }
        // echo $firstName  . "<br>";
        // echo $lastName  . "<br>";
        // echo $username . "<br>";
        // echo $email . "<br>"; 
        // echo $email2 . "<br>";
        // echo $password . "<br>";
        // echo $password2 . "<br>";
    }

    function getInputValue($name) {
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
    } 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to Ahmetflix</title>
        <link rel="icon" href="assets/images/icon.png">
        <link rel="stylesheet" type="text/css" href="assets/style/style.css" />
    </head>
    <body>
        
        <div class="signInContainer">

            <div class="column">

                <div class="header">
                    <img src="assets/images/logo.png" title="Logo" alt="Site logo" />
                    <h3>Sign Up</h3>
                    <span>to continue to Ahmetflix</span>
                </div>

                <form method="POST">
                    <?php echo "<span class='error'>". $account->getError(Constants::$firstNameCharacters) . "</span>"; ?>

                    <input type="text" name="firstName" autocomplete="off"  placeholder="First name" value = "<?php getInputValue("firstName"); ?>" required>

                    <?php echo "<span class='error'>". $account->getError(Constants::$lastNameCharacters) . "</span>"; ?>

                    <input type="text" name="lastName" autocomplete="off"  placeholder="Last name" value = "<?php getInputValue("lastName"); ?>" required>

                    <?php echo "<span class='error'>". $account->getError(Constants::$usernameCharacters) . "</span>"; ?>
                    <?php echo "<span class='error'>". $account->getError(Constants::$usernameTaken) . "</span>"; ?>

                    <input type="text" name="username" autocomplete="off"  placeholder="Username" value = "<?php getInputValue("username"); ?>" required>

                    <?php echo "<span class='error'>". $account->getError(Constants::$emailsDontMatch) . "</span>"; ?>
                    <?php echo "<span class='error'>". $account->getError(Constants::$emailInvalid) . "</span>"; ?>                            
                    <?php echo "<span class='error'>". $account->getError(Constants::$emailTaken) . "</span>"; ?>

                    <input type="email" name="email" autocomplete="off"  placeholder="Email" value = "<?php getInputValue("email"); ?>"  required>
                    
                    <input type="email" name="email2" autocomplete="off"  placeholder="Confirm email" value = "<?php getInputValue("email2"); ?>" required>

                    <?php echo "<span class='error'>". $account->getError(Constants::$passwordsDontMatch) . "</span>"; ?>
                    <?php echo "<span class='error'>". $account->getError(Constants::$passwordLength) . "</span>"; ?> 

                    <input type="password" name="password" autocomplete="off"  placeholder="Password" required>

                    <input type="password" name="password2" autocomplete="off"  placeholder="Confirm password" required>

                    <input type="submit" name="submitButton" value="SUBMIT">

                </form>

                <a href="login.php" class="signInMessage">Already have an account? Sign in here!</a>

            </div>

        </div>

    </body>
</html>