
<!-- début viewInsert -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Projet - Insertion vaccin</title>
        <?php include $root . '/app/view/fragment/fragmentHeader.html' ?>
    </head>

    <body>
        <div class="container">
            <?php include $root . '/app/view/fragment/fragmentMenu.html' ?>
            <br><br><br>
            <form role="form" method='get' action='router.php'>
                <input type="hidden" name='action' value='vaccinCreated'>
                <div class="form-group">
                    <label for="label">Label : </label>
                    <input class="form-control" type="text" id="label" name='label' size='75' value='Quipik'>
                </div>
                <div class="form-group">
                    <label for="doses">Doses : </label>
                    <input class="form-control" type="number" id="doses" name='doses' value='0'>
                </div>
                <button class="btn btn-primary" type="submit">Envoyer</button>
            </form>
            <?php include $root . '/app/view/fragment/fragmentFooter.html'?>
        </div>
    </body>
</html>
<!-- fin viewInsert -->

