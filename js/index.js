function openNav() {
    document.getElementById("sidenav").style.width = "225px";
    document.getElementById("main-container").style.marginLeft = "225px";
    // document.body.style.backgroundColor = "rgba(0,0,0, 0.3)";
  }
  
  function closeNav() {
    document.getElementById("sidenav").style.width = "0";
    document.getElementById("main-container").style.marginLeft= "0px";
    document.body.style.backgroundColor = "#fff";
  }