<?php
include_once 'nav.php';
$hidden_planet='none';
$hidden_satelitte='none';
$selecteur='Choisissez l\'élément que vous souhaitez ajouter';

echo'<pre style="color:white;">';print_r($_POST);echo'</pre>';

// $_GET['choix_table']=htmlspecialchars(strip_tags(addslashes($_GET['choix_table'])));
if(isset($_POST['nom'], $_POST['distance_soleil'], $_POST['position_soleil'], $_POST['rayon'], $_POST['masse'], $_POST['gravite'], $_POST['periode_orbitale'],$_POST['inclinaison_ecliptique'], $_POST['inclinaison_axe'], $_POST['journee'], $_POST['nombre_satellite'], $_POST['etymologie'], $_POST['description'])) 
{
    foreach($_POST as $key=>$value)
    {
        $_POST[$key]=htmlspecialchars(strip_tags(addslashes($value)));
    }


    $insertion=$systemeSolaire->prepare("INSERT INTO planet (nom, distance_soleil, position_soleil, rayon, masse, gravite, periode_orbitale, inclinaison_ecliptique, journee, inclinaison_axe, nombre_satellite, etymologie, description) VALUES (:nom, :distance_soleil, :position_soleil, :rayon, :masse, :gravite, :periode_orbitale, :inclinaison_ecliptique, :journee, :inclinaison_axe  :nombre_satellite, :etymologie, :description)");

    foreach ($_POST as $key => $value)
    {
        if($key=='position_soleil' || $key=='nombre_satellite')
        $insertion->bindValue(":$key", $value, PDO::PARAM_INT);
        else
        $insertion->bindValue(":$key", $value, PDO::PARAM_STR);
    }
    $insertion->execute();
    // $insertion->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
    // $insertion->bindValue(':distance_soleil', $_POST['distance_soleil'], PDO::PARAM_STR);
    // $insertion->bindValue(':position_soleil', $_POST['position_soleil'], PDO::PARAM_INT);
    // $insertion->bindValue(':rayon', $_POST['rayon'], PDO::PARAM_STR);
    // $insertion->bindValue(':masse', $_POST['masse'], PDO::PARAM_STR);
    // $insertion->bindValue(':gravite', $_POST['gravite'], PDO::PARAM_STR);
    // $insertion->bindValue(':periode_orbitale', $_POST['periode_orbitale'], PDO::PARAM_STR);
    // $insertion->bindValue(':inclinaison_ecliptique', $_POST['inclinaison_ecliptique'], PDO::PARAM_STR);
    // $insertion->bindValue(':journee', $_POST['journee'], PDO::PARAM_STR);
    // $insertion->bindValue(':inclinaison_axe', $_POST['inclinaison_axe'], PDO::PARAM_STR);
    // $insertion->bindValue(':nombre_satellite', $_POST['nombre_satellite'], PDO::PARAM_INT);
    // $insertion->bindValue(':etymologie', $_POST['etymologie'], PDO::PARAM_STR);
    // $insertion->bindValue(':description', $_POST['description'], PDO::PARAM_STR);

    
}


if(isset($_GET) && ($_GET['choix_table']=='planet' || $_GET['choix_table']=='satelitte'))
{
    

    switch($_GET['choix_table'])
    {
        case 'planet':
        {
            $hidden_planet='';
            $hidden_satelitte='none';
            $selecteur='Entrer une nouvelle planète';
            break;
        }
        case 'satelitte':
        {
            $hidden_satelitte='';
            $hidden_planet='none';
            $selecteur='Entrer un nouveau satellite';
            break;
        }
    }
}

?>

<div class="selecteur">
    <form action="" method="get">
        <div>
            <label for="choix_table"></label>
            <select name="choix_table" id="choix_table">
                <option value="" selected><?= $selecteur?></option>
                <option value="planet">Entrer une nouvelle planète</option>
                <option value="satelitte">Entrer un nouveau satellite</option>
            </select>
            <button type="submit">Valider</button>
        </div>
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
<div class="formulaire" style="display:<?=$hidden_satelitte?>">
    <form action="" method="post">
        <div class="input">
            <label for="nom">Nom du satelitte</label>
            <input type="text" name="nom" id="nom">
        </div>
        <div class="input">
            <label for="distance_soleil">Distance par rapport à son </label>
            <input type="text" name="distance_soleil" id="distance_soleil">
        </div>
        <div class="input">
            <label for="position_soleil">Position de la planète par rapport au soleil</label>
            <input type="text" name="position_soleil" id="position_soleil">
        </div>
        <div class="input">
            <label for="rayon ">Rayon moyen de la planète</label>
            <input type="text" name="rayon " id="rayon ">
        </div>
        <div class="input">
            <label for="masse">Masse de la planète</label>
            <input type="text" name="masse" id="masse">
        </div>
        <div class="input">
            <label for="gravite ">Gravité à sa surface</label>
            <input type="text" name="gravite " id="gravite ">
        </div>
        <div class="input">
            <label for="periode_orbitale">Période orbitale</label>
            <input type="text" name="periode_orbitale" id="periode_orbitale">
        </div>
        <div class="input">
            <label for="inclinaison_ecliptique ">Inclinaison sur le plan de l'ecliptique</label>
            <input type="text" name="inclinaison_ecliptique " id="inclinaison_ecliptique ">
        </div>
        <div class="input">
            <label for=" 	journee ">Durée d'une journée</label>
            <input type="text" name=" 	journee " id=" 	journee ">
        </div>
        <div class="input">
            <label for=" 	inclinaison_axe">Inclinaison axe de rotation</label>
            <input type="text" name=" 	inclinaison_axe" id=" 	inclinaison_axe">
        </div>
        <div class="input">
            <label for="nombre_satellite">Nombre de satellite(s)</label>
            <input type="text" name="nombre_satellite" id="nombre_satellite">
        </div>
        <div class="input">
            <label for="etymologie">Etymologie du nom</label>
            <input type="text" name="etymologie" id="etymologie">
        </div>
        <div class="input">
            <label for="description"></label>
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