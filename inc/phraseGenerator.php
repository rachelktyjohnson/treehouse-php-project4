<?php
$phrases = [
  "a piece of cake",
  "back to square one",
  "cut to the chase",
  "down to earth",
  "eat my hat",
  "fish out of water",
  "go out on a limb",
  "head over heels",
  "in a pickle",
  "jump the gun",
  "knock your socks off",
  "like father like son",
  "my cup of tea",
  "needle in a haystack",
  "on cloud nine",
  "put a sock in it",
  "quit cold turkey",
  "right off the bat",
  "spill the beans",
  "the plot thickens",
  "under the weather",
  "vice versa",
  "wild goose chase",
  "x marks the spot",
  "you shall not pass",
  "zero hour"
];

function phraseGenerator(){
  global $phrases;
  return $phrases[array_rand($phrases)];
}
