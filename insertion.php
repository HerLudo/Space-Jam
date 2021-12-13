<?php
include_once 'nav.php';

$hidden_planet='none';
$hidden_satelitte='none';
$selecteurP='';
$selecteurS='';

$selecteur_planet=$systemeSolaire->query("SELECT id_planet, nom FROM planet WHERE (nombre_satellite!=0 || nombre_satellite!=null)");

if(isset($_GET) && ($_GET['choix_table']=='planet' || $_GET['choix_table']=='satelitte'))
{
    
    switch($_GET['choix_table'])
    {
        case 'planet':
        {
            $hidden_planet='';
            $hidden_satelitte='none';
            $selecteurP='selected';

            if(isset($_POST['nom'], $_POST['distance_soleil'], $_POST['position_soleil'], $_POST['rayon'], $_POST['masse'], $_POST['gravite'], $_POST['periode_orbitale'],$_POST['inclinaison_ecliptique'], $_POST['inclinaison_axe'], $_POST['journee'], $_POST['nombre_satellite'], $_POST['etymologie'], $_POST['description'])) 
            {
                foreach($_POST as $key=>$value)
                {
                    $_POST[$key]=htmlspecialchars(strip_tags(addslashes($value)));
                }


                $insertion=$systemeSolaire->prepare("INSERT INTO planet (nom, distance_soleil, position_soleil, rayon, masse, gravite, periode_orbitale, inclinaison_ecliptique, journee, inclinaison_axe, nombre_satellite, etymologie, description) VALUES (:nom, :distance_soleil, :position_soleil, :rayon, :masse, :gravite, :periode_orbitale, :inclinaison_ecliptique, :journee, :inclinaison_axe,  :nombre_satellite, :etymologie, :description)");

                foreach ($_POST as $key => $value)
                {
                    if($key=='position_soleil' || $key=='nombre_satellite')
                    $insertion->bindValue(":$key", $value, PDO::PARAM_INT);
                    else
                    $insertion->bindValue(":$key", $value, PDO::PARAM_STR);
                }
                $insertion->execute();
                
            }
            break;
        }
        case 'satelitte':
        {
            $hidden_satelitte='';
            $hidden_planet='none';
            $selecteurS='selected';
            if(isset($_POST['nom_sat'], $_POST['planet_id'], $_POST['distance_astre'], $_POST['position_astre'], $_POST['rayon_sat'], $_POST['masse_sat'], $_POST['gravite_sat'], $_POST['periode_orbitale_sat'], $_POST['journee_sat'], $_POST['inclinaison_orbitale_sat'], $_POST['etymologie'], $_POST['description']))
            {
                
                foreach($_POST as $key=>$value)
                {
                    $_POST[$key]=htmlspecialchars(strip_tags(addslashes($value)));
                }

                $insertion_sat=$systemeSolaire->prepare("INSERT INTO satelitte (planet_id, nom_sat, distance_astre, position_astre, rayon_sat, masse_sat, gravite_sat, periode_orbitale_sat, inclinaison_orbitale_sat, journee_sat, etymologie, description) VALUES (:planet_id, :nom_sat, :distance_astre, :position_astre, :rayon_sat, :masse_sat, :gravite_sat, :periode_orbitale_sat, :inclinaison_orbitale_sat, :journee_sat, :etymologie, :description)");
                
                foreach ($_POST as $key => $value)
                {
                    if($key=='position_astre' || $key=='planet_id')
                        $insertion_sat->bindValue(":$key", $value, PDO::PARAM_INT);

                    else 
                    {
                        $insertion_sat->bindValue(":$key", $value, PDO::PARAM_STR);
                    }
                }
                $insertion_sat->execute();

            }
            break;
        }
    }
}

?>

<div class="selecteur">
    <form action="" method="get">
            <select name="choix_table" id="choix_table">
                <option value="">Ajouter une planète ou un satellite</option>
                <option value="planet" <?=$selecteurP?>>Entrer une nouvelle planète</option>
                <option value="satelitte" <?=$selecteurS?>>Entrer un nouveau satellite</option>
            </select>
            <button type="submit">Valider</button>      
    </form>
</div>

<!-- ###################################################### FORMULAIRE PLANETE ###################################################### -->
<div class="formulaire" style="display:<?=$hidden_planet?>">
    <form action="" method="post">
        <div class="input">
            <label for="nom">Nom de la planète</label>
            <input type="text" name="nom" id="nom">
        </div>
        <div class="input">
            <label for="distance_soleil">Distance par rapport au soleil</label>
            <input type="text" name="distance_soleil" id="distance_soleil">
        </div>
        <div class="input">
            <label for="position_soleil">Position de la planète par rapport au soleil</label>
            <input type="text" name="position_soleil" id="position_soleil">
        </div>
        <div class="input">
            <label for="rayon">Rayon moyen de la planète</label>
            <input type="text" name="rayon" id="rayon">
        </div>
        <div class="input">
            <label for="masse">Masse de la planète</label>
            <input type="text" name="masse" id="masse">
        </div>
        <div class="input">
            <label for="gravite">Gravité à sa surface</label>
            <input type="text" name="gravite" id="gravite">
        </div>
        <div class="input">
            <label for="periode_orbitale">Période orbitale</label>
            <input type="text" name="periode_orbitale" id="periode_orbitale">
        </div>
        <div class="input">
            <label for="inclinaison_ecliptique">Inclinaison sur le plan de l'ecliptique</label>
            <input type="text" name="inclinaison_ecliptique" id="inclinaison_ecliptique">
        </div>
        <div class="input">
            <label for="journee">Durée d'une journée</label>
            <input type="text" name="journee" id="journee">
        </div>
        <div class="input">
            <label for=" inclinaison_axe">Inclinaison axe de rotation</label>
            <input type="text" name="inclinaison_axe" id="inclinaison_axe">
        </div>
        <div class="input">
            <label for="nombre_satellite">Nombre de satellite(s)</label>
            <input type="text" name="nombre_satellite" id="nombre_satellite">
        </div>
        <div class="input">
            <label for="etymologie">Etymologie du nom</label>
            <textarea name="etymologie" id="etymologie" cols="30" rows="5" placeholde="Etymologie ..."></textarea>
        </div>
        <div class="input">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="5" placeholde="Description ..."></textarea>
        </div>
        <div class="input">
            <button type="submit">Enregistrer</button>
        </div>
    </form>
</div>

<!-- ###################################################### FORMULAIRE SATELITTE ###################################################### -->
<div class="formulaire satelitte" style="display:<?=$hidden_satelitte?>">
    <form action="" method="post" class="form_sat">
        <div class="input">
            <label for="nom_sat">Nom du satelitte</label>
            <input type="text" name="nom_sat" id="nom_sat">
        </div>

        <div id="selecteurP">
            <label for="planet_id">Astre mère</label>
            <select name="planet_id" id="planet_id">
                <?php while($astre=$selecteur_planet->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?=$astre['id_planet']?>"><?=$astre['nom']?></option>
                <?php endwhile;?>
            </select>
        </div>

        <div class="input">
            <label for="distance_astre">Distance à l'astre mère </label>
            <input type="text" name="distance_astre" id="distance_astre">
        </div>
        <div class="input">
            <label for="position_astre">Position à l'astre mère</label>
            <input type="text" name="position_astre" id="position_astre">
        </div>
        <div class="input">
            <label for="rayon_sat">Rayon moyen</label>
            <input type="text" name="rayon_sat" id="rayon_sat">
        </div>
        <div class="input">
            <label for="masse_sat">Masse</label>
            <input type="text" name="masse_sat" id="masse_sat">
        </div>
        <div class="input">
            <label for="gravite_sat">Gravité surface</label>
            <input type="text" name="gravite_sat" id="gravite_sat">
        </div>
        <div class="input">
            <label for="periode_orbitale_sat">Période orbitale</label>
            <input type="text" name="periode_orbitale_sat" id="periode_orbitale_sat">
        </div>
        <div class="input">
            <label for="journee_sat">Journée</label>
            <input type="text" name="journee_sat" id="journee_sat">
        </div>
        <div class="input">
            <label for="inclinaison_orbitale_sat">Inclinaison orbitale</label>
            <input type="text" name="inclinaison_orbitale_sat" id="inclinaison_orbitale_sat">
        </div>
        <div class="input">
            <label for="etymologie">Etymologie</label>
            <textarea name="etymologie" id="" cols="30" rows="5" placeholde="Etymologie ..."></textarea>
        </div>
        <div class="input">
            <label for="description">Description</label>
            <textarea name="description" id="" cols="30" rows="5" placeholde="Description ..."></textarea>
        </div>
        <div class="input">
            <button type="submit">Enregistrer</button>
        </div>
    </form>
</div>



<?php
include_once 'footer.php';
?>