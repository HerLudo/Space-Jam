<?php
include_once 'nav.php';

if(isset($_GET) && ($_GET['id_planet']=='mercure' || $_GET['id_planet']=='venus' || $_GET['id_planet']=='terre' || $_GET['id_planet']=='mars' || $_GET['id_planet']=='jupiter' || $_GET['id_planet']=='saturne' || $_GET['id_planet']=='uranus' || $_GET['id_planet']=='neptune' )): ?>

<h2><?php if($_GET['id_planet']=='terre') echo'La '.$_GET['id_planet']; else echo$_GET['id_planet'];?></h2>
    <section class="generale">

        <div class="image">
            <img src="pictures/<?=$_GET['id_planet'];?>.jpg" alt="Photo de <?= $_GET['id_planet'];?>" id="<?=$_GET['id_planet'];?>">
        </div>

        <article class="article_planet">
            <h3>Données Physiques</h3>
            <p> Le soleil est une étoile de type naine jaune. Sa masse est d'environ 1,989 x10^30 kg, sa masse représente environ 99% de la masse totale du système solaire. Il est composé d'environ 75% d'hydrogène et 25% d'hélium. L'hydrogène représente environ 92% de son volume total et l'hélium les 8% restants.</p>

            <h3 class="sous-titre">Données Astronomiques</h3>

            <p>Le soleil fait partie de notre galaxie que l'on appelle la "Voie Lactée",il se situe dans le bras d'Orion à environ 26 100 années-lumières (8kpc - parsec) du centre galactique. Il se déplace à une vitesse d'environ 250km/s et fait le tour de la Voie Lactée (orbite) en environ 220 millions d'année. Il tourne sur lui même (rotation) en environ 27 jours.</p>

            <h3 class="sous-titre">Données Historiques</h3>
            <p>Le soleil est agé d'environ 4,57 milliards d'années, un peu moins de la moitié de sa séquence principale.</p>

            <h3 class="sous-titre">Étymologie</h3>
            <p>Le mot soleil est issu du latin "sol/solis" désignant l'astre, le dieu. </p>
        </article>

    </section>

<?php
endif;
include_once 'footer.php';
?>