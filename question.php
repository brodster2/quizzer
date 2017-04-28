<?php include 'database.php'; ?>
<?php
    // Set question number using n in the URL (see index.php)
    $number = (int) $_GET['n'];

    /*
    * Get Question
    */
    $query = "SELECT * FROM `questions`
                WHERE question_number = $number";
    
    //Get query results
    $result = $mysqli->query($query) or die($mysqli->error._LINE_);

    $question = $result->fetch_assoc();

    /*
    * Get Choices
    */
    $query = "SELECT * FROM `choices`
                WHERE question_number = $number";
    
    //Get query results
    $choices = $mysqli->query($query) or die($mysqli->error._LINE_);
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
            <div class="current">Question <?php echo $number ?> of 5</div>
            <p class="question">
                <?php echo $question['text']; ?>
            </p>
            <form method="post" action="process.php">
                <ul class="choices">
                    <?php while($row = $choices->fetch_assoc()): ?>
                        <li><input name="choice" type="radio" value="<?php echo $row['id']; ?>"><?php echo $row['text']; ?></li>
                    <?php endwhile; ?>
                </ul>
                <input type="submit" name="submit" value="Submit">
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