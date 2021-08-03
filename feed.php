<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=MonteCarlo&display=swap" rel="stylesheet">
</head>

<body style="display: flex; justify-content:center; align-items:center; height:600px;background:url('feedbg.jpg'); background-size:cover;">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="fbd">
        <span style=" transform:translateY(-75px); font-family:'MonteCarlo'; font-size:2em;">Add a recipe</span>
        <input class="feed" id="name" type="text" name="name" placeholder="Name of the dish" required>
        <input class="feed" id="image" type="text" name="image" placeholder="Recipe link" required>
        <input class="feed" type="submit" id="recipeadder" value="Add" name="recipeadder" style="width: 100px;border:1px solid black;">
        <a href="main.php">Go home</a>
    </form>
    <?php
    if (isset($_POST['recipeadder'])) {
        $n = $_POST['name'];
        $pn = $_SESSION['name'];
        $l = $_POST['image'];
        $con = new mysqli("localhost", "root", "", "restaurant");
        if ($con->errno) {
            echo "Connection error, reload the page";
        } else {
            $sql = "insert into recipesnew values('$n','$pn','$l');";
            $result = $con->query($sql);
            if ($result == TRUE) {
                // echo "<br>Success";
            } else {
                echo "<br>Failed to add the recipe try again";
            }
        }
    }
    ?>
</body>

</html>