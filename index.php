<?php
  require_once 'connection.php';

  $sql = "SELECT * FROM albums";

  $all_albums = $conn->query($sql);

  $sqlD = "SELECT A.TITLE AS ALBUM_TITLE, A.COVER, S.TITLE AS SONG_TITLE, S.LISTENED FROM ALBUMS A JOIN SONGS S ON A.ALBUM_ID = S.ALBUM_ID  WHERE S.SONG_ID = ( SELECT S1.SONG_ID FROM SONGS S1 WHERE S1.ALBUM_ID = A.ALBUM_ID ORDER BY S1.LISTENED DESC LIMIT 1 );;
          ";

  $most_listened = $conn->query($sqlD);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARCMON</title>
    <script src="https://kit.fontawesome.com/a9d0efbe41.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-dark-subtle">
    <head>

          <!-- NAVIGATION SECTION -->
        <nav class="navbar navbar-expand-lg navbar-light bg-dark-subtle sticky-top">
            <div class="container-fluid">
              <a class="navbar-brand" href="#" style="font-size:30px; font-weight:800;">ARCMON</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto ">
                  <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#albums">Albums</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#most-listened">Most Listened</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#platform">Platform</a>
                  </li>
                </ul>
              </div>
            </div>
        </nav>

        <!-- BANNE SECTION -->
        <div class="banner">
            <div class="banner-bg">
                <img src="" alt="">
            </div>
        </div>
    </head>
    <main>
        <!-- ABOUT SECTION -->
        <div class="about" id="about">
            <p>Artic Monkeys are an English rock band formed in Sheffield in 2022. The group consists of lead singer Alex Turner, drummer Matt Helders, guitarist Jamie Cook and bassist Nick O Mallay.</p>

            <br>
            <hr style="width: 50%; margin: auto;">
            <br>

            <p class="about-2">Here you can find information about their albums, starting from their albums sales, top song and their social media.</p>
        </div>

        <!-- ALBUM CARD SECTION -->
        <h1 class="albums-sec" id="albums">ALBUMS</h1>
        <div class="album-gallery bg-secondary-subtle">

          <!-- PHP UNTUK MENDAPATKAN DATA DARI DATABASE -->
          <?php
            while ($row = mysqli_fetch_assoc($all_albums)){
          ?>
          <div class="card card-gallery" style="width: 18rem; margin: 30px;">
            <img src="<?php echo $row["COVER"]?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h4 class="card-title"><?php echo $row["TITLE"]?></h4>
              <p class="card-text">Date Released: <?php echo $row["RELEASED_DATE"]?></p>
            </div>
          </div>
          <?php  
            }
          ?>
        </div>

        <!-- MOST LISTENED SECTION -->
        <div class="most-listened" id="most-listened">
          <div class="glass-effect">
            <h1 style="margin-top: 40px;">MOST LISTENED</h1>
            <h6>Here are the most listened song from each album.</h6>
            <!-- PHP UNTUK MENDAPATKAN DATA DARI DATABASE -->
            <?php
              while ($row = mysqli_fetch_assoc($most_listened)){
              ?>
            <div class="song-list">
              <div class="album-cv">
                <img src="<?php echo $row["COVER"]?>" alt="" style="max-width: 250px; margin-right: 20px;">
              </div>
              <div class="info">
                <div class="title">
                  <h2><?php echo $row["SONG_TITLE"]?></h2>
                </div>
                <div class="album-name">
                  <h4><?php echo $row["ALBUM_TITLE"]?></h4>
                </div>
                <div class="desc">
                  <p>It is one of the songs from the AM Album with a total of <?php echo $row["LISTENED"]?> listeners on the Spotify platform.</p>
                </div>
              </div>
            </div>
            <?php
              }
            ?>
          </div>
        </div>
        <!-- PLATFORM SECTION -->
        <div class="platform" id="platform">
          <h1>LISTEN TO THEM ON</h1>
          <h3>You can find and listen to more amazing Arctic Monkeys songs on Spotify or YouTube. Click the icon below to go to Arctic Monkeys Profile.</h3>

          <div class="socials"> 
            <!-- INTERACTIVE ELEMENT (JS) CONFIRM -->
            <ul>
                <li><a href="https://www.youtube.com/channel/UC-KTRBl9_6AX10-Y7IKwKdw" id="youtubeButton" onclick="return confirmNavigate('Arctic Monkeys YouTube Channel');" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                <li><a href="https://open.spotify.com/artist/7Ln80lUS6He07XvHI8qqHH?si=J6gOM0yaRKurN2EaBExvdw" id="spotifyButton" onclick="return confirmNavigate('Arctic Monkeys Spotify Page');" target="_blank"><i class="fa-brands fa-spotify"></i></a></li>
            </ul>
        </div>
    </main>
    <footer>
    <div class="footer-menu">
        <ul>
          <li>
            <a href="#about">About</a>
          </li>
          <li>
            <a href="#albums">Albums</a>
          </li>
          <li>
            <a href="#most-listened">Most Listened</a>
          </li>
          <li>
            <a href="#platform">Platform</a>
          </li>
        </ul>
      </div>
    </footer>
    <script src="main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>