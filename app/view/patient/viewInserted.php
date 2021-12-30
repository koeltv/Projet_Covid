
<!-- début viewInserted -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Projet - Patient inséré</title>
        <?php include $root . '/app/view/fragment/fragmentHeader.html' ?>
    </head>

    <body>
        <div class="container">
            <?php include $root . '/app/view/fragment/fragmentMenu.html' ?>
            <br><br><br>
            <?php
                if ($results) {
                    echo "<h3>Le nouveau patient a été ajouté </h3>";
                    echo '<ul>';
                    echo "<li>id = " . $results . "</li>";
                    echo "<li>nom = " . $_GET['nom'] . "</li>";
                    echo "<li>prénom = " . $_GET['prenom'] . "</li>";
                    echo "<li>adresse = " . $_GET['adresse'] . "</li>";
                    echo '</ul>';
                } else {
                    echo "<h3>Problème d'insertion du patient</h3>";
                }

                include $root . '/app/view/fragment/fragmentFooter.html'?>
        </div>
    </body>
</html>
<!-- fin viewInserted -->

