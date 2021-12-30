
<!-- début viewAll -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Projet - Affichage vaccins</title>
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
                    <th>doses</th>
                </tr>
                </thead>
                <?php
                    foreach ($results as $vaccin) {
                        printf("<tr><td>%d</td><td>%s</td><td>%d</td></tr>",
                            $vaccin->getId(), $vaccin->getLabel(), $vaccin->getDoses());
                    }
                ?>
            </table>
            <?php include $root . '/app/view/fragment/fragmentFooter.html'?>
        </div>
    </body>
</html>
<!-- fin viewAll -->

