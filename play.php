<?php
require "inc/Phrase.php";
require "inc/Game.php";
require 'inc/phraseGenerator.php';

session_start();
//if no game happening, start a new session with phrase and game
if (!isset($_GET['key']) || $_GET['key']=="enter") {

  $phraseString = phraseGenerator();
  $_SESSION['phrase'] = new Phrase($phraseString);
  $_SESSION['game'] = new Game($_SESSION['phrase']);
} else {
  $selection = filter_input(INPUT_GET, 'key', FILTER_SANITIZE_STRING);
  $_SESSION['phrase']->appendSelected($selection);
  if (!$_SESSION['phrase']->checkLetter($selection)){
    $_SESSION['game']->removeLife();
  } else {
    $_SESSION['phrase']->appendCorrect($selection);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Phrase Hunter</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/styles.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>

<body>
  <div class="main-container">
    <?php
    if ($_SESSION['game']->checkForWin() || $_SESSION['game']->checkForLose()){ ?>
      <?php
      if ($_SESSION['game']->checkForWin()){
        $theClass="win";
      } else {
        $theClass="lose";
      }
      ?>
      <div id="overlay" class="<?= $theClass; ?>">
        <h1 id="game-over-message"><?php echo $_SESSION['game']->gameOver(); ?></h1>
    		<a href="/play.php"><button id="btn__reset">Play Again!</button></a>
    	</div>
    <?php } else { ?>

    <div id="banner" class="section">
        <h2 class="header">Phrase Hunter</h2>
        <?php
        echo $_SESSION['phrase']->addPhraseToDisplay();
        echo $_SESSION['game']->displayKeyboard();
        echo $_SESSION['game']->displayScore();
        ?>
    </div>
    <?php }
    $passSelected = $_SESSION['phrase']->getSelected();
    $passSelectedArray = "['";
    $passSelectedArray .= implode("','",$passSelected);
    $passSelectedArray .= "']"
    ?>


  </div>
  <script type="text/javascript">
    var selectedArray = "<?php print_r($passSelectedArray); ?>;"
  </script>
  <script type="text/javascript" src="js/script.js"></script>
</body>
</html>
