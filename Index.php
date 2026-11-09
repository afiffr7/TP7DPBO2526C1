<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include("view/header.php"); ?>

    <nav>
        <a href="?page=0"></a>
        <a href="?page=1"></a>
        <a href="?page=2"></a>
    </nav>

    <main>
        <?php
            if(isset($_GET["page"])) {
                $page = $_GET["page"];
                if($page == "0"){
                    
                }else if($page == "1"){

                }else{
                    
                }
            }
        ?>
    </main>

    <?php include("view/footer.php"); ?>
</body>
</html>