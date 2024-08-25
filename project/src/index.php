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
  <title>Вход</title>
</head>

<body>
  <main>
    <div>
      <form action="SCRIPTS/login.php" method="post">
        <h1>Вход</h1>
        <input type="text" placeholder="Введите имя" maxlength="25" name="username">
        <input type="password" placeholder="Введите пароль" maxlength="40" name="pass">
        <button>Войти</button>
        <span>
          <a href="regist.php">Регистрация</a>
          <?
          if (isset($_SESSION["mess"])) {
            echo "<span class='mess'> | {$_SESSION["mess"]}</span>";
            $_SESSION["mess"] = null;
          };

          if (isset($_SESSION["error"])) {
            echo "<span class='error'> | {$_SESSION["error"]}</span>";
            $_SESSION["error"] = null;
          };

          ?>
        </span>
      </form>
    </div>
  </main>
</body>

</html>