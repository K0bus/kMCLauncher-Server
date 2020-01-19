<?php
  session_start();
  if(!file_exists('protected/config.json'))
    header('Location: register.php');
  if(isset($_SESSION['hash']) && $_SESSION['hash'] == json_decode(file_get_contents('protected/config.json'), true)['user']['hash'])
    header('Location: index.php');
  $error = array();
  if(isset($_POST['username']) && isset($_POST['username']))
  {
    if(!empty($_POST['username']) && !empty($_POST['password']))
    {
      $config = json_decode(file_get_contents('protected/config.json'), true);
      if($_POST['username'] == $config['user']['username'] && sha1($_POST['password']) == $config['user']['password'])
      {
        $config['user']['hash'] = sha1(microtime().$_POST['username']);
        $_SESSION['hash'] = $config['user']['hash'];
        $_SESSION['username'] = $config['user']['username'];
        file_put_contents('protected/config.json', json_encode($config));
        header('Location: index.php');
      }
      else
      {
        array_push($error, 'Identifiants incorrects !');
      }
    }
    else
    {
      array_push($error, 'Merci de remplir tous les champs !');
    }
  }
?>
<html>
    <head>
        <title>kERP - Login</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="css/module/auth.css">
        <link rel="favicon" href="img/logo.png">
        <meta charset="UTF-8">
    </head>
    <body class="text-center">
        
        <div class="container">
            
    <form method="POST" class="form-signin" style="margin:0 auto;">
        <img class="mb-4" src="img/logo.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Merci de vous connecter</h1>
        <?php
          if(count($error)>0){
            foreach($error as $e)
            {
              echo "<p class='text-danger'>".$e."</p>";
            }
          }
        ?>

        <label for="inputUsername" class="sr-only">Identifiant</label>
        <input type="text" id="inputUsername" name="username" class="form-control top" placeholder="Identifiant" required>
        <label for="inputPassword" class="sr-only">Mot de passe</label>
        <input type="password" id="inputPassword" name="password" class="form-control bottom" placeholder="Mot de passe" required>
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me"> Retenir ma connexion
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
        <p class="mt-5 mb-3">&copy; 2019</p>
      </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>