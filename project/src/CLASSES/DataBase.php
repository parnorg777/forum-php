<?php

class DataBase
{
    protected $host = 'mysql';
    protected $dbname = 'forum';
    protected $port = '3306';
    protected $username = 'root';
    protected $password = '132231';
    protected $conect;

    function __construct()
    {
        try {
            $this->conect = new PDO("mysql:host=$this->host;dbname=$this->dbname;port=$this->port", $this->username, $this->password);
        } catch (\PDOException) {
            die('Ошибка подключения к базе данных');
        }
    }

    function getUserName($username)
    {
        $sql = "SELECT * FROM `users` WHERE `username` = ?";

        $query = $this->conect->prepare($sql);

        $query->execute([$username]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    function getUserNamePass($username, $password)
    {
        $sql = "SELECT * FROM `users` WHERE `username` = :username AND `password` = :password";

        $query = $this->conect->prepare($sql);

        $query->execute([
            "username" => $username,
            "password" => $password,
        ]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    function addUser($username, $password)
    {
        $sql = "INSERT INTO `users` (`id`, `username`, `password`) VALUES (NULL, :username, :password)";

        $query = $this->conect->prepare($sql);

        $query->execute([
            'username' => $username,
            'password' => $password,
        ]);
    }

    function addPost($post_text, $user_id)
    {
        $sql = "INSERT INTO `posts`(`post_text`, `user_id`) VALUES (:post_text, :user_id)";

        $query = $this->conect->prepare($sql);

        $query->execute([
            'post_text' => $post_text,
            'user_id' => $user_id,
        ]);
    }

    function getPostID($id)
    {
        $columns = "posts.id, posts.date_time, posts.post_text, posts.user_id, users.username";

        $sql = "SELECT $columns FROM `posts` JOIN `users` ON posts.user_id  = users.id WHERE posts.id = ?";

        $query = $this->conect->prepare($sql);

        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    function getAllPosts()
    {
        $columns = "posts.id, posts.date_time, posts.post_text, posts.user_id, users.username";

        $sql = "SELECT $columns FROM `posts` JOIN `users` ON posts.user_id  = users.id ORDER BY posts.id DESC";

        $query = $this->conect->query($sql);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function addUpdatePost($post_id, $post_text, $user_id)
    {
        $sql = "UPDATE `posts` SET `post_text`=:post_text WHERE `id` = :post_id AND `user_id` = :user_id";

        $query = $this->conect->prepare($sql);

        $query->execute([
            "post_text" => $post_text,
            "post_id" => $post_id,
            "user_id" => $user_id,
        ]);
    }

    function delPost($post_id, $user_id)
    {
        $sql = "DELETE FROM `posts` WHERE `id` = :post_id AND `user_id` = :user_id";

        $query = $this->conect->prepare($sql);

        $query->execute([
            "post_id" => $post_id,
            "user_id" => $user_id,
        ]);
    }

    function getUserID($id)
    {
        $sql = "SELECT * FROM `users` WHERE `id` = ?";

        $query = $this->conect->prepare($sql);

        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    function addAnswer($answer_text, $post_id, $user_id)
    {
        $sql = "INSERT INTO `answers`(`answer_text`, `user_id`, `post_id`) VALUES (:answer_text, :user_id, :post_id)";

        $query = $this->conect->prepare($sql);

        $query->execute([
            "answer_text" => $answer_text,
            "user_id" => $user_id,
            "post_id" => $post_id,
        ]);
    }

    function getAnswersPost($post_id)
    {
        $columns = "answers.id, answers.date_time, answers.answer_text, answers.user_id, users.username";

        $sql = "SELECT $columns FROM `answers` JOIN `users` ON answers.user_id  = users.id WHERE answers.post_id = ?";

        $query = $this->conect->prepare($sql);

        $query->execute([$post_id]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function getAnswerID($answer_id)
    {
        $sql = "SELECT * FROM `answers` WHERE `id` = ?";

        $query = $this->conect->prepare($sql);

        $query->execute([$answer_id]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    function addUpdateAnswer($answer_id, $answer_text, $user_id)
    {
        $sql = "UPDATE `answers` SET `answer_text`=:answer_text WHERE `id` = :answer_id AND `user_id` = :user_id";

        $query = $this->conect->prepare($sql);

        $query->execute([
            "answer_text" => $answer_text,
            "answer_id" => $answer_id,
            "user_id" => $user_id,
        ]);
    }

    function delAnswer($answer_id, $user_id)
    {
        $sql = "DELETE FROM `answers` WHERE `id` = :answer_id AND `user_id` = :user_id";

        $query = $this->conect->prepare($sql);

        $query->execute([
            "answer_id" => $answer_id,
            "user_id" => $user_id,
        ]);
    }
}
