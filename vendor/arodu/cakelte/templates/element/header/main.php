<script>
  function fechar(){
    document.getElementById('it').style.display= 'none';
  }
</script>

<!-- Left navbar links -->
<ul class="navbar-nav " onblur="fechar() ">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" onclick="fechar()"><i class="fas fa-bars"></i></a>
      </li>

      <?php echo $this->element('header/menu') ?>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
       <?php echo $this->element('header/messages') ?>

      <!-- Notifications Dropdown Menu -->
       <?php echo $this->element('header/notifications') ?>

       <!-- SEARCH FORM -->
       <?php echo $this->element('header/search') ?>

      <li class="nav-item" style="color: #E1E7E0;">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-th-large" ></i></a>
      </li>

    </ul>
