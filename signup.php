<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="app.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=MonteCarlo&display=swap" rel="stylesheet">
</head>

<body id="sub">
    <div id="signupform" class="signupf" style="border-radius: 4px;">
        <span style="font-family: MonteCarlo; font-size:25px;">
            Signup for De La Cuisine!
        </span>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="signupf">
            <input type="text" class="signfields" placeholder="Name" required maxlength="20" name="name">
            <input type="password" class="signfields" placeholder="Password" required maxlength="15" minlength="8" name="password">
            <input type="email" class="signfields" placeholder="Email" required maxlength="30" name="email">
            <input type="text" class="signfields" placeholder="Phone" required maxlength="30" name="phone">
            <input type="submit" class="signfields" name="signfieldbutton" id="buttonscheck" value="Sign Up">
            <a href="login.php" class="divlinks">Existing User? Login here</a>
        </form>
        <span>

        </span>
    </div>
    <?php
    if (isset($_POST['signfieldbutton'])) {
        $n = $_POST['name'];
        $p = $_POST['password'];
        $e = $_POST['email'];
        $ph = $_POST['phone'];
        $con = new mysqli("localhost", "root", "", "restaurant");
        if ($con->errno) {
            header("Location:signup.php");
        } else {
            $sql = "insert into members values('$n','$p','$e','$ph');";
            $result = $con->query($sql);
            if ($result == TRUE) {
                $_SESSION['name'] = $n;
                echo "Success";
                header("Location:main.php");
            } else {
                echo "Unsuccesful";
            }
        }
    }
    ?>
</body>

</html>