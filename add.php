<?php
include "database.php";
if(isset($_POST['submit'])){
    //Get post variables
    $question_number = $_POST['question_number'];
    $question_text = $_POST['question_text'];
    //Choices array
    $choices = array();
    $choices[0] = $_POST['choice1'];
    $choices[1] = $_POST['choice2'];
    $choices[2] = $_POST['choice3'];
    $choices[3] = $_POST['choice4'];
    $choices[4] = $_POST['choice5'];
    
    //Question query
    $query = "INSERT INTO `questions`(question_number, text)
                VALUES('question_number', 'question_text')";
    //Run query
    $insert_row = $mysqli->query($query) or die(mysqli->error.__LINE__);
    
    //Validate insert row
    if($insert_row){
       foreach($choices as $choice => $value){
           if($value != ''){
               
           }
       } 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP Quizzer</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
    <header>
        <div class="container">
            <h1>PHP Quizzer</h1>
        </div>
    </header>
    <main>
        <div class="container">
            <h2>Add a question</h2>
            <form method="post" action="add.php">
                <p>
                    <label>Question Number:</label>
                    <input type="number" name="question_number">
                </p>
                <p>
                    <label>Question Text:</label>
                    <input type="text" name="question_text">
                </p>
                <p>
                    <label>Choice #1: </label>
                    <input type="text" name="choice1">
                </p>
                <p>
                    <label>Choice #2: </label>
                    <input type="text" name="choice2">
                </p>
                <p>
                    <label>Choice #3: </label>
                    <input type="text" name="choice3">
                </p>
                <p>
                    <label>Choice #4: </label>
                    <input type="text" name="choice4">
                </p>
                <p>
                    <label>Choice #5: </label>
                    <input type="text" name="choice5">
                </p>
                <p>
                    <label>Correct Choice Number:</label>
                    <input type="number" name="correct_choice">
                </p>
                <p>
                    <input type="submit" name="submit" value="submit">
                </p>
                
            </form>
        </div>
    </main>
    <footer>
        <div class="container">
            Copyright &copy; 2017, PHP Quizzer
        </div>
    </footer>
</body>
</html>