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
    $loginResult = $db->prepare( 'SELECT * FROM users WHERE login = :loginName AND password = :userPassword AND admin = :isAdmin' );
    $loginResult->execute( $params );
    // $queryResult = $loginResult->fetch(PDO::FETCH_ASSOC);
    $queryResult = $loginResult->rowCount();
    
    if($queryResult == 1) {
      //Если есть совпадение, возвращается true
      return true;
    } else {
      //Если такого пользователя не существует, данные стираются, а возвращается false
      unset($_SESSION['login'],$_SESSION['password']);
      return false;
    }
  }
