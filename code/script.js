let showed = [];
let index = 0;
let page = 1;
let stringpage = page.toString();
let sortation =
  "https://api.themoviedb.org/3/movie/popular?api_key=a0de165b02ebc311a75d06031d5d107f&language=en-US&page=";

// funkcija za dobivanje cookies
function getCookie(imecookie) {
  let ime = imecookie + "="; // npr. UserKeyGen=
  let dekodcookie = decodeURIComponent(document.cookie); //dekodira piškotke
  let ca = dekodcookie.split(";"); //splita string piškotkov pri ;
  for (let i = 0; i < ca.length; i++) {
    //loop ki gre cez celo dolzino stringa piškotkov
    let c = ca[i]; //nastavi c na index v stringu piškotov
    while (c.charAt(0) == " ") {
      //dokler je na prvem mestu ' ' se premika za eno naprej.
      c = c.substring(1);
    }
    if (c.indexOf(ime) == 0) {
      //če je na prvem mestu c-ja niz ime izpiše ime
      return c.substring(ime.length, c.length);
    }
  }
  return "";
}

//function za LOGIN FAILED/REGISTER

//FUNCTION FOR PROFILE ACCESS
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("mySidenav").style.zIndex = 100000;
  document.getElementById("userkeygenDisplay").innerHTML =
    getCookie("UserKeyGen");
  document.getElementById("userkeygenDisplay").style.display = "block";
  document.getElementById("currentuser").style.display = "block";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("userkeygenDisplay").style.display = "none";
  document.getElementById("currentuser").style.display = "none";
}

function openNav1() {
  document.getElementById("mySidenav1").style.width = "250px";
  document.getElementById("mySidenav1").style.zIndex = 100000;
  console.log("OPENED NAV1");
}

function closeNav1() {
  document.getElementById("mySidenav1").style.width = "0";
}

//function for search
function SortByTopRated() {
  sortation =
    "https://api.themoviedb.org/3/movie/top_rated?api_key=a0de165b02ebc311a75d06031d5d107f&language=en-US&page=";
  FetchMovie();
}

function SortByPopular() {
  sortation =
    "https://api.themoviedb.org/3/movie/popular?api_key=a0de165b02ebc311a75d06031d5d107f&language=en-US&page=";
  FetchMovie();
}
function SortByPlayingNow() {
  sortation =
    "https://api.themoviedb.org/3/movie/now_playing?api_key=a0de165b02ebc311a75d06031d5d107f&language=en-US&page=";
  FetchMovie();
}

// FUNCTION TO CHECK IF LIKES OLDER THAN 20 MINUTES, IF NOT DELETE LIKED MOVIES
async function DeleteMovies() {
  let key = getCookie("UserKeyGen");
  let user = getCookie("username");
  let deleteData = { username: user, keygen: key };
  
  try {
    let response = await fetch("./deleteliked.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(deleteData),
    });

    if (response.ok) {
      let responseData = await response.json();
      
      if (responseData.success) {
        console.log("Deletion successful");
      } else {
        console.log("Deletion failed");
      }
    } else {
      console.log("Error: " + response.status);
    }
  } catch (err) {
    console.error("Error: " + err);
  }
}

//LogOut Function
async function LogOut() {
  let key = getCookie("UserKeyGen");
  let user = getCookie("username");
  let deleteData = { username: user, keygen: key, logout: 1 };
  
  try {
    let response = await fetch("./deleteliked.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(deleteData),
    });

    if (response.ok) {
      let responseData = await response.json();
      
      if (responseData.success) {
        document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "UserKeyGen=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/Vaje/Homework3/matura-app;";
        document.cookie = "conformation=0; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.location.href = "./frontpagehtml.php";
      } else {
        console.log("Logout failed");
      }
    } else {
      console.log("Error: " + response.status);
    }
  } catch (err) {
    console.error("Error: " + err);
  }
}

//Premakne na matched movies
function ToMatchedMovies() {
  document.location.href = "./MatchedMovies.html";
}

function ToMain() {
  document.location.href = "./mainhtml.php";
}

//nariše matches
async function PopulateMatched() {
  //get CheckKey
  let ChkKey = getCookie("UserKeyGen");
  let username = getCookie("username");

  // NASTAVITEV ZA PHP/mySQLI--------------------------------------------------------------------------
  let datatobesent = { userkey: ChkKey, userid: username };
  // DOBIM MATCHE
  let similarcheck = await fetch("./GetMatches.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(datatobesent),
  })
    .then((check) => {
      return check.json();
    })
    .catch((err) => {
      console.error(err);
    });

  //DOBI PODATKE O FILMU
  //fetch movie data

  console.log(similarcheck);
  console.log(similarcheck.length);
  let stmatched = similarcheck.length;
  let columnpos = 4;
  let NumOfMatcheds = [];
  for (let i = 0; i < stmatched; i++) {
    let id = similarcheck[i]["id"];

    NumOfMatcheds[id] = similarcheck[i]["amount"];

    let title = await fetch(
      "https://api.themoviedb.org/3/movie/" +
        id +
        "?api_key=a0de165b02ebc311a75d06031d5d107f&language=en-US",
      {}
    )
      .then((response) => {
        return response.json();
      })
      .catch((err) => {
        console.error(err);
      });

    let img = document.createElement("img");
    presentMatchedMovie(id, NumOfMatcheds);
    console.log(img.id);

    let column = document.createElement("column" + columnpos);
    column.classList.add("column");
    let row = document.getElementById("row1");

    img.src = "http://image.tmdb.org/t/p/original/" + title.poster_path;
    img.style.width = "280px";
    img.id = id;

    img.addEventListener("click", function (event) {
      console.log(event.target.id);
      presentMatchedMovie(event.target.id, NumOfMatcheds);
    });

    column.appendChild(img);
    row.appendChild(column);
    document.body.appendChild(row);

    if (columnpos > 1) {
      columnpos--;
    } else columnpos = 4;
  }
}

async function presentMatchedMovie(id, amount) {
  let title = await fetch(
    "https://api.themoviedb.org/3/movie/" +
      id +
      "?api_key=a0de165b02ebc311a75d06031d5d107f&language=en-US",
    {}
  )
    .then((response) => {
      return response.json();
    })
    .catch((err) => {
      console.error(err);
    });

  let modal = document.getElementById("modal1");
  let modalcontent = document.getElementsByClassName("modal-content")[0];
  let openButt = document.getElementById(id);
  let closeButt = document.getElementsByClassName("close")[0];

  //adds background
  // modalcontent.style.backgroundImage="url(http://image.tmdb.org/t/p/original/"+title.backdrop_path+")"; // TOLE NASTIMA BACKGROUND KOT MOVIE POSTER
  //adds eventlistener on click;

  openButt.addEventListener("click", function () {
    document.getElementById("ModalTitle").innerHTML = title.title;
    document.getElementById("ModalImage").src =
      "http://image.tmdb.org/t/p/original/" + title.poster_path;
    document.getElementById("ModalSummary").innerHTML = title.overview;
    let genresstring = "";
    for (let i = 0; i < title.genres.length; i++) {
      if (i + 1 != title.genres.length) {
        genresstring += title.genres[i].name + ", ";
      } else {
        genresstring += title.genres[i].name;
      }
    }
    document.getElementById("ModalGenres").innerHTML = genresstring;
    document.getElementById("ModalRuntime").innerHTML = title.runtime;
    document.getElementById("ModalReleaseDate").innerHTML = title.release_date;
    document.getElementById("NumberOfMatches").innerHTML = amount[id];
    modal.style.display = "block";
  });

  // Add an event listener to the close button
  closeButt.addEventListener("click", function () {
    // Get a reference to the iframe element
    var videoIframe = document.getElementById("TrailerVideo");

    // Pause the video by setting the src attribute to an empty string
    videoIframe.src = "";
  });

  //makes close button close
  closeButt.addEventListener("click", function () {
    modal.style.display = "none";
  });

  //makes close anywhere else
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };

  let trailer = await fetch(
    "https://api.themoviedb.org/3/movie/" +
      id +
      "/videos?api_key=a0de165b02ebc311a75d06031d5d107f&language=en-US",
    {}
  )
    .then((response) => {
      return response.json();
    })
    .catch((err) => {
      console.error(err);
    });
  if (trailer.results.length > 1) {
    document.getElementById("TrailerVideo").src =
      "https://www.youtube.com/embed/" + trailer.results[1].key;
  } else {
    document.getElementById("TrailerVideo").src =
      "https://www.youtube.com/embed/" + trailer.results[0].key;
  }
}

//FUNKCIAJ KI NAREDI MODAL POPUP DA PREDSTAVI FILM
function presentMovie() {
  let modal = document.getElementById("modal1");
  let openButt = document.getElementById("imgInfo");
  let closeButt = document.getElementsByClassName("close")[0];

  //makes open button open
  openButt.addEventListener("click", function () {
    modal.style.display = "block";
  });

  //makes close button close
  closeButt.addEventListener("click", function () {
    modal.style.display = "none";
    // Get a reference to the iframe element
    var videoIframe = document.getElementById("TrailerVideo");

    let source = videoIframe.src;

    // Pause the video by setting the src attribute to source
    videoIframe.src = source;
  });

  //makes close anywhere else
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";

      var videoIframe = document.getElementById("TrailerVideo");

      let source = videoIframe.src;

      // Pause the video by setting the src attribute to source
      videoIframe.src = source;
    }
  };
}

// FUNKCIJA ZA CHECK MATCH---------------------------------------------------------------

async function checkMatch() {
  //get CheckKey
  let ChkKey = getCookie("UserKeyGen");

  // NASTAVITEV ZA PHP/mySQLI--------------------------------------------------------------------------
  let datatobesent = { CheckKey: ChkKey };

  let similarcheck = await fetch("./checkMatch.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(datatobesent),
  })
    .then((check) => {
      return check.json();
    })
    .catch((err) => {
      console.log("Error: ");
      console.error(err);
    });
  if (similarcheck.length > 0) {
    alert("There's a match! Please proceed to the 'Matched' page to check.");
  }
}

function startChecking() {
  setInterval(async () => {
    checkMatch();
  }, 1000);
}

// funkcija za generateanje random stringa-------------------------------------------------------------------------------------
function generateRandomString(length) {
  return Math.random().toString(20).substr(2, length);
}

// FUNKCIJA ZA IZDELAVO SVOJEGA KEYA
function GenerateMyKey() {
  // MODAL CREATION
  let modal = document.getElementsByClassName("modal")[0];
  let Content = document.getElementsByClassName("modal-content")[0];
  modal.style.display = "block";
  document.getElementById("myForm").style.display = "none";
  let span = document.getElementsByClassName("close")[0];
  span.onclick = function () {
    modal.style.display = "none";
  };

  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };

  let para = document.getElementById("KEYGEN");
  let newUserKey = generateRandomString(10);
  para.innerHTML = newUserKey;
  para.style.display = "block";
  document.getElementById("MyCont").style.display = "block";
  document.getElementById("MyCont").onclick = function () {
    document.cookie = "UserKeyGen=" + newUserKey;
    window.location = "./mainhtml.php";
  };
}

//FUNKCIJA ZA VPIS PRIJATELJEVEGA KEYA
function InsertFriendKey() {
  let modal = document.getElementsByClassName("modal")[0];
  modal.style.display = "block";
  let span = document.getElementsByClassName("close")[0];
  span.onclick = function () {
    modal.style.display = "none";
  };

  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
  document.getElementById("KEYGEN").style.display = "none";
  document.getElementById("MyCont").style.display = "block";
  document.getElementById("myForm").style.display = "block";
  document.getElementById("MyCont").onclick = function () {
    let newFriendKey = document.getElementById("friendkey").value;
    document.cookie = "UserKeyGen=" + newFriendKey;
    window.location = "./mainhtml.php";
  };
}

// VARIABLE ZA SCROLLING
let yscroll = 1;
setInterval(function () {
  if (document.getElementById("shortinfobackg") != null) {
    document.getElementById("shortinfobackg").scrollBy(0, yscroll);
    yscroll += 0.025;
    if (yscroll > 5) {
      yscroll = 1;
      document.getElementById("shortinfobackg").scrollTo(0, 0);
    }
  }
}, 80);

//--------------------FUNCTION ZA PRIKAZ FILMA TAKOJ NA ZAČETKU----------------------------------------------------
async function FetchMovie() {
  console.log(sortation);
  console.log(stringpage);

  //fetch movies
  let titles = await fetch(sortation + stringpage, {})
    .then((response) => {
      return response.json();
    })
    .catch((err) => {
      console.error(err);
    });

  // dobi random index od 0 do 20 in shrani filme v array showed, da se ne ponavljajo filmi----------------------------------------------------------------------------

  do {
    index = Math.floor(Math.random() * 20);
  } while (showed.includes(titles.results[index].id));

  showed.push(titles.results[index].id);

  console.log(showed);
  // začne dobijati podatke z drugih strani če smo pregledali že 20 filmov.
  if (showed.length % 20 == 0) {
    page++;
    stringpage = page.toString();
  }

  // NASTAVITEV SLIKE-------------------------------------------------------------------------------------
  document.getElementById("presentimg").src = "http://image.tmdb.org/t/p/original/" + titles.results[index].poster_path;
  document.getElementById("shortinfobackg").innerHTML = titles.results[index].title;
  document.getElementById("MovieTitle").innerHTML = titles.results[index].title;
  console.log(document.getElementById("MovieTitle").innerHTML);
  document.getElementById("MovieID").innerHTML = titles.results[index].id;
  document.getElementById("shortinfobackg").scrollTo(0, 0);

  // adds overview to present img
  //document.getElementById("MovieSummary").innerHTML=titles.results[index].overview;

  // NASTAVITVE ZA MODAL------------------------------------------------------------------------
  let title = await fetch(
    "https://api.themoviedb.org/3/movie/" +
      titles.results[index].id +
      "?api_key=a0de165b02ebc311a75d06031d5d107f&language=en-US",
    {}
    )
    .then((response) => {
      return response.json();
    })
    .catch((err) => {
      console.error(err);
    });
  document.getElementById("ModalTitle").innerHTML = title.title;
  document.getElementById("ModalImage").src = "http://image.tmdb.org/t/p/original/" + title.poster_path;
  document.getElementById("ModalSummary").innerHTML = title.overview;

  let genresstring = "";

  for (let i = 0; i < title.genres.length; i++) {
    if (i + 1 != title.genres.length) {
      genresstring += title.genres[i].name + ", ";
    } else {
      genresstring += title.genres[i].name;
    }
  }
  document.getElementById("ModalGenres").innerHTML = genresstring;
  document.getElementById("ModalRuntime").innerHTML = title.runtime;
  document.getElementById("ModalReleaseDate").innerHTML = title.release_date;

  let trailer = await fetch(
    "https://api.themoviedb.org/3/movie/" +
      document.getElementById("MovieID").innerHTML +
      "/videos?api_key=a0de165b02ebc311a75d06031d5d107f&language=en-US",
    {}
  )
    .then((response) => {
      return response.json();
    })
    .catch((err) => {
      console.error(err);
    });

  if (trailer.results.length == 0) {
    document.getElementById("TrailerVideo").src =
    "https://www.youtube.com/embed/dQw4w9WgXcQ";
    return;
  }


  if (trailer.results.length > 1) {
    document.getElementById("TrailerVideo").src =
      "https://www.youtube.com/embed/" + trailer.results[1].key;
  } else {
    document.getElementById("TrailerVideo").src =
      "https://www.youtube.com/embed/" + trailer.results[0].key;
  }
}

//--------------------MOVIE LIKE-----------------------------------
async function LikeMovie() {
  //get username
  let setUsername = getCookie("username");

  //get CheckKey
  let ChkKey = getCookie("UserKeyGen");

  // NASTAVITEV ZA PHP/mySQLI
  let moviesetTitle = document.getElementById("MovieTitle").innerHTML;
  let moviesetId = document.getElementById("MovieID").innerHTML;
  let datatobesent = {
    MovieId: moviesetId,
    MovieName: moviesetTitle,
    UserName: setUsername,
    CheckKey: ChkKey,
  };

  console.log(datatobesent);
  let similarcheck = await fetch("./writetodatabase.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(datatobesent),
  })
    .then((response) => {
      let tmp = response.json();
      // console.log(tmp)
      return tmp;
    })
    .catch((error) => {
      console.error("Error:", error);
    });
  console.log("similarcheck: ");
  console.log(similarcheck);
  if (similarcheck.data == true) {
    alert("There's a match! Please proceed to the 'Matched' page to check.");
  }
  FetchMovie();
}

function DislikeMovie() {
  FetchMovie();
}

function goToLogIn() {
  window.location.href = "./frontpagehtml.php";
}

function returnHome() {
  window.location.href = "./index.php";
}


function closePromptModal() {
  document.getElementById("promptModal").style.display = "none";
}

function openPromptModal() {
  document.getElementById("promptModal").style.display = "block";
}
