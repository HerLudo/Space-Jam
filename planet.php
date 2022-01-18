<?php
include_once 'nav.php';

if(isset($_GET) && ($_GET['id_planet']=='mercure' || $_GET['id_planet']=='venus' || $_GET['id_planet']=='terre' || $_GET['id_planet']=='mars' || $_GET['id_planet']=='jupiter' || $_GET['id_planet']=='saturne' || $_GET['id_planet']=='uranus' || $_GET['id_planet']=='neptune' )): 

    $varPlanet=ucfirst($_GET['id_planet']);
    $planets=$systemeSolaire->prepare("SELECT * FROM planet WHERE nom=:nom");
    $planets->bindValue(':nom', $varPlanet, PDO::PARAM_STR);
    $planets->execute();
    $planet=$planets->fetchAll(PDO::FETCH_ASSOC);
    
?>

<h2><?php if($_GET['id_planet']=='terre') echo'La '.$varPlanet; else echo$varPlanet;?></h2>
<p><?= $planet[0]['description'];?></p>
    <section class="generale">

        <div class="image">
            <img src="pictures/<?=$_GET['id_planet'];?>.jpg" alt="Photo de <?= $_GET['id_planet'];?>" id="<?=$_GET['id_planet'];?>">
        </div>

        <article class="article_planet">
            <h3>Données Physiques</h3>
            
            <table class="tableau">
                <?php foreach($planet[0] as $key=>$value): ?>                        
                    <?php if($key=='rayon' || $key=='masse' || $key=='gravite'): ?> 
                     <tr><td class="titreColonneTableau"><?= ($key=='gravite') ? 'gravité' : $key; ?> :</td><td><?=$value?></td></tr>
                    <?php endif;?>
                <?php endforeach; ?>
            </table>

            <h3 class="sous-titre">Données Astronomiques</h3>

            <table class="tableau">
            <?php foreach($planet[0] as $key=>$value): ?>                        
                    <?php if($key!='id_planet' && $key!='rayon' && $key!='masse' && $key!='gravite' && $key!='etymologie' && $key!='description'): ?> 
                     <tr> <td class="titreColonneTableau"> <?= str_replace("_", " ", $key); ?> :</td> <td> <?= $value; ?></td> </tr>
                    <?php endif;?>
                <?php endforeach; ?>
            </table>

            <h3 class="sous-titre">Étymologie</h3>
            <p><?= $planet[0]['etymologie'];?></p>
        </article>

    </section>

<?php
endif;
include_once 'footer.php';
?>