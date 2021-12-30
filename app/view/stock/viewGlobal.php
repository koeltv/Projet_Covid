
<!-- début viewGlobal -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Projet - Affichage stocks globaux</title>
        <?php include $root . '/app/view/fragment/fragmentHeader.html' ?>
    </head>

    <body>
        <div class="container">
            <?php include $root . '/app/view/fragment/fragmentMenu.html' ?>
            <br><br><br>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>centre</th>
                    <th>doses</th>
                </tr>
                </thead>
                <?php
                    foreach ($results as $centre) {
                        printf("<tr><td>%s</td><td>%d</td></tr>",
                            $centre['centre'], $centre['doses']);
                    }
                ?>
            </table>
            <?php include $root . '/app/view/fragment/fragmentFooter.html'?>
        </div>
    </body>
</html>
<!-- fin viewGlobal -->

