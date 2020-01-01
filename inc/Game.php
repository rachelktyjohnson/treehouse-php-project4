<?php

class Game
{
  protected $phrase; //an instance of the Phrase class
  protected $lives=5; //an integer for the number of lives left

  public function __construct($phraseObject){
    $this->phrase = $phraseObject;
  }

  public function removeLife(){
    $this->lives--;
  }

  //checkForWin(): this method checks to see if the player has selected all of the letters.
  public function checkForWin(){
    $phraseArray = str_split($this->phrase->getCurrentPhrase());
    $phraseArrayUnique = array_unique($phraseArray);
    if (count($phraseArrayUnique)-1 == count($this->phrase->getCorrect())){
      return true;
    } else {
      return false;
    }
  }

  //checkForLose(): this method checks to see if the player has guessed too many wrong letters.
  public function checkForLose(){
    if ($this->lives == 0){
      return true;
    }
  }

  //gameOver(): this method displays one message if the player wins and another message if they lose. It returns false if the game has not been won or lost.
  public function gameOver(){
    if ($this->checkForWin()){
      return "Congratulations on guessing:<br>" . ucwords($this->phrase->getCurrentPhrase());
    } else {
      return "The phrase was: " . ucwords($this->phrase->getCurrentPhrase() . "<br>Better luck next time!");
    }
  }

  //displayKeyboard(): Create a onscreen keyboard form. See the example_html/keyboard.txt file for an example of what the render HTML for the keyboard should look like. If the letter has been selected the button should be disabled. Additionally, the class "correct" or "incorrect" should be added based on the checkLetter() method of the Phrase object. Return a string of HTML for the keyboard form.
  public function displayKeyboard(){
    $keyboard = [
      ['q','w','e','r','t','y','u','i','o','p'],
      ['a','s','d','f','g','h','j','k','l'],
      ['z','x','c','v','b','n','m']
    ];

    $output = "<div id='qwerty' class='section'>"; //start output
    foreach ($keyboard as $row){
      $output .= "<div class='keyrow'>"; //start row output

      foreach ($row as $key){
        $extraClass = "";
        $disabled = "";
        //determine what chosen/wrong class to add (if already selected)
        //check if letter has been selected
        if (in_array($key, $this->phrase->getSelected())){
            if ($this->phrase->checkLetter($key)){
              $extraClass="chosen";
            } else {
              $extraClass="wrong";
            }
            $disabled = "disabled";
        } //if not, just skip over this block

        $output .= "<a href='play.php?key=$key'><button class='key $extraClass' $disabled>$key</button></a>";
      }

      $output .= "</div>"; //end row output
    }
    $output .= "</div>"; //end output
    return $output;
    /*
    <div id="qwerty" class="section">
      <div class="keyrow">
        <button class="key">q</button>
        <button class="key">w</button>
        <button class="key">e</button>
        <button class="key chosen">r</button>
        <button class="key wrong" disabled>t</button>
        <button class="key">y</button>
        <button class="key">u</button>
        <button class="key">i</button>
        <button class="key">o</button>
        <button class="key">p</button>
      </div>
      //repeat for the other 2 rows
    </div>
    */
  }

  //Display the number of guesses available. Returns string HTML of Scoreboard.
  public function displayScore(){
    $output = "<div id='scoreboard' class='section'><ol>"; //start of output
    for ($i=1; $i<=$this->lives; $i++){
      $output .= '<li class="tries"><img class="animated infinite pulse" src="images/liveHeart.png" height="35px" widght="30px"></li>';
    }
    for ($i=1; $i<=5-$this->lives; $i++){
      $output .= '<li class="tries"><img src="images/lostHeart.png" height="35px" widght="30px"></li>';
    }
    $output .= "</ol></div>"; //end of output
    return $output;
    /*
    HTML output
    <div id="scoreboard" class="section">
      <ol>
        <li class="tries"><img src="images/loseHeart.png" height="35px" widght="30px"></li> x5
      </ol>
    </div>
    */
  }


}
