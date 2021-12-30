
<!-- début viewSelect -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Projet - Sélection patient</title>
        <?php include $root . '/app/view/fragment/fragmentHeader.html' ?>
    </head>

    <body>
        <div class="container">
            <?php include $root . '/app/view/fragment/fragmentMenu.html' ?>
            <br><br><br>
            <form role="form" method='get' action='router.php'>
                <input type="hidden" name='action' value='rdvReadForPatient'>
                <div class="form-group">
                    <label for="patient">Sélectionnez un patient : </label>
                    <select class="form-control" id='patient' name='patient' style="width: 200px">
                        <?php foreach ($results as $id)
                            printf("<option>%d : %s : %s</option>",  $id->getId(), $id->getNom(), $id->getPrenom());
                        ?>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Envoyer</button>
            </form>
            <?php include $root . '/app/view/fragment/fragmentFooter.html'?>
        </div>
    </body>
</html>
<!-- fin viewSelect -->

