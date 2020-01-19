<?php require('parts/header.php') ?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tableau de bord</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-folder"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Fichier</span>
                <span class="info-box-number"><?= $FILES->file_Number ?></span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-hdd"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Taille</span>
                <span class="info-box-number"><?= $FILES->getProperSize() ?> Mo</span>
              </div>
            </div>
          </div>
        </div>

    <?php require('parts/changelog.php') ?>

        </div>
    </section>

<?php require('parts/footer.php') ?>