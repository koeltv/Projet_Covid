
<!-- début viewUpdate -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Projet - Mise à jour des stocks</title>
        <?php include $root . '/app/view/fragment/fragmentHeader.html' ?>
    </head>

    <body>
        <div class="container">
            <?php include $root . '/app/view/fragment/fragmentMenu.html' ?>
            <br><br><br>
            <form role="form" method='get' action='router.php'>
                <input type="hidden" name='action' value='stockUpdated'>
                <div class="form-group">
                    <label for="centre">Centre : </label>
                    <select class="form-control" id='centre' name='centre' style="width: 200px">
                        <?php foreach ($results['centre'] as $centre)
                            printf("<option>%d : %s</option>",  $centre->getId(), $centre->getLabel());
                        ?>
                    </select>
                </div>
                <?php
                    foreach ($results['vaccin'] as $vaccin) {
                        echo '<div class="form-group">';
                        printf("<label for='%s'>Nombre de doses de %s à ajouter : </label>", $vaccin->getLabel(), $vaccin->getLabel());
                        printf("<input class='form-control' type='number' id='%s' name='%s' style='width:200px' value='0'>", $vaccin->getLabel(), $vaccin->getLabel());
                        echo '</div>';
                    }
                ?>
                <button class="btn btn-primary" type="submit">Envoyer</button>
            </form>
            <?php include $root . '/app/view/fragment/fragmentFooter.html'?>
        </div>
    </body>
</html>
<!-- fin viewUpdate -->

