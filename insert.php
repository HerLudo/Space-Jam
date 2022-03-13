<?php
include_once 'nav.php';

define("RACINE_SITE", $_SERVER['DOCUMENT_ROOT'].'/systèmeSolaire/V2/');
define("URL", "http://localhost//systèmeSolaire/V2/");

$hidden_planet='none';
$hidden_satelitte='none';
$selectPlanetForm='none';
$selectSatForm='none';
$selectP='';
$selectS='';
$selectUP='';
$selectUS='';
$group='';

$selecteur_planet=$systemeSolaire->query("SELECT id_planet, nom FROM planet");
$selecteur_planet_sat=$systemeSolaire->query("SELECT id_planet, nom FROM planet WHERE nombre_satellite != 0");
$selecteur_sat=$systemeSolaire->query("SELECT id_planet, nom, id_satelitte, nom_sat FROM satelitte INNER JOIN planet ON satelitte.planet_id=planet.id_planet");


/*###################################################### ACTION ###################################################### */
if (isset($_GET))
{
    if(isset($_GET['action']))
    {
        switch($_GET['action'])
        {
            case 'addPlanet':
            {
                $hidden_planet='';
                $hidden_satelitte='none';
                $selectP='selected';

                debug($_POST);
                debug($_FILES);

                if(isset($_POST['nom'], $_POST['distance_soleil'], $_POST['position_soleil'], $_POST['rayon'], $_POST['masse'], $_POST['gravite'], $_POST['periode_orbitale'],$_POST['inclinaison_ecliptique'], $_POST['inclinaison_axe'], $_POST['journee'], $_POST['nombre_satellite'], $_POST['etymologie'], $_POST['description'])) 
                {
                    foreach($_POST as $key=>$value)
                    {
                        $_POST[$key]=htmlspecialchars(strip_tags(addslashes($value)));
                    }
                    //Requete d'insertion
                    $insertion=$systemeSolaire->prepare("INSERT INTO planet (nom, distance_soleil, position_soleil, rayon, masse, gravite, periode_orbitale, inclinaison_ecliptique, journee, inclinaison_axe, nombre_satellite, etymologie, description, picture) VALUES (:nom, :distance_soleil, :position_soleil, :rayon, :masse, :gravite, :periode_orbitale, :inclinaison_ecliptique, :journee, :inclinaison_axe, :nombre_satellite, :etymologie, :description, :picture)");
                    foreach ($_POST as $key => $value)
                    {
                        if($key=='position_soleil' || $key=='nombre_satellite')
                        $insertion->bindValue(":$key", $value, PDO::PARAM_INT);
                        else
                        $insertion->bindValue(":$key", $value, PDO::PARAM_STR);
                    } 

                    if(isset($_FILES['picture']))
                    {
                        $nomPicture=mb_strtolower($_POST['nom']);
                        $extention=substr(stristr($_FILES['picture']['type'], "/"),1);
                        $pictureBDD=URL."pictures/$nomPicture.".$extention;
                        $pictureRepo = RACINE_SITE . "pictures/$nomPicture.$extention";
                        copy($_FILES['picture']['tmp_name'], $pictureRepo);
                        $insertion->bindValue(":picture", $pictureBDD, PDO::PARAM_STR);
                    }
                    
                    $insertion->execute();              
                }
                header('location: '.URL.'insert.php');
                break;
            }

            case 'addSat':
            {
                $hidden_satelitte='';
                $hidden_planet='none';
                $selectS='selected';

                if(isset($_POST['planet_id'], $_POST['nom_sat'], $_POST['distance_astre'], $_POST['position_astre'], $_POST['rayon_sat'], $_POST['masse_sat'], $_POST['gravite_sat'], $_POST['periode_orbitale_sat'], $_POST['inclinaison_orbitale_sat'], $_POST['journee_sat'], $_POST['etymologie_sat'], $_POST['description_sat']))
                {
                    $insertion_sat=$systemeSolaire->prepare("INSERT INTO satelitte (planet_id, nom_sat, distance_astre, position_astre, rayon_sat, masse_sat, gravite_sat, periode_orbitale_sat, inclinaison_orbitale_sat, journee_sat, etymologie_sat, description_sat, picture_sat) VALUES (:planet_id, :nom_sat, :distance_astre, :position_astre, :rayon_sat, :masse_sat, :gravite_sat, :periode_orbitale_sat, :inclinaison_orbitale_sat, :journee_sat, :etymologie_sat, :description_sat, :picture_sat)");   

                    foreach ($_POST as $key => $value)
                    {
                        $_POST[$key]=htmlspecialchars(strip_tags(addslashes($value)));

                        if($key=='position_astre' || $key=='planet_id')
                            $insertion_sat->bindValue(":$key", $value, PDO::PARAM_INT);
                        else 
                            $insertion_sat->bindValue(":$key", $value, PDO::PARAM_STR);
                    }

                    if(isset($_FILES['picture_sat']))
                    {
                        $nomPictureSat=mb_strtolower($_POST['nom_sat']);
                        $extentionSat=substr(stristr($_FILES['picture_sat']['type'], "/"),1);
                        $pictureSatBDD=URL."pictures/$nomPictureSat.".$extentionSat;
                        $pictureSatRepo = RACINE_SITE . "pictures/$nomPictureSat.$extentionSat";
                        copy($_FILES['picture_sat']['tmp_name'], $pictureSatRepo);
                        $insertion_sat->bindValue(":picture_sat", $pictureSatBDD, PDO::PARAM_STR);
                    }

                    $insertion_sat->execute();
                }
                header('location: '.URL.'insert.php');
                break;
            }

            case 'updatePlanet':
            {          
                $selectPlanetForm='';
                $selectUP='selected';
                break;
            }

            case 'updateSat':
            {
                $selectSatForm='';
                $selectUS='selected';
                break;
            }
        }
    }    
    //Planet Update
    if (isset($_GET['idPlanet']))
    {
        //récupération de l'enregistrement lié à l'ID
        $planetUpdate=$systemeSolaire->prepare("SELECT * FROM planet WHERE id_planet=:idPlanet");
        $planetUpdate->bindValue(":idPlanet", $_GET['idPlanet'], PDO::PARAM_INT);
        $planetUpdate->execute();
        $planetValues=$planetUpdate->fetch(PDO::FETCH_ASSOC);

        $hidden_planet='';
        $hidden_satelitte='none';
        $selectUP='selected';
        
        //Si il y a déjà une image pour cette id, on récupère l'adresse.
        $pictureBDD= (!empty($planetValues['picture'])) ? $planetValues['picture'] : '' ;
        
        if(isset($_POST['id_planet']))
        {
            //Requete Update
            $upPlanet=$systemeSolaire->prepare("UPDATE planet SET nom = :nom, distance_soleil = :distance_soleil, position_soleil = :position_soleil, rayon = :rayon, masse = :masse, gravite = :gravite, periode_orbitale = :periode_orbitale, inclinaison_ecliptique = :inclinaison_ecliptique, journee = :journee, inclinaison_axe = :inclinaison_axe, nombre_satellite = :nombre_satellite, etymologie = :etymologie, description = :description, picture = :picture WHERE id_planet = :id_planet");

            foreach($_POST as $key=>$value)
            {
                $_POST[$key]=htmlspecialchars(strip_tags(addslashes($value)));

                if($key=='position_soleil' || $key=='nombre_satellite' || $key=='id_planet')
                $upPlanet->bindValue(":$key", $value, PDO::PARAM_INT);
                
                else
                $upPlanet->bindValue(":$key", $value, PDO::PARAM_STR);
            }

            if($_FILES)
            {                       
                $nomPicture=mb_strtolower($_POST['nom']);
                $extention=substr(stristr($_FILES['picture']['type'], "/"),1);
                $pictureBDD=URL."pictures/$nomPicture.".$extention;
                $pictureRepo = RACINE_SITE . "pictures/$nomPicture.$extention";
                copy($_FILES['picture']['tmp_name'], $pictureRepo);
            }

            $upPlanet->bindValue(":picture", $pictureBDD, PDO::PARAM_STR);
            
            $upPlanet->execute();              
        }
        header('location: '.URL.'insert.php');
    }

    //Sat Update
    elseif(isset($_GET['sat']))
    {
        $satUpdate=$systemeSolaire->prepare("SELECT * FROM satelitte WHERE id_satelitte =:id_satelitte ");
        $satUpdate->bindValue(":id_satelitte", $_GET['sat'], PDO::PARAM_INT);
        $satUpdate->execute();
        $satValues=$satUpdate->fetch(PDO::FETCH_ASSOC);

        $hidden_planet='none';
        $hidden_satelitte='';
        $selectUS='selected';
        $pictureSatBDD=(!empty($satValues['picture_sat'])) ? $satValues['picture_sat'] : '' ;

        if(isset($_POST['planet_id'], $_POST['nom_sat'], $_POST['distance_astre'], $_POST['position_astre'], $_POST['rayon_sat'], $_POST['masse_sat'], $_POST['gravite_sat'], $_POST['periode_orbitale_sat'], $_POST['inclinaison_orbitale_sat'], $_POST['journee_sat'], $_POST['etymologie_sat'], $_POST['description_sat'] ))
        {
            $upSatellite=$systemeSolaire->prepare("UPDATE satelitte SET planet_id = :planet_id, nom_sat = :nom_sat, distance_astre = :distance_astre, position_astre = :position_astre, rayon_sat = :rayon_sat, masse_sat = :masse_sat, gravite_sat = :gravite_sat, periode_orbitale_sat = :periode_orbitale_sat, inclinaison_orbitale_sat = :inclinaison_orbitale_sat, journee_sat = :journee_sat, etymologie_sat = :etymologie_sat, description_sat = :description_sat, picture_sat = :picture_sat WHERE id_satelitte = :id_satelitte ");

            foreach($_POST as $key=>$value)
            {
                $_POST[$key]=htmlspecialchars(strip_tags(addslashes($value)));
                
                if($key=='planet_id' || $key=='position_astre')
                $upSatellite->bindValue(":$key", $value, PDO::PARAM_INT);

                else
                $upSatellite->bindValue(":$key", $value, PDO::PARAM_STR);
            }
            if($_FILES)
            {                       
                $nomPictureSat=mb_strtolower($_POST['nom_sat']);
                $extentionSat=substr(stristr($_FILES['picture_sat']['type'], "/"),1);
                $pictureSatBDD=URL."pictures/$nomPictureSat.".$extentionSat;
                $pictureSatRepo = RACINE_SITE . "pictures/$nomPictureSat.$extentionSat";
                copy($_FILES['picture_sat']['tmp_name'], $pictureSatRepo);
            }

            $upSatellite->bindValue(":picture_sat", $pictureSatBDD, PDO::PARAM_STR);

            $upSatellite->bindValue(":id_satelitte", $_GET['sat'], PDO::PARAM_INT);
            $upSatellite->execute();
        }
        header('location: '.URL.'insert.php');
    }

}
?>
<!-- ###################################################### SELECTEUR ACTION ###################################################### -->
<div class="selecteur">
    <form action="" method="get">
            <select name="action" id="action">
                <option value="">Ajouter une planète ou un satellite</option>
                <option value="addPlanet" <?=$selectP?>>Entrer une nouvelle planète</option>
                <option value="addSat" <?=$selectS?>>Entrer un nouveau satellite</option>
                <option value="updatePlanet" <?=$selectUP?>>Modifier une planète</option>
                <option value="updateSat" <?=$selectUS?>>Modifier un satellite</option>
            </select>
            <button type="submit">Valider</button>      
    </form>
</div>

<!-- ###################################################### SELECTEUR PLANET ###################################################### -->
<div class="selecteur selecteurPlanet" style="display:<?=$selectPlanetForm?>">
    <form action="" method="get">
            <select name="idPlanet" id="idPlanet">
                <option value="">Sélectionner la planète à modifier</option>
                <?php while($planet=$selecteur_planet->fetch(PDO::FETCH_ASSOC)): ?>                    
                        <option value="<?=$planet['id_planet']?>"><?=$planet['nom']?></option>
                <?php endwhile;?>
            </select>
            <button type="submit">Valider</button>      
    </form>
</div>

<!-- ###################################################### SELECTEUR SATELLITE ###################################################### -->
<div class="selecteur selecteurSat" style="display:<?=$selectSatForm?>">
    <form action="" method="get">
            <select name="sat" id="sat">
                <option value="">Sélectionner le satellite à modifier</option>

            <?php while($satellite=$selecteur_sat->fetch(PDO::FETCH_ASSOC)):?>
                <?php if($group!=$satellite['nom']):?>
                    <optgroup label="<?=$satellite['nom']?>">
                <?php endif;?>    

                <option value="<?=$satellite['id_satelitte']?>"><?= $satellite['nom_sat']?></option>

                <?php if($group!=$satellite['nom']):?>
                    </optgroup">
                <?php endif;?>

                <?php $group=($group!=$satellite['nom']) ? $satellite['nom'] : $group;?>
                     
            <?php endwhile;?>

            </select>
            <button type="submit">Valider</button>      
    </form>
</div>


<!-- ###################################################### FORMULAIRE PLANETE ###################################################### -->
<div class="formulaire" style="display:<?=$hidden_planet?>">
    <form enctype="multipart/form-data" action="" method="post">
        <?php if(isset($_GET['idPlanet'])):?>
            <input type="hidden" name="id_planet" value="<?=$planetValues['id_planet']?>">
        <?php endif; ?>    
        <div class="input">
            <label for="nom">Nom de la planète</label>
            <input type="text" name="nom" id="nom" value="<?= isset($_GET['idPlanet']) ? $planetValues['nom']: ''; ?>">
        </div>
        <div class="input">
            <label for="distance_soleil">Distance par rapport au soleil</label>
            <input type="text" name="distance_soleil" id="distance_soleil" value="<?= isset($_GET['idPlanet']) ? $planetValues['distance_soleil']: ''; ?>">
        </div>
        <div class="input">
            <label for="position_soleil">Position de la planète par rapport au soleil</label>
            <input type="text" name="position_soleil" id="position_soleil" value="<?= isset($_GET['idPlanet']) ? $planetValues['position_soleil']: ''; ?>">
        </div>
        <div class="input">
            <label for="rayon">Rayon moyen de la planète</label>
            <input type="text" name="rayon" id="rayon" value="<?= isset($_GET['idPlanet']) ? $planetValues['rayon']: ''; ?>">
        </div>
        <div class="input">
            <label for="masse">Masse de la planète</label>
            <input type="text" name="masse" id="masse" value="<?= isset($_GET['idPlanet']) ? $planetValues['masse']: ''; ?>">
        </div>
        <div class="input">
            <label for="gravite">Gravité à sa surface</label>
            <input type="text" name="gravite" id="gravite" value="<?= isset($_GET['idPlanet']) ? $planetValues['gravite']: ''; ?>">
        </div>
        <div class="input">
            <label for="periode_orbitale">Période orbitale</label>
            <input type="text" name="periode_orbitale" id="periode_orbitale" value="<?= isset($_GET['idPlanet']) ? $planetValues['periode_orbitale']: ''; ?>">
        </div>
        <div class="input">
            <label for="inclinaison_ecliptique">Inclinaison sur le plan de l'ecliptique</label>
            <input type="text" name="inclinaison_ecliptique" id="inclinaison_ecliptique" value="<?= isset($_GET['idPlanet']) ? $planetValues['inclinaison_ecliptique']: ''; ?>">
        </div>
        <div class="input">
            <label for="journee">Durée d'une journée</label>
            <input type="text" name="journee" id="journee" value="<?= isset($_GET['idPlanet']) ? $planetValues['journee']: ''; ?>">
        </div>
        <div class="input">
            <label for=" inclinaison_axe">Inclinaison axe de rotation</label>
            <input type="text" name="inclinaison_axe" id="inclinaison_axe" value="<?= isset($_GET['idPlanet']) ? $planetValues['inclinaison_axe']: ''; ?>">
        </div>
        <div class="input">
            <label for="nombre_satellite">Nombre de satellite(s)</label>
            <input type="text" name="nombre_satellite" id="nombre_satellite" value="<?= isset($_GET['idPlanet']) ? $planetValues['nombre_satellite']: ''; ?>">
        </div>
        <div class="input">
            <label for="etymologie">Etymologie du nom</label>
            <textarea name="etymologie" id="etymologie" cols="30" rows="5" placeholde="Etymologie ..."><?= isset($_GET['idPlanet']) ? $planetValues['etymologie']: ''; ?></textarea>
        </div>
        <div class="input">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="5" placeholde="Description ..."><?= isset($_GET['idPlanet']) ? $planetValues['description']: ''; ?></textarea>
        </div>
        <div class="input">
            <label for="picture">Ajouter une Photo</label>
            <input type="file" id="picture" name="picture">
        </div>
        <div class="input">
            <button type="submit">Enregistrer</button>
        </div>
        
    </form>
</div>

<!-- ###################################################### FORMULAIRE SATELITTE ###################################################### -->
<div class="formulaire satelitte" style="display:<?=$hidden_satelitte?>">
    <form enctype="multipart/form-data" action="" method="post" class="form_sat" >
        <div id="selecteurP">
            <label for="planet_id">Astre mère</label>
            <select name="planet_id" id="planet_id">
                <option value="">Sélectionner un astre mère</option>
                <?php while($astre=$selecteur_planet_sat->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?=$astre['id_planet']?>" <?= (isset($satValues) && $satValues['planet_id']==$astre['id_planet']) ? 'selected' : '';?> ><?=$astre['nom']?></option>
                <?php endwhile;?>
            </select>
        </div>
        <div class="input">
            <label for="nom_sat">Nom du satelitte</label>
            <input type="text" name="nom_sat" id="nom_sat" value="<?= isset($_GET['sat']) ? $satValues['nom_sat'] : '';?>">
        </div>
        <div class="input">
            <label for="distance_astre">Distance à l'astre mère </label>
            <input type="text" name="distance_astre" id="distance_astre" value="<?= isset($_GET['sat']) ? $satValues['distance_astre'] : '';?>">
        </div>
        <div class="input">
            <label for="position_astre">Position à l'astre mère</label>
            <input type="text" name="position_astre" id="position_astre" value="<?= isset($_GET['sat']) ? $satValues['position_astre'] : '';?>">
        </div>
        <div class="input">
            <label for="rayon_sat">Rayon moyen</label>
            <input type="text" name="rayon_sat" id="rayon_sat" value="<?= isset($_GET['sat']) ? $satValues['rayon_sat'] : '';?>">
        </div>
        <div class="input">
            <label for="masse_sat">Masse</label>
            <input type="text" name="masse_sat" id="masse_sat" value="<?= isset($_GET['sat']) ? $satValues['masse_sat'] : '';?>">
        </div>
        <div class="input">
            <label for="gravite_sat">Gravité surface</label>
            <input type="text" name="gravite_sat" id="gravite_sat" value="<?= isset($_GET['sat']) ? $satValues['gravite_sat'] : '';?>">
        </div>
        <div class="input">
            <label for="periode_orbitale_sat">Période orbitale</label>
            <input type="text" name="periode_orbitale_sat" id="periode_orbitale_sat" value="<?= isset($_GET['sat']) ? $satValues['periode_orbitale_sat'] : '';?>">
        </div>
        <div class="input">
            <label for="inclinaison_orbitale_sat">Inclinaison orbitale</label>
            <input type="text" name="inclinaison_orbitale_sat" id="inclinaison_orbitale_sat" value="<?= isset($_GET['sat']) ? $satValues['inclinaison_orbitale_sat'] : '';?>">
        </div>
        <div class="input">
            <label for="journee_sat">Journée</label>
            <input type="text" name="journee_sat" id="journee_sat" value="<?= isset($_GET['sat']) ? $satValues['journee_sat'] : '';?>">
        </div>
        <div class="input">
            <label for="etymologie_sat">Etymologie</label>
            <textarea name="etymologie_sat" id="" cols="30" rows="5" placeholde="Etymologie ..."><?= isset($_GET['sat']) ? $satValues['etymologie_sat'] : '';?></textarea>
        </div>
        <div class="input">
            <label for="description_sat">Description</label>
            <textarea name="description_sat" id="" cols="30" rows="5" placeholde="Description ..."><?= isset($_GET['sat']) ? $satValues['description_sat'] : '';?></textarea>
        </div>
        <div class="input">
            <label for="picture_sat">Ajouter une Photo</label>
            <input type="file" id="picture_sat" name="picture_sat">
        </div>
        <div class="input">
            <button type="submit">Enregistrer</button>
        </div>
    </form>
</div>



<?php
include_once 'footer.php';
?>


