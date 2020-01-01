<?php

class Phrase
{
    protected $currentPhrase = ""; //the phrase that is being hunted
    protected $selected = []; //an array of already-selected letters

    public function __construct($phrase=null, $selected=null){
      $this->currentPhrase = $phrase;
      $this->selected = $selected;
    }

    //Builds the HTML for the letters of the phrase. Each letter is presented by an empty box, one list item for each letter. See the example_html/phrase.txt file for an example of what the render HTML for a phrase should look like when the game starts. When the player correctly guesses a letter, the empty box is replaced with the matched letter. Use the class "hide" to hide a letter and "show" to show a letter. Make sure the phrase displayed on the screen doesn't include boxes for spaces: see example HTML.
    public function addPhraseToDisplay(){
      $output = "<div id="phrase" class="section"><ul>";

      //str_split (we want to keep the space delimiter) string to workable array
      $phraseArray = str_split($this->currentPhrase);
      $class="letter";
      foreach ($phraseArray as $letter){
        //check if it's a space, if so change the display class
        if ($letter==" "){
          $class="space";
        }
        $output .= "<li class='hide $class $letter'>$letter</li>"
      }
      $output .= "</ul></div>";

      /*
      HTML output
      <div id="phrase" class="section">
        <ul>
          <li class="hide letter h">h</li> (if letter)
          <li class="hide space"> </li> (if space)
        </ul>
      </div>
      */

    }

    //Checks to see if a letter matches a letter in the phrase. Accepts a single letter to check against the phrase. Returns true or false.
    public function checkLetter($letter){
      if (strpos($this->currentPhrase, $letter) !== false) {
        return true;
      } else {
        return false;
      }
    }
}
