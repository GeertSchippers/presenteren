<?php                                                                               // geeft aan dat code PHP is todat er een sluit teken komt
  $errorMessage = '';                                                               // maakt de variable errorMessage met als waarde een lege string
  if ($_SERVER["REQUEST_METHOD"] == "POST") {                                       //Maakt een if statement kijkt of de reqeust methode gelijk is aan POST
    $username = $_POST["username"];                                                 //Maakt een variable genaamt username met als waarde value van $_POST['usernam']
    $query = find_user($username);                                                  //Maakt een variable met daarin de functie find_user met als argument de variable username
    $user = mysqli_fetch_assoc($query);                                             //maakt een variable user waarin de informatie van de database worden opgeslagen
    $hash = $user["password"];                                                      //maakt een variable waarim het wachtwoord van de user word opgeslagen
    $valid = password_verify($_POST["password"],$hash);                             //check of het wachtwoord van de POST hetzelfde is als het wachtwoord van de database
    $admin = $user["admin"] == 1;                                                   //check of the user een admin is door het te vergelijken met 1
    if ($valid && $admin) {                                                         //als het wachterwoord true is EN de user een admin is voer dit uit
      $_SESSION['user'] = $user;                                                    //zet de Session[user] gelijk aan de variable user
      header('Location: ./admin/index.php');                                        //verander de locatie van de website naar de admin/index
    } elseif ($valid) {                                                             //als het vorige statement niet klopte voer dit uit
      $_SESSION['user'] = $user;                                                    //zet de session user gelijk aan user
      header('Location: ./guest/index.php');                                        //verande de locatie van de website naar de guest/index
    } else {                                                                        // als de vorige statements niet klopten voer deze uit
      $errorMessage = "Incorrect username and/or password. Please try again.";      //verander de variable errorMessage naar de sting
    }                                                                               //sluit de else af
  }                                                                                 //sluit de if af
 ?>                                                                                 <!--sluit php af -->

<img class='logo' src='<?= './images/surfboard.png'; ?>' />                         <!-- uit een image aan met de class logo -->

<div class='form-container'>                                                        <!-- maak een div aan met de class form-container -->
  <p class='error'><?= $errorMessage; ?></p>                                        <!-- maakt een p met de class error en daarin een de variable errorMessage -->
  <form method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"><!-- maak een form met die zijn informatie POST wanner er op de knop word gedrukt htmlspecialchars veranders specialle karacters naar HTML karaters om aanvallen via code incetion kunen worden tegen gehouden $_SERVER["PHP_SELF"] is een super variable die verstuurde data opvacht op de zelfde pagina als het form zodat de user een error kan krijgen op de zelfde pagina -->
    <input type='text' id='username' name='username' placeholder='Username...'>     <!-- maakt een input veld aan waarin de user zijn username moet invullen  -->

    <input type='password' id='password' name='password' placeholder='Password...'> <!-- maakt een input veld aan waarin de user zijn passowrd moet invullen -->

    <input type='submit' value='submit'>                                            <!-- maakt een knop waarop de user kan druken zodra hij zijn username en wachtwoord heeft ingevult -->
  </form>                                                                           <!-- sluit de form af -->
</div>                                                                              <!-- sluit de div af -->