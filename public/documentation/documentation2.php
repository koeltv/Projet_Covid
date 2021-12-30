
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
                <div class="panel-heading">Innovation 2 : Liste de patients vaccinés par vaccin par centre</div>
                <div class="panel-body">
                    <p>Cette fonction permet d'afficher les patients qui ont fini leur traitement par vaccin et par centre. C'est à dire qu'ils ont fait autant d'injection que le nombre de dosage nécessaire.</p>
                    <p>Elle est réalisé avec la requête SQL suivante :</p>
                    <code>SELECT centre.id, centre.label AS centre, COUNT(patient_id) AS vacciné FROM rendezvous, centre, vaccin WHERE centre_id = centre.id AND vaccin_id = vaccin.id AND injection = doses GROUP BY centre.label</code>
                </div>
            </div>
            <?php include $root . '/app/view/fragment/fragmentFooter.html'?>
        </div>
    </body>
</html>
<!-- fin documentation -->

