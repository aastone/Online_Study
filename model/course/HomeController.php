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
class HomeController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionError() {
        $this->render('error');
    }
    
    public function actionImport() {
        $handle = @fopen("d:/ques.txt", "r");
        if ($handle) {
            while (!feof($handle)) {
                $ques = new QuestionModel();
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
            fclose($handle);
        }
    }
}

?>
