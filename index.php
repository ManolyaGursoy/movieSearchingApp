<?php
require('pdo.php');
require('ImdbApi.php');
  if (isset($_GET['search']) && isset($_GET['text'])) {
    $imdb = new MoviesandSeries ($_GET['text']);
    $allData=$imdb->search();
  }
?>

<?php

if (isset($_GET['imdbID']) && isset($_GET['Title']) && isset($_GET['Type']) && isset($_GET['Year']) && isset($_GET['Poster'])):
    $movie_id = $_GET['imdbID'];
    $title = $_GET['Title'];
    $type = $_GET['Type'];
    $year = $_GET['Year'];
    $poster = $_GET['Poster'];

    $stmt = $conn->prepare('INSERT INTO favorites (movie_id, Title, Type, Year, Poster) VALUES (:movie_id, :Title, :Type, :Year, :Poster)');
    $stmt->execute(array(
            ':movie_id' => $movie_id,
            ':Title' => $title,
            ':Type' => $type,
            ':Year' => $year,
            ':Poster' => $poster)
    );

    endif;

 ?>

<!DOCTYPE html>
<html>
<head>
  <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

<title>Search Movie and Tv Series</title>
</head>
<body>

  <div class="container mt-2">
      <div class="row">
        <img class="img-fluid" max-width: 100%; height: auto; src="filmRoll.jpg" alt="Film Roll">
      </div>
      <div class="row text-center mt-3">
        <h1>Search Movie and Tv Series</h1>
  </div>
<div class="row text-center mt-3">
  <form >
          <input type="text" name="text" placeholder="Enter title here...">
          <input type="submit" name="search" value="Search">
  </form>
</div>
 
    <div class="list-group mt-3">
      <?php
        if (isset($allData)):
          $json = json_decode($allData, true);
        //  print_r($json);
            foreach ($json['Search'] as $key => $value) :
      ?>
  <div class="list-group-item list-group-item-action">
    <img src="<?php echo $value['Poster'] ?>" class="rounded" width="150" height="200">
        <?php echo "<b>".$value['Title']."</b>"." / ".($value['Year'])." / ".$value['Type']?>
          <a href="index.php?imdbID=<?php echo $value['imdbID'] ?>&Title=<?php echo $value['Title'] ?>&Year=<?php echo $value['Year'] ?>&Type=<?php echo $value['Type'] ?>&Poster=<?php echo $value['Poster'] ?>" class="">
              <input type="button" name="favorite" class="btn float-end">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                </svg>
              </input>
          </a>
  </div>

      <?php
          endforeach;
          endif;
      ?>
    
  <div class="container mt-4" style="border:1px solid #cecece;" >
    <?php $stmt = $conn->query("SELECT Title, Type, Year, movie_id FROM favorites"); ?>
      <table class="table table-striped">
        <h3 class="text-center mt-3 mb-3">Your Favorites</h3>
          <thead>
              <tr>
                <th scope="col">Title</th>
                <th scope="col">Type</th>
                <th scope="col">Year</th>
                <th scope="col">Movie ID</th>
              </tr>
          </thead>
            <tbody>
              <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC) ) { ?>
              <tr>
                <th scope="row"><?php echo(htmlentities($row['Title'])); ?></th>
                <td><?php echo(htmlentities($row['Type'])); ?></td>
                <td><?php echo(htmlentities($row['Year'])); ?></td>
                <td><?php echo(htmlentities($row['movie_id'])); ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </body>
</html>
