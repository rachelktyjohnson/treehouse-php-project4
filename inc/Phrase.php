<?php

class Phrase
{
    protected $currentPhrase = ""; //the phrase that is being hunted
    protected $selected = []; //an array of already-selected letters
    protected $correct = [];

    public function __construct($phrase=null, $selected=null){
      if ($phrase!=null){
        $this->currentPhrase = $phrase;
      }
      if ($selected!=null){
        $this->selected = $selected;
      }
    }

    public function getCurrentPhrase(){
      return $this->currentPhrase;
    }

    public function getSelected(){
      return $this->selected;
    }

    public function appendSelected($addition){
      array_push($this->selected, $addition);
    }

    public function getCorrect(){
      return $this->correct;
    }

    public function appendCorrect($addition){
      array_push($this->correct, $addition);
    }

    //Builds the HTML for the letters of the phrase. Each letter is presented by an empty box, one list item for each letter. When the player correctly guesses a letter, the empty box is replaced with the matched letter. Use the class "hide" to hide a letter and "show" to show a letter. Make sure the phrase displayed on the screen doesn't include boxes for spaces: see example HTML.
    public function addPhraseToDisplay(){
      $output = '<div id="phrase" class="section"><ul>'; //start of output

      //str_split (we want to keep the space delimiter) string to workable array
      $phraseArray = str_split($this->currentPhrase);


      //loop through the array and treat it accordingly
      foreach ($phraseArray as $letter){

        //check if it's a space or letter
        if ($letter==" "){
          $spaceorletter="space";
        } else {
          $spaceorletter="letter";
        }

        //check if it's been selected
        if(in_array($letter,$this->selected)){
          $hideorshow = "show";
        } else {
          $hideorshow = "hide";
        }

        $output .= "<li class='$hideorshow $spaceorletter $letter'>$letter</li>";
      }

      $output .= "</ul></div>"; //end of output

      return $output;
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
