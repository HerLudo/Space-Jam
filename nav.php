<?php
function debug($value)
{
    echo'<pre style="color:white">';print_r($value);echo'</pre>';
}


$systemeSolaire=new PDO('mysql:host=localhost;dbname=solarsystem', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
]);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="solar.css">
    <title>Index</title>
</head>

<body>
    <header>
        <a href="index.php"><h1 id="home">le système solaire</h1></a>               
    
        <nav>
            <ul class="menu_niveau_1">
                <li class="haut"><a href="soleil.php#soleil" title="Le Soleil brille">Le Soleil</a></li>
                <li class="bas"><a href="planet.php?id_planet=mercure" title="Mercure brûle">Mercure</a></li>
                <li class="haut"><a href="planet.php?id_planet=venus" title="L'étoile du berger">Venus</a></li>
                <li class="sousmenu bas"><a href="planet.php?id_planet=terre" title="Notre planète">La Terre</a>
                    <ul class="menu_niveau_2">
                        <li><a href="planet.php?id_planet=terre#lune" title="Notre satellite">La lune</a></li>
                    </ul>
                </li>        
                <li class="sousmenu haut"><a href="planet.php?id_planet=mars" title="La planète rouge">Mars</a>            
                    <ul class="menu_niveau_2">
                        <li><a href="planet.php?id_planet=mars#phobos" title="Phobos">Phobos</a></li>           
                        <li><a href="planet.php?id_planet=mars#deimos" title="Deimos">Deimos</a></li>    
                    </ul>
                </li>             
                <li class="sousmenu bas"><a href="planet.php?id_planet=jupiter" title="La géante">Jupiter</a>
                    <ul class="menu_niveau_2">
                        <li><a href="planet.php?id_planet=jupiter#io" title="Io">Io</a></li>       
                        <li><a href="planet.php?id_planet=jupiter#europe" title="Europe">Europe</a></li>          
                        <li><a href="planet.php?id_planet=jupiter#ganymede" title="Ganymède">Ganymède</a></li>           
                        <li><a href="planet.php?id_planet=jupiter#callisto" title="Callisto">Callisto</a></li>   
                    </ul>
                </li>                 
                <li class="sousmenu haut"><a href="planet.php?id_planet=saturne" title="Seigneur des anneaux">Saturne</a>
                    <ul class="menu_niveau_2">
                        <li><a href="planet.php?id_planet=saturne#encelade">Encelade</a></li>        
                        <li><a href="planet.php?id_planet=saturne#mimas" >Mimas</a></li>           
                        <li><a href="planet.php?id_planet=saturne#tethys" >Téthys</a></li>          
                        <li><a href="planet.php?id_planet=saturne#titan" >Titan</a></li>  
                    </ul>
                </li>                   
                <li class="sousmenu bas"><a href="planet.php?id_planet=uranus" title="La planète couchée">Uranus</a>
                    <ul class="menu_niveau_2">
                        <li><a href="planet.php?id_planet=uranus#ariel" >Ariel</a></li>      
                        <li><a href="planet.php?id_planet=uranus#oberon" >Obéron</a></li>         
                        <li><a href="planet.php?id_planet=uranus#titania" >Titania</a></li>
                        <li><a href="planet.php?id_planet=uranus#umbriel" >Umbriel</a></li> 
                    </ul> 
                </li>                  
                <li class="sousmenu haut"><a href="planet.php?id_planet=neptune" title="La dernière">Neptune</a>
                    <ul class="menu_niveau_2">
                        <li><a href="planet.php?id_planet=neptune#larissa" >Larissa</a></li>      
                        <li><a href="planet.php?id_planet=neptune#nereide" >Néréide</a></li>
                        <li><a href="planet.php?id_planet=neptune#triton" >Triton</a></li> 
                    </ul>
                </li>    
            </ul>
        </nav>
    </header>
    
    <main>