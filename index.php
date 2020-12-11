<?php
  $db_host = 'localhost';
  $db_name = 'kinopoisk';
  $db_charset='utf8';
  $db_user = 'kinopoisk';
  $db_password = 'eTx1234';

  try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=$db_charset", $db_user, $db_password);
  } catch (PDOException $e) {
      print "Error!: " . $e->getMessage();
      die();
    }
  // var_dump($db);
  $films = $db->query(" SELECT f.title, f.premiere, c.country, f.images, g.genre_name
                        FROM films AS f, dic_country AS c, dic_genre AS g
                        WHERE f.country_id = c.id AND f.genre_id = g.id");
  // while($row = $films->fetch(PDO::FETCH_LAZY))
  // {
  //   print_r($row);
  // }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой кинопоиск</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;0,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header class="container header">
        <h1>Мой кинопоиск</h1>
    </header>
    <div class="container section">
        <div class="toprow">
            <div class="cell htitle">Название</div>
            <div class="cell hpremiere">Примьера</div>
            <div class="cell hcountry">Страна</div>
            <div class="cell himages">Постер</div>
            <div class="cell hgenre">Жанр</div>
        </div>
        <?php while($row = $films->fetch(PDO::FETCH_LAZY)) { ?>
        <div class="row_item">
            <div class="cell title"><?php echo $row['title'];?></div>
            <div class="cell premiere"><?php echo $row['premiere'];?></div>
            <div class="cell country"><?php echo $row['country'];?></div>
            <div class="cell images"><img width=150px src="img/<?php echo $row['images'];?>" alt=""></div>
            <div class="cell genre"><?php echo $row['genre_name'];?></div>
        </div>
        <?php };?>
    </div>
</body>
</html>