
<!-- debut ControllerCentre -->
<?php
    require_once '../model/ModelCentre.php';
    const CENTRE_VIEW_PATH = '/app/view/centre/';

    class ControllerCentre
    {
        public static function centreReadAll() {
            $results = ModelCentre::getAll();
            include 'config.php';
            $vue = $root . CENTRE_VIEW_PATH . 'viewAll.php';
            if (DEBUG) echo "ControllerCentre : centreReadAll : vue = $vue";
            require $vue;
        }

        public static function centreCreate() {
            include 'config.php';
            $vue = $root . CENTRE_VIEW_PATH . 'viewInsert.php';
            if (DEBUG) echo "ControllerCentre : centreCreate : vue = $vue";
            require $vue;
        }

        public static function centreCreated() {
            $results = ModelCentre::insert(htmlspecialchars($_GET['label']), htmlspecialchars($_GET['adresse']));
            include 'config.php';
            $vue = $root . CENTRE_VIEW_PATH . 'viewInserted.php';
            if (DEBUG) echo "ControllerCentre : centreCreated : vue = $vue";
            require $vue;
        }
    }
?>
<!-- fin ControllerCentre -->

