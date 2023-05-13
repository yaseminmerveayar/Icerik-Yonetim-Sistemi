
// $("btnBlue").on("click", function() {
//   let color = document.getElementById('navColor')
//   document.getElementById("nav").style.backgroundColor = color.value;
// });

function selectColor() {
    // let color = document.getElementById('navColor').value;
    // changing the background color
    document.getElementsByClassName("navbar").style.backgroundColor = document.getElementById('navColor').value;
 }

//  <script>
    //   let colorInput = document.getElementById('navColor');
    //   // Whenever the user changes the color, the input event will be called.
    //   colorInput.addEventListener('input', () =>{
    //      document.getElementsByClassName("navbar").style.backgroundColor = colorInput.value;
    //   });
//    </script>