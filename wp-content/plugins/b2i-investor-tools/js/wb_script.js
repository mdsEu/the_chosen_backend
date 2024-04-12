function b2i_show1(){
  document.getElementById('b2i_Hide').style.display ='none';
  document.getElementById( 'NoEmail' ).value = "anonemail@b2itech.com";
  document.getElementById( 'NoFirstName' ).value = "Unknown";
  document.getElementById( 'NoLastName' ).value = "Unknown";
  document.getElementById( 'NoPhone' ).value = "Unknown";
}

function b2i_show2(){
  document.getElementById('b2i_Hide').style.display = 'block';
  document.getElementById( 'NoEmail' ).value = "";
  document.getElementById( 'NoFirstName' ).value = "";
  document.getElementById( 'NoLastName' ).value = "";
  document.getElementById( 'NoPhone' ).value = "";
}