<?php
require_once "DataBase.php";
$dataBase = new DataBase();

class Post
{
    protected $post_id;
    protected $date;
    protected $post_text;
    protected $user_id;
    protected $user_name;

    function __construct($data)
    {
        $this->post_id = $data["post_id"] ?? "none";
        $this->date = $data["date"] ?? "none";
        $this->post_text = $data["post_text"] ?? "none";
        $this->user_id = $data["user_id"] ?? "none";
        $this->user_name = $data["user_name"] ?? "none";
    }

    function addPost()
    {
        global $dataBase;

        $dataBase->addPost($this->post_text, $this->user_id);
    }

    function getPostID()
    {
        global $dataBase;

        $post = $dataBase->getPostID($this->post_id);

        $this->date = $post["date_time"] ?? "none";
        $this->post_text = $post["post_text"] ?? "none";
        $this->user_id = $post["user_id"] ?? "none";
        $this->user_name = $post["username"] ?? "none";

        return $post;
    }

    function renderPost($session, $admin, $countAns)
    {
        $date_time = explode(" ", $this->date); ?>

        <div class='posts'>
            <div class='posts-header'>
                <span>Опубликовал: <b><?= $this->user_name ?></b></span>
                <span>
          <span>|</span>
          <span>Время: <b><?= $date_time[1] ?></b></span>
          <span>|</span>
        </span>
                <span>Дата: <b><?= $date_time[0] ?></b></span>
            </div>
            <pre class='post-text'><?= $this->post_text ?></pre>
            <div class='options'>
        <span>
          <a href='SCRIPTS/answer.php?post_id=<?= $this->post_id ?>'>Ответить<?= "($countAns)" ?></a>
        </span>

                <span>
          <?
          if ($session == $this->user_id) {
              echo "<a href='SCRIPTS/redpost.php?post_id=$this->post_id'>Редактировать</a>";
          }

          if ($admin == true) {
              echo " <a href='SCRIPTS/delpost.php?post_id=$this->post_id&user_id=$this->user_id'>Удалить</a>";
          } else if ($session == $this->user_id) {
              echo " <a href='SCRIPTS/delpost.php?post_id=$this->post_id&user_id=$session'>Удалить</a>";
          }
          ?>
        </span>
            </div>
        </div>
    <? }

    function setPost($post_text)
    {
        global $dataBase;

        $dataBase->addUpdatePost($this->post_id, $post_text, $this->user_id);
    }

    function delPost()
    {
        global $dataBase;

        $dataBase->delPost($this->post_id, $this->user_id);
    }

    static function getAllPosts()
    {
        global $dataBase;

        return $dataBase->getAllPosts();
    }
}

class Answer
{
    protected $answer_id;
    protected $date;
    protected $answer_text;
    protected $user_id;
    protected $user_name;
    protected $post_id;

    function __construct($data)
    {
        $this->answer_id = $data["answer_id"] ?? "none";
        $this->date = $data["date"] ?? "none";
        $this->answer_text = $data["answer_text"] ?? "none";
        $this->user_id = $data["user_id"] ?? "none";
        $this->user_name = $data["user_name"] ?? "none";
        $this->post_id = $data["post_id"] ?? "none";
    }

    function addAnswer()
    {
        global $dataBase;

        $dataBase->addAnswer($this->answer_text, $this->post_id, $this->user_id);
    }

    function renderAnswer($session, $admin)
    {
        $date_time = explode(" ", $this->date); ?>
        <div class="answer">
            <div class="posts-header">
                <span>Ответил: <b><?= $this->user_name ?></b></span>
                <span>
          <span>|</span>
          <span>Время: <b><?= $date_time[1] ?></b></span>
          <span>|</span>
        </span>
                <span>Дата: <b><?= $date_time[0] ?></b></span>
            </div>
            <pre class="post-text"><?= $this->answer_text ?></pre>
            <div class="options">
        <span>
        </span>
                <span>
          <?
          if ($session == $this->user_id) {
              echo "<a href='SCRIPTS/redanswer.php?answer_id=$this->answer_id'>Редактировать</a>";
          }

          if ($admin == true) {
              echo " <a href='SCRIPTS/delanswer.php?answer_id=$this->answer_id&user_id=$this->user_id'>Удалить</a>";
          } else if ($session == $this->user_id) {
              echo " <a href='SCRIPTS/delanswer.php?answer_id=$this->answer_id&user_id=$session'>Удалить</a>";
          }
          ?>
        </span>
            </div>
        </div>
    <? }

    function getAnswerID()
    {
        global $dataBase;

        return $dataBase->getAnswerID($this->answer_id);
    }

    function setAnswer($answer_text)
    {
        global $dataBase;

        $dataBase->addUpdateAnswer($this->answer_id, $answer_text, $this->user_id);
    }

    function delAnswer()
    {
        global $dataBase;

        $dataBase->delAnswer($this->answer_id, $this->user_id);
    }
}
