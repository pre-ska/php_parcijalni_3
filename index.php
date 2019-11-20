<!DOCTYPE html>
<!-- autor: Predrag Š. -->
<html>
  <head>
    <title>Parcijalni zadatak 3 - Dvorane</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <head>
      <style>
        html, body {
          font-family: 'Lato', sans-serif;
          color: #1c487a;
          text-align: center;
        }

        .linkBox {
          line-height: 85px;
          color: #1c487a;
          font-size: 24px;
          padding: 5px 10px;
          border-radius: 5px;
          text-align: center;
        }

        .linkBox:hover {
          background: #EDF3FF;
        }

        a {
          text-decoration: none;
        }

        .containerLinks {
          width: 560px;
          display: grid;
          grid-gap: 15px;
          grid-template-columns: repeat(5, 100px);
          grid-template-rows: repeat(2, 100px);
          grid-auto-flow: row;
          margin: 50px auto;
        }
        
        .logo {
          min-width: 32px;
          position: fixed;
          top: 20px;
          right: 20px;
        }
      </style>
  </head>
  <body> 
    <a href="https://github.com/pre-ska/php_parcijalni_3"  title="Github" target='_blank' class='logo' >
          <img src="https://i.imgur.com/wUYw1nr.png" alt="">
    </a>
    <?php
      include 'db_connection.php';

      echo "<h1>Dvorane sa rezervacijom:</h1><div class='containerLinks'>";

      $upit = "SELECT DISTINCT dvorana.* FROM dvorana INNER JOIN rezervacija ON dvorana.oznDvorana = rezervacija.oznDvorana ORDER BY oznDvorana ASC";

      if ($rez = $mysqli->query($upit)) {
        while ($red = $rez->fetch_assoc()) {
          $tmp = $red['oznDvorana'];

          echo "
            <a href=rezervacija.php?dvorana=".$tmp.">
              <div class='linkBox'>".$tmp."</div>
            </a>";
        }
      }
    ?>
    </div>
  </body>
</html>
