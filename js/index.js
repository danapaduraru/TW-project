function openNav() {
    document.getElementById("sidenav").style.width = "250px";
    document.getElementById("main-container").style.marginLeft = "250px";
    document.body.style.backgroundColor = "rgba(0,0,0, 0.3)";
  }
  
  function closeNav() {
    document.getElementById("sidenav").style.width = "0";
    document.getElementById("sidenav").style.color = "#111";
    document.getElementById("main-container").style.marginLeft= "0";
    document.body.style.backgroundColor = "#fff";
  }