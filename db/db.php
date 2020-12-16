<?php
  require_once("tools.php");

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
  $films = $db->query(" SELECT f.id, f.title, f.premiere, c.country, f.images, g.genre_name
                        FROM films AS f, dic_country AS c, dic_genre AS g
                        WHERE f.country_id = c.id AND f.genre_id = g.id");
?>