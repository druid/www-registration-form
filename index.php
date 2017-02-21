<!doctype html>
<!--
  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html lang="et">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Tor varjatud teenus</title>

    <link rel="shortcut icon" href="images/favicon.png">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.2.0/material.teal-red.min.css">
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">
      <div class="demo-ribbon"></div>
      <main class="demo-main mdl-layout__content">
        <div class="demo-container mdl-grid">
          <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
          <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col">
            <h3>Tor varjatud teenus</h3>
              <p>
                Tere! Oled leidnud infoturbe kursuse raames loodud Tor varjatud teenuse.                
              </p>
<?php
  session_start();

  // Check for Tor2Web proxy
  // https://chloe.re/2016/05/20/killing-tor2web-once-and-for-all/
  $s = $_SERVER;
  if (array_key_exists("HTTP_X_TOR2WEB",$s)
      || array_key_exists("HTTP_X_FORWARDED_PROTO",$s)
      || array_key_exists("HTTP_X_FORWARDED_HOST",$s)) {
    $_SESSION['error-message'] = 'See leht ei ole kättesaadav läbi Tor2Web proxy!';
  }

  // Parse submission
  if (isset($_POST['submit'])) {
    $f = fopen('data/students.csv', 'a');
    fwrite($f, join(';', array(
      date('c'),
      $_POST['StudentID'],
      $_POST['Name']
    )) . "\n");
    fclose($f);
    $_SESSION['ok'] = true;
  }

  if (isset($_SESSION['ok'])) {
?>
                  <div class="alert alert-success" role="alert">
                    Oled registreeritud. Täname!.
                  </div>
<?php
  } else if (isset($_SESSION['error-message'])) {
?>
              <div class="alert alert-warning" role="alert">
                <?php echo $_SESSION['error-message']; ?>
              </div>
<?php
    unset($_SESSION['error-message']); // Delete message once shown
  } else {
?>
              <p>
				Registreeri ennast allpool olevas vormis selleks, et kodutöö ülesande punkte saada.
				Tulemus ilmub tulemuste tabelisse pärast seda kui kodutöö tähtaeg on möödunud.
              </p>
<?php
    if (isset($_SESSION['submit-message'])) {
?>
              <div class="alert alert-warning" role="alert">
                <?php echo $_SESSION['submit-message']; ?>
              </div>
<?php
      unset($_SESSION['submit-message']); // Delete message once shown
    }
?>
              <form action="#" method="post">
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input" type="text" id="Name" name="Name">
                      <label class="mdl-textfield__label" for="Name">Täisnimi...</label>
                  </div>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input" type="text" id="StudentID" name="StudentID">
                      <label class="mdl-textfield__label" for="StudentID">Matriklinumber...</label>
                  </div>
                  <div class="alert alert-warning" role="alert">
					Hoiatus! Päriselt Tor kasutades ei tohiks sisestada enda identiteedile viitavat infot. Praegu on tegu kodutöö käigus tehtava erandiga.
                  </div>
                  <p>
                      <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit" name="submit">
                          Sisesta andmed
                      </button>
                  </p>
              </form>
<?php
  }
?>
          </div>
        </div>
        <footer class="demo-footer mdl-mini-footer">
          <div class="mdl-mini-footer--left-section">
          Design based on Material Design Lite by Google.
          </div>
        </footer>
      </main>
    </div>
    <script src="https://code.getmdl.io/1.2.0/material.min.js"></script>
  </body>
</html>
