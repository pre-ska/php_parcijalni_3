<!DOCTYPE html>
<!-- autor: Predrag Š. -->
<html>
  <head>
    <title>Parcijalni zadatak 3 - Rezervacije</title>
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

      table {
        margin: 50px auto;
        border-collapse: collapse;
      }

      th {
        font-weight: 600;
        padding: 12px 0;
        color: white;
        background-color: #1c487a;
      }

      tr:hover {
        background: #EDF3FF;
      }

      td {
        padding: 10px 0;
        text-align: center;
        border-bottom: 1px solid #EDF3FF;
        cursor: default;
        color: #1c487a;
      }

      a {
        text-decoration: none;
      }


      .btn {
          position: fixed;
          top: 20px;
      }

      .left {
        left: 20px;
        border: 1px solid #EDF3FF;
        box-sizing: border-box;
        border-radius: 5px;
        padding: 5px 20px;
      }

      .left:hover {
        background-color: #EDF3FF;
      }

      .right {
          min-width: 32px;
          right: 20px;
      }

      </style>

  </head>
  <body> 
  <a href="https://github.com/pre-ska/php_parcijalni_3" title="Github" target='_blank' class='btn right' >
        <img src="https://i.imgur.com/wUYw1nr.png" alt="">
  </a>

  <a href='index.php' alt='github'  class='btn left'>Natrag</a>
  <?php

    include 'db_connection.php';

    function  dani($dan) {

      switch($dan) {

        case 'PO':
          return  'Ponedjeljak';
  
        case 'UT':
          return  'Utorak';
        
        case 'SR':
          return  'Srijeda';
        
        case 'CE':
          return  'Četvrtak';
        
        case 'PE':
          return  'Petak';
        
        default:
          return  $dan;
      }
    }

    if(isset($_GET["dvorana"])) {

      $dvorana = $_GET["dvorana"];

      $upit = " SELECT nazPred, oznVrstaDan, sat 
                FROM rezervacija 
                JOIN pred 
                ON rezervacija.sifPred=pred.sifPred 
                WHERE rezervacija.oznDvorana='$dvorana'
                ORDER BY oznVrstaDan ASC";

      $rez = mysqli_query($mysqli, $upit);

      if ($rez) {
        
        if ($rowcount=mysqli_num_rows($rez) > 0) {

          echo "<h1>Rezervacije dvorane $dvorana</h1>
            <table width='600'>
              <tr>
                <th>Dan</th>
                <th>Sat</th>
                <th>Predmet</th>
              </tr>";

          while ($red = mysqli_fetch_array($rez)) {
              echo "<tr>
              <td>".dani($red['oznVrstaDan'])."</td>
              <td>".$red['sat']."</td>
              <td>".$red['nazPred']."</td></tr>";   
          }

          echo "</table>";

        } else  echo "<h1>Nema rezervacija za traženu dvoranu</h1>";
      
      } else echo 'Pogreska kod SQL upita';

    } else echo "<h1>404</h1>";

  ?>
  <script>
    let niz = [...document.getElementsByTagName('td')];

    let obj = {
      Ponedjeljak: [],
      Utorak: [],
      Srijeda: [],
      Četvrtak: [],
      Petak: []
    }
   
    for (let i = 0; i < niz.length; i+=3) {
      let sat;

      if (niz[i+1].textContent.length < 2) sat = `0${niz[i+1].textContent}:00`;
      else sat = `${niz[i+1].textContent}:00`;

      let obj = {
        dan: niz[i].textContent,
        sat,
        pred: niz[i+2].textContent
      };

      obj[niz[i].textContent].push(obj)
    }

    for (let key in obj) {
      if (obj[key].length) 
        obj[key].sort((a,b) => (a.sat > b.sat) ? 1 : ((b.sat > a.sat) ? -1 : 0));
    }

    let noviNiz = [...obj.Ponedjeljak, ...obj.Utorak, ...obj.Srijeda, ...obj.Četvrtak, ...obj.Petak ]

    for (let i=0; i<niz.length; i+=3) {
      let nObj = noviNiz[i/3];

      niz[i].textContent = nObj.dan;
      niz[i+1].textContent = nObj.sat;
      niz[i+2].textContent = nObj.pred;
    }
  
  </script>


  </div>

  </body>
</html>
