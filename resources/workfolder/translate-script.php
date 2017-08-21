<?php

//CONNEXION AU 2 BASES DE DONNÉES
try{$bddNet = new PDO('mysql:host=localhost;dbname=oblyk', 'root', 'MySql26400', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));}
catch(Exception $e){die('Erreur : '.$e->getMessage());}

try{$bddOrg = new PDO('mysql:host=localhost;dbname=oblykorg;charset=utf8', 'root', 'MySql26400', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));}
catch(Exception $e){die('Erreur : '.$e->getMessage());}

include('markdown.php');

//Constant

$oblyk_id = 57;
$startDate = date("Y-m-d H:i:s");

//convertie une cotation en valeur
function valToGrad($val){
    $grad = 0;

    //cotation type 1a, 6a, 8b

    if($val == 1 || $val == 2) $grad = '1a' ;
    if($val == 3 || $val == 4) $grad = '1b' ;
    if($val == 5 || $val == 6) $grad = '1c' ;

    if($val == 7 || $val == 8) $grad = '2a' ;
    if($val == 9 || $val == 10) $grad = '2b' ;
    if($val == 11 || $val == 12) $grad = '2c' ;

    if($val == 13 || $val == 14) $grad = '3a' ;
    if($val == 15 || $val == 16) $grad = '3b' ;
    if($val == 17 || $val == 18) $grad = '3c' ;

    if($val == 19 || $val == 20) $grad = '4a' ;
    if($val == 21 || $val == 22) $grad = '4b' ;
    if($val == 23 || $val == 24) $grad = '4c' ;

    if($val == 25 || $val == 26) $grad = '5a' ;
    if($val == 27 || $val == 28) $grad = '5b' ;
    if($val == 29 || $val == 30) $grad = '5c' ;

    if($val == 31 || $val == 32) $grad = '6a' ;
    if($val == 33 || $val == 34) $grad = '6b' ;
    if($val == 35 || $val == 36) $grad = '6c' ;

    if($val == 37 || $val == 38) $grad = '7a' ;
    if($val == 39 || $val == 40) $grad = '7b' ;
    if($val == 41 || $val == 42) $grad = '7c' ;

    if($val == 43 || $val == 44) $grad = '8a' ;
    if($val == 45 || $val == 46) $grad = '8b' ;
    if($val == 47 || $val == 48) $grad = '8c' ;

    if($val == 49 || $val == 50) $grad = '9a' ;
    if($val == 51 || $val == 52) $grad = '9b' ;
    if($val == 53 || $val == 54) $grad = '9c' ;

    return $grad;
}

function slugify($text) {
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

//pour souvenir
//"%â˜º%" -> :)
//"%ðŸ˜ƒ%" -> :D
//"%ðŸ˜%" -> <3
//"%ðŸ™„%" -> :/
//"%ðŸ˜•%" -> :\
//"%ðŸ˜‰%" -> ;)
//"%ðŸ˜Š%" -> ^^
//"%ðŸ˜%" ->
//"%ðŸ™Š%" -> &#128586;

// REGEXP "â˜º|ðŸ˜ƒ|ðŸ˜|ðŸ™„|ðŸ˜•|ðŸ˜‰|ðŸ˜Š|ðŸ˜|ðŸ™Š"

//1 . LES UTILISATEURS
$users = [];
$req = $bddNet->prepare('SELECT * FROM usr_pr');
$req->execute(array());
while($data = $req->fetch()){

  $insert = $bddOrg->prepare('INSERT INTO users (name, email, password, localisation, birth, sex, description, last_fil_read, created_at) VALUES (:name, :email, :password, :localisation, :birth, :sex, :description, :last_fil_read, :created_at)');
  $insert->execute([
    'name'=>$data['nom'],
    'email'=>$data['email'],
    'password'=> 'Must be changed',
    'localisation'=>$data['localisation'],
    'birth'=>$data['age'],
    'sex'=>$data['sex'],
    'description'=>$data['description_profil'],
    'last_fil_read'=>date('Y-m-d H:m:s'),
    'created_at'=>$data['date'],
  ]);

  $users[$data['id']] = $bddOrg->lastInsertId();;

  //Les paramètres Utiliateurs
  $insert = $bddOrg->prepare('INSERT INTO user_settings (user_id, created_at) VALUES (:user_id, :created_at)');
  $insert->execute([
    'user_id'=>$users[$data['id']],
    'created_at'=>$data['date'],
  ]);

  //on va chercher les paramètres du partenaire
  $reqPartnerSettings = $bddNet->prepare('SELECT * FROM usr_climbing_setting WHERE id_user = :user_id');
  $reqPartnerSettings->execute(['user_id'=>$data['id']]);
  $dataPartner = $reqPartnerSettings->fetch();

  //Les paramètres de recherche de partenaire
  if(isset($dataPartner['description_preference'])){

    $insert = $bddOrg->prepare('
      INSERT INTO user_partner_settings (user_id, partner, description, climb_1, climb_2, climb_3, climb_4, climb_5, climb_6, climb_7, climb_8, grade_max, grade_min, created_at)
      VALUES (:user_id, :partner, :description, :climb_1, :climb_2, :climb_3, :climb_4, :climb_5, :climb_6, :climb_7, :climb_8, :grade_max, :grade_min, :created_at)');
    $insert->execute([
      'user_id'=>$users[$data['id']],
      'partner'=>$data['partenaire'],
      'description'=>$dataPartner['description_preference'],
      'climb_1'=>$dataPartner['type_bloc_ext'],
      'climb_2'=>$dataPartner['type_voie_ext'],
      'climb_3'=>$dataPartner['type_gv'],
      'climb_4'=>$dataPartner['type_trad'],
      'climb_5'=>$dataPartner['type_artif'],
      'climb_6'=>$dataPartner['type_dw'],
      'climb_7'=>0,
      'climb_8'=>0,
      'grade_max'=>valToGrad($dataPartner['cotation_max']),
      'grade_min'=>valToGrad($dataPartner['cotation_mini']),
      'created_at'=>$data['date'],
    ]);

  }else{

    //Les paramètres de recherche de partenaire
    $insert = $bddOrg->prepare('INSERT INTO user_partner_settings (user_id, partner, description, climb_1, climb_2, climb_3, climb_4, climb_5, climb_6, climb_7, grade_max, grade_min, created_at) VALUES (:user_id, :partner, :description, :climb_1, :climb_2, :climb_3, :climb_4, :climb_5, :climb_6, :climb_7, :grade_max, :grade_min, :created_at)');
    $insert->execute([
      'user_id'=>$users[$data['id']],
      'partner'=>0,
      'description'=>'',
      'climb_1'=>0,
      'climb_2'=> 0,
      'climb_3'=> 0,
      'climb_4'=> 0,
      'climb_5'=> 0,
      'climb_6'=> 0,
      'climb_7' => 0,
      'grade_max'=>'2a',
      'grade_min'=>'2a',
      'created_at'=>$data['date'],
    ]);
  }

  //copie du bandeau si existe
  if($data['img_bandeau'] != ''){
    if(file_exists('../oblyk.net/img_user/photo_bandeau/' . $data['img_bandeau'])){
      $splitBandeau = explode('.',$data['img_bandeau']);
      $extension = $splitBandeau[1];
      copy('../oblyk.net/img_user/photo_bandeau/' . $data['img_bandeau'], '../oblyk.org/storage/app/public/users/1300/bandeau-' . $users[$data['id']] . '.' . $extension);
    }
  }

  //copie de l'image du user si existe
  if($data['img_pr'] != ''){
    if(file_exists('../oblyk.net/img_user/' . $data['img_pr'])){
      $splitImgProfile = explode('.',$data['img_pr']);
      $extension = $splitImgProfile[1];
      copy('../oblyk.net/img_user/' . $data['img_pr'], '../oblyk.org/storage/app/public/users/1000/user-' . $users[$data['id']] . '.' . $extension);
    }
  }

  //Indexation pour la recherche rapide
  $insert = $bddOrg->prepare('INSERT INTO searches (searchable_id, searchable_type, label, created_at) VALUES (:searchable_id, :searchable_type, :label, :created_at)');
  $insert->execute([
    'searchable_id'=> $users[$data['id']],
    'searchable_type'=>'App\User',
    'label'=> slugify($data['nom']),
    'created_at'=>$data['date'],
  ]);
}
echo "1. Les Utiliateurs -> ok <br>";


//2 . Les albums
$albums = [];
$req = $bddNet->prepare('SELECT * FROM usr_album');
$req->execute(array());
while($data = $req->fetch()){

  $insert = $bddOrg->prepare('INSERT INTO albums (label, description, user_id, created_at) VALUES (:label, :description, :user_id, :created_at)');
  $insert->execute([
    'label'=>$data['nom'],
    'description'=>$data['description'],
    'user_id'=> $users[$data['id_user']],
    'created_at'=>$data['date_cr'],
  ]);

  $albums[$data['id']] = $bddOrg->lastInsertId();

}
echo "2. Les albums photo -> ok <br>";


//3 . Les types de roches
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
echo ('3. Type de roche -> ok <br>');


//4 . Les falaises
$crags = [];
$cragSlugs = [];
$req = $bddNet->prepare('SELECT * FROM site_pr');
$req->execute(array());
while($data = $req->fetch()){

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
  $cragSlugs[$data['id']] = slugify($data['nom']);

  //Indexation pour la recherche rapide
  $insert = $bddOrg->prepare('INSERT INTO searches (searchable_id, searchable_type, label, created_at) VALUES (:searchable_id, :searchable_type, :label, :created_at)');
  $insert->execute([
    'searchable_id'=> $crags[$data['id']],
    'searchable_type'=>'App\Crag',
    'label'=> slugify($data['nom']),
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
echo "4. Site, saison, orientation -> ok <br>";

//5. Les Parkings
$parkings = [];
$req = $bddNet->prepare('SELECT * FROM site_parking');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_site'], $crags)){

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
echo '5. parkings des sites -> ok <br>';


//6. Les descriptions sur les sites d'escalade
$req = $bddNet->prepare('SELECT * FROM site_description');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_site'], $crags)){

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
echo '6. description des sites -> ok <br>';



//7. Les liens des sites
$req = $bddNet->prepare('SELECT * FROM site_lien');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_site'], $crags) && array_key_exists($data['id_user'], $users)){

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
echo '7. liens des sites -> ok <br>';


// 8 . Éxposition à la pluie
$insert = $bddOrg->query('INSERT INTO rain_exposures (label) VALUES ("éxposition à la pluie inconnu")');
$insert = $bddOrg->query('INSERT INTO rain_exposures (label) VALUES ("abrité de la pluie")');
$insert = $bddOrg->query('INSERT INTO rain_exposures (label) VALUES ("éxposé à la pluie")');
echo "8. Type d'éxposition à la pluie -> ok <br>";


// 9 . Éxposition au soleil
$insert = $bddOrg->query('INSERT INTO suns (label) VALUES ("ensoleillement inconnu")');
$insert = $bddOrg->query('INSERT INTO suns (label) VALUES ("ensoleillé toute la journée")');
$insert = $bddOrg->query('INSERT INTO suns (label) VALUES ("à l\'ombre toute la journée")');
$insert = $bddOrg->query('INSERT INTO suns (label) VALUES ("au soleil l\'après-midi")');
$insert = $bddOrg->query('INSERT INTO suns (label) VALUES ("au soleil le matin")');
echo "9. Type d'éxposition au soleil -> ok <br>";


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
echo "10' . création des secteurs manquant -> ok <br>";


// 10. Les Secteurs
$sectors = [];
$sectorSlugs = [];
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
    $sectorSlugs[$data['id']] = slugify($data['nom']);

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
echo "10. secteur, saison, orientations -> ok <br>";


// 11 . Le Lexique
$words = [];
$req = $bddNet->prepare('SELECT * FROM lexique');
$req->execute(array());
while($data = $req->fetch()){

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
    'label'=> slugify($data['nom']),
    'created_at'=>$data['date_cr'],
  ]);
}
echo '11. lexique -> ok <br>';


// 12. Les noms des types de grimpe
$insert = $bddOrg->query('INSERT INTO climbs (label) VALUES ("inconnu")'); //1
$insert = $bddOrg->query('INSERT INTO climbs (label) VALUES ("bloc")'); // 2
$insert = $bddOrg->query('INSERT INTO climbs (label) VALUES ("voie")'); // 3
$insert = $bddOrg->query('INSERT INTO climbs (label) VALUES ("grande-voie")'); // 4
$insert = $bddOrg->query('INSERT INTO climbs (label) VALUES ("trad")'); // 5
$insert = $bddOrg->query('INSERT INTO climbs (label) VALUES ("artif")'); // 6
$insert = $bddOrg->query('INSERT INTO climbs (label) VALUES ("deep-water")'); // 7
$insert = $bddOrg->query('INSERT INTO climbs (label) VALUES ("via-ferrata")'); // 8
echo '12. type de grimpe -> ok <br>';


// 12. Les types de relais
$insert = $bddOrg->query('INSERT INTO anchors (label) VALUES ("inconnu")'); // 1
$insert = $bddOrg->query('INSERT INTO anchors (label) VALUES ("relais chaîné")'); // 2
$insert = $bddOrg->query('INSERT INTO anchors (label) VALUES ("2 points non chaîné")'); // 3
$insert = $bddOrg->query('INSERT INTO anchors (label) VALUES ("tête de bélier")'); // 4
$insert = $bddOrg->query('INSERT INTO anchors (label) VALUES ("relais sur freinds")'); // 5
$insert = $bddOrg->query('INSERT INTO anchors (label) VALUES ("pas de relais")'); // 6
echo '12. type de relais -> ok <br>';


// 13. Les types de point
$insert = $bddOrg->query('INSERT INTO points (label) VALUES ("inconnu")'); // 1
$insert = $bddOrg->query('INSERT INTO points (label) VALUES ("broches")'); // 2
$insert = $bddOrg->query('INSERT INTO points (label) VALUES ("plaquettes")'); // 3
$insert = $bddOrg->query('INSERT INTO points (label) VALUES ("crochets")'); // 4
$insert = $bddOrg->query('INSERT INTO points (label) VALUES ("anneaux")'); // 5
$insert = $bddOrg->query('INSERT INTO points (label) VALUES ("pas de point")'); // 6
echo '13. type de point -> ok <br>';


//14 . Les types d'inclinaisons
$insert = $bddOrg->query('INSERT INTO inclines (label) VALUES ("inconnu")'); // 1
$insert = $bddOrg->query('INSERT INTO inclines (label) VALUES ("dalle positive")'); // 2
$insert = $bddOrg->query('INSERT INTO inclines (label) VALUES ("mur vertical")'); // 3
$insert = $bddOrg->query('INSERT INTO inclines (label) VALUES ("léger dévers")'); // 4
$insert = $bddOrg->query('INSERT INTO inclines (label) VALUES ("dévers")'); // 5
$insert = $bddOrg->query('INSERT INTO inclines (label) VALUES ("toit")'); // 6
echo '14. type inclinaison -> ok <br>';


//15 . Les types de récéptions
$insert = $bddOrg->query('INSERT INTO receptions (label) VALUES ("inconnu")'); // 1
$insert = $bddOrg->query('INSERT INTO receptions (label) VALUES ("bonne")'); // 2
$insert = $bddOrg->query('INSERT INTO receptions (label) VALUES ("correcte")'); // 3
$insert = $bddOrg->query('INSERT INTO receptions (label) VALUES ("mauvaise")'); // 4
$insert = $bddOrg->query('INSERT INTO receptions (label) VALUES ("dangeureuse")'); // 5
echo '15. type de récéption -> ok <br>';


//16. Les types de départ
$insert = $bddOrg->query('INSERT INTO starts (label) VALUES ("inconnu")'); // 1
$insert = $bddOrg->query('INSERT INTO starts (label) VALUES ("départ assis")'); // 2
$insert = $bddOrg->query('INSERT INTO starts (label) VALUES ("départ debout")'); // 3
$insert = $bddOrg->query('INSERT INTO starts (label) VALUES ("départ sauté")'); // 4
$insert = $bddOrg->query('INSERT INTO starts (label) VALUES ("run and jump")'); // 5
echo '16. type de départ -> ok <br>';


//17 . Les lignes
$routes = [];
$routeSlugs = [];
$routeSections = [];
$req = $bddNet->prepare('SELECT * FROM ligne_pr');
$req->execute(array());
while($data = $req->fetch()){

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
    $routeSlugs[$data['id']] = slugify($data['nom']);

    //Indexation pour la recherche rapide
    $insert = $bddOrg->prepare('INSERT INTO searches (searchable_id, searchable_type, label, created_at) VALUES (:searchable_id, :searchable_type, :label, :created_at)');
    $insert->execute([
      'searchable_id'=> $routes[$data['id']],
      'searchable_type'=>'App\Route',
      'label'=> slugify($data['nom']),
      'created_at'=>$data['date_cr'],
    ]);

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
echo '17. Lignes et sections -> ok <br>';



// 18. les gaps grades des falaises
$req = $bddOrg->prepare('SELECT * FROM crags');
$req->execute(array());
while($data = $req->fetch()){

  $min = 100;
  $max = 0;
  $minText = '';
  $maxText = '';
  $reqVal = $bddOrg->prepare('SELECT route_sections.grade_val AS val, route_sections.grade AS grade FROM routes INNER JOIN route_sections ON routes.id = route_sections.route_id WHERE routes.crag_id = :crag_id');
  $reqVal->execute([
    'crag_id' => $data['id']
  ]);
  while($dataRoute = $reqVal->fetch()){

    if($dataRoute['val'] < $min){
      $min = $dataRoute['val'];
      $minText = $dataRoute['grade'];
    }

    if($dataRoute['val'] > $max){
      $max = $dataRoute['val'];
      $maxText = $dataRoute['grade'];
    }
  }

  $insert = $bddOrg->prepare('
    INSERT INTO gap_grades (spreadable_id, spreadable_type, min_grade_val, max_grade_val, min_grade_text, max_grade_text, created_at)
    VALUES (:spreadable_id, :spreadable_type, :min_grade_val, :max_grade_val, :min_grade_text, :max_grade_text, :created_at)');
  $insert->execute([
    'spreadable_id' => $data['id'],
    'spreadable_type' => 'App\Crag',
    'min_grade_val' => $min,
    'max_grade_val' => $max,
    'min_grade_text' => $minText,
    'max_grade_text' => $maxText,
    'created_at' => $data['created_at'],
  ]);
}
echo '18. écart de cotation -> ok <br>';


// 18 ''. les gaps grades des secteurs
$req = $bddOrg->prepare('SELECT * FROM sectors');
$req->execute(array());
while($data = $req->fetch()){

  $min = 100;
  $max = 0;
  $minText = '';
  $maxText = '';
  $reqVal = $bddOrg->prepare('SELECT route_sections.grade_val AS val, route_sections.grade AS grade FROM routes INNER JOIN route_sections ON routes.id = route_sections.route_id WHERE routes.sector_id = :sector_id');
  $reqVal->execute([
    'sector_id' => $data['id']
  ]);
  while($dataRoute = $reqVal->fetch()){

    if($dataRoute['val'] < $min){
      $min = $dataRoute['val'];
      $minText = $dataRoute['grade'];
    }

    if($dataRoute['val'] > $max){
      $max = $dataRoute['val'];
      $maxText = $dataRoute['grade'];
    }
  }

  $insert = $bddOrg->prepare('
    INSERT INTO gap_grades (spreadable_id, spreadable_type, min_grade_val, max_grade_val, min_grade_text, max_grade_text, created_at)
    VALUES (:spreadable_id, :spreadable_type, :min_grade_val, :max_grade_val, :min_grade_text, :max_grade_text, :created_at)');
  $insert->execute([
    'spreadable_id' => $data['id'],
    'spreadable_type' => 'App\Sector',
    'min_grade_val' => $min,
    'max_grade_val' => $max,
    'min_grade_text' => $minText,
    'max_grade_text' => $maxText,
    'created_at' => $data['created_at'],
  ]);
}
echo '18 \'. écart de cotation dans un secteur -> ok <br>';

//19. Les descriptions sur les lignes
$req = $bddNet->prepare('SELECT * FROM ligne_description');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_ligne'], $routes) && array_key_exists($data['id_user'], $users)){

    $insert = $bddOrg->prepare('
      INSERT INTO descriptions (descriptive_id, descriptive_type, description, user_id, created_at)
      VALUES (:descriptive_id, :descriptive_type, :description, :user_id, :created_at)');
    $insert->execute([
      'descriptive_id'=>$routes[$data['id_ligne']],
      'descriptive_type'=>'App\Route',
      'description'=> $data['description'],
      'user_id'=>$users[$data['id_user']],
      'created_at'=>$data['date_cr'],
    ]);
  }
}
echo '19. description des lignes -> ok <br>';


//20. Les commentaires sur les lignes
$req = $bddNet->prepare('SELECT * FROM ligne_com');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_ligne'], $routes) && array_key_exists($data['id_user'], $users)){

    $insert = $bddOrg->prepare('
      INSERT INTO descriptions (descriptive_id, descriptive_type, description, user_id, created_at)
      VALUES (:descriptive_id, :descriptive_type, :description, :user_id, :created_at)');
    $insert->execute([
      'descriptive_id'=>$routes[$data['id_ligne']],
      'descriptive_type'=>'App\Route',
      'description'=> $data['commentaire'],
      'user_id'=>$users[$data['id_user']],
      'created_at'=>$data['date_cr'],
    ]);
  }
}
echo '20. commentaires des lignes -> ok <br>';


//21. Les topos
$topos = [];
$req = $bddNet->prepare('SELECT * FROM topo_pr');
$req->execute(array());
while($data = $req->fetch()){

  //on change l'id du user s'il n'existe plus
  $user_id = array_key_exists($data['id_user'], $users) ? $users[$data['id_user']] : $oblyk_id;

  //transformation de la date
  $dateCr = ($data['date_cr'] != '0000-00-00 00:00:00') ? $data['date_cr'] : date('Y-m-d H:m:s');

  $insert = $bddOrg->prepare('
    INSERT INTO topos (user_id, label, author, editor, editionYear, price, page, weight, created_at)
    VALUES (:user_id, :label, :author, :editor, :editionYear, :price, :page, :weight, :created_at)');
  $insert->execute([
    'user_id'=>$user_id,
    'label'=>$data['nom_topo'],
    'author'=>$data['auteur'],
    'editor'=>$data['editeur'],
    'editionYear'=>$data['annee_edition'],
    'price'=>$data['prix'],
    'page'=>0,
    'weight'=>0,
    'created_at'=>$dateCr,
  ]);

  $topos[$data['id']] = $bddOrg->lastInsertId();

  //copie de la couverture du topo si elle existe
  if($data['img_topo'] != ''){
    if(file_exists('../oblyk.net/img_topo/' . $data['img_topo'])){
      $splitImg = explode('.',$data['img_topo']);
      $extension = $splitImg[1];
      copy('../oblyk.net/img_topo/' . $data['img_topo'], '../oblyk.org/storage/app/public/topos/700/topo-' . $topos[$data['id']] . '.' . $extension);
    }
  }

  //Indexation pour la recherche rapide
  $insert = $bddOrg->prepare('INSERT INTO searches (searchable_id, searchable_type, label, created_at) VALUES (:searchable_id, :searchable_type, :label, :created_at)');
  $insert->execute([
    'searchable_id'=> $topos[$data['id']],
    'searchable_type'=>'App\Topo',
    'label'=> slugify($data['nom_topo']),
    'created_at' => $dateCr,
  ]);

}
echo '21. Les topos -> ok <br>';


//22. Les descriptions sur les topos
$req = $bddNet->prepare('SELECT * FROM topo_description');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_topo'], $topos) && array_key_exists($data['id_user'], $users)){

    $insert = $bddOrg->prepare('
      INSERT INTO descriptions (descriptive_id, descriptive_type, description, user_id, created_at)
      VALUES (:descriptive_id, :descriptive_type, :description, :user_id, :created_at)');
    $insert->execute([
      'descriptive_id'=>$topos[$data['id_topo']],
      'descriptive_type'=>'App\Topo',
      'description'=> $data['description'],
      'user_id'=>$users[$data['id_user']],
      'created_at'=>$data['date_cr'],
    ]);
  }
}

echo '22. description des topos -> ok <br>';



//23. Les liens des topos

$req = $bddNet->prepare('SELECT * FROM topo_lien');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_topo'], $topos)){

    $insert = $bddOrg->prepare('
      INSERT INTO links (linkable_id, linkable_type, label, link, description, user_id, created_at)
      VALUES (:linkable_id, :linkable_type, :label, :link, :description, :user_id, :created_at)');
    $insert->execute([
      'linkable_id'=>$topos[$data['id_topo']],
      'linkable_type'=>'App\Topo',
      'label'=> $data['nom'],
      'link'=> $data['href'],
      'description'=> $data['description_lien'],
      'user_id'=>$oblyk_id,
      'created_at'=>$data['date_cr'],
    ]);
  }
}
echo '23. liens des topos -> ok <br>';



//24. Liaison topo -> sites d'escalade
$req = $bddNet->prepare('SELECT * FROM topo_site');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_topo'], $topos) && array_key_exists($data['id_site'], $crags)){

    //on change l'id du user s'il n'existe plus
    $user_id = array_key_exists($data['id_user'], $users) ? $users[$data['id_user']] : $oblyk_id;

    $insert = $bddOrg->prepare('
      INSERT INTO topo_crags (user_id, topo_id, crag_id, created_at)
      VALUES (:user_id, :topo_id, :crag_id, :created_at)');
    $insert->execute([
      'user_id'=>$user_id,
      'topo_id'=>$topos[$data['id_topo']],
      'crag_id'=>$crags[$data['id_site']],
      'created_at'=>$data['date_ajout'],
    ]);
  }
}
echo '24. Liaison topos / sites -> ok <br>';


//25. Les points de vente des topos
$req = $bddNet->prepare('SELECT * FROM topo_vente');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_topo'], $topos)){

    //on change l'id du user s'il n'existe plus
    $user_id = array_key_exists($data['id_user'], $users) ? $users[$data['id_user']] : $oblyk_id;

    $insert = $bddOrg->prepare('
      INSERT INTO topo_sales (user_id, topo_id, label, description, url, lat, lng, created_at)
      VALUES (:user_id, :topo_id, :label, :description, :url, :lat, :lng, :created_at)');
    $insert->execute([
      'user_id'=>$user_id,
      'topo_id'=>$topos[$data['id_topo']],
      'label'=>$data['nom_point'],
      'description'=>$data['description'],
      'url'=>$data['lien'],
      'lat'=>$data['latitude'],
      'lng'=>$data['longitude'],
      'created_at'=>$data['date'],
    ]);
  }
}
echo '25. point de vente des topos -> ok <br>';



//25. Les massifs
$massives = [];
$req = $bddNet->prepare('SELECT * FROM massif_pr');
$req->execute(array());
while($data = $req->fetch()){

  $insert = $bddOrg->prepare('
    INSERT INTO massives (user_id, label, created_at)
    VALUES (:user_id, :label, :created_at)');
  $insert->execute([
    'user_id'=>$oblyk_id,
    'label'=>$data['nom'],
    'created_at'=> $data['date_cr'],
  ]);

  $massives[$data['id']] = $bddOrg->lastInsertId();

  //Indexation pour la recherche rapide
  $insert = $bddOrg->prepare('INSERT INTO searches (searchable_id, searchable_type, label, created_at) VALUES (:searchable_id, :searchable_type, :label, :created_at)');
  $insert->execute([
    'searchable_id'=> $massives[$data['id']],
    'searchable_type'=>'App\Massive',
    'label'=> slugify($data['nom']),
    'created_at'=>$data['date_cr'],
  ]);
}
echo '25. Les massifs -> ok <br>';



//26. Les descriptions sur les massifs
$req = $bddNet->prepare('SELECT * FROM massif_description');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_massif'], $massives) && array_key_exists($data['id_user'], $users)){

    $insert = $bddOrg->prepare('
      INSERT INTO descriptions (descriptive_id, descriptive_type, description, user_id, created_at)
      VALUES (:descriptive_id, :descriptive_type, :description, :user_id, :created_at)');
    $insert->execute([
      'descriptive_id'=>$massives[$data['id_massif']],
      'descriptive_type'=>'App\Massive',
      'description'=> $data['description'],
      'user_id'=>$users[$data['id_user']],
      'created_at'=>$data['date_cr'],
    ]);
  }
}
echo '26. description des massifs -> ok <br>';


//27. Les liens des massifs

$req = $bddNet->prepare('SELECT * FROM massif_lien');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_massif'], $massives)){

    $insert = $bddOrg->prepare('
      INSERT INTO links (linkable_id, linkable_type, label, link, description, user_id, created_at)
      VALUES (:linkable_id, :linkable_type, :label, :link, :description, :user_id, :created_at)');
    $insert->execute([
      'linkable_id'=>$massives[$data['id_massif']],
      'linkable_type'=>'App\Massive',
      'label'=> $data['nom'],
      'link'=> $data['href'],
      'description'=> $data['description_lien'],
      'user_id'=>$oblyk_id,
      'created_at'=>$data['date_cr'],
    ]);
  }
}
echo '27. liens des massifs -> ok <br>';


//28. Liaison massif -> sites d'escalade
$req = $bddNet->prepare('SELECT * FROM massif_site');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_massif'], $massives) && array_key_exists($data['id_site'], $crags)){

    $insert = $bddOrg->prepare('
      INSERT INTO massive_crags (user_id, massive_id, crag_id, created_at)
      VALUES (:user_id, :massive_id, :crag_id, :created_at)');
    $insert->execute([
      'user_id'=>$oblyk_id,
      'massive_id'=>$massives[$data['id_massif']],
      'crag_id'=>$crags[$data['id_site']],
      'created_at'=>$data['date_cr'],
    ]);
  }
}
echo '28. Liaison massif / sites -> ok <br>';


// 29. les types de liens socials
$insert = $bddOrg->query('INSERT INTO social_networks (label) VALUES ("site web")'); // 1
$insert = $bddOrg->query('INSERT INTO social_networks (label) VALUES ("facebook")'); // 2
$insert = $bddOrg->query('INSERT INTO social_networks (label) VALUES ("tiwitter")'); // 3
$insert = $bddOrg->query('INSERT INTO social_networks (label) VALUES ("google +")'); // 4
$insert = $bddOrg->query('INSERT INTO social_networks (label) VALUES ("instagramme")'); // 5
$insert = $bddOrg->query('INSERT INTO social_networks (label) VALUES ("pinterest")'); // 6
$insert = $bddOrg->query('INSERT INTO social_networks (label) VALUES ("youtube")'); // 7
$insert = $bddOrg->query('INSERT INTO social_networks (label) VALUES ("vimeo")'); // 8
$insert = $bddOrg->query('INSERT INTO social_networks (label) VALUES ("dailymotion")'); // 9
$insert = $bddOrg->query('INSERT INTO social_networks (label) VALUES ("diaspora")'); // 10
$insert = $bddOrg->query('INSERT INTO social_networks (label) VALUES ("tumblr")'); // 11
$insert = $bddOrg->query('INSERT INTO social_networks (label) VALUES ("camptocamp")'); // 12
$insert = $bddOrg->query('INSERT INTO social_networks (label) VALUES ("ilooove.it")'); // 13
$insert = $bddOrg->query('INSERT INTO social_networks (label) VALUES ("behance")'); // 14
$insert = $bddOrg->query('INSERT INTO social_networks (label) VALUES ("flickr")'); // 15
$insert = $bddOrg->query('INSERT INTO social_networks (label) VALUES ("verticall")'); // 16
echo '29. Les types de liens socials -> ok <br>';


//30 . Les liens socials des users
$req = $bddNet->prepare('SELECT * FROM usr_social');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_user'], $users)){

    //FACEBOOK
    if($data['lien_facebook'] != ''){
      $insert = $bddOrg->prepare('
        INSERT INTO user_social_networks (user_id, social_network_id, label, url, created_at)
        VALUES (:user_id, :social_network_id, :label, :url, :created_at)');
      $insert->execute([
        'user_id'=>$users[$data['id_user']],
        'social_network_id'=> 2,
        'label'=>'Facebook',
        'url'=>$data['lien_facebook'],
        'created_at'=>date('Y-m-d H:m:s'),
      ]);
    }

    //TWITTER
    if($data['lien_twitter'] != ''){
      $insert = $bddOrg->prepare('
        INSERT INTO user_social_networks (user_id, social_network_id, label, url, created_at)
        VALUES (:user_id, :social_network_id, :label, :url, :created_at)');
      $insert->execute([
        'user_id'=>$users[$data['id_user']],
        'social_network_id'=> 3,
        'label'=>'Twitter',
        'url'=>$data['lien_twitter'],
        'created_at'=>date('Y-m-d H:m:s'),
      ]);
    }

    //GOOGLE +
    if($data['lien_google_plus'] != ''){
      $insert = $bddOrg->prepare('
        INSERT INTO user_social_networks (user_id, social_network_id, label, url, created_at)
        VALUES (:user_id, :social_network_id, :label, :url, :created_at)');
      $insert->execute([
        'user_id'=>$users[$data['id_user']],
        'social_network_id'=> 4,
        'label'=>'Google +',
        'url'=>$data['lien_google_plus'],
        'created_at'=>date('Y-m-d H:m:s'),
      ]);
    }

    //INSTAGRAMME
    if($data['lien_instagramme'] != ''){
      $insert = $bddOrg->prepare('
        INSERT INTO user_social_networks (user_id, social_network_id, label, url, created_at)
        VALUES (:user_id, :social_network_id, :label, :url, :created_at)');
      $insert->execute([
        'user_id'=>$users[$data['id_user']],
        'social_network_id'=> 5,
        'label'=>'Instagramme',
        'url'=>$data['lien_instagramme'],
        'created_at'=>date('Y-m-d H:m:s'),
      ]);
    }

    //INSTAGRAMME
    if($data['lien_instagramme'] != ''){
      $insert = $bddOrg->prepare('
        INSERT INTO user_social_networks (user_id, social_network_id, label, url, created_at)
        VALUES (:user_id, :social_network_id, :label, :url, :created_at)');
      $insert->execute([
        'user_id'=>$users[$data['id_user']],
        'social_network_id'=> 5,
        'label'=>'Instagramme',
        'url'=>$data['lien_instagramme'],
        'created_at'=>date('Y-m-d H:m:s'),
      ]);
    }

    //PINTEREST
    if($data['lien_pinterest'] != ''){
      $insert = $bddOrg->prepare('
        INSERT INTO user_social_networks (user_id, social_network_id, label, url, created_at)
        VALUES (:user_id, :social_network_id, :label, :url, :created_at)');
      $insert->execute([
        'user_id'=>$users[$data['id_user']],
        'social_network_id'=> 6,
        'label'=>'Pinterest',
        'url'=>$data['lien_pinterest'],
        'created_at'=>date('Y-m-d H:m:s'),
      ]);
    }

    //YOUTUDE
    if($data['lien_youtube'] != ''){
      $insert = $bddOrg->prepare('
        INSERT INTO user_social_networks (user_id, social_network_id, label, url, created_at)
        VALUES (:user_id, :social_network_id, :label, :url, :created_at)');
      $insert->execute([
        'user_id'=>$users[$data['id_user']],
        'social_network_id'=> 7,
        'label'=>'Youtube',
        'url'=>$data['lien_youtube'],
        'created_at'=>date('Y-m-d H:m:s'),
      ]);
    }

    //VIMEO
    if($data['lien_vimeo'] != ''){
      $insert = $bddOrg->prepare('
        INSERT INTO user_social_networks (user_id, social_network_id, label, url, created_at)
        VALUES (:user_id, :social_network_id, :label, :url, :created_at)');
      $insert->execute([
        'user_id'=>$users[$data['id_user']],
        'social_network_id'=> 8,
        'label'=>'Vimeo',
        'url'=>$data['lien_vimeo'],
        'created_at'=>date('Y-m-d H:m:s'),
      ]);
    }

    //DAILYMOTION
    if($data['lien_dailymotion'] != ''){
      $insert = $bddOrg->prepare('
        INSERT INTO user_social_networks (user_id, social_network_id, label, url, created_at)
        VALUES (:user_id, :social_network_id, :label, :url, :created_at)');
      $insert->execute([
        'user_id'=>$users[$data['id_user']],
        'social_network_id'=> 9,
        'label'=>'Dailymotion',
        'url'=>$data['lien_dailymotion'],
        'created_at'=>date('Y-m-d H:m:s'),
      ]);
    }

    //DIASPORA
    if($data['lien_diaspora'] != ''){
      $insert = $bddOrg->prepare('
        INSERT INTO user_social_networks (user_id, social_network_id, label, url, created_at)
        VALUES (:user_id, :social_network_id, :label, :url, :created_at)');
      $insert->execute([
        'user_id'=>$users[$data['id_user']],
        'social_network_id'=> 10,
        'label'=>'Diaspora',
        'url'=>$data['lien_diaspora'],
        'created_at'=>date('Y-m-d H:m:s'),
      ]);
    }

    //TUMBLR
    if($data['lien_tumblr'] != ''){
      $insert = $bddOrg->prepare('
        INSERT INTO user_social_networks (user_id, social_network_id, label, url, created_at)
        VALUES (:user_id, :social_network_id, :label, :url, :created_at)');
      $insert->execute([
        'user_id'=>$users[$data['id_user']],
        'social_network_id'=> 11,
        'label'=>'Tumblr',
        'url'=>$data['lien_tumblr'],
        'created_at'=>date('Y-m-d H:m:s'),
      ]);
    }

    //CAMPTOCAMP
    if($data['lien_camptocamp'] != ''){
      $insert = $bddOrg->prepare('
        INSERT INTO user_social_networks (user_id, social_network_id, label, url, created_at)
        VALUES (:user_id, :social_network_id, :label, :url, :created_at)');
      $insert->execute([
        'user_id'=>$users[$data['id_user']],
        'social_network_id'=> 12,
        'label'=>'Camptocamp',
        'url'=>$data['lien_camptocamp'],
        'created_at'=>date('Y-m-d H:m:s'),
      ]);
    }

    //ILOOOVE.IT
    if($data['lien_love_climbing'] != ''){
      $insert = $bddOrg->prepare('
        INSERT INTO user_social_networks (user_id, social_network_id, label, url, created_at)
        VALUES (:user_id, :social_network_id, :label, :url, :created_at)');
      $insert->execute([
        'user_id'=>$users[$data['id_user']],
        'social_network_id'=> 13,
        'label'=>'Ilooove.it',
        'url'=>$data['lien_love_climbing'],
        'created_at'=>date('Y-m-d H:m:s'),
      ]);
    }

    //BEHANCE
    if($data['lien_behance'] != ''){
      $insert = $bddOrg->prepare('
        INSERT INTO user_social_networks (user_id, social_network_id, label, url, created_at)
        VALUES (:user_id, :social_network_id, :label, :url, :created_at)');
      $insert->execute([
        'user_id'=>$users[$data['id_user']],
        'social_network_id'=> 14,
        'label'=>'Behance',
        'url'=>$data['lien_behance'],
        'created_at'=>date('Y-m-d H:m:s'),
      ]);
    }

    //FLICKR
    if($data['lien_flickr'] != ''){
      $insert = $bddOrg->prepare('
        INSERT INTO user_social_networks (user_id, social_network_id, label, url, created_at)
        VALUES (:user_id, :social_network_id, :label, :url, :created_at)');
      $insert->execute([
        'user_id'=>$users[$data['id_user']],
        'social_network_id'=> 15,
        'label'=>'Flickr',
        'url'=>$data['lien_flickr'],
        'created_at'=>date('Y-m-d H:m:s'),
      ]);
    }

    //VERTICALL
    if($data['lien_verticall'] != ''){
      $insert = $bddOrg->prepare('
        INSERT INTO user_social_networks (user_id, social_network_id, label, url, created_at)
        VALUES (:user_id, :social_network_id, :label, :url, :created_at)');
      $insert->execute([
        'user_id'=>$users[$data['id_user']],
        'social_network_id'=> 16,
        'label'=>'Verticall',
        'url'=>$data['lien_verticall'],
        'created_at'=>date('Y-m-d H:m:s'),
      ]);
    }
  }
}
echo '30. Liaison social -> ok <br>';


//31. Les conversations
$conversations = [];
$req = $bddNet->prepare('SELECT * FROM conversation_pr');
$req->execute(array());
while($data = $req->fetch()){

  $insert = $bddOrg->prepare('
    INSERT INTO conversations (label, created_at)
    VALUES (:label, :created_at)');
  $insert->execute([
    'label'=>'',
    'created_at'=>$data['date_p_msg'],
  ]);

  $conversations[$data['id']] = $bddOrg->lastInsertId();

}
echo '31. Les conversations -> ok <br>';


//32. Les users dans la conversation
$req = $bddNet->prepare('SELECT * FROM conversation_user');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_user'], $users) && array_key_exists($data['id_conversation'], $conversations)){

    $newMessages = $data['lu'] == 1 ? 0 : 1;

    $insert = $bddOrg->prepare('
      INSERT INTO user_conversations (user_id, conversation_id, new_messages, created_at)
      VALUES (:user_id, :conversation_id, :new_messages, :created_at)');
    $insert->execute([
      'user_id' => $users[$data['id_user']],
      'conversation_id' => $conversations[$data['id_conversation']],
      'new_messages' => $newMessages,
      'created_at' => date('Y-m-d H:m:s'),
    ]);
  }
}
echo '32. Les users de la conversation -> ok <br>';


//33. Les messages d'un user dans une conversation
$req = $bddNet->prepare('SELECT * FROM conversation_message');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_user'], $users) && array_key_exists($data['id_conversation'], $conversations)){

    $insert = $bddOrg->prepare('
      INSERT INTO messages (user_id, conversation_id, message, created_at)
      VALUES (:user_id, :conversation_id, :message, :created_at)');
    $insert->execute([
      'user_id' => $users[$data['id_user']],
      'conversation_id' => $conversations[$data['id_conversation']],
      'message' => $data['message'],
      'created_at' => $data['date_poste'],
    ]);
  }
}
echo '33. Les messages users de la conversation -> ok <br>';

//34. Les salles d'escalades
$gyms = [];
$req = $bddNet->prepare('SELECT * FROM sae_pr');
$req->execute(array());
while($data = $req->fetch()){

  $insert = $bddOrg->prepare('
    INSERT INTO gyms (user_id, label, description, type_boulder, type_route, free, address, postal_code, code_country, country, city, big_city, region, lat, lng, email, phone_number, web_site, created_at)
    VALUES (:user_id, :label, :description, :type_boulder, :type_route, :free, :address, :postal_code, :code_country, :country, :city, :big_city, :region, :lat, :lng, :email, :phone_number, :web_site, :created_at)');
  $insert->execute([
    'user_id' => $oblyk_id,
    'label' => $data['nom'],
    'description' => $data['intro'],
    'type_boulder' => 0,
    'type_route' => 0,
    'free' => 1,
    'address' => $data['adresse'],
    'postal_code' => $data['code_postal'],
    'code_country' => $data['pays'],
    'country' => $data['pays'],
    'city' => $data['ville'],
    'big_city' => $data['grande_ville'],
    'region' => $data['departement'],
    'lat' => $data['latitude'],
    'lng' => $data['longitude'],
    'email' => $data['mail'],
    'phone_number' => $data['telephone'],
    'web_site' => $data['site_internet'],
    'created_at' => date('Y-m-d H:m:s'),
  ]);

  $gyms[$data['id']] = $bddOrg->lastInsertId();

  //copie du logo s'il existe
  if($data['img_logo'] != ''){
    if(file_exists('../oblyk.net/img_sae/img_logo/' . $data['img_logo'])){
      $splitImg = explode('.',$data['img_logo']);
      $extension = $splitImg[1];
      copy('../oblyk.net/img_sae/img_logo/' . $data['img_logo'], '../oblyk.org/storage/app/public/gyms/100/logo-' . $gyms[$data['id']] . '.' . $extension);
    }
  }

  //copie du bandeau s'il existe
  if($data['img_bandeau'] != ''){
    if(file_exists('../oblyk.net/img_sae/img_bandeau/' . $data['img_bandeau'])){
      $splitImg = explode('.',$data['img_bandeau']);
      $extension = $splitImg[1];
      copy('../oblyk.net/img_sae/img_bandeau/' . $data['img_bandeau'], '../oblyk.org/storage/app/public/gyms/1300/bandeau-' . $gyms[$data['id']] . '.' . $extension);
    }
  }

  //Indexation pour la recherche rapide
  $insert = $bddOrg->prepare('INSERT INTO searches (searchable_id, searchable_type, label, created_at) VALUES (:searchable_id, :searchable_type, :label, :created_at)');
  $insert->execute([
    'searchable_id' => $gyms[$data['id']],
    'searchable_type' => 'App\Gym',
    'label' => slugify($data['nom']),
    'created_at' => date('Y-m-d H:m:s'),
  ]);

}
echo '34. Les salles d\'escalade -> ok <br>';

// 35. les types de grande catégorie
$insert = $bddOrg->query('INSERT INTO forum_general_categories (label) VALUES ("Communauté")'); // 1
$insert = $bddOrg->query('INSERT INTO forum_general_categories (label) VALUES ("Oblyk")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_general_categories (label) VALUES ("Matos")'); // 3
$insert = $bddOrg->query('INSERT INTO forum_general_categories (label) VALUES ("Escalade")'); // 4
$insert = $bddOrg->query('INSERT INTO forum_general_categories (label) VALUES ("Entraînement")'); // 5
$insert = $bddOrg->query('INSERT INTO forum_general_categories (label) VALUES ("Actus - Évènements")'); // 6
$insert = $bddOrg->query('INSERT INTO forum_general_categories (label) VALUES ("Topos")'); // 7
echo '35. Les grandes catégories du forum -> ok <br>';

// 36. Les sous catégorie du forum
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (1,"Résumé de trip, histoires","Envie de partager une histoire, une anecdote, de faire un retour sur un trip grimpe (photos, vidéos, etc.) ?")'); // 1
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (1,"Recherche de partenaires","Tu cherches quelqu\'un pour grimper dans une salle ou en falaise, ou même pour un trip? C\'est ici !")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (1,"Zone d\'expression libre","Ici, tu peux parler de tout et de rien !")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (1,"Organiser une sortie grimpe","Besoin de trouver un co-voiturage, ou de se faire prêter du matos? Tout ce qui concerne l\'organisation d\'une sortie à plusieurs.")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (1,"Photos / Vidéos : conseils et matos","Pour ceux qui ont besoin de conseils pour prendre de belles images de grimpe, pour choisir le matos, etc.")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (2,"Boîte à idées","Tu as des idées d\'amélioration pour Oblyk, ou des remarques ? C\'est ici que ça se passe !")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (2,"Bugs","Si tu as relevé un bug sur le site, n\'hésite pas à le poster ici. On n\'est pas des machines et on peut faire des erreurs !")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (2,"Traduction","Si tu as remarqué des erreurs sur la traduction anglaise, ou si tu es motivé pour proposer une traduction du site dans une autre langue ! ; )")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (2,"Articles","Lancer une discussion, ou réagir à un article publié sur Oblyk, tout est permis !")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (3,"Chaussons","Voir les avis sur une marque ou un modèle de chaussons, ou partager ses expériences, et ses attentes.")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (3,"Baudrier, corde, casque","Voir les avis sur une marque ou un modèle de baudrier, corde ou casque, et partager ses expériences, et ses attentes.")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (3,"Quincaillerie : mousquetons, dégaines, etc.","Voir les avis sur une marque ou un modèle de mousquetons, dégaines, etc., et partager ses expériences, et ses attentes.")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (4,"Informations / Réglementation sites d\'escalade","Tu cherches des informations sur un site ou la réglementation pour y pratiquer l\'escalade ? C\'est ici que ça se passe.")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (4,"Voie","Tu recherches des informations sur une voie en particulier, ou tu veux partager ton expérience ? C\'est ici que ça se passe !")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (4,"Grande voie / Trad","Ici, tu peux raconter ton expérience dans une grande voie (ou trad), ou demander des informations plus spécifiques.")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (4,"Résine et salles","Tout ce qui concerne les salles d\'escalade.")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (4,"Club","Envie de parler d\'un club en particulier, de promouvoir un évènement organisé par un club, ou même de rechercher des bénévoles ? C\'est par ici !")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (4,"Bloc","Ici, on peut parler de tout ce qui relève de l\'univers du bloc !")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (4,"Deep water","Deep water, psicobloc, bref tout ce qui concerne la grimpe au dessus de l\'eau.")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (4,"Urban climbing","L\'espace dédié à l\'urban climbing ! Là où on peut en faire, les bons spots, etc.")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (5,"Diététique","Ici, tu peux partager tout ce qui concerne la diététique à adopter pour l\'escalade : conseils, recettes, idées, ou questions.")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (5,"Entraînement spécifique","Des conseils ou des questions concernant les exercices spécifiques pour s\'entraîner ? Pan güllich, poutre, etc., c\'est ici que ça se passe. Bref, l\'espace des masos ! ; )")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (5,"Conseils pour progresser","Si tu débutes, ou que tu cherches à progresser en escalade, tu peux poser tes questions ici.")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (5,"Planification","Un espace pour parler de tout ce qui touche, de près ou de loin, à la planification d\'entraînement en escalade.")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (5,"Blessures","Pour partager des expériences sur certaines blessures, et donner des conseils de prévention pour éviter qu\'elle surviennent.")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (6,"Évènements","Pour connaître les prochains évènements qui concernent l\'escalade (compétitions, contests, rassemblements, etc.), ou autre.")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (6,"Les news de la grimpe","Ici, tu peux discuter ou réagir sur les dernières news du monde de la grimpe.")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (7,"Nouveau topo","Si un topo vient de sortir, tu peux en parler ici pour informer les autres grimpeurs qu\'il est disponible.")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (7,"Recherche de topo","Si tu recherches un topo et que tu n\'arrives pas à le trouver, tu peux consulter cette partie du forum.")'); // 2
$insert = $bddOrg->query('INSERT INTO forum_categories (general_category_id, label, description) VALUES (7,"Discussions topos","Un espace de discussion libre où on peut parler de tout ce qui concerne les topos (papier, numérique, etc.).")'); // 2
echo '36. Les sous catégories du forum -> ok <br>';



//37. Les sujets du forum
$topics = [];
$req = $bddNet->prepare('SELECT * FROM forum_sujet');
$req->execute(array());
while($data = $req->fetch()){

  //transformation de la date
  $dateLastPost = ($data['date_d_poste'] != '0000-00-00 00:00:00') ? $data['date_d_poste'] : date('Y-m-d H:m:s');

  if (array_key_exists($data['id_user'], $users)){
    $insert = $bddOrg->prepare('
      INSERT INTO forum_topics (category_id, user_id, label, nb_post, last_post, created_at)
      VALUES (:category_id, :user_id, :label, :nb_post, :last_post, :created_at)');
    $insert->execute([
      'category_id'=>$data['categorie'],
      'user_id'=>$users[$data['id_user']],
      'label'=>$data['titre_sujet'],
      'nb_post'=>$data['nb_poste'],
      'last_post'=>$dateLastPost,
      'created_at'=>$data['date_cr'],
    ]);

    $topics[$data['id']] = $bddOrg->lastInsertId();

    //Indexation pour la recherche rapide
    $insert = $bddOrg->prepare('INSERT INTO searches (searchable_id, searchable_type, label, created_at) VALUES (:searchable_id, :searchable_type, :label, :created_at)');
    $insert->execute([
      'searchable_id'=> $topics[$data['id']],
      'searchable_type'=>'App\ForumTopic',
      'label'=> slugify($data['titre_sujet']),
      'created_at'=>$data['date_cr'],
    ]);
  }
}
echo '37. les sujets du forum -> ok <br>';



//38. la ticklist
$req = $bddNet->prepare('SELECT * FROM usr_ticklist');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_user'], $users) && array_key_exists($data['id_ligne'], $routes)){
    $insert = $bddOrg->prepare('
      INSERT INTO tick_lists (user_id, route_id, created_at)
      VALUES (:user_id, :route_id, :created_at)');
    $insert->execute([
      'user_id'=>$users[$data['id_user']],
      'route_id'=>$routes[$data['id_ligne']],
      'created_at'=>$data['date_ticklist'],
    ]);
  }
}
echo '38. La ticklist -> ok <br>';


// 39. les types d'encordement
$insert = $bddOrg->query('INSERT INTO cross_modes (label) VALUES ("tête")'); // 1
$insert = $bddOrg->query('INSERT INTO cross_modes (label) VALUES ("moulinette")'); // 1
$insert = $bddOrg->query('INSERT INTO cross_modes (label) VALUES ("leader")'); // 1
$insert = $bddOrg->query('INSERT INTO cross_modes (label) VALUES ("second")'); // 1
$insert = $bddOrg->query('INSERT INTO cross_modes (label) VALUES ("réversible")'); // 1
echo '39. Mode d\'encordement -> ok <br>';

// 40. la difficulté de la ligne
$insert = $bddOrg->query('INSERT INTO cross_hardnesses (label) VALUES ("pas d\'avis")'); // 1
$insert = $bddOrg->query('INSERT INTO cross_hardnesses (label) VALUES ("facile pour la cotation")'); // 1
$insert = $bddOrg->query('INSERT INTO cross_hardnesses (label) VALUES ("juste, bien coté")'); // 1
$insert = $bddOrg->query('INSERT INTO cross_hardnesses (label) VALUES ("dur pour la cotation")'); // 1
echo '40. La difficulté -> ok <br>';

// 41. les status
$insert = $bddOrg->query('INSERT INTO cross_statuses (label) VALUES ("projet")'); // 1
$insert = $bddOrg->query('INSERT INTO cross_statuses (label) VALUES ("terminé")'); // 1
$insert = $bddOrg->query('INSERT INTO cross_statuses (label) VALUES ("après travail")'); // 1
$insert = $bddOrg->query('INSERT INTO cross_statuses (label) VALUES ("flash")'); // 1
$insert = $bddOrg->query('INSERT INTO cross_statuses (label) VALUES ("à vue")'); // 1
$insert = $bddOrg->query('INSERT INTO cross_statuses (label) VALUES ("répétition")'); // 1
echo '41. Le status -> ok <br>';

//42. Les croix
$crosses = [];
$req = $bddNet->prepare('SELECT * FROM usr_cc');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_user'], $users) && array_key_exists($data['id_ligne'], $routes)){


    $hardness = 1;
    if($data['cotation_user'] == 0) $hardness = 1;
    if($data['cotation_user'] == 1) $hardness = 3;
    if($data['cotation_user'] == 2) $hardness = 2;
    if($data['cotation_user'] == 3) $hardness = 4;

    //transformation de la date
    $dateCroix = ($data['date_croix'] != '0000-00-00 00:00:00') ? $data['date_croix'] : date('Y-m-d H:m:s');

    $insert = $bddOrg->prepare('
      INSERT INTO crosses (route_id, user_id, status_id, mode_id, hardness_id, environment, release_at, created_at)
      VALUES (:route_id, :user_id, :status_id, :mode_id, :hardness_id, :environment, :release_at, :created_at)');
    $insert->execute([
      'route_id'=>$routes[$data['id_ligne']],
      'user_id'=>$users[$data['id_user']],
      'status_id'=>$data['status'] + 1,
      'mode_id'=>$data['mode'] + 1,
      'hardness_id'=>$hardness,
      'environment'=>0,
      'release_at'=>$dateCroix,
      'created_at'=>$dateCroix,
    ]);

    $crosses[$data['id']] = $bddOrg->lastInsertId();

    //s'il y a un commentaire sur cette croix
    if($data['text_libre'] != ''){

      $insert = $bddOrg->prepare('
        INSERT INTO descriptions (descriptive_id, descriptive_type, description, user_id, note, cross_id, created_at)
        VALUES (:descriptive_id, :descriptive_type, :description, :user_id, :note, :cross_id, :created_at)');
      $insert->execute([
        'descriptive_id'=>$routes[$data['id_ligne']],
        'descriptive_type'=>'App\Route',
        'description'=> $data['text_libre'],
        'user_id'=>$users[$data['id_user']],
        'note'=>$data['note'],
        'cross_id'=>$crosses[$data['id']],
        'created_at'=>$dateCroix,
      ]);

    }
  }
}
echo '42. Les croix -> ok <br>';

// 43. Les sections des croix
$req = $bddOrg->prepare('SELECT * FROM crosses');
$req->execute(array());
while($data = $req->fetch()){

  $reqRoute = $bddOrg->prepare('SELECT * FROM route_sections where route_id = :route_id');
  $reqRoute->execute([
    'route_id'=>$data['route_id']
  ]);
  while($dataRoute = $reqRoute->fetch()){
    $insert = $bddOrg->prepare('
      INSERT INTO cross_sections (cross_id, route_section_id, created_at)
      VALUES (:cross_id, :route_section_id, :created_at)');
    $insert->execute([
      'cross_id'=>$data['id'],
      'route_section_id'=>$dataRoute['id'],
      'created_at'=>$data['release_at'],
    ]);
  }
}
echo '43. Les sections des croix -> ok <br>';



//44. Les lieux de grimpe (PARTENAIRE)
$req = $bddNet->prepare('SELECT * FROM usr_climbing_zone');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_user'], $users)){

    //limite à 40 Km
    $rayon = ($data['rayon'] > 40) ? 40 : $data['rayon'];

    $insert = $bddOrg->prepare('
      INSERT INTO user_places (user_id, lat, lng, rayon, label, description, active, created_at)
      VALUES (:user_id, :lat, :lng, :rayon, :label, :description, :active, :created_at)');
    $insert->execute([
      'user_id'=>$users[$data['id_user']],
      'lat'=>$data['latitude'],
      'lng'=>$data['longitude'],
      'rayon'=>$rayon,
      'label'=>$data['titre_lieu'],
      'description'=>'',
      'active'=>$data['active_zone'],
      'created_at'=> date('Y-m-d H:m:s'),
    ]);
  }
}
echo '44. Les lieux des grimpeurs -> ok <br>';


//45. Following des falaises
$req = $bddNet->prepare('SELECT * FROM site_follow');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_user'], $users) && array_key_exists($data['id_site'], $crags)){
    $insert = $bddOrg->prepare('
      INSERT INTO follows (followed_id, followed_type, user_id, created_at)
      VALUES (:followed_id, :followed_type, :user_id, :created_at)');
    $insert->execute([
      'followed_id'=>$crags[$data['id_site']],
      'followed_type'=>'App\Crag',
      'user_id'=>$users[$data['id_user']],
      'created_at'=> $data['date_follow'],
    ]);
  }
}
echo '45. Following des falaises -> ok <br>';


//46. Following des topos
$req = $bddNet->prepare('SELECT * FROM topo_follow');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_user'], $users) && array_key_exists($data['id_topo'], $topos)){
    $insert = $bddOrg->prepare('
      INSERT INTO follows (followed_id, followed_type, user_id, created_at)
      VALUES (:followed_id, :followed_type, :user_id, :created_at)');
    $insert->execute([
      'followed_id'=>$topos[$data['id_topo']],
      'followed_type'=>'App\Topo',
      'user_id'=>$users[$data['id_user']],
      'created_at'=> $data['date_follow'],
    ]);
  }
}
echo '46. Following des topos -> ok <br>';


//46. Following des massif
$req = $bddNet->prepare('SELECT * FROM massif_follow');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_user'], $users) && array_key_exists($data['id_massif'], $massives)){
    $insert = $bddOrg->prepare('
      INSERT INTO follows (followed_id, followed_type, user_id, created_at)
      VALUES (:followed_id, :followed_type, :user_id, :created_at)');
    $insert->execute([
      'followed_id'=>$massives[$data['id_massif']],
      'followed_type'=>'App\Massive',
      'user_id'=>$users[$data['id_user']],
      'created_at'=> $data['date_follow'],
    ]);
  }
}
echo '46. Following des massifs -> ok <br>';


//47. Following des salles de grimpe
$req = $bddNet->prepare('SELECT * FROM sae_follow');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_user'], $users) && array_key_exists($data['id_sae'], $gyms)){
    $insert = $bddOrg->prepare('
      INSERT INTO follows (followed_id, followed_type, user_id, created_at)
      VALUES (:followed_id, :followed_type, :user_id, :created_at)');
    $insert->execute([
      'followed_id'=>$gyms[$data['id_sae']],
      'followed_type'=>'App\Gym',
      'user_id'=>$users[$data['id_user']],
      'created_at'=> $data['date_follow'],
    ]);
  }
}
echo '47. Following des salles -> ok <br>';


//48. Following des topics du forum
$req = $bddNet->prepare('SELECT * FROM forum_suivi');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_user'], $users) && array_key_exists($data['id_sujet'], $topics)){
    $insert = $bddOrg->prepare('
      INSERT INTO follows (followed_id, followed_type, user_id, created_at)
      VALUES (:followed_id, :followed_type, :user_id, :created_at)');
    $insert->execute([
      'followed_id'=>$topics[$data['id_sujet']],
      'followed_type'=>'App\ForumTopic',
      'user_id'=>$users[$data['id_user']],
      'created_at'=> $data['date_suivi'],
    ]);
  }
}
echo '48. Following des topics -> ok <br>';



//49. Les relations d'amitié
$req = $bddNet->prepare('SELECT * FROM usr_relation');
$req->execute(array());
while($data = $req->fetch()){

  if (array_key_exists($data['id_user_demande'], $users) && array_key_exists($data['id_user_cible'], $users)){
    $insert = $bddOrg->prepare('
      INSERT INTO follows (followed_id, followed_type, user_id, created_at)
      VALUES (:followed_id, :followed_type, :user_id, :created_at)');
    $insert->execute([
      'followed_id'=>$users[$data['id_user_cible']],
      'followed_type'=>'App\User',
      'user_id'=>$users[$data['id_user_demande']],
      'created_at'=> $data['date_demande'],
    ]);

    if($data['accept'] == 1) {

      $insert = $bddOrg->prepare('
        INSERT INTO follows (followed_id, followed_type, user_id, created_at)
        VALUES (:followed_id, :followed_type, :user_id, :created_at)');
      $insert->execute([
        'followed_id'=>$users[$data['id_user_demande']],
        'followed_type'=>'App\User',
        'user_id'=>$users[$data['id_user_cible']],
        'created_at'=> $data['date_accept'],
      ]);

    }
  }
}
echo '49. Les relations user / user -> ok <br>';



//50. Les posts dans le flux de premier niveau
$posts = [];
$req = $bddNet->prepare('SELECT * FROM flux WHERE id_reponse = 0');
$req->execute(array());
while($data = $req->fetch()){

  // TYPE 1 - SAE
  if($data['type_sujet'] == 1){
    if(array_key_exists($data['id_sujet'], $gyms) && array_key_exists($data['id_redacteur'], $users)){
      $insert = $bddOrg->prepare('
        INSERT INTO posts (postable_id, postable_type, user_id, content, created_at)
        VALUES (:postable_id, :postable_type, :user_id, :content, :created_at)');
      $insert->execute([
        'postable_id'=>$gyms[$data['id_sujet']],
        'postable_type'=>'App\Gym',
        'user_id'=>$users[$data['id_redacteur']],
        'content'=> Markdown($data['text_flux']),
        'created_at'=> $data['date_cr'],
      ]);

      $posts[$data['id']] = $bddOrg->lastInsertId();
    }
  }


  // TYPE 2 - USER
  if($data['type_sujet'] == 2){
    if(array_key_exists($data['id_sujet'], $users) && array_key_exists($data['id_redacteur'], $users)){
      $insert = $bddOrg->prepare('
        INSERT INTO posts (postable_id, postable_type, user_id, content, created_at)
        VALUES (:postable_id, :postable_type, :user_id, :content, :created_at)');
      $insert->execute([
        'postable_id'=>$users[$data['id_sujet']],
        'postable_type'=>'App\User',
        'user_id'=>$users[$data['id_redacteur']],
        'content'=> Markdown($data['text_flux']),
        'created_at'=> $data['date_cr'],
      ]);
      $posts[$data['id']] = $bddOrg->lastInsertId();
    }
  }

  // TYPE 3 - TOPO
  if($data['type_sujet'] == 3){
    if(array_key_exists($data['id_sujet'], $topos) && array_key_exists($data['id_redacteur'], $users)){
      $insert = $bddOrg->prepare('
        INSERT INTO posts (postable_id, postable_type, user_id, content, created_at)
        VALUES (:postable_id, :postable_type, :user_id, :content, :created_at)');
      $insert->execute([
        'postable_id'=>$topos[$data['id_sujet']],
        'postable_type'=>'App\Topo',
        'user_id'=>$users[$data['id_redacteur']],
        'content'=> Markdown($data['text_flux']),
        'created_at'=> $data['date_cr'],
      ]);
      $posts[$data['id']] = $bddOrg->lastInsertId();
    }
  }


  // TYPE 4 - MASSIF
  if($data['type_sujet'] == 4){
    if(array_key_exists($data['id_sujet'], $massives) && array_key_exists($data['id_redacteur'], $users)){
      $insert = $bddOrg->prepare('
        INSERT INTO posts (postable_id, postable_type, user_id, content, created_at)
        VALUES (:postable_id, :postable_type, :user_id, :content, :created_at)');
      $insert->execute([
        'postable_id'=>$massives[$data['id_sujet']],
        'postable_type'=>'App\Massive',
        'user_id'=>$users[$data['id_redacteur']],
        'content'=> Markdown($data['text_flux']),
        'created_at'=> $data['date_cr'],
      ]);
      $posts[$data['id']] = $bddOrg->lastInsertId();
    }
  }

  // TYPE 5 - SITE
  if($data['type_sujet'] == 5){
    if(array_key_exists($data['id_sujet'], $crags) && array_key_exists($data['id_redacteur'], $users)){
      $insert = $bddOrg->prepare('
        INSERT INTO posts (postable_id, postable_type, user_id, content, created_at)
        VALUES (:postable_id, :postable_type, :user_id, :content, :created_at)');
      $insert->execute([
        'postable_id'=>$crags[$data['id_sujet']],
        'postable_type'=>'App\Crag',
        'user_id'=>$users[$data['id_redacteur']],
        'content'=> Markdown($data['text_flux']),
        'created_at'=> $data['date_cr'],
      ]);
      $posts[$data['id']] = $bddOrg->lastInsertId();
    }
  }
}
echo '50. Posts de niveau 1 -> ok <br>';


//51. Converstion des messages dans le forum en post de niveau 1
$req = $bddNet->prepare('SELECT * FROM forum_poste');
$req->execute(array());
while($data = $req->fetch()){

  if(array_key_exists($data['id_sujet'], $topics) && array_key_exists($data['id_user'], $users)){
    $insert = $bddOrg->prepare('
      INSERT INTO posts (postable_id, postable_type, user_id, content, created_at)
      VALUES (:postable_id, :postable_type, :user_id, :content, :created_at)');
    $insert->execute([
      'postable_id'=>$topics[$data['id_sujet']],
      'postable_type'=>'App\ForumTopic',
      'user_id'=>$users[$data['id_user']],
      'content'=> Markdown($data['text_poste']),
      'created_at'=> $data['date_poste'],
    ]);
  }
}
echo '51. Sujet forum en post flux -> ok <br>';



// 52. Les posts dans le flux de second niveau
$comments = [];
$req = $bddNet->prepare('SELECT * FROM flux WHERE id_reponse != 0');
$req->execute(array());
while($data = $req->fetch()){

  //si c'est un commentaire sur un post
  if(array_key_exists($data['id_reponse'], $posts)){

    if(array_key_exists($data['id_redacteur'], $users)){
      $insert = $bddOrg->prepare('
        INSERT INTO comments (commentable_id, commentable_type, comment, user_id, created_at)
        VALUES (:commentable_id, :commentable_type, :comment, :user_id, :created_at)');
      $insert->execute([
        'commentable_id'=>$posts[$data['id_reponse']],
        'commentable_type'=>'App\Post',
        'comment'=> $data['text_flux'],
        'user_id'=>$users[$data['id_redacteur']],
        'created_at'=> $data['date_cr'],
      ]);

      $comments[$data['id']] = $bddOrg->lastInsertId();
    }

  }else{

    //si c'est un commentaire sur un commentaire
    if(array_key_exists($data['id_reponse'], $comments)){
      if(array_key_exists($data['id_redacteur'], $users)){
        $insert = $bddOrg->prepare('
          INSERT INTO comments (commentable_id, commentable_type, comment, user_id, created_at)
          VALUES (:commentable_id, :commentable_type, :comment, :user_id, :created_at)');
        $insert->execute([
          'commentable_id'=>$comments[$data['id_reponse']],
          'commentable_type'=>'App\Comment',
          'comment'=> $data['text_flux'],
          'user_id'=>$users[$data['id_redacteur']],
          'created_at'=> $data['date_cr'],
        ]);

        $comments[$data['id']] = $bddOrg->lastInsertId();
      }
    }
  }
}
echo '52. Les commentaires de seconds niveaux -> ok <br>';


//53. Les vidéo sur les sites d'escalades
$req = $bddNet->prepare('SELECT * FROM site_video');
$req->execute(array());
while($data = $req->fetch()){

  if(array_key_exists($data['id_site'], $crags)){

    //on change l'id du user s'il n'existe plus
    $user_id = array_key_exists($data['id_user'], $users) ? $users[$data['id_user']] : $oblyk_id;

    $insert = $bddOrg->prepare('
      INSERT INTO videos (user_id, viewable_id, viewable_type, iframe, description, created_at)
      VALUES (:user_id, :viewable_id, :viewable_type, :iframe, :description, :created_at)');
    $insert->execute([
      'user_id'=>$user_id,
      'viewable_id'=>$crags[$data['id_site']],
      'viewable_type'=>'App\Crag',
      'iframe'=> $data['href_video'],
      'description'=> $data['description'],
      'created_at'=> $data['date_cr'],
    ]);
  }
}
echo '53. Les vidéos sur les sites d\'escalade -> ok <br>';



//54. Les vidéo sur les lignes
$req = $bddNet->prepare('SELECT * FROM ligne_video');
$req->execute(array());
while($data = $req->fetch()){

  if(array_key_exists($data['id_ligne'], $routes)){

    //on change l'id du user s'il n'existe plus
    $user_id = array_key_exists($data['id_user'], $users) ? $users[$data['id_user']] : $oblyk_id;

    $insert = $bddOrg->prepare('
      INSERT INTO videos (user_id, viewable_id, viewable_type, iframe, description, created_at)
      VALUES (:user_id, :viewable_id, :viewable_type, :iframe, :description, :created_at)');
    $insert->execute([
      'user_id'=>$user_id,
      'viewable_id'=>$routes[$data['id_ligne']],
      'viewable_type'=>'App\Route',
      'iframe'=> $data['href_video'],
      'description'=> $data['description'],
      'created_at'=> $data['date_cr'],
    ]);
  }
}
echo '54. Les vidéos sur les lignes -> ok <br>';



//55. Les vidéo sur les Salle
$req = $bddNet->prepare('SELECT * FROM sae_video');
$req->execute(array());
while($data = $req->fetch()){

  if(array_key_exists($data['id_sae'], $gyms)){

    $insert = $bddOrg->prepare('
      INSERT INTO videos (user_id, viewable_id, viewable_type, iframe, description, created_at)
      VALUES (:user_id, :viewable_id, :viewable_type, :iframe, :description, :created_at)');
    $insert->execute([
      'user_id'=>$oblyk_id,
      'viewable_id'=>$gyms[$data['id_sae']],
      'viewable_type'=>'App\Gym',
      'iframe'=> $data['href_video'],
      'description'=> $data['legende'],
      'created_at'=> $data['date_cr'],
    ]);
  }
}
echo '55. Les vidéos sur les salles -> ok <br>';


//56. Les photos
$photos = [];
$req = $bddNet->prepare('SELECT * FROM photo');
$req->execute(array());
while($data = $req->fetch()){

  //Photo sur les sites
  if($data['type_source'] == 'site'){
    if(array_key_exists($data['id_source'], $crags)){
      if(file_exists('../oblyk.net/photo/site/' . $data['href_photo'])){

        //on change l'id du user s'il n'existe plus
        $user_id = array_key_exists($data['id_user'], $users) ? $users[$data['id_user']] : $oblyk_id;

        //On enregistre la photo en table (avec un nom temporaire)
        $insert = $bddOrg->prepare('
          INSERT INTO photos (illustrable_id, illustrable_type, slug_label, user_id, album_id, description, created_at)
          VALUES (:illustrable_id, :illustrable_type, :slug_label, :user_id, :album_id, :description, :created_at)');
        $insert->execute([
          'illustrable_id'=>$crags[$data['id_source']],
          'illustrable_type'=>'App\Crag',
          'slug_label'=>'temp-slug',
          'user_id'=>$user_id,
          'album_id'=>$albums[$data['id_user_album']],
          'description'=> $data['legende'],
          'created_at'=> $data['date_cr'],
        ]);

        $photos[$data['id']] = $bddOrg->lastInsertId();

        // on copie le fichier
        $splitImg = explode('.', $data['href_photo']);
        $extension = $splitImg[1];
        $imgName = $cragSlugs[$data['id_source']] . '-' . $photos[$data['id']] . '.' . $extension;
        copy('../oblyk.net/photo/site/' . $data['href_photo'], '../oblyk.org/storage/app/public/photos/crags/1300/' . $imgName);

        //on modifie l'ancien slug pour le nouveau
        $update = $bddOrg->prepare('UPDATE photos SET slug_label = :slug_label WHERE id = :id');
        $update->execute([
          'slug_label'=>$imgName,
          'id'=> $photos[$data['id']],
        ]);

      }
    }
  }


  //Photo sur les secteurs
  if($data['type_source'] == 'secteur'){
    if(array_key_exists($data['id_source'], $sectors)){
      if(file_exists('../oblyk.net/photo/secteur/' . $data['href_photo'])){

        //on change l'id du user s'il n'existe plus
        $user_id = array_key_exists($data['id_user'], $users) ? $users[$data['id_user']] : $oblyk_id;

        //On enregistre la photo en table (avec un nom temporaire)
        $insert = $bddOrg->prepare('
          INSERT INTO photos (illustrable_id, illustrable_type, slug_label, user_id, album_id, description, created_at)
          VALUES (:illustrable_id, :illustrable_type, :slug_label, :user_id, :album_id, :description, :created_at)');
        $insert->execute([
          'illustrable_id'=>$sectors[$data['id_source']],
          'illustrable_type'=>'App\Sector',
          'slug_label'=>'temp-slug',
          'user_id'=>$user_id,
          'album_id'=>$albums[$data['id_user_album']],
          'description'=> $data['legende'],
          'created_at'=> $data['date_cr'],
        ]);

        $photos[$data['id']] = $bddOrg->lastInsertId();

        // on copie le fichier
        $splitImg = explode('.', $data['href_photo']);
        $extension = $splitImg[1];
        $imgName = $sectorSlugs[$data['id_source']] . '-' . $photos[$data['id']] . '.' . $extension;
        copy('../oblyk.net/photo/secteur/' . $data['href_photo'], '../oblyk.org/storage/app/public/photos/crags/1300/' . $imgName);

        //on modifie l'ancien slug pour le nouveau
        $update = $bddOrg->prepare('UPDATE photos SET slug_label = :slug_label WHERE id = :id');
        $update->execute([
          'slug_label'=>$imgName,
          'id'=> $photos[$data['id']],
        ]);

      }
    }
  }

  //Photo sur les lignes
  if($data['type_source'] == 'ligne'){
    if(array_key_exists($data['id_source'], $routes)){
      if(file_exists('../oblyk.net/photo/ligne/' . $data['href_photo'])){

        //on change l'id du user s'il n'existe plus
        $user_id = array_key_exists($data['id_user'], $users) ? $users[$data['id_user']] : $oblyk_id;

        //On enregistre la photo en table (avec un nom temporaire)
        $insert = $bddOrg->prepare('
          INSERT INTO photos (illustrable_id, illustrable_type, slug_label, user_id, album_id, description, created_at)
          VALUES (:illustrable_id, :illustrable_type, :slug_label, :user_id, :album_id, :description, :created_at)');
        $insert->execute([
          'illustrable_id'=>$routes[$data['id_source']],
          'illustrable_type'=>'App\Route',
          'slug_label'=>'temp-slug',
          'user_id'=>$user_id,
          'album_id'=>$albums[$data['id_user_album']],
          'description'=> $data['legende'],
          'created_at'=> $data['date_cr'],
        ]);

        $photos[$data['id']] = $bddOrg->lastInsertId();

        // on copie le fichier
        $splitImg = explode('.', $data['href_photo']);
        $extension = $splitImg[1];
        $imgName = $routeSlugs[$data['id_source']] . '-' . $photos[$data['id']] . '.' . $extension;
        copy('../oblyk.net/photo/ligne/' . $data['href_photo'], '../oblyk.org/storage/app/public/photos/crags/1300/' . $imgName);

        //on modifie l'ancien slug pour le nouveau
        $update = $bddOrg->prepare('UPDATE photos SET slug_label = :slug_label WHERE id = :id');
        $update->execute([
          'slug_label'=>$imgName,
          'id'=> $photos[$data['id']],
        ]);

      }
    }
  }
}
echo '56. Les photos -> ok <br>';


// 57 . Les tags
$req = $bddNet->prepare('SELECT * FROM ligne_tag');
$req->execute(array());
while($data = $req->fetch()){

  if(array_key_exists($data['id_ligne'], $routes)){

    //on change l'id du user s'il n'existe plus
    $user_id = array_key_exists($data['id_user'], $users) ? $users[$data['id_user']] : $oblyk_id;

    $insert = $bddOrg->prepare('
      INSERT INTO tags (route_id, user_id, tag_id, created_at)
      VALUES (:route_id, :user_id, :tag_id, :created_at)');
    $insert->execute([
      'route_id'=>$routes[$data['id_ligne']],
      'user_id'=>$user_id,
      'tag_id'=>$data['id_tag'],
      'created_at'=> $data['date_cr'],
    ]);
  }
}
echo '57. Les tags -> ok <br>';


// 58 . Les marches d'approches
$req = $bddNet->prepare('SELECT * FROM site_approche');
$req->execute(array());
while($data = $req->fetch()){

  if(array_key_exists($data['id_site'], $crags)){

    //on change l'id du user s'il n'existe plus
    $user_id = array_key_exists($data['id_user'], $users) ? $users[$data['id_user']] : $oblyk_id;

    $insert = $bddOrg->prepare('
      INSERT INTO approaches (crag_id, user_id, polyline, description, length, created_at)
      VALUES (:crag_id, :user_id, :polyline, :description, :length, :created_at)');
    $insert->execute([
      'crag_id'=>$crags[$data['id_site']],
      'user_id'=>$user_id,
      'polyline'=>$data['gpx'],
      'description'=>$data['description'],
      'length'=>$data['longueur'],
      'created_at'=> $data['date_cr'],
    ]);
  }
}
echo '58. Les marches d\'approches -> ok <br>';



// 59 . Les éxeptions sur les falaises
$req = $bddNet->prepare('SELECT * FROM site_interdiction');
$req->execute(array());
while($data = $req->fetch()){

  if(array_key_exists($data['id_site'], $crags)){

    $insert = $bddOrg->prepare('
      INSERT INTO exceptions (crag_id, user_id, exceptions_type, description, created_at)
      VALUES (:crag_id, :user_id, :exceptions_type, :description, :created_at)');
    $insert->execute([
      'crag_id'=>$crags[$data['id_site']],
      'user_id'=>$oblyk_id,
      'exceptions_type'=>$data['niveau'],
      'description'=>$data['description'],
      'created_at'=> $data['date'],
    ]);
  }
}
echo '59. Les éxeptions -> ok <br>';



//calcul du temps d'éxécution
echo "<br><br>FIN<br><br>";
$endDate = date("Y-m-d H:i:s");

echo "début : " . $startDate . '<br>';
echo "fin : " . $endDate . '<br>';
