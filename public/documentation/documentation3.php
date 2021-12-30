
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
                <div class="panel-heading">Innovation 3 : Liste de patients en cours de vaccination par vaccin par centre</div>
                <div class="panel-body">
                    <p>Cette fonction permet d'afficher les patients qui sont en cours de traitement par vaccin et par centre. C'est-à-dire qu'ils ont reçu au moins 1 dose mais pas assez pour finir leur traitement.</p>
                    <p>Elle est réalisé avec la requête SQL suivante :</p>
                    <code>SELECT centre.label AS centre, vaccin.label as vaccin, COUNT(patient_id) AS à_vacciner FROM rendezvous, centre, vaccin WHERE centre_id = centre.id AND vaccin_id = vaccin.id AND injection < doses AND patient_id NOT IN (SELECT DISTINCT patient_id FROM rendezvous, vaccin WHERE injection >= doses AND vaccin_id = vaccin.id) GROUP BY centre.label, vaccin.label</code>
                </div>
            </div>
            <?php include $root . '/app/view/fragment/fragmentFooter.html'?>
        </div>
    </body>
</html>
<!-- fin documentation -->

