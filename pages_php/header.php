<?php 


    function headLinks (string $title, bool $admin_style = FALSE) {
        /* Writes the HTML tags needed in <head> */

        if ($admin_style) {
            $style = 'admin';
        } else {
            if (!isset($_COOKIE['style'])) {
                setcookie('style', 'style', time() + 3600 * 24);
                $style = 'style';
            } else {
                $style = $_COOKIE['style'];
            }
            
        }
        echo '<meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title> '.$title.' </title>
              <link rel="stylesheet" id="style" href="../css/'.$style.'.css"/>
              <link rel="icon" href="../images/icon.png">
              <script src="../js/cookie.js"> </script>
              <script src="../js/style.js"> </script>';
    }



    define('PAGE_LINKS', array(
        'Carte' => 'carte.php',
        'Connexion' => 'connexion.php',
        "À propos" => 'bistroche.php',
        'Accueil' => 'index.php',
        'Notez votre expérience' => 'notation.php',
        'Mentions légales' => 'mentions_legales.php'
    ));

    function createHeader (array $pages) : void {
        // Creates a page's header with links to the given pages

        echo '<header> 
                <div> 
                    <a href="index.php" id="logo"> 
                    <h1> Le Bistroche </h1> 
                    </a>
                </div>';
        
        echo '<div> |';
        foreach($pages as $page) {
            echo '<a href="'.PAGE_LINKS[$page].'"> '.$page.' </a> <span> | </span>';
        }
        if ($_SESSION['logged_in']) {
            if ($_SESSION['status'] != 'client') {
                echo '<a href="commandes.php"> Commandes </a> <span> | </span>';
            }
            if ($_SESSION['status'] == 'admin') {
                echo '<a href="admin.php"> Page administrateur </a> <span> | </span>';
            }
        }
        echo '</div>';


        if ($_SESSION['logged_in']) {
            echo "<div>
                    <a href='panier.php'> Panier ".($_SESSION['panier'] ? '('.countCart().')' : '')."</a>
                    <span> | </span>
                    <a href='profil.php'> Profil </a>
                    <span> | </span>
                    <a href='deconnexion.php'> Se déconnecter </a>
                    <button id='theme' onclick='toggleStyle();'> Thème </button>
                    </div>";
        }
        else {
            echo "<div>
                    <a href='inscription.php'> Inscription </a>
                    <span> | </span>
                    <a href='connexion.php'> Connexion </a>
                    <button id='theme' onclick='toggleStyle();'> Thème </button>
                    </div>";
        }
        
        
            
        echo "</header>";
    }



    function createFooter (array $pages) : void {
        // Creates a page's footer with links to the given pages

        echo '<footer> <div> |';
        foreach($pages as $page) {
            echo '<a href="'.PAGE_LINKS[$page].'"> '.$page.' </a> <span> | </span>';
        }
        echo '</div> </footer>';
    }



    function countCart () {
        // Counts how many items are currently in the cart
        if (!isset($_SESSION['panier']) || !$_SESSION['panier']) {
            return 0;
        }

        $count = 0;
        foreach ($_SESSION['panier'] as $amount) {
            $count += $amount;
        }
        return $count;
    }

?>