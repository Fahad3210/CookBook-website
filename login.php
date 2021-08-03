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

<body id="lnf">
    <div id="signupform" class="signupf" style="border-radius: 4px;">
        <span style="font-family: MonteCarlo; font-size:25px;">
            Login into De La Cuisine!
        </span>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="signupf">
            <input type="text" class="signfields" placeholder="Name" required maxlength="20" name="name">
            <input type="password" class="signfields" placeholder="Password" required maxlength="15" minlength="8" name="password">
            <input type="submit" class="signfields" name="loginfieldbutton" id="buttonscheck">
            <a href="signup.php" class="divlinks">New User? SignUp here</a>
        </form>
        <span>

        </span>
    </div>
    <?php
    if (isset($_POST['loginfieldbutton'])) {
        $n = $_POST['name'];
        $p = $_POST['password'];
        $con = new mysqli("localhost", "root", "", "restaurant");
        $sql = "select password from members where name='" . $n . "'";
        $result = $con->query($sql)->fetch_assoc();
        if ($result == TRUE) {
            // echo $result['password'];
            if ($result['password'] == $p) {
                $_SESSION['name'] = $n;
                header("Location:main.php");
            } else {
                echo "<span class=\"warnings\"><span>Incorrect password</span></span>";
            }
        } else {
            echo "<span class=\"warnings\"><span>User doesn't exist</span></span>";
        }
    }
    ?>
</body>

</html>