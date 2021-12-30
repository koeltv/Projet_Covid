
<!-- début viewInsert -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Projet - Insertion centre</title>
        <?php include $root . '/app/view/fragment/fragmentHeader.html' ?>
    </head>

    <body>
        <div class="container">
            <?php include $root . '/app/view/fragment/fragmentMenu.html' ?>
            <br><br><br>
            <form role="form" method='get' action='router.php'>
                <input type="hidden" name='action' value='centreCreated'>
                <div class="form-group">
                    <label for="label">Label : </label>
                    <input class="form-control" type="text" id="label" name='label' size='75' value='Centre Troyes'>
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse : </label>
                    <input class="form-control" type="text" id="adresse" name='adresse' value='71, avenue Legros'>
                </div>
                <button class="btn btn-primary" type="submit">Envoyer</button>
            </form>
        <?php include $root . '/app/view/fragment/fragmentFooter.html'?>
        </div>
    </body>
</html>
<!-- fin viewInsert -->

