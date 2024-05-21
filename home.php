<?php
require ("connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="CSS/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Forum&display=swap">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="JS/skrypt.js"></script>

  <title>Restauracja | Mortadello</title>
</head>

<body>
  <div class="preload">
    <div class="loadingCircle"></div>
    <p class="text">Mortadello</p>
  </div>
  <div class="topBar">
    <div class="container">

      <address class="topbar-item">
        <div class="icon">
          <ion-icon name="location-outline" aria-hidden="true"></ion-icon>
        </div>

        <span class="span">Al. Kilińskiego 8 09-400 Płock</span>
      </address>

      <div class="separator"></div>

      <div class="topbar-item item-2">
        <div class="icon">
          <ion-icon name="time-outline" aria-hidden="true"></ion-icon>
        </div>

        <span class="span">Codziennie: 10.00 do 21.00</span>
      </div>
    </div>
  </div>

  <header class="header" data-header>
    <div class="container">

      <a href="#" class="logo">
        <img src="Assets/mortadello.gif" width="190" height="62.5" alt="Mortadello - Strona główna">
      </a>

      <nav class="navbar" data-navbar>

        <a href="#" class="logo">
          <img src="Assets/mortadello-logo.png" width="190" height="62.5" alt="Mortadello - Strona główna">
        </a>

        <ul class="navbar-list">

          <li class="navbar-item">
            <a href="#home" class="navbar-link hover-underline active">
              <div class="separator"></div>

              <span class="span">Strona główna</span>
            </a>
          </li>

          <li class="navbar-item">
            <a href="#menu" class="navbar-link hover-underline">
              <div class="separator"></div>

              <span class="span">Menu</span>
            </a>
          </li>

          <li class="navbar-item">
            <a href="#onas" class="navbar-link hover-underline">
              <div class="separator"></div>

              <span class="span">O nas</span>
            </a>
          </li>

          <li class="navbar-item">
            <a href="Rezerwacja/rezerwacjaStrona.php" class="navbar-link hover-underline">
              <div class="separator"></div>

              <span class="span">Rezerwacja</span>
            </a>
          </li>

          <li class="navbar-item">
            <a href="#kontakt" class="navbar-link hover-underline">
              <div class="separator"></div>

              <span class="span">Kontakt</span>
            </a>
          </li>

          <li class="navbar-item">
            <a href="Login-Register/loginPage.php" class="navbar-link hover-underline">
              <div class="separator"></div>

              <span class="span">Zaloguj się</span>
            </a>
          </li>

        </ul>
  </header>

  <main>
    <article>
      <section class="hero text-center" id="home">
        <ul class="hero-slider" data-hero-slider>

          <li class="slider-item active" data-hero-slider-item>

            <div class="slider-bg">
              <video id="background-video" autoplay loop muted>
                <source src="Assets/mortadello-tlo.mp4" type="video/mp4" class="vid-cover">
              </video>
            </div>

          </li>

        </ul>
      </section>
    </article>
  </main>
</body>

</html>