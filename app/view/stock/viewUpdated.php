
<!-- début viewUpdated -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Projet - Stocks mis à jour</title>
        <?php include $root . '/app/view/fragment/fragmentHeader.html' ?>
    </head>

    <body>
        <div class="container">
            <?php include $root . '/app/view/fragment/fragmentMenu.html' ?>
            <br><br><br>
            <?php
                if ($results) {
                    echo "<h3>Les stocks du centre " . $_GET['centre'] . " ont été mis à jour </h3>";
                    echo '<ul>';
                    foreach ($results as $key => $value) {
                        printf("<li>%s ajoutés : %d</li>", $key, $value);
                    }
                } else {
                    echo "<h3>Problème de mise à jour des stocks</h3>";
                }

                include $root . '/app/view/fragment/fragmentFooter.html'?>
        </div>
    </body>
</html>
<!-- fin viewUpdated -->

