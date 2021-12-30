
<!-- debut ControllerPatient -->
<?php
    require_once '../model/ModelPatient.php';
    const PATIENT_VIEW_PATH = '/app/view/patient/';

    class ControllerPatient
    {
        public static function patientReadAll() {
            $results = ModelPatient::getAll();
            include 'config.php';
            $vue = $root . PATIENT_VIEW_PATH . 'viewAll.php';
            if (DEBUG) echo "ControllerPatient : patientReadAll : vue = $vue";
            require $vue;
        }

        public static function patientCreate() {
            include 'config.php';
            $vue = $root . PATIENT_VIEW_PATH . 'viewInsert.php';
            if (DEBUG) echo "ControllerPatient : patientCreate : vue = $vue";
            require $vue;
        }

        public static function patientCreated() {
            $results = ModelPatient::insert(htmlspecialchars($_GET['nom']), htmlspecialchars($_GET['prenom']), htmlspecialchars($_GET['adresse']));
            include 'config.php';
            $vue = $root . PATIENT_VIEW_PATH . 'viewInserted.php';
            if (DEBUG) echo "ControllerPatient : patientCreated : vue = $vue";
            require $vue;
        }
    }
    ?>
<!-- fin ControllerPatient -->

