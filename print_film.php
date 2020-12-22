<?php
  include("tools.php");
  include("db/db.php");

  // $country = $db->query("SELECT id, country FROM dic_country");
  // $genre = $db->query("SELECT id, genre_name FROM dic_genre");
  $params = ([
  		'id' => $_GET['film'],
  ]);
  $currentRecord = $db->prepare( 'SELECT f.id, f.title, f.premiere, c.country, f.images, g.genre_name, f.description
                        FROM films AS f, dic_country AS c, dic_genre AS g
                        WHERE f.country_id = c.id AND f.genre_id = g.id AND f.id = :id');
  $currentRecord->execute( $params );
  $currentRecordData = $currentRecord->fetch(PDO::FETCH_ASSOC);
  // debug($currentRecordData);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo($currentRecordData['title'])?></title>
  <link rel="stylesheet" href="../css/reset.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;0,500;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="container">
    <!-- <form action="/" method="POST"  enctype="multipart/form-data"> -->
      <div class="add_film">
        <div class="card mb-3" style="max-width: 840px;">
          <div class="row g-0">
            <div class="col-md-3">
              <img class="film_img" width="280" src="img/<?php echo($currentRecordData['images'])?>" alt="Poster" name="film_img" id="film_img">
            </div>
            <div class="col-md-9">
              <div class="card-body">
                <h2><?php echo($currentRecordData['title'])?></h2>
                <p class="form-label">Страна производства: <h3><?php echo($currentRecordData['country'])?></h3></p>
                <p class="form-label">Дата выхода: <h3><?php echo($currentRecordData['premiere'])?></h3></p>
                <p class="form-label">Выберите жанр: <h3><?php echo($currentRecordData['genre_name'])?></h3></p>
                <p class="form-label">Описание</p>
                <p>
                <?php echo($currentRecordData['description'])?>
                </p>
                <button class="btn btn-primary btn-films" onclick="this.style='display: none'; print();" name="action" value="print">Распечатать</button>
                <button class="btn btn-secondary btn-films" name="filmDiscard" value="Discard">Отмена</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- </form> -->
  </div>
  <script
  src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
  integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
