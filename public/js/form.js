
// function docheck() {
//     if (document.getElementById("check").checked) {
//         document.getElementById("forms").style.zIndex = "-1";
//         document.getElementById("forms").style.transition = "all -1.5s";
//         document.getElementById("explore").style.zIndex = "-1";
//         document.getElementById("explore").style.transition = "all -1.5s";
//         document.getElementById("search").style.zIndex = "-1";
//         document.getElementById("search").style.transition = "all -1.5s";
//         document.getElementById("container_main").style.zIndex = "-1";
//         document.getElementById("container_main").style.transition = "all 1.5s";

//     } else {
//         document.getElementById("forms").style.zIndex = "1";
//         document.getElementById("forms").style.transition = "all 1.5s";
//         document.getElementById("explore").style.zIndex = "1";
//         document.getElementById("explore").style.transition = "all 1.5s";
//         document.getElementById("search").style.zIndex = "1";
//         document.getElementById("search").style.transition = "all 1.5s";
//     }
// }
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  console.log("clicked");
    document.getElementById("myDropdown").classList.toggle("show");
    }
    
    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
//Add image button
    // const file = document.querySelector('#file');
    // file.addEventListener('change', (e) => {
    //   // Get the selected file
    //   const [file] = e.target.files;
    //   // Get the file name and size
    //   const { name: fileName, size } = file;
    //   // Convert size in bytes to kilo bytes
    //   const fileSize = (size / 1000).toFixed(2);
    //   // Set the text content
    //   const fileNameAndSize = `${fileName} - ${fileSize}KB`;
    //   document.querySelector('.file-name').textContent = fileNameAndSize;
    // });
    

