function hamburger() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
      x.className += " responsive";
    } else {
      x.className = "topnav";
    }
}

function changeToGb(){
  document.cookie = "language= ; expires=Thu, 18 Dec 2022 12:00:00 UTC; path=index.php";
  document.cookie = "language=en; expires=Thu, 18 Dec 2022 12:00:00 UTC; path=index.php";
  document.getElementById("languageSetting").className = "flag-icon flag-icon-gb";
}

function changeToIta(){
  document.cookie = "language= ; expires=Thu, 18 Dec 2022 12:00:00 UTC; path=index.php";
  document.cookie = "language=it; expires=Thu, 18 Dec 2022 12:00:00 UTC; path=index.php";
  document.getElementById("languageSetting").className = "flag-icon flag-icon-it";
  }

function deleteCoo(){
    document.cookie = "orario= ; expires=Thu, 18 Dec 2013 12:00:00 UTC; path=index.php";
    alert('cookie cancellato!');
}