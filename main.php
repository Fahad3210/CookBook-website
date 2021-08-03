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
    <link rel="stylesheet" href="main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=MonteCarlo&display=swap" rel="stylesheet">
    <script src="script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gowun+Dodum&display=swap" rel="stylesheet">
</head>

<body id="mb">
    <div id="dela">
        <!-- currently invisible, if user clicks the unsubscribe button at the bottom, this block becomes visible -->
        <div id="delin">
            <span style="color: white; font-family:'Gowun Dodum';"> Are you sure you wannna unsubscribe :( ?</span>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="submit" class="delbs" value="Yes" name="yesd"><input type="submit" class="delbs" value="No" name="nod">
            </form>
        </div>

    </div>
    <nav id="navbar">
        <span id="title">De La Cuisine</span>
        <span style="align-self: flex-start; font-size:1.3em; transform:translateY(-30px)"><a href="feed.php" id="feedlink">Add More recipes</a></span>
        <span id="welcome">Welcome, <?php
                                    echo $_SESSION['name'];
                                    ?></span>
    </nav>
    <section id="recipes">
        <div id="mainblock">
            <section class="items" onclick="redirect('https://hebbarskitchen.com/recipes/south-indian-dosa-recipes/')">Dosa</section>
            <section class="items" onclick="redirect('https://www.foodnetwork.com/recipes/ina-garten/panzanella-recipe-1944317#:~:text=In%20a%20large%20bowl%2C%20mix,for%20the%20flavors%20to%20blend.')">Panzanella</section>
            <section class="items" onclick="redirect('https://www.delish.com/cooking/recipe-ideas/a27409128/best-bruschetta-tomato-recipe/')">Bruschetta</section>
            <section class="items" onclick="redirect('https://www.ruchiskitchen.com/focaccia-bread-recipe/')">Focaccia Bread</section>
            <section class="items" onclick="redirect('https://www.allrecipes.com/recipe/85389/gourmet-mushroom-risotto/')">Mushroom Risotto</section>
            <section class="items" onclick="redirect('https://www.daringgourmet.com/maultaschen/')">Maultaschen</section>
            <section class="items" onclick="redirect('https://www.thespruceeats.com/labskaus-specialty-of-seafaring-town-hamburg-1446932')">Labskaus</section>
            <section class="items" onclick="redirect('https://www.daringgourmet.com/kaesespaetzle-swabian-german-macaroni-and-cheese/')">Käsespätzle</section>
            <section class="items" onclick="redirect('https://www.foodnetwork.com/recipes/ina-garten/coq-au-vin-recipe4-2011654')">Coq au vin</section>
            <section class="items" onclick="redirect('https://www.seriouseats.com/traditional-french-cassoulet-recipe')">Cassoulet</section>
            <section class="items" onclick="redirect('https://recipes.timesofindia.com/recipes/flamiche/rs57892250.cms')">Flamiche</section>
            <section class="items" onclick="redirect('https://tasty.co/recipe/ratatouille')">Ratatouille</section>
            <section class="items" onclick="redirect('https://tasty.co/recipe/french-style-apple-tart-tarte-tatin')">Tarte Tatin</section>
            <section class="items" onclick="redirect('https://natashaskitchen.com/apple-pie-recipe/')">Apple Pie</section>
            <section class="items" onclick="redirect('https://sallysbakingaddiction.com/how-to-make-chicago-style-deep-dish-pizza/')">Deep-Dish Pizza</section>
            <section class="items" onclick="redirect('https://www.indianhealthyrecipes.com/hyderabadi-biryani-recipe/')">Hyderabadi Biriyani</section>
            <section class="items" onclick="redirect('https://www.indianhealthyrecipes.com/butter-chicken/')">Butter Chicken</section>
            <section class="items" onclick="redirect('https://hebbarskitchen.com/samosa-recipe-samosa-banane-ki-vidhi/')">Samosa</section>
            <section class="items" onclick="redirect('https://www.cubesnjuliennes.com/tandoori-chicken-recipe/')">Tandoori Chicken</section>
            <section class="items" onclick="redirect('https://hebbarskitchen.com/matar-paneer-recipe-restaurant-style/')">Matar Paneer</section>
            <?php
            $con = new mysqli("localhost", "root", "", "restaurant");
            $result = $con->query("select * from recipesnew;");
            while ($row = $result->fetch_assoc()) {
                //to display recipes mentioned by users(stored in DB)
                echo "<section class=\"items\" onclick=\"redirect('" . $row['link'] . "')\">" . $row['name'] . "<span class=\"bynames\">by " . $row['recipeby'] . "</span>" . "</section>";
            }
            ?>
        </div>
    </section>
    <footer id="end">
        <form class="teg" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <input class="rbs" type="submit" value="Log out" name="logout">
        </form>
        <a class="teg" href="recipes.php">Show my recipes</a>
        <form class="teg" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <input class="rbs" type="submit" value="Unsubscribe" name="unsubscribe">
        </form>
        <?php
        if (isset($_POST['logout'])) {
            session_destroy();
            echo "<script>window.location.replace(\"login.php\");</script>";
        }
        if (isset($_POST['unsubscribe'])) {
            // to display confirmation block to unsubscribe
            echo "<script>
        document.getElementById(\"dela\").style.display=\"flex\";
        </script>";
        }
        if (isset($_POST['yesd'])) {
            // if user confirms to unsubscribe
            $n = $_SESSION['name'];
            $con = new mysqli("localhost", "root", "", "restaurant");
            if ($con->errno) {
                echo "Error refresh again";
            } else {
                $sql = "delete from recipesnew where recipeby='" . $n . "';";
                $result = $con->query($sql);
                if ($result == TRUE) {
                    $sql = "delete from members where name='" . $n . "';";
                    $result = $con->query($sql);
                    session_destroy();
                    echo "<script>window.location.replace(\"signup.php\");</script>";
                } else {
                    echo "Try again";
                }
            }
        }
        if (isset($_POST['nod'])) {
            //if user decides not to unsubscribe
            echo "<script>
            document.getElementById(\"dela\").style.display=\"none\";
            </script>";
        }
        ?>
    </footer>

</body>

</html>