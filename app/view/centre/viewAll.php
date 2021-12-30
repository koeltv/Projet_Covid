
<!-- début viewAll -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Projet - Affichage centres</title>
        <?php include $root . '/app/view/fragment/fragmentHeader.html' ?>
    </head>

    <body>
        <div class="container">
            <?php include $root . '/app/view/fragment/fragmentMenu.html' ?>
            <br><br><br>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>label</th>
                    <th>adresse</th>
                </tr>
                </thead>
                <?php
                    foreach ($results as $centre) {
                        printf("<tr><td>%d</td><td>%s</td><td>%s</td></tr>",
                            $centre->getId(), $centre->getLabel(), $centre->getAdresse());
                    }
                ?>
            </table>
            <?php include $root . '/app/view/fragment/fragmentFooter.html'?>
        </div>
    </body>
</html>
<!-- fin viewAll -->

