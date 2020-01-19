<?php require('parts/header.php') ?>
<?php
  $config = json_decode(file_get_contents('protected/config.json'),true);
    $error = array();
    if(isset($_POST['form']) && $_POST['form'] == "account")
    {
      if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['cpassword']))
      {
        if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['cpassword']))
        {
          if($_POST['password'] == $_POST['cpassword'])
          {
            $user = array(
              'username' => $_POST['username'],
              'password' => sha1($_POST['password']),
              'hash' => sha1(microtime().$_POST['username']),
            );
            $_SESSION['hash'] = $user['hash'];
            $_SESSION['username'] = $user['username'];
            $config['user'] = $user;
            file_put_contents('protected/config.json', json_encode($config));
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
    }
    elseif(isset($_POST['form']) && $_POST['form'] == "server")
    {
      if(isset($_POST['name']) && !empty($_POST['name']))
      {
        $server = array(
          'name' => $_POST['name'],
        );
        $config['server'] = $server;
        file_put_contents('protected/config.json', json_encode($config));
      }
      else
      {
        array_push($error, "Merci de remplir tous les champs requis.");
      }
    }

  $config = json_decode(file_get_contents('protected/config.json'),true);
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Configuration</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">

      <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
                <h3 class="box-title">Détails de connexion</h3>
                <form method="POST">
                    <div class="form-group">
                        <label>Utilisateur</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter ..." value="<?= $config['user']['username'] ?>" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter ..." value="" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;" autocomplete="off">

                        <label>Confirmation</label>
                        <input type="password" class="form-control" name="cpassword" placeholder="Enter ..." value="" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;" autocomplete="off">
                    </div>
                    <input type="hidden" name="form" value="account">
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <h3 class="box-title">Détails du serveur</h3>
                <form method="POST">
                    <div class="form-group">
                        <label>Nom du serveur</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter ..." value="<?= $config['server']['name'] ?>" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;" autocomplete="off">
                    </div>
                    <input type="hidden" name="form" value="server">
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>

        </div>
    </section>

<?php require('parts/footer.php') ?>