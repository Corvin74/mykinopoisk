<?php
  include("tools.php");
  include("db/db.php");
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
    <?php
      if (isset($_POST['action'])) {
          switch ($_POST['action']) {
            case 'add':
                echo '<meta http-equiv="refresh" content="0;URL=/add_film.php">';
                $_SESSION['authorize'] = 1;
            break;
            
            case 'edit':
            	$redirect = "<meta http-equiv='refresh' content='0;URL=/edit_film.php?film=" . $_POST["filmID"] ."'>";
            	echo $redirect; 
                $_SESSION['authorize'] = 1;
            break;
            
            case 'delete':
                $_SESSION['authorize'] = 1;
                echo('DELETE RECORD ID = ' . $_POST["filmID"]);
            break;
                
            default:
                # code...
            break;
          }
      }
      if (isset($_POST['filmAdd'])) {
      	$prepareParams = [
      			"title" => $_POST["filmTitle"],
      			"premiere" => $_POST["filmDate"],
      			"country_id" => $_POST["filmCountry"],
      			"images" => $_FILES["filmPoster"]["name"],
      			"genre_id" => $_POST["filmGenre"],
      	];
      	checkUploadFile();
        addFilm($db, $prepareParams);
      }
	  if (!(empty($_POST)) AND ( isset($_POST['authorize']) OR isset($_POST['register']) ) ) {
	  	if ( isset( $_POST['authorize'] ) ) {
        echo '<meta http-equiv="refresh" content="0;URL=/login.php">';
	  	}
	  	if ( isset( $_POST['register'] ) ) {
          // <meta http-equiv="refresh" content="SECONDS;URL=REDIRECT_URL">
          echo '<meta http-equiv="refresh" content="0;URL=/register.php">';
          // header('Location: /register.php');
	  	}
	  }
	  if(empty($_SESSION['logged_in']) AND empty($_POST)){
		  echo('
			<div class="container">
			<div class="loginButton">
			  <form method="post">
				<button type="submit" class="btn btn-info header-btn" name="register" value="yes">Регистрация</button>
				<button type="submit" class="btn btn-success header-btn" name="authorize" value="yes">Авторизоваться</button>
			  </form>
			</div>
			</div>
		  ' );
	  }
	  if(isset($_POST['userName']) && isset($_POST['userPassword'])) {
	  	$_SESSION['login'] = $_POST['userName'];
	  	$_SESSION['password'] = $_POST['userPassword'];
	  }
	  if(isset($_SESSION['login']) && isset($_SESSION['password'])) {
	  	if(login($db, $_SESSION['login'], $_SESSION['password'])) {//Попытка авторизации
              $_SESSION['authorize'] = 1;
              $_SESSION['logged_in'] = 1;
	  	}
	  }
  ?>
    <div class="container section">
        <?php while($row = $films->fetch(PDO::FETCH_ASSOC)) { //debug($row);?>
        <div class="card mb-3" style="max-width: 1200px;">
        <div class="row g-0">
            <div class="col-md-4">
            <img src="img/<?php echo $row['images'];?>" alt="...">
            </div>
            <div class="col-md-5">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['title'];?></h5>
                <p class="card-text"><?php echo $row['premiere'];?></p>
                <p class="card-text"><?php echo $row['country'];?></p>
                <p class="card-text"><small class="text-muted"><?php echo $row['genre_name'];?></small></p>
                <?php if (isset($_SESSION['authorize'])){?>
                <p class="card-text">
                    <form method="post">
                    <input type="hidden" id="filmID" name="filmID" value="<?php echo $row['id'];?>">
                    <button class="btn btn-primary" name="action" value="add">Add</button>
                    <button type="submit" class="btn btn-primary" name="action" value="edit">Edit</button>
                    <button class="btn btn-primary" name="action" value="delete">Delete</button>
                    </form>
                </p>
                <?php }; // endif?>
            </div>
            </div>
        </div>
        </div>
        <?php };?>
    </div>
</body>
</html>