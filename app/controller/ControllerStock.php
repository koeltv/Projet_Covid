
<!-- debut ControllerStock -->
<?php
    require_once '../model/ModelStock.php';
    const STOCK_VIEW_PATH = '/app/view/stock/';

    class ControllerStock
    {
        public static function stockReadAll() {
            $results = ModelStock::getVaccinForEachCenter();
            include 'config.php';
            $vue = $root . STOCK_VIEW_PATH . 'viewAll.php';
            if (DEBUG) echo "ControllerStock : stockReadAll : vue = $vue";
            require $vue;
        }

        public static function stockReadGlobal() {
            $results = ModelStock::getGlobalDosesPerCentre();
            include 'config.php';
            $vue = $root . STOCK_VIEW_PATH . 'viewGlobal.php';
            if (DEBUG) echo "ControllerStock : stockReadGlobal : vue = $vue";
            require $vue;
        }

        public static function stockUpdate() {
            $results['centre'] = ModelCentre::getAll();
            $results['vaccin'] = ModelVaccin::getAll();
            include 'config.php';
            $vue = $root . STOCK_VIEW_PATH . 'viewUpdate.php';
            if (DEBUG) echo "ControllerStock : stockUpdate : vue = $vue";
            require $vue;
        }

        public static function stockUpdated() {
            $list = [];
            foreach ($_GET as $key => $value) {
                if ($key != 'action' && $key != 'centre') $list[htmlspecialchars($key)] = htmlspecialchars($value);
            }
            $results = ModelStock::update(htmlspecialchars(explode(' ', $_GET['centre'])[0]), $list);
            include 'config.php';
            $vue = $root . STOCK_VIEW_PATH . 'viewUpdated.php';
            if (DEBUG) echo "ControllerStock : stockUpdated : vue = $vue";
            require $vue;
        }
    }
?>
<!-- debut ControllerStock -->

