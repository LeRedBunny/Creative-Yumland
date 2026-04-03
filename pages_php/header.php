<?php 

    session_start();

    function createHeader (array $links) : void {
        echo '<header> 
                <div> 
                    <a href="index.php" id="logo"> 
                    <h1> Le Bistroche </h1> 
                    </a>
                </div>';
        
        echo '<div>';
        foreach($centerLinks as $link) {
            echo '<a href="carte.php"> Carte </a> <span> | </span>';
        }
        echo '</div>';

            

            if ($_SESSION['logged_in']) {
                echo "<div>
                        <a href='profil.php'> Profil </a>
                        <span> | </span>
                        <a href='econnexion.php'> Se déconnecter </a>
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
?>