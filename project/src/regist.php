<?
session_start();

if (isset($_SESSION["username"])) {
  header("location: about.php");
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="CSS/index-style.css">
  <link rel="icon" type="image" href="IMG/2636341.png" />
  <title>Регистрация</title>
</head>

<body>
  <main>
    <div>
      <form action="SCRIPTS/adduser.php" method="post">
        <h1>Регистрация</h1>
        <input type="text" placeholder="Введите имя" maxlength="25" name="username">
        <input type="password" placeholder="Введите пароль" maxlength="40" name="pass">
        <input type="password" placeholder="Повторите пароль" maxlength="40" name="repass">
        <button>Зрегистрироваться</button>
        <span>
          <a href="/">Вход</a>
          <?
          if (isset($_SESSION["error"])) {
            echo "<span id='error'> | {$_SESSION["error"]}</span>";
            $_SESSION["error"] = null;
          };
          ?>
        </span>
      </form>
    </div>
  </main>
</body>

</html>