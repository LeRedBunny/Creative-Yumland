<?php 

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
                    </div>";
        }
        else {
            echo "<div>
                    <a href='inscription.php'> Inscription </a>
                    <span> | </span>
                    <a href='connexion.php'> Connexion </a>
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