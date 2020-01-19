<?php require('parts/header.php') ?>
<?php
    $change_ADD = $FILES->getUpdateAdded();
    $change_EDIT = $FILES->getUpdateEdited();
    $change_REM = $FILES->getUpdateRemoved();

    $changeNbr = count($change_ADD) + count($change_EDIT) + count($change_REM);

    $error = array();
    if(isset($_POST['author']) && isset($_POST['details']))
    {
        if(!empty($_POST['author']))
        {
            
            if(file_exists('changelog.json'))
            {
                $json = json_decode(file_get_contents('changelog.json'));
            }
            else
            {
                $json = array();
            }
            if(empty($_POST['details']))
                $detail = "Auncune description.";
            else
                $detail = $_POST['details'];
            $changelog = array(
                'date' => date('d/m/Y H:i'),
                'author' => $_POST['author'],
                'details' => $detail,
                'change' => array(
                    'add' => $FILES->getUpdateAdded(),
                    'remove' => $FILES->getUpdateRemoved(),
                    'edit' => $FILES->getUpdateEdited()
                )
            );
            array_push($json, $changelog);
            file_put_contents('changelog.json', json_encode($json));
            $FILES->parseContent();
        }
        else
        {
            array_push($error, 'Merci de remplir le champs Auteurs');
        }
    }
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Mise à jour</h1>
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
                <h3 class="box-title">Détails de la mise à jour</h3>
                <?php
                    if($changeNbr > 0){
                ?>
                <form method="POST">
                    <div class="form-group">
                        <label>Auteur</label>
                        <input type="text" class="form-control" name="author" placeholder="Enter ..." value="<?= $_SESSION['username'] ?>" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="details" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </div>
                </form>
                <?php
                    } else {echo "<p>Aucun changement à effectuer !</p>";}
                ?>
            </div>
            <div class="col-md-6">
                <h3 class="box-title">Fichiers modifié</h3>
                <h5 class="box-title">Ajouts</h3>
                    <pre><?php
                            foreach($FILES->getUpdateAdded() as $v)
                            {
                                echo $v."<br>";
                                $changeNbr++;
                            }
                        ?>
                    </pre>
                <h5 class="box-title">Suppressions</h3>
                    <pre><?php
                            foreach($FILES->getUpdateRemoved() as $v)
                            {
                                echo $v."<br>";
                                $changeNbr++;$changeNbr++;
                            }
                        ?>
                    </pre>
                <h5 class="box-title">Modifications</h3>
                    <pre><?php
                            foreach($FILES->getUpdateEdited() as $v)
                            {
                                echo $v."<br>";
                                $changeNbr++;
                            }
                        ?>
                    </pre>
            </div>
          </div>
        </div>
      </div>
            <?php require('parts/changelog.php') ?>
        </div>
    </section>

<?php require('parts/footer.php') ?>