
<!-- début viewAll -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Projet - Affichage rendez-vous</title>
        <?php include $root . '/app/view/fragment/fragmentHeader.html' ?>
    </head>

    <body>
        <div class="container">
            <?php include $root . '/app/view/fragment/fragmentMenu.html' ?>
            <br><br><br>
            <?php
                if ($results && !empty($results['rdv'])) {
                    if ($results['lastInjection'][0] >= $results['doses'][0]) {
                        echo '<h2>Le patient a tous ces vaccins</h2>';
                    } else {
                        echo '<h2>Le patient n\'a pas tous ces vaccins</h2>';
                        printf("<h3>Il reste actuellement %d injection(s) à effectuer</h3>",
                            $results['doses'][0] - $results['lastInjection'][0]);
                    }
                    ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>patient_id</th>
                            <th>centre</th>
                            <th>vaccin</th>
                            <th>injection</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach ($results['rdv'] as $rendezVous) {
                                printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%d</td></tr>",
                                    $rendezVous['patient_id'], $rendezVous['centre'], $rendezVous['vaccin'], $rendezVous['injection']);
                            }
                        ?>
                        </tbody>
                    </table>
                    <?php
                    if ($results['lastInjection'][0] < $results['doses'][0]) form($results);
                } else {
                    echo '<h2>Le patient n\'a aucun vaccin</h2>';
                    form($results);
                }
            ?>
            <?php include $root . '/app/view/fragment/fragmentFooter.html'?>
        </div>
    </body>
</html>
<!-- fin viewAll -->
<?php
    function form($results) {
        ?>
        <form role="form" method='get' action='router.php'>
            <input type="hidden" name='action' value='rdvCreated'>
            <input type="hidden" name='patientId' value='<?php echo htmlspecialchars(explode(' ', $_GET['patient'])[0]) ?>'>
            <div class="form-group">
                <label for="centre">Veuillez sélectionner un centre : </label>
                <select class="form-control" id='centre' name='centre' style="width: 400px">
                    <?php foreach ($results['centre'] as $centre)
                        printf("<option>%d : %s : %s</option>",  $centre->getId(), $centre->getLabel(), $centre->getAdresse());
                    ?>
                </select>
            </div>
            <button class="btn btn-primary" type="submit">Envoyer</button>
        </form>
        <?php
    }
?>

