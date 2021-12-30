
<!-- debut ControllerVaccin -->
<?php
    require_once '../model/ModelVaccin.php';
    const VACCIN_VIEW_PATH = '/app/view/vaccin/';

    class ControllerVaccin
    {
        /**
         * Liste des vaccins
         */
        public static function vaccinReadAll() {
            $results = ModelVaccin::getAll();
            include 'config.php';
            $vue = $root . VACCIN_VIEW_PATH . 'viewAll.php';
            if (DEBUG) echo "ControllerVaccin : vaccinReadAll : vue = $vue";
            require $vue;
        }

        public static function vaccinCreate() {
            include 'config.php';
            $vue = $root . VACCIN_VIEW_PATH . 'viewInsert.php';
            if (DEBUG) echo "ControllerVaccin : vaccinCreate : vue = $vue";
            require $vue;
        }

        public static function vaccinCreated() {
            $results = ModelVaccin::insert(htmlspecialchars($_GET['label']), htmlspecialchars($_GET['doses']));
            include 'config.php';
            $vue = $root . VACCIN_VIEW_PATH . 'viewInserted.php';
            if (DEBUG) echo "ControllerVaccin : vaccinCreated : vue = $vue";
            require $vue;
        }

        public static function vaccinUpdate() {
            $results = ModelVaccin::getAll();
            include 'config.php';
            $vue = $root . VACCIN_VIEW_PATH . 'viewSelect.php';
            if (DEBUG) echo "ControllerVaccin : vaccinUpdate : vue = $vue";
            require $vue;
        }

        public static function vaccinUpdated() {
            $results = ModelVaccin::update(htmlspecialchars(explode(' ', $_GET['vaccin'])[0]), htmlspecialchars($_GET['doses']));
            $results[] = htmlspecialchars(explode(' ', $_GET['vaccin'])[2]);
            include 'config.php';
            $vue = $root . VACCIN_VIEW_PATH . 'viewInserted.php';
            if (DEBUG) echo "ControllerVaccin : vaccinUpdated : vue = $vue";
            require $vue;
        }
    }
?>
<!-- fin ControllerVin -->

