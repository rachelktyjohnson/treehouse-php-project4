//event listener for when the physical keyboard is pressed
window.addEventListener('keypress', (e) => {
  //check the key is alpha
  if(/[a-z]/i.test( e.key )){
    let keypressed = e.key.toLowerCase();
    window.location.href = `play.php?key=${keypressed}`;
  }

  //check that the key pressed isn't already in the selected range

  //take the key and pass it to the page through GET (play.php/?key=KEYPRESSED)

});
