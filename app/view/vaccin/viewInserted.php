
<!-- début viewInserted -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Projet - Vaccin inséré</title>
        <?php include $root . '/app/view/fragment/fragmentHeader.html' ?>
    </head>

    <body>
        <div class="container">
            <?php include $root . '/app/view/fragment/fragmentMenu.html' ?>
            <br><br><br>
            <?php
                if ($results) {
                    if ($results[0] == 'insert') {
                        echo "<h3>Le nouveau vaccin a été ajouté </h3>";
                    } else {
                        echo "<h3>Le vaccin a été mis à jour </h3>";
                    }
                    echo '<ul>';
                    echo "<li>id = " . $results[1] . "</li>";
                    echo "<li>label = " . $results[2] . "</li>";
                    echo "<li>doses = " . $_GET['doses'] . "</li>";
                    echo '</ul>';
                } else {
                    echo "<h3>Problème d'insertion du vaccin</h3>";
                }

                include $root . '/app/view/fragment/fragmentFooter.html'?>
        </div>
    </body>
</html>
<!-- fin viewInserted -->

