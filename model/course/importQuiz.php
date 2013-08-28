<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HomeController
 *
 * @author Expression Calvinyang is undefined on line 10, column 14 in Templates/Scripting/PHPClass.php.
 */

class QuestionModel {
    var $title;
    var $answer1;
    var $answer2;
    var $answer3;
    var $answer4;
    var $answer;
    var $course_level_id;
    var $difficulty;
    var $score;
    var $tag1;
    var $tag2;
    var $dbc;

    public function initDB() {
        $this->dbc = mysqli_connect('localhost','stone','123456','db_study') or die('ERROR connecting to MySQL.');
        mysqli_query($this->dbc, "set names utf8");
    }

    public function save() {
        $query = "insert into tbl_question" . 
            "(course_level_id, title, answer1, answer2, answer3, answer4, answer, score, tag1, tag2, difficulty) ". 
            "values" . 
            "($this->course_level_id, '$this->title', '$this->answer1', '$this->answer2', '$this->answer3', '$this->answer4', '$this->answer', '$this->score', '$this->tag1', '$this->tag2', '$this->difficulty')";
        $data = mysqli_query($this->dbc,$query);
    }

    public function closeDB() {
        mysqli_close($this->dbc);
    }
}

class HomeController{
    
    public function actionImport() {
        $handle = @fopen("d:/ques.txt", "r");
        if ($handle) {
            $ques = new QuestionModel();
            $ques->initDB();
            while (!feof($handle)) {
                $ques->title = trim(preg_replace("/[0-9]+、/", "", fgets($handle, 4096)));
                $ques->answer1 = fgets($handle, 4096);
                $ques->answer2 = fgets($handle, 4096);
                $ques->answer3 = fgets($handle, 4096);
                $ques->answer4 = fgets($handle, 4096);
                $ques->answer = preg_replace('/[^A-Z]/', "", fgets($handle, 4096));
                $ques->course_level_id = 0;
                $ques->difficulty = 0;
                $ques->score = 0;
                $ques->tag1 = '';
                $ques->tag2 = '';
                $ques->save();
            }
            $ques->closeDB();
            fclose($handle);
        }
        echo "ended";
    }
}

$tmp = new HomeController();
$tmp->actionImport();

?>
