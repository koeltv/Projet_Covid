
<!-- début documentation -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Projet - Documentation</title>
        <?php include $root . '/app/view/fragment/fragmentHeader.html' ?>
    </head>

    <body>
        <div class="container">
            <?php include $root . '/app/view/fragment/fragmentMenu.html' ?>
            <br><br><br>
            <div class="panel panel-primary">
                <div class="panel-heading">Innovation 1 : Liste de vaccins utilisés par centre</div>
                <div class="panel-body">
                    <p>Cette fonction permet l'affichage du nombre de vaccins utilisés (différent de 0) avec leurs noms pour chacun des centres.</p>
                    <p>Elle est réalisé avec la requête SQL suivante :</p>
                    <code>SELECT centre.label AS centre, vaccin.label AS vaccin, COUNT(vaccin_id) AS utilisé FROM rendezvous, centre, vaccin WHERE centre_id = centre.id AND vaccin_id = vaccin.id GROUP BY centre_id, vaccin_id</code>
                </div>
            </div>
            <?php include $root . '/app/view/fragment/fragmentFooter.html'?>
        </div>
    </body>
</html>
<!-- fin documentation -->

