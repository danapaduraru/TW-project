function openNav() {
  document.getElementById("sidenav").style.width = "225px";
  document.getElementById("main-container").style.marginLeft = "225px";
  // document.body.style.backgroundColor = "rgba(0,0,0, 0.3)";
}

function closeNav() {
  document.getElementById("sidenav").style.width = "0";
  document.getElementById("main-container").style.marginLeft = "0px";
  document.body.style.backgroundColor = "#fff";
}

function triggerPopUp(popUpName, closeBtnName) {
  var popUp = document.getElementById(popUpName);
  var closeBtn = document.getElementsByClassName(closeBtnName)[0];

  if (popUp.style.display == "" || popUp.style.display == "none") {
    popUp.style.display = "block";
  }

  closeBtn.onclick = function () {
    popUp.style.display = "none";
  }

  window.onclick = function (event) {
    if (event.target == popUp) {
      popUp.style.display = "none";
    }
  }
}