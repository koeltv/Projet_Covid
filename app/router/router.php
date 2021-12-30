<!-- début Router -->
<?php
    require ('../controller/ControllerDefault.php');
    require ('../controller/ControllerVaccin.php');
    require ('../controller/ControllerCentre.php');
    require ('../controller/ControllerPatient.php');
    require ('../controller/ControllerStock.php');
    require ('../controller/ControllerRendezVous.php');

    //récupération de l'action passée dans l'URL
    $query_string = $_SERVER['QUERY_STRING'];

    //fonction parse_str permet de construire
    //une table de hachage (clé + valeur)
    parse_str($query_string, $param);

    if (isset($param['action'])) {
        //$action contient le nom de la méthode statique recherchée
        $action = htmlspecialchars($param["action"]);

        //On supprime l'élément action de la structure
        unset($param['action']);

        //Tout ce qui reste sont des arguments
        $args = $param;
    } else {
        $action = NULL;
    }

    //Liste des méthodes autorisées
    switch ($action) {
        case "vaccinReadAll" :
        case "vaccinCreate" :
        case "vaccinCreated" :
        case "vaccinUpdate" :
        case "vaccinUpdated" :
            ControllerVaccin::$action();
            break;
        case 'centreReadAll' :
        case 'centreCreate' :
        case 'centreCreated' :
            ControllerCentre::$action();
            break;
        case 'patientReadAll' :
        case 'patientCreate' :
        case 'patientCreated' :
            ControllerPatient::$action();
            break;
        case 'stockReadAll' :
        case 'stockReadGlobal' :
        case 'stockUpdate' :
        case 'stockUpdated' :
            ControllerStock::$action();
            break;
        case 'rdvReadForPatient' :
        case 'rdvGetPatient' :
        case 'rdvCreated' :
        case 'rdvVaccinUsagePerCentre' :
        case 'rdvVaccinatedPerCentre' :
        case 'rdvToVaccinatePerVaccinPerCentre' :
            ControllerRendezVous::$action();
            break;
        case 'documentation' :
            ControllerDefault::$action($args);
            break;
        default:
            $action = "accueil";
            ControllerDefault::$action();
    }
?>
<!-- Fin Router -->