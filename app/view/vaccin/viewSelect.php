
<!-- début viewSelect -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Projet - Sélection vaccin</title>
        <?php include $root . '/app/view/fragment/fragmentHeader.html' ?>
    </head>

    <body>
        <div class="container">
            <?php include $root . '/app/view/fragment/fragmentMenu.html' ?>
            <br><br><br>
            <form role="form" method='get' action='router.php'>
                <input type="hidden" name='action' value='vaccinUpdated'>
                <div class="form-group">
                    <label for="vaccin">Vaccin : </label>
                    <select class="form-control" id='vaccin' name='vaccin' style="width: 200px">
                        <?php foreach ($results as $id)
                            printf("<option>%d : %s : %d</option>",  $id->getId(), $id->getLabel(), $id->getDoses());
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="doses">Nombre de doses à ajouter : </label>
                    <input class="form-control" type="number" id='doses' name='doses' style="width: 200px" value='0'>
                </div>
                <button class="btn btn-primary" type="submit">Envoyer</button>
            </form>
            <?php include $root . '/app/view/fragment/fragmentFooter.html'?>
        </div>
    </body>
</html>
<!-- fin viewSelect -->

