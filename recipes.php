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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gowun+Dodum&display=swap" rel="stylesheet">
</head>

<body style="display: flex; flex-direction:column; align-items:center;justify-content:center; background:url('table.png');background-size:cover; color:white">
    <span id="welre">
        Recipes by<?php echo " " . $_SESSION['name']; ?>
    </span>
    <table id="rtable" cellpadding="10px" cellspacing="0px">
        <tr class="mainborder">
            <td class="innerborder">Name</td>
            <td class="innerborder">Link</td>
        </tr>
        <?php
        $i = 0;
        $n = $_SESSION['name'];
        $con = new mysqli("localhost", "root", "", "restaurant");
        $sql = "select * from recipesnew where recipeby='" . $n . "'";
        if ($con->errno) {
        } else {
            $result = $con->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr class=\"mainborder\">
            <td class=\"innerborder\">" . $row['name'] . "</td>
            <td class=\"innerborder\">" . $row['link'] . "</td>
            </tr>";
            }
        }
        ?>
    </table>

</body>

</html>