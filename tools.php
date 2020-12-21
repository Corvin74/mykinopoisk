<?php
  function debug($param) {
    echo("<pre>");
      var_dump($param);
    echo("</pre>");
  }

  function debugx($param) {
    echo("<pre>");
    var_dump($param);
    echo("</pre>");
    exit();
  }
    
  function login($db, $login, $password) {
    // Обязательно нужно провести валидацию логина и пароля, чтобы
    // исключить вероятность инъекции
    
    //Запрос в базу данных
    $password = md5($password);
    $params = ([
        'loginName' => $login,
        'userPassword' => $password,
        'isAdmin' => 1,
    ]);
    $loginResult = $db->prepare( 'SELECT * FROM dic_users WHERE user_login = :loginName AND user_password = :userPassword AND is_admin = :isAdmin' );
    $loginResult->execute( $params );
    // $queryResult = $loginResult->fetch(PDO::FETCH_ASSOC);
    $queryResult = $loginResult->rowCount();
    
    if($queryResult == 1) {
      //Если есть совпадение, возвращается true
      $_SESSION['authorize'] = 1;
      return true;
    } else {
      //Если такого пользователя не существует, данные стираются, а возвращается false
      unset($_SESSION['login'],$_SESSION['password']);
      return false;
    }
  }

  function addFilm($db, $params) {
	$addQuery = "	INSERT INTO films (title, premiere, country_id, images, genre_id)
				  VALUES (:title, :premiere, :country_id, :images, :genre_id)";
	$addResult = $db->prepare( $addQuery );
	$addResult->execute( $params );
	$queryResult = $addResult->rowCount();
	
	if($queryResult == 1) {
		//Если данные попали в базу, возвращается true
		return true;
	} else {
		//Если данные не попали в базу, возвращается false
		return false;
	}
}

function editFilm($db, $params) {
	$editQuery = "	UPDATE films SET title = :title, premiere = :premiere, country_id = :country_id, images = :images, genre_id = :genre_id)
					WHERE	id = :id";
	$editResult = $db->prepare( $editQuery );
	$editResult->execute( $params );
	
	$queryResult = $editResult->rowCount();
	debugx(queryResult);
	if($queryResult == 1) {
		//Если данные попали в базу, возвращается true
		return true;
	} else {
		//Если данные не попали в базу, возвращается false
		return false;
	}
}

function checkUploadFile() {
  	$target_dir = "img/";
  	$target_file = $target_dir . basename($_FILES["filmPoster"]["name"]);
  	$uploadOk = 1;
  	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  	// Check if image file is a actual image or fake image
  	$check = getimagesize($_FILES["filmPoster"]["tmp_name"]);
  	if($check !== false) {
  		echo "File is an image - " . $check["mime"] . ".";
  		$uploadOk = 1;
  	} else {
  		echo "File is not an image.";
  		$uploadOk = 0;
  	}
  	// Check if file already exists
  	if (file_exists($target_file)) {
  		echo "Sorry, file already exists.";
  		$uploadOk = 0;
  	}
  	// Check file size
  	if ($_FILES["filmPoster"]["size"] > 500000) {
  		echo "Sorry, your file is too large.";
  		$uploadOk = 0;
  	}
  	// Allow certain file formats
  	if(	$imageFileType != "jpg" &&
  		$imageFileType != "png" &&
  		$imageFileType != "jpeg" &&
  		$imageFileType != "gif" &&
  		$imageFileType != "webp" ) {
  	  echo "Sorry, only JPG, JPEG, WEBP, PNG & GIF files are allowed.";
  	  $uploadOk = 0;
  	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	  echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	  if (move_uploaded_file($_FILES["filmPoster"]["tmp_name"], $target_file)) {
		echo "The file ". basename( $_FILES["filmPoster"]["name"]). " has been uploaded.";
	  } else {
		echo "Sorry, there was an error uploading your file.";
	  }
	}
  }