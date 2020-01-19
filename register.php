<?php
session_start();
  if(file_exists('protected/config.json'))
    header('Location: login.php');
  if(isset($_SESSION['hash']) && $_SESSION['hash'] == json_decode(file_get_contents('protected/config.json'), true)['user']['hash'])
    header('Location: index.php');
  $error = array();
      if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['cpassword']))
      {
        if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['cpassword']))
        {
          if($_POST['password'] == $_POST['cpassword'])
          {
            $config = array(
              'server' => array(
                'name' => "kMCLauncher",
              ),
              'user' => array(
                'username' => $_POST['username'],
                'password' => sha1($_POST['password']),
                'hash' => sha1(microtime().$_POST['username']),
              ),
            );
            $_SESSION['hash'] = $config['user']['hash'];
            $_SESSION['username'] = $config['user']['username'];
            file_put_contents('protected/config.json', json_encode($config));
            mkdir('data');
            mkdir('data/files');
            header('Location: index.php');
          }
          else
          {
            array_push($error, 'Le mot de passe et sa confirmation ne sont pas identiques !');
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
        <input type="username" id="inputUsername" name="username" class="form-control" placeholder="Identifiant" required>

        <label for="inputPassword" class="sr-only">Mot de passe</label>
        <input type="password" id="inputPassword" name="password" class="form-control top" placeholder="Mot de passe" required>
        <label for="inputCPassword" class="sr-only">Confirmation</label>
        <input type="password" id="inputCPassword" name="cpassword" class="form-control bottom" placeholder="Confirmation" required>
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