<?php include "database.php"; ?>
<?php

if(isset($_POST['submit'])){
    //Get post variables
    $question_number = $_POST['question_number'];
    $question_text = $_POST['question_text'];
	$correct_choice = $_POST['correct_choice']-1;
    //Choices array
    $choices = array();
    $choices[0] = $_POST['choice1'];
    $choices[1] = $_POST['choice2'];
    $choices[2] = $_POST['choice3'];
    $choices[3] = $_POST['choice4'];
    $choices[4] = $_POST['choice5'];
    
    //Question query taken from use input
    $query = "INSERT INTO `questions`(question_number, text)
                VALUES('$question_number', '$question_text')";
	
    //execute the question query
    $insert_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
    
    /**
	* If the question is added to the questions table successfully
	* check if a choice was entered into the page input i.e. not empty
	* then check if the choice is the correct choice specified by the user
	*/
    if($insert_row){
       foreach($choices as $choice => $value){
           if($value != ''){
               if($correct_choice == $choice){
				   $is_correct = 1;
			   } else {
				   $is_correct = 0;
			   }
			   
			   //Add the currently looped choice into the choices table
			   $query = "INSERT INTO `choices` (question_number, is_correct, text)
			   			VALUES ('$question_number', '$is_correct', '$value')";
			   
			   //Execute the query
			   $insert_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
			   
			   //Validate query insert
			   if($insert_row) {
				   continue;
			   } else {
				   die('Error: ('.$mysqli->errno . ') ' .$mysqli->error);
			   }
           }
       }
		$msg = 'Question has been added';
    }
}

	/*
	* Get total number of questions
	*/
	$query = "SELECT * FROM `questions`";
	//Get results
	$results = $mysqli->query($query) or die($mysqli->error._LINE_);
	$next = $results->num_rows + 1;
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
            <?php
				if(isset($msg)){
					echo '<p style="background:green; color:white;">'.$msg.'</p>';
				}
			?>
            <form method="post" action="add.php">
                <p>
                    <label>Question Number:</label>
                    <input type="number" value="<?php echo $next; ?>" name="question_number">
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
            <a href="index.php" class="start">Take the quiz</a>
        </div>
    </main>
    <footer>
        <div class="container">
            Copyright &copy; 2017, PHP Quizzer
        </div>
    </footer>
</body>
</html>