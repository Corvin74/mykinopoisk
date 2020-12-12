<?php
  include("tools.php");
  include("db/db.php");

  $country = $db->query("SELECT id, country FROM dic_country");
  $genre = $db->query("SELECT id, genre_name FROM dic_genre");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;0,500;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="container">
    <form action="/" method="POST">
      <div class="add_film">
        <div class="card mb-3" style="max-width: 840px;">
          <div class="row g-0">
            <div class="col-md-3">
              <img width="250" src="img/Chernobyl.jpg" alt="...">
            </div>
            <div class="col-md-9">
              <div class="card-body">
                <label for="filmTitle" class="form-label">Название фильма:</label>
                <input type="text" class="form-control" id="filmTitle" name="filmTitle" placeholder="Введите название фильма">
                <label for="filmCountry" class="form-label">Страна производства:</label>
                <select class="form-select" id="filmCountry" name="filmCountry">
                  <?php while($row = $country->fetch(PDO::FETCH_ASSOC)){
                    if ($row['id'] == 1) {?>
                  <option value="<?php echo($row['id']); ?>" selected><?php echo($row['country']); ?></option>
                    <?php } else { ?>
                  <option value="<?php echo($row['id']); ?>"><?php echo($row['country']); ?></option>
                    <?php } // end if ?>
                  <?php } // end while ?>
                </select>
                <label for="filmDate" class="form-label">Дата выхода</label>
                <input type="date" class="form-control" id="filmTitle" name="filmDate" placeholder="Выберете дату выхода:">
                <label for="filmGenre" class="form-label">Выберите жанр:</label>
                <select class="form-select" id="filmGenre" name="filmGenre">
                  <?php while($row = $genre->fetch(PDO::FETCH_ASSOC)){
                      if ($row['id'] == 1) {?>
                    <option value="<?php echo($row['id']); ?>" selected><?php echo($row['genre_name']); ?></option>
                      <?php } else { ?>
                    <option value="<?php echo($row['id']); ?>"><?php echo($row['genre_name']); ?></option>
                      <?php } // end if ?>
                    <?php } // end while ?>
                </select>
                <label class="input-group-text" for="filmPoster">Загрузить постер:</label>
                <input type="file" class="form-control" id="filmPoster" name="filmPoster">
                <button type="submit" class="btn btn-success btn-films" name="filmAdd" value="Yes">Сохранить</button>
                <button type="submit" class="btn btn-secondary btn-films" name="filmDiscard" value="Discard">Отмена</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</body>
</html>
