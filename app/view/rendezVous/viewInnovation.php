
<!-- début viewInnovation -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Projet - Affichage Innovations</title>
        <?php include $root . '/app/view/fragment/fragmentHeader.html' ?>
    </head>

    <body>
        <div class="container">
            <?php include $root . '/app/view/fragment/fragmentMenu.html' ?>
            <br><br><br>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <?php foreach ($results['columnNames'] as $columnName) echo "<th>$columnName</th>" ?>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($results['rows'] as $row) {
                        echo "<tr>";
                        foreach ($row as $value) echo "<td>$value</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
            <?php include $root . '/app/view/fragment/fragmentFooter.html'?>
        </div>
    </body>
</html>
<!-- fin viewInnovation -->

