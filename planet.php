<?php
include_once 'nav.php';

if(isset($_GET) && ($_GET['id_planet']=='mercure' || $_GET['id_planet']=='venus' || $_GET['id_planet']=='terre' || $_GET['id_planet']=='mars' || $_GET['id_planet']=='jupiter' || $_GET['id_planet']=='saturne' || $_GET['id_planet']=='uranus' || $_GET['id_planet']=='neptune' )): 

    $varPlanet=ucfirst($_GET['id_planet']);
    $planets=$systemeSolaire->prepare("SELECT * FROM planet WHERE nom=:nom");
    $planets->bindValue(':nom', $varPlanet, PDO::PARAM_STR);
    $planets->execute();
    $planet=$planets->fetch(PDO::FETCH_ASSOC);

    if(!empty($planet['nombre_satellite']))
    {
        $satellites=$systemeSolaire->prepare("SELECT nom_sat, distance_astre, position_astre, rayon_sat, masse_sat, gravite_sat, periode_orbitale_sat, inclinaison_orbitale_sat, journee_sat, etymologie_sat, description_sat FROM satelitte INNER JOIN planet ON planet_id = id_planet WHERE planet.nom=:nomPlanet ORDER BY position_astre");
        $satellites->bindValue(':nomPlanet', $varPlanet, PDO::PARAM_STR);
        $satellites->execute();
        $satellites=$satellites->fetchAll(PDO::FETCH_ASSOC);
    }
    $compteur=0;
?>

    <h2><?= ($_GET['id_planet']=='terre') ? 'La '.$varPlanet : $varPlanet;?></h2>

    <p class="sous-titre"><?= $planet['description'];?></p>

        <section class="generale">
            <div class="image">   
                <img src="<?=$planet['picture'];?>" alt="Photo de <?=$_GET['id_planet'];?>" id="<?=$_GET['id_planet'];?>">
            </div>
            <article class="article_planet">
                <h3>Données Physiques</h3>
                
                <table class="tableau">
                    <?php foreach($planet as $key=>$value): ?>                        
                        <?php if($key=='rayon' || $key=='masse' || $key=='gravite'): ?> 
                        <tr><td class="titreColonneTableau"><?= ($key=='gravite') ? 'gravité' : $key; ?> :</td><td> <?=$value?></td></tr>
                        <?php endif;?>
                    <?php endforeach; ?>
                </table>

                <h3 class="sous-titre">Données Astronomiques</h3>

                <table class="tableau">
                <?php foreach($planet as $key=>$value): ?>                        
                        <?php if($key!='id_planet' && $key!='rayon' && $key!='masse' && $key!='gravite' && $key!='etymologie' && $key!='description' && $key!='nom'): ?> 
                        <tr> <td class="titreColonneTableau"> <?= str_replace("_", " ", $key); ?> :</td> 
                        <td> <?= $value; ?></td> </tr>
                        <?php endif;?>
                    <?php endforeach; ?>
                </table>

                <h3 class="sous-titre">Étymologie</h3>
                <p><?= $planet['etymologie'];?></p>
            </article>

        </section>


    <?php if($satellites): ?>

        <?php foreach($satellites as $satellite): 
            $compteur++;
            $extention=pathinfo("pictures/$satellite[nom_sat]", PATHINFO_EXTENSION);
            
        ?>
             
            <h2 id="<?=$satellite['nom_sat']?>"><?= ($satellite['nom_sat']=='lune') ? 'La Lune' : ucfirst($satellite['nom_sat']); debug($extention);?></h2>

            <section class="generale">
                <?php if($compteur%2==1):?>

                    <div class="image-gauche">
                        <?php if($key=='nom_sat'):?>
                            <img  src="pictures/<?=$value;?>.jpg" alt="Photo de <?= $value;?>">
                        <?php endif;?>
                    </div>

                    <article class="article article_sat">

                        <h3>Données Physiques</h3>
                        <?php  foreach($satellite as $key=> $value):?>                  
                            <table class="tableau">
                                <?php if($key=='rayon_sat' || $key=='masse_sat' || $key=='gravite_sat'): ?> 
                                <tr><td class="titreColonneTableau"><?= ($key=='gravite_sat') ? 'gravité' : str_replace("_sat", "",$key); ?> :</td>
                                <td> <?=$value?></td></tr>
                                <?php endif;?>
                            </table>
                        <?php endforeach;?>

                        <h3 class="sous-titre-sat">Données Astronomiques</h3>
                        <?php  foreach($satellite as $key=> $value):?>
                            <table class="tableau">
                                <?php if($key!='rayon_sat' && $key!='masse_sat' && $key!='gravite_sat' && $key!='etymologie_sat' && $key!='description_sat' && $key!='nom_sat'): ?> 
                                <tr> <td class="titreColonneTableau"> <?= ($key=='gravite') ? 'gravité' : str_replace("_sat", " ", $key); ?> :</td> 
                                <td> <?= $value; ?></td> </tr>
                                <?php endif;?>
                            </table>                             
                        <?php endforeach;?>     

                        <h3 class="sous-titre-sat">Étymologie</h3>
                        <?php  foreach($satellite as $key=> $value):?>
                            <?php if($key=='etymologie_sat'):?>
                                <p><?= $value;?></p>
                            <?php endif;?>
                        <?php endforeach;?> 
                    </article>

                <?php else: ?>
                    <article class="article article_sat">

                        <h3>Données Physiques</h3>
                        <?php  foreach($satellite as $key=> $value):?>                  
                            <table class="tableau">
                                <?php if($key=='rayon_sat' || $key=='masse_sat' || $key=='gravite_sat'): ?> 
                                <tr><td class="titreColonneTableau"><?= ($key=='gravite_sat') ? 'gravité' : str_replace("_sat", "",$key); ?> :</td>
                                <td> <?=$value?></td></tr>
                                <?php endif;?>
                            </table>
                        <?php endforeach;?>

                        <h3 class="sous-titre-sat">Données Astronomiques</h3>
                        <?php  foreach($satellite as $key=> $value):?>
                            <table class="tableau">
                                <?php if($key!='rayon_sat' && $key!='masse_sat' && $key!='gravite_sat' && $key!='etymologie_sat' && $key!='description_sat' && $key!='nom_sat'): ?> 
                                <tr> <td class="titreColonneTableau"> <?= ($key=='gravite') ? 'gravité' : str_replace("_sat", " ", $key); ?> :</td> 
                                <td> <?= $value; ?></td> </tr>
                                <?php endif;?>
                            </table>                             
                        <?php endforeach;?>     

                        <h3 class="sous-titre-sat">Étymologie</h3>
                        <?php  foreach($satellite as $key=> $value):?>
                            <?php if($key=='etymologie_sat'):?>
                                <p><?= $value;?></p>
                            <?php endif;?>
                        <?php endforeach;?> 
                    </article>

                    <div class="image-droite">
                        <?php if($key=='nom_sat'):?>
                            <img  src="pictures/<?=$value;?>.jpg" alt="Photo de <?= $value;?>">
                        <?php endif;?>
                    </div>
                <?php endif;?>
            </section>
        <?php endforeach; 
    endif;
endif;?>


<?php
include_once 'footer.php'; ?>