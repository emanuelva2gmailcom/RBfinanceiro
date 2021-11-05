<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <!-- <title><?= strip_tags($this->settings['appName']) . ' | ' . $this->fetch('title') ?></title> -->

  <?= $this->Html->meta('icon') ?>
  <?= $this->fetch('meta') ?>

  <!-- Jquery -->
  <?= $this->Html->script('CakeLte./AdminLTE/plugins/jquery/jquery.min.js') ?>
  <!-- ChartJS -->
  <?= $this->Html->script('CakeLte./AdminLTE/plugins/chart.js/Chart.js') ?>
  <?= $this->Html->css('CakeLte./AdminLTE/plugins/chart.js/Chart.css') ?>

  <!-- Tabledate -->
  <?= $this->Html->css('CakeLte./AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>
  <?= $this->Html->css('CakeLte./AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>
  <?= $this->Html->css('CakeLte./AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>
  <?= $this->Html->script('CakeLte./AdminLTE/plugins/datatables/jquery.dataTables.min.js'); ?>
  <?= $this->Html->script('CakeLte./AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>
  <?= $this->Html->script('CakeLte./AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>
  <?= $this->Html->script('CakeLte./AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>
  <?= $this->Html->script('CakeLte./AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js'); ?>
  <?= $this->Html->script('CakeLte./AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); ?>
  <?= $this->Html->script('CakeLte./AdminLTE/plugins/jszip/jszip.min.js'); ?>
  <?= $this->Html->script('CakeLte./AdminLTE/plugins/pdfmake/pdfmake.min.js'); ?>
  <?= $this->Html->script('CakeLte./AdminLTE/plugins/pdfmake/vfs_fonts.js'); ?>
  <?= $this->Html->script('CakeLte./AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js'); ?>
  <?= $this->Html->script('CakeLte./AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js'); ?>
  <?= $this->Html->script('CakeLte./AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js'); ?>
  <!-- Font Awesome Icons -->
  <?= $this->Html->css('CakeLte./AdminLTE/plugins/fontawesome-free/css/all.min.css') ?>
  <!-- icheck bootstrap -->
  <?= $this->Html->css('CakeLte./AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>
  <!-- Theme style -->
  <?= $this->Html->css('CakeLte./AdminLTE/dist/css/adminlte.min.css') ?>
  <?= $this->Html->css('CakeLte./AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>
  <!-- Select2 -->
  <?= $this->Html->css('CakeLte./AdminLTE/plugins/select2/css/select2.min.css'); ?>
  <?= $this->Html->script('CakeLte./AdminLTE/plugins/select2/js/select2.min.js'); ?>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <?= $this->Html->css('CakeLte.style') ?>
  <?= $this->Html->css('default') ?>

  <?= $this->element('layout/css') ?>

  <?= $this->fetch('css') ?>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand">
      <?= $this->element('header/main') ?>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-secondary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= $this->Url->build('/') ?>" class="brand-link bg-white">
        <?= $this->Html->image('logo2.png', ['class' => 'imgS']) ?>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <?= $this->element('sidebar/main') ?>
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->


      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">

        <!-- Main content -->

        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
      </div>
      <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar">
      <!-- Control sidebar content goes here -->
      <?= $this->element('aside/main') ?>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
  </div>
  <footer class="footer">
    <?= $this->element('footer/main') ?>
  </footer>

  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->




  <!-- Bootstrap 4 -->
  <?= $this->Html->script('CakeLte./AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>
  <!-- AdminLTE App -->
  <?= $this->Html->script('CakeLte./AdminLTE/dist/js/adminlte.min.js') ?>

  <?= $this->element('layout/script') ?>

  <?= $this->fetch('script') ?>


</body>

</html>
