
<!-- début viewInserted -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Projet - Rendez-vous inséré</title>
        <?php include $root . '/app/view/fragment/fragmentHeader.html' ?>
    </head>

    <body>
        <div class="container">
            <?php include $root . '/app/view/fragment/fragmentMenu.html' ?>
            <br><br><br>
            <?php
                if ($results) {
                    echo "<h3>Le nouveau rendez-vous a été ajouté </h3>";
                    echo '<ul>';
                    echo "<li>centre = " . $_GET['centre'] . "</li>";
                    echo "<li>patient_id = " . $results['patientId'] . "</li>";
                    echo "<li>vaccin_id = " . $results['vaccin'] . "</li>";
                    echo '</ul>';
                } else {
                    echo "<h3>Problème d'insertion du rendez-vous</h3>";
                }

                include $root . '/app/view/fragment/fragmentFooter.html'?>
        </div>
    </body>
</html>
<!-- fin viewInserted -->

