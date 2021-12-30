
<!-- debut ControllerDefault -->
<?php

    class ControllerDefault
    {
        //Page d'acceuil
        public static function accueil() {
            include 'config.php';
            $vue = $root . '/app/view/viewAccueil.php';
            if (DEBUG) echo ("ControllerDefault : accueil : vue = $vue");
            require $vue;
        }

        public static function documentation($args) {
            include 'config.php';
            $vue = $root . '/public/documentation/documentation' . $args['target'] . '.php';
            if (DEBUG) echo ("ControllerDefault : documentation : vue = $vue");
            require $vue;
        }
    }
?>
<!-- fin ControllerDefault -->

