<?
session_start();

if (!isset($_SESSION["user"])) {
    header("location: /");
}

require_once "CLASSES/Post.php";
require_once "CLASSES/User.php";

$user = new User([
    "id" => $_SESSION["user"]["id"],
    "username" => $_SESSION["user"]["name"],
]);

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/about-style.css">
    <link rel="icon" type="image" href="IMG/2636341.png"/>
    <title>Посты</title>
</head>

<body>
<main>
    <div id="header"><b><?= $_SESSION["user"]["name"] ?></b> | <a href="SCRIPTS/logout.php">ВЫЙТИ</a></div>

    <div id="posts-container">
        <?
        $posts = Post::getAllPosts();

        foreach ($posts as $post) {
            $newPost = new Post([
                "post_id" => $post["id"],
                "date" => $post["date_time"],
                "post_text" => $post["post_text"],
                "user_id" => $post["user_id"],
                "user_name" => $post["username"],
            ]);
            $answers = $dataBase->getAnswersPost($post["id"]);

            $newPost->renderPost($_SESSION["user"]["id"], $user->isAdmin(), count($answers));

            if ($answers != []) {
                echo '<div class="answers">
          <div class="line-container">
            <div class="line-answers"></div>
          </div>
          <div class="answers-container">';

                foreach ($answers as $answer) {
                    $newAnswer = new Answer([
                        "answer_id" => $answer["id"],
                        "date" => $answer["date_time"],
                        "answer_text" => $answer["answer_text"],
                        "user_id" => $answer["user_id"],
                        "user_name" => $answer["username"],
                        "post_id" => $post["id"],
                    ]);
                    $newAnswer->renderAnswer($_SESSION["user"]["id"], $user->isAdmin());
                }

                echo '</div></div>';
            }
        } ?>
    </div>
    </div>

    <?
    if (isset($_SESSION["post"])) {
        $script = "SCRIPTS/addupdatepost.php";
    } else if (isset($_SESSION["answer"]["post_id"])) {
        $script = "SCRIPTS/addanswer.php";
    } else if (isset($_SESSION["answer"]["answer_text"])) {
        $script = "SCRIPTS/addupdateanswer.php";
    } else {
        $script = "SCRIPTS/addpost.php";
    }
    ?>

    <div id="form-container">
        <form action="<?= $script ?>" method="post">
            <input type="hidden" value="<?= $_SESSION["user"]["id"] ?>" name="user_id">
            <input type="hidden"
                   value="<?= $_SESSION["post"]["id"] ?? $_SESSION["answer"]["post_id"] ?? $_SESSION["answer"]["answer_id"] ?? NULL ?>"
                   name="post_id">
            <textarea placeholder="Введите текст"
                      name="text"><?= $_SESSION["post"]["text"] ?? $_SESSION["answer"]["answer_text"] ?? NULL ?></textarea>
            <button>Отправить</button>
        </form>
    </div>

    <?
    unset($_SESSION["post"]);
    unset($_SESSION["answer"]);
    ?>

</main>
</body>

</html>