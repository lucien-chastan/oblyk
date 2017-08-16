<?php

//CONNEXION AU 2 BASES DE DONNÉES
try{$bddNet = new PDO('mysql:host=localhost;dbname=oblyk', 'root', 'MySql26400', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));}
catch(Exception $e){die('Erreur : '.$e->getMessage());}

try{$bddOrg = new PDO('mysql:host=localhost;dbname=oblykorg;charset=utf8', 'root', 'MySql26400', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));}
catch(Exception $e){die('Erreur : '.$e->getMessage());}


//Constant

$oblyk_id = 57;

//1 . LES UTILISATEURS
echo '<h1>Les Utiliateurs</h1>';
$users = [];

$req = $bddNet->prepare('SELECT * FROM usr_pr');
$req->execute(array());
while($data = $req->fetch()){

  // echo $data['id'] . ' : ' . $data['nom'] . '<br>';

  $insert = $bddOrg->prepare('INSERT INTO users (name, email, password, localisation, birth, sex, description, created_at) VALUES (:name, :email, :password, :localisation, :birth, :sex, :description, :created_at)');
  $insert->execute([
    'name'=>$data['nom'],
    'email'=>$data['email'],
    'password'=> 'Must be changed',
    'localisation'=>$data['localisation'],
    'birth'=>$data['age'],
    'sex'=>$data['sex'],
    'description'=>$data['description_profil'],
    'created_at'=>$data['date'],
  ]);

  $users[$data['id']] = $bddOrg->lastInsertId();;

  //Indexation pour la recherche rapide
  $insert = $bddOrg->prepare('INSERT INTO searches (searchable_id, searchable_type, label, created_at) VALUES (:searchable_id, :searchable_type, :label, :created_at)');
  $insert->execute([
    'searchable_id'=> $users[$data['id']],
    'searchable_type'=>'App\User',
    'label'=> $data['nom'],
    'created_at'=>$data['date'],
  ]);

}


//2 . Les albums
echo '<h1>Les Albums</h1>';
$albums = [];

$req = $bddNet->prepare('SELECT * FROM usr_album');
$req->execute(array());
while($data = $req->fetch()){

  // echo $data['id'] . ' : ' . $data['nom'] . '<br>';

  $insert = $bddOrg->prepare('INSERT INTO albums (label, description, user_id, created_at) VALUES (:label, :description, :user_id, :created_at)');
  $insert->execute([
    'label'=>$data['nom'],
    'description'=>$data['description'],
    'user_id'=> $users[$data['id_user']],
    'created_at'=>$data['date_cr'],
  ]);

  $albums[$data['id']] = $bddOrg->lastInsertId();

}

//3 . Les types de roches
echo '<h1>Les Types de roche</h1>';
$insert = $bddOrg->query('INSERT INTO rocks (label) VALUES ("inconnue")');
$insert = $bddOrg->query('INSERT INTO rocks (label) VALUES ("ardoise")');
$insert = $bddOrg->query('INSERT INTO rocks (label) VALUES ("calcaire")');
$insert = $bddOrg->query('INSERT INTO rocks (label) VALUES ("conglomérats")');
$insert = $bddOrg->query('INSERT INTO rocks (label) VALUES ("gabbro")');
$insert = $bddOrg->query('INSERT INTO rocks (label) VALUES ("gneiss")');
$insert = $bddOrg->query('INSERT INTO rocks (label) VALUES ("granite")');
$insert = $bddOrg->query('INSERT INTO rocks (label) VALUES ("grès")');
$insert = $bddOrg->query('INSERT INTO rocks (label) VALUES ("migmatite")');
$insert = $bddOrg->query('INSERT INTO rocks (label) VALUES ("molasse")');
$insert = $bddOrg->query('INSERT INTO rocks (label) VALUES ("quartzite")');
$insert = $bddOrg->query('INSERT INTO rocks (label) VALUES ("serpentine")');
$insert = $bddOrg->query('INSERT INTO rocks (label) VALUES ("silex")');
$insert = $bddOrg->query('INSERT INTO rocks (label) VALUES ("basalte")');
$insert = $bddOrg->query('INSERT INTO rocks (label) VALUES ("rhiolyte")');
$insert = $bddOrg->query('INSERT INTO rocks (label) VALUES ("andésite")');
$insert = $bddOrg->query('INSERT INTO rocks (label) VALUES ("schiste")');
$insert = $bddOrg->query('INSERT INTO rocks (label) VALUES ("phonolithe")');
echo ('roche créées');


//4 . Les falaises

echo '<h1>Les Falaises, Saisons &amp; Orientations</h1>';
$crags = [];

$req = $bddNet->prepare('SELECT * FROM site_pr');
$req->execute(array());
while($data = $req->fetch()){

  // echo $data['id'] . ' : ' . $data['nom'] . '<br>';

  $insert = $bddOrg->prepare('
    INSERT INTO crags (label, rock_id, bandeau, code_country, country, city, region, user_id, lat, lng, type_voie, type_grande_voie, type_bloc, type_deep_water, type_via_ferrata ,created_at)
    VALUES (:label, :rock_id, :bandeau, :code_country, :country, :city, :region, :user_id, :lat, :lng, :type_voie, :type_grande_voie, :type_bloc, :type_deep_water, :type_via_ferrata , :created_at)');
  $insert->execute([
    'label'=>$data['nom'],
    'rock_id'=>$data['roch'] + 1,
    'bandeau'=> '/img/default-crag-bandeau.jpg',
    'code_country'=>$data['pays'],
    'country'=>$data['pays'],
    'city'=>$data['commune'],
    'region'=>$data['dep'],
    'user_id'=> $users[$data['id_user']],
    'lat'=>$data['latitude'],
    'lng'=>$data['longitude'],
    'type_voie'=>$data['type_voie'],
    'type_grande_voie'=>$data['type_gv'],
    'type_deep_water'=>$data['type_dw'],
    'type_bloc'=>$data['type_bloc'],
    'type_via_ferrata'=>0,
    'created_at'=>$data['date_cr'],
  ]);

  $crags[$data['id']] = $bddOrg->lastInsertId();

  //Indexation pour la recherche rapide
  $insert = $bddOrg->prepare('INSERT INTO searches (searchable_id, searchable_type, label, created_at) VALUES (:searchable_id, :searchable_type, :label, :created_at)');
  $insert->execute([
    'searchable_id'=> $crags[$data['id']],
    'searchable_type'=>'App\Crag',
    'label'=> $data['nom'],
    'created_at'=>$data['date_cr'],
  ]);

  //Orientation
  $orientations = explode(' - ', $data['orientation']);
  $north = 0;
  $east = 0;
  $south = 0;
  $west = 0;

  foreach ($orientations as $value) {
    if($value == 'Nord') $north = 1;
    if($value == 'Est') $east = 1;
    if($value == 'Sud') $south = 1;
    if($value == 'Ouest') $west = 1;
  }

  $insert = $bddOrg->prepare('
    INSERT INTO orientations (orientable_id, orientable_type, north, east, south, west, created_at)
    VALUES (:orientable_id, :orientable_type, :north, :east, :south, :west, :created_at)');
  $insert->execute([
    'orientable_id'=>$crags[$data['id']],
    'orientable_type'=> 'App\Crag',
    'north'=> $north,
    'east'=>$east,
    'south'=>$south,
    'west'=>$west,
    'created_at'=>$data['date_cr'],
  ]);

  //LES SAISONS
  $insert = $bddOrg->prepare('
    INSERT INTO seasons (seasontable_id, seasontable_type, summer, autumn, winter, spring, created_at)
    VALUES (:seasontable_id, :seasontable_type, :summer, :autumn, :winter, :spring, :created_at)');
  $insert->execute([
    'seasontable_id'=>$crags[$data['id']],
    'seasontable_type'=> 'App\Crag',
    'summer'=> $data['saison_ete'],
    'autumn'=> $data['saison_automne'],
    'winter'=> $data['saison_hiver'],
    'spring'=> $data['saison_printemps'],
    'created_at'=>$data['date_cr'],
  ]);
}


//5. Les Parkings

$parkings = [];
echo '<h1>Les Parkings</h1>';

$req = $bddNet->prepare('SELECT * FROM site_parking');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_site'], $crags)){

    // echo 'Parking : ' . $data['id'] . ' du site : ' . $data['id_site'] . '<br>';

    $insert = $bddOrg->prepare('
      INSERT INTO parkings (crag_id, user_id, description, lat, lng, created_at)
      VALUES (:crag_id, :user_id, :description, :lat, :lng, :created_at)');
    $insert->execute([
      'crag_id'=>$crags[$data['id_site']],
      'user_id'=>$users[$data['id_user']],
      'description'=> $data['description'],
      'lat'=>$data['latitude'],
      'lng'=>$data['longitude'],
      'created_at'=>$data['date_cr'],
    ]);

    $parkings[$data['id']] = $bddOrg->lastInsertId();
  }
}
echo 'parkings créés';


//6. Les descriptions sur les sites d'escalade

echo '<h1>Les Descriptions sur les sites d\'escalade</h1>';

$req = $bddNet->prepare('SELECT * FROM site_description');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_site'], $crags)){

    // echo 'Description : ' . $data['id'] . ' du site : ' . $data['id_site'] . '<br>';

    $insert = $bddOrg->prepare('
      INSERT INTO descriptions (descriptive_id, descriptive_type, description, user_id, created_at)
      VALUES (:descriptive_id, :descriptive_type, :description, :user_id, :created_at)');
    $insert->execute([
      'descriptive_id'=>$crags[$data['id_site']],
      'descriptive_type'=>'App\Crag',
      'description'=> $data['description'],
      'user_id'=>$users[$data['id_user']],
      'created_at'=>$data['date_cr'],
    ]);
  }
}
echo 'description des sites créés';



//7. Les liens des sites

echo '<h1>Les liens sur les sites d\'escalade</h1>';

$req = $bddNet->prepare('SELECT * FROM site_lien');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_site'], $crags) && array_key_exists($data['id_user'], $users)){

    // echo 'Lien : ' . $data['id'] . ' du site : ' . $data['id_site'] . '<br>';

    $insert = $bddOrg->prepare('
      INSERT INTO links (linkable_id, linkable_type, label, link, description, user_id, created_at)
      VALUES (:linkable_id, :linkable_type, :label, :link, :description, :user_id, :created_at)');
    $insert->execute([
      'linkable_id'=>$crags[$data['id_site']],
      'linkable_type'=>'App\Crag',
      'label'=> $data['nom'],
      'link'=> $data['href'],
      'description'=> $data['description_lien'],
      'user_id'=>$users[$data['id_user']],
      'created_at'=>$data['date_cr'],
    ]);
  }
}
echo 'liens des sites créés';



// 8 . Éxposition à la pluie

echo '<h1>Les éxpositions à la pluie</h1>';

$insert = $bddOrg->query('INSERT INTO rain_exposures (label) VALUES ("éxposition à la pluie inconnu")');
$insert = $bddOrg->query('INSERT INTO rain_exposures (label) VALUES ("abrité de la pluie")');
$insert = $bddOrg->query('INSERT INTO rain_exposures (label) VALUES ("éxposé à la pluie")');



// 9 . Éxposition au soleil

echo '<h1>Les éxpositions au soleil</h1>';

$insert = $bddOrg->query('INSERT INTO suns (label) VALUES ("ensoleillement inconnu")');
$insert = $bddOrg->query('INSERT INTO suns (label) VALUES ("ensoleillé toute la journée")');
$insert = $bddOrg->query('INSERT INTO suns (label) VALUES ("à l\'ombre toute la journée")');
$insert = $bddOrg->query('INSERT INTO suns (label) VALUES ("au soleil l\'après-midi")');
$insert = $bddOrg->query('INSERT INTO suns (label) VALUES ("au soleil le matin")');

// 10 . On va créer des secteurs la ou il n'y en à pas
// -> on va créer des secteurs à partir de la liste des sites avec des voies vide

$req = $bddNet->prepare('SELECT DISTINCT ligne_pr.id_site AS id_site, site_pr.nom AS nom_site, site_pr.nom AS nom_site, site_pr.date_cr AS date_cr FROM `ligne_pr` INNER JOIN site_pr ON site_pr.id = ligne_pr.id_site WHERE ligne_pr.id_secteur = 0 ');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_site'], $crags)){

    //on créer un secteur qui à pour nom le nom du site
    $insert = $bddNet->prepare('
      INSERT INTO secteur_pr (id_site, id_user, id_user_ed, nom, description, orientation, ensoleillement, pluie, temps_approche, type_approche, acces, latitude, longitude, date_cr, date_ed)
      VALUES (:id_site, :id_user, :id_user_ed, :nom, :description, :orientation, :ensoleillement, :pluie, :temps_approche, :type_approche, :acces, :latitude, :longitude, :date_cr, :date_ed)');
    $insert->execute([
      'id_site'=> $data['id_site'],
      'id_user'=> 63,
      'id_user_ed'=> 63,
      'nom'=> $data['nom_site'],
      'description'=> '',
      'orientation'=> '',
      'ensoleillement'=> 0,
      'pluie'=> 0,
      'temps_approche'=> 0,
      'type_approche'=> 0,
      'acces'=> '',
      'latitude'=> 0,
      'longitude'=> 0,
      'date_cr'=>$data['date_cr'],
      'date_ed'=>$data['date_cr'],
    ]);

    $idSecteur = $bddNet->lastInsertId();

    //on change l'id du secteur des lignes concerné
    $update = $bddNet->prepare('
      UPDATE ligne_pr SET id_secteur = :id_secteur
      WHERE id_site = :id_site AND id_secteur = 0');
    $update->execute([
      'id_site'=> $data['id_site'],
      'id_secteur'=> $idSecteur,
    ]);
  }
}


// 10. Les Secteurs

echo '<h1>Les Secteurs, Saisons &amp; Orientations</h1>';
$sectors = [];

$req = $bddNet->prepare('SELECT * FROM secteur_pr');
$req->execute(array());
while($data = $req->fetch()){

  // echo $data['id'] . ' : ' . $data['nom'] . '<br>';

  if (array_key_exists($data['id_site'], $crags)){

    //on change l'id du user s'il n'existe plus
    $user_id = array_key_exists($data['id_user'], $users) ? $users[$data['id_user']] : $oblyk_id;

    $insert = $bddOrg->prepare('
      INSERT INTO sectors (label, crag_id, user_id, lat, lng, rain_id, sun_id, approach, created_at)
      VALUES (:label, :crag_id, :user_id, :lat, :lng, :rain_id, :sun_id, :approach, :created_at)');
    $insert->execute([
      'label'=>$data['nom'],
      'crag_id'=> $crags[$data['id_site']],
      'user_id'=> $user_id,
      'lat'=> ($data['latitude'] <= 180 && $data['latitude'] >= -180) ? $data['latitude'] : 0,
      'lng'=>($data['longitude'] <= 180 && $data['longitude'] >= -180) ? $data['longitude'] : 0,
      'rain_id'=>$data['pluie'] + 1,
      'sun_id'=>$data['ensoleillement'] + 1,
      'approach'=>$data['temps_approche'],
      'created_at'=>$data['date_cr'],
    ]);

    $sectors[$data['id']] = $bddOrg->lastInsertId();


    //Orientation
    $orientations = explode(' - ', $data['orientation']);
    $north = 0;
    $east = 0;
    $south = 0;
    $west = 0;

    foreach ($orientations as $value) {
      if($value == 'Nord') $north = 1;
      if($value == 'Est') $east = 1;
      if($value == 'Sud') $south = 1;
      if($value == 'Ouest') $west = 1;
    }

    $insert = $bddOrg->prepare('
      INSERT INTO orientations (orientable_id, orientable_type, north, east, south, west, created_at)
      VALUES (:orientable_id, :orientable_type, :north, :east, :south, :west, :created_at)');
    $insert->execute([
      'orientable_id'=>$sectors[$data['id']],
      'orientable_type'=> 'App\Sector',
      'north'=> $north,
      'east'=>$east,
      'south'=>$south,
      'west'=>$west,
      'created_at'=>$data['date_cr'],
    ]);

    //LES SAISONS
    $insert = $bddOrg->prepare('
      INSERT INTO seasons (seasontable_id, seasontable_type, created_at)
      VALUES (:seasontable_id, :seasontable_type, :created_at)');
    $insert->execute([
      'seasontable_id'=>$sectors[$data['id']],
      'seasontable_type'=> 'App\Sector',
      'created_at'=>$data['date_cr'],
    ]);


    //ON PASSE LA DESCRIPTION DU SECTEUR (S'il y en à une)
    if($data['id'] != ''){
      $insert = $bddOrg->prepare('
        INSERT INTO descriptions (descriptive_id, descriptive_type, description, user_id, created_at)
        VALUES (:descriptive_id, :descriptive_type, :description, :user_id, :created_at)');
      $insert->execute([
        'descriptive_id'=>$sectors[$data['id']],
        'descriptive_type'=>'App\Sector',
        'description'=> $data['description'],
        'user_id'=> $oblyk_id,
        'created_at'=>$data['date_cr'],
      ]);
    }

  }
}

// 11 . Le Lexique

echo '<h1>Le lexique</h1>';
$words = [];


$req = $bddNet->prepare('SELECT * FROM lexique');
$req->execute(array());
while($data = $req->fetch()){

  // echo $data['id'] . ' : ' . $data['nom'] . '<br>';

  //on change l'id du user s'il n'existe plus
  $user_id = array_key_exists($data['id_user'], $users) ? $users[$data['id_user']] : $oblyk_id;

  $insert = $bddOrg->prepare('
    INSERT INTO words (label, definition, user_id, created_at)
    VALUES (:label, :definition, :user_id, :created_at)');
  $insert->execute([
    'label'=>$data['nom'],
    'definition'=> $data['definition'],
    'user_id'=> $user_id,
    'created_at'=>$data['date_cr'],
  ]);

  $words[$data['id']] = $bddOrg->lastInsertId();

  //Indexation pour la recherche rapide
  $insert = $bddOrg->prepare('INSERT INTO searches (searchable_id, searchable_type, label, created_at) VALUES (:searchable_id, :searchable_type, :label, :created_at)');
  $insert->execute([
    'searchable_id'=> $words[$data['id']],
    'searchable_type'=>'App\Word',
    'label'=> $data['nom'],
    'created_at'=>$data['date_cr'],
  ]);
}

// 12. Les noms des types de grimpe
$insert = $bddOrg->query('INSERT INTO climbs (label) VALUES ("inconnu")'); //1
$insert = $bddOrg->query('INSERT INTO climbs (label) VALUES ("bloc")'); // 2
$insert = $bddOrg->query('INSERT INTO climbs (label) VALUES ("voie")'); // 3
$insert = $bddOrg->query('INSERT INTO climbs (label) VALUES ("grande-voie")'); // 4
$insert = $bddOrg->query('INSERT INTO climbs (label) VALUES ("trad")'); // 5
$insert = $bddOrg->query('INSERT INTO climbs (label) VALUES ("artif")'); // 6
$insert = $bddOrg->query('INSERT INTO climbs (label) VALUES ("deep-water")'); // 7
$insert = $bddOrg->query('INSERT INTO climbs (label) VALUES ("via-ferrata")'); // 8

// 12. Les types de relais
$insert = $bddOrg->query('INSERT INTO anchors (label) VALUES ("inconnu")'); // 1
$insert = $bddOrg->query('INSERT INTO anchors (label) VALUES ("relais chaîné")'); // 2
$insert = $bddOrg->query('INSERT INTO anchors (label) VALUES ("2 points non chaîné")'); // 3
$insert = $bddOrg->query('INSERT INTO anchors (label) VALUES ("tête de bélier")'); // 4
$insert = $bddOrg->query('INSERT INTO anchors (label) VALUES ("relais sur freinds")'); // 5
$insert = $bddOrg->query('INSERT INTO anchors (label) VALUES ("pas de relais")'); // 6

// 13. Les types de point
$insert = $bddOrg->query('INSERT INTO points (label) VALUES ("inconnu")'); // 1
$insert = $bddOrg->query('INSERT INTO points (label) VALUES ("broches")'); // 2
$insert = $bddOrg->query('INSERT INTO points (label) VALUES ("plaquettes")'); // 3
$insert = $bddOrg->query('INSERT INTO points (label) VALUES ("crochets")'); // 4
$insert = $bddOrg->query('INSERT INTO points (label) VALUES ("anneaux")'); // 5
$insert = $bddOrg->query('INSERT INTO points (label) VALUES ("pas de point")'); // 6

//14 . Les types d'inclinaisons
$insert = $bddOrg->query('INSERT INTO inclines (label) VALUES ("inconnu")'); // 1
$insert = $bddOrg->query('INSERT INTO inclines (label) VALUES ("dalle positive")'); // 2
$insert = $bddOrg->query('INSERT INTO inclines (label) VALUES ("mur vertical")'); // 3
$insert = $bddOrg->query('INSERT INTO inclines (label) VALUES ("léger dévers")'); // 4
$insert = $bddOrg->query('INSERT INTO inclines (label) VALUES ("dévers")'); // 5
$insert = $bddOrg->query('INSERT INTO inclines (label) VALUES ("toit")'); // 6

//15 . Les types de récéptions
$insert = $bddOrg->query('INSERT INTO receptions (label) VALUES ("inconnu")'); // 1
$insert = $bddOrg->query('INSERT INTO receptions (label) VALUES ("bonne")'); // 2
$insert = $bddOrg->query('INSERT INTO receptions (label) VALUES ("correcte")'); // 3
$insert = $bddOrg->query('INSERT INTO receptions (label) VALUES ("mauvaise")'); // 4
$insert = $bddOrg->query('INSERT INTO receptions (label) VALUES ("dangeureuse")'); // 5

//16. Les types de départ
$insert = $bddOrg->query('INSERT INTO starts (label) VALUES ("inconnu")'); // 1
$insert = $bddOrg->query('INSERT INTO starts (label) VALUES ("départ assis")'); // 2
$insert = $bddOrg->query('INSERT INTO starts (label) VALUES ("départ debout")'); // 3
$insert = $bddOrg->query('INSERT INTO starts (label) VALUES ("départ sauté")'); // 4
$insert = $bddOrg->query('INSERT INTO starts (label) VALUES ("run and jump")'); // 5

//17 . Les lignes
echo '<h1>Les lignes et ses Sections</h1>';
$routes = [];
$routeSections = [];

$req = $bddNet->prepare('SELECT * FROM ligne_pr');
$req->execute(array());
while($data = $req->fetch()){

  // echo $data['id'] . ' : ' . $data['nom'] . '<br>';

  if (array_key_exists($data['id_site'], $crags) && array_key_exists($data['id_secteur'], $sectors)){

    //on change l'id du user s'il n'existe plus
    $user_id = array_key_exists($data['id_user'], $users) ? $users[$data['id_user']] : $oblyk_id;

    $climbType = 1;
    if($data['type'] == 0) $climbType = 2;
    if($data['type'] == 1) $climbType = 3;
    if($data['type'] == 2) $climbType = 4;
    if($data['type'] == 3) $climbType = 5;
    if($data['type'] == 4) $climbType = 6;
    if($data['type'] == 5) $climbType = 1;
    if($data['type'] == 6) $climbType = 7;

    $insert = $bddOrg->prepare('
      INSERT INTO routes (label, crag_id, sector_id, user_id, climb_id, height, open_year, opener, note, nb_note, nb_longueur, created_at)
      VALUES (:label, :crag_id, :sector_id, :user_id, :climb_id, :height, :open_year, :opener, :note, :nb_note, :nb_longueur, :created_at)');
    $insert->execute([
      'label' => $data['nom'],
      'crag_id' => $crags[$data['id_site']],
      'sector_id' => $sectors[$data['id_secteur']],
      'user_id' => $user_id,
      'climb_id' => $climbType,
      'height' => $data['hauteur'],
      'open_year' => $data['annee_ouverture'],
      'opener' => $data['ouvreur'],
      'note' => $data['note'],
      'nb_note' => $data['nb_note'],
      'nb_longueur' => $data['nb_longueur'],
      'created_at' =>$data['date_cr'],
    ]);

    $routes[$data['id']] = $bddOrg->lastInsertId();

    //Si c'est une voie d'une seul longeur
    if($data['type_cotation'] == 0) {

      $inclineType = 1;
      if($data['type'] == 0) $inclineType = 1;
      if($data['type'] == 1) $inclineType = 2;
      if($data['type'] == 2) $inclineType = 3;
      if($data['type'] == 3) $inclineType = 5;
      if($data['type'] == 4) $inclineType = 6;
      if($data['type'] == 5) $inclineType = 4;

      $insert = $bddOrg->prepare('
        INSERT INTO route_sections (route_id, grade, sub_grade, grade_val, section_height, nb_point, point_id, anchor_id, incline_id, reception_id, start_id, section_order, created_at)
        VALUES (:route_id, :grade, :sub_grade, :grade_val, :section_height, :nb_point, :point_id, :anchor_id, :incline_id, :reception_id, :start_id, :section_order, :created_at)');
      $insert->execute([
        'route_id'=>$routes[$data['id']],
        'grade'=>$data['cotation'],
        'sub_grade'=>$data['ponderation'],
        'grade_val'=>$data['val_cotation'],
        'section_height'=>$data['hauteur'],
        'nb_point'=>$data['nb_degaine'],
        'point_id'=>$data['type_point'] + 1,
        'anchor_id'=>$data['type_relais'] + 1,
        'incline_id'=>$inclineType,
        'reception_id'=>$data['reception_bloc'] + 1,
        'start_id'=>$data['depart_bloc'] + 1,
        'section_order'=> 1,
        'created_at'=>$data['date_cr'],
      ]);

    }else {

      //si c'est une voie en plusieur longueur
      $reqSections = $bddNet->prepare('SELECT * FROM longueur_pr WHERE id_ligne = :id_ligne');
      $reqSections->execute([
        'id_ligne' => $data['id']
      ]);
      while($dataSection = $reqSections->fetch()){

        $insert = $bddOrg->prepare('
          INSERT INTO route_sections (route_id, grade, sub_grade, grade_val, section_height, nb_point, point_id, anchor_id, incline_id, reception_id, start_id, section_order, created_at)
          VALUES (:route_id, :grade, :sub_grade, :grade_val, :section_height, :nb_point, :point_id, :anchor_id, :incline_id, :reception_id, :start_id, :section_order, :created_at)');
        $insert->execute([
          'route_id' => $routes[$data['id']],
          'grade' => $dataSection['cotation'],
          'sub_grade' => $dataSection['ponderation'],
          'grade_val' => $dataSection['val_cotation'],
          'section_height' => $dataSection['hauteur'],
          'nb_point' => $dataSection['nb_point'],
          'point_id' => $dataSection['type_point'] + 1,
          'anchor_id' => $dataSection['type_relais'] + 1,
          'incline_id' => 1,
          'reception_id' => 1,
          'start_id' => 1,
          'section_order' => $dataSection['ordre'] + 1,
          'created_at' => $data['date_cr'],
        ]);
      }
    }
  }
}
