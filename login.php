<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <title>Авторизуйтесь пожалуйста</title>
</head>
<body>

<div class="header">
<h1>НАЗВАНИЕ</h1>

<h3>ВВЕДИТЕ ДАННЫЕ ДЛЯ АВТОРИЗАЦИИ</h3>
</div>

  <div class="container">
	<form action="/" method="post">
	  <div class="row mb-3">
	    <label for="userName" class="col-sm-2 col-form-label">Имя пользователя</label>
	    <div class="col-sm-5">
	      <input type="text" class="form-control" id="userName" name="userName">
	    </div>
	  </div>
	  <div class="row mb-3">
	    <label for="userPassword" class="col-sm-2 col-form-label">Пароль</label>
	    <div class="col-sm-5">
	      <input type="password" class="form-control" id="userPassword" name="userPassword">
	    </div>
	  </div>
	  <button type="submit" class="btn btn-primary">Авторизоваться</button>
	</form>
  </div>
</body>
</html>