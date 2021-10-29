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

  <?= $this->element('layout/css') ?>

  <?= $this->fetch('css') ?>

  <style>
    footer {
      height: auto;
      text-align: center;
      padding: 30px;
      background-color: #59CBFF;
      color: #2E2E2F;
      justify-content: center;

    }

    img {
      max-width: 100%;
    }

    .titulo {
      font-family: Tahoma;
    }

    p {
      font-family: helvetica;
    }
  </style>


  <style>
    .main-header {
      background-color: #59CBFF;
    }

    .main-sidebar {
      background-color: #2E2E2F;
    }

    .content-header {
      background-color: #2F6D80;
    }

    .content {
      background-color: #DBDBDB;
    }

    .main-footer {
      background-color: #6AA4B0;
    }

    a {
      color: #2E2E2F;
    }

    
  /* @media (max-width : 620px) {
    .footer {
      position: absolute;
     margin-top: 800px;
      min-width: 80%;
      background-color: gainsboro;
    }
    body{
      background-color: #DBDBDB;
    }
  } */
</style>

  


</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-info">
      <?= $this->element('header/main') ?>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-secondary elevation-4" style="color: #ACD9FF;">
      <!-- Brand Logo -->
      <a href="<?= $this->Url->build('/') ?>" class="brand-link bg-white">
        <?= $this->Html->image('logo2.png') ?>
      </a>

      <!-- Sidebar -->
      <div class="sidebar text-info teste">
        <?= $this->element('sidebar/main') ?>
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->


      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content" style="padding: 0%; margin: 0%; min-height:150vh;">

        <!-- Main content -->

        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
      </div>
      <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark" id="cu">
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
