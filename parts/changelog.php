<?php
                if(file_exists('changelog.json'))
                {
                    $data = json_decode(file_get_contents('changelog.json'), true);
                }
                else
                {
                    $data = array();
                }
?>
<!-- Content Header (Page header) -->
            <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Les mises à  jours</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
        <div class="row">
          <!-- Main node for this component -->
<div class="timeline" style="width: 100%;">
  <!-- Timeline time label -->
  <div class="time-label">
    <span class="bg-green"><?= date('d M. Y') ?></span>
  </div>
  <?php
        foreach ($data as $k => $v) {
      ?>
  <div style="width: 100%;">
  <!-- Before each timeline item corresponds to one icon on the left scale -->
    <i class="fas fa-arrow-circle-up bg-blue"></i>
    <!-- Timeline item -->
    <div class="timeline-item">
    <!-- Time -->
      <span class="time"><i class="fas fa-clock"></i> <?= $v['date'] ?></span>
      <!-- Header. Optional -->
      <h3 class="timeline-header"><a href="#"><?= $v['author'] ?></a> a mis à jour le modpack</h3>
      <!-- Body -->
      <div class="timeline-body">
      <?= $v['details'] ?>
      </div>
      <!-- Placement of additional controls. Optional -->
      <div class="timeline-footer">
        <a class="btn btn-primary btn-sm" disabled>Voir les détails</a>
        <a class="btn btn-danger btn-sm" disabled>Supprimer</a>
      </div>
    </div>
  </div>
        <?php } ?>
  <div>
    <i class="fas fa-clock bg-gray"></i>
  </div>
</div>