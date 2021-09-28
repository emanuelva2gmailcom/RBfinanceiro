<!-- Sidebar user panel (optional) -->
<?php echo $this->element('sidebar/user') ?>

<!-- Sidebar Menu -->

<nav class="mt-2" onblur="fechar()">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <?php echo $this->element('sidebar/menu') ?>
  </ul>
</nav>