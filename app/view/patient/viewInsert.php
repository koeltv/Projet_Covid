
<!-- début viewInsert -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Projet - Insertion patient</title>
        <?php include $root . '/app/view/fragment/fragmentHeader.html' ?>
    </head>

    <body>
        <div class="container">
            <?php include $root . '/app/view/fragment/fragmentMenu.html' ?>
            <br><br><br>
            <form role="form" method='get' action='router.php'>
                <input class="form-control" type="hidden" name='action' value='patientCreated'>
                <div class="form-group">
                    <label for="nom">Nom : </label>
                    <input class="form-control" type="text" id="nom" name='nom' size='75' value='Diossi'>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom : </label>
                    <input class="form-control" type="text" id="prenom" name='prenom' value='Kelly'>
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse : </label>
                    <input class="form-control" type="text" id="adresse" name='adresse' value='Toulouse'>
                </div>
                <button class="btn btn-primary" type="submit">Envoyer</button>
            </form>
            <?php include $root . '/app/view/fragment/fragmentFooter.html'?>
        </div>
    </body>
</html>
<!-- fin viewInsert -->

