<?php
  include("db/db.php");

  $echo = " <div class='table'>
              <div class='tale-wrapper'>
                <div class='table-title'>
                  Войти в панель администратора
                </div>
                <div class='table-content'>
                  <form method='post' id='login-form' class='login-form'>
                    <p><input type='text' placeholder='Логин' class='input' name='login' required></p>
                    <p><input type='password' placeholder='Пароль' class='input' name='password' required></p>
                    <p><input type='submit' value='Войти' class='button'></p>
                  </form>
                </div>
              </div>
            </div>"
  ;

  function login($db, $login,$password) {
    //Обязательно нужно провести валидацию логина и пароля, чтобы исключить вероятность инъекции
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


  if(isset($_POST['login']) && isset($_POST['password'])) {
    $_SESSION['login'] = $_POST['login'];
    $_SESSION['password'] = $_POST['password'];
  }

  if(isset($_SESSION['login']) && isset($_SESSION['password'])) {
    // debug($_SESSION);
    if(login($db, $_SESSION['login'],$_SESSION['password'])) {
      //Попытка авторизации
      //Тут будут проходить все операции




      // if(isset($_GET['act'])){
      //   $act = $_GET['act'];
      // } else {
      //   $act = 'home';
      // }
      // switch($act) {
      //   case 'home':
      //     $article_result = mysqli_query($db,"SELECT * FROM articles");
      //     if(mysqli_num_rows($article_result) >= 1) {
      //       while($article_array = mysqli_fetch_array($article_result)) {
      //         $articles .= "<div class='table-content__list-item'><a href='?act=edit_article&id=$article_array[id]'>$article_array[id] | $article_array[title]</a></div>";
      //       }
      //     } else {
      //     $articles = "Статей пока нет";
      //     }
      //     $users_result = mysqli_query($db,"SELECT * FROM userlist");
      //     if(mysqli_num_rows($users_result) >= 1) {
      //     while($users_array = mysqli_fetch_array($users_result)) {
      //     $users .= "<div class='table-content__list-item'><a href='?act=edit_user&id=$users_array[id]'>$users_array[id] | 
      //     $users_array[login]</a></div>";
      //     }
      //     } else {
      //     $users = "Статей пока нет";
      //     }
      //     $echo = "<div class='tables'>
      //     <div class='table'>
      //     <div class='table-wrapper'>
      //     <div class='table-title'>Страницы</div>
      //     <div class='table-content'>
      //     $articles
      //     <a href='?act=add_article' class='table__add-button' id='add_article'>+</a>
      //     </div>
      //     </div>
      //     </div>
      //     <div class='table'>
      //     <div class='table-wrapper'>
      //     <div class='table-title'>Пользователи</div>
      //     <div class='table-content'>
      //     $users
      //     <a href='?act=add_user' class='table__add-button'
      //     id='add_user'>+</a>
      //     </div>
      //     </div>
      //     </div>
      //     </div>";
      //   break;
      // }



      $echo = null; //Обнуление переменной, чтобы удалить из вывода форму авторизации
    }
  }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Админка</title>
  <link rel="stylesheet" href="css/admin.css">
</head>
<body>
  <div class="wrapper">
    <div class="main">
      <?php echo($echo);?>
    </div>
  </div>
</body>
</html>