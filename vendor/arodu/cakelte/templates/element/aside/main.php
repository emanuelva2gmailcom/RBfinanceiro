<style>
  .tes a{
    margin-left: 2%;
  }

  .tes li{
    margin-bottom: 5%;
  }
</style>

<div class="tes p-3" >
  <li class="nav-item d-sm-block" style="list-style: none; color: yellow;">
    <i class="nav-icon fas fa-tools" style="color: #59CBFF;"></i>
    <?= $this->Html->link(__('Configurações'), ['controller' => 'users','action' => 'dashboard', 'plugin' => 'Usermgmt']) ?>
  </li>
  <li class="nav-item d-sm-block" style="list-style: none; color: yellow;">
    <i class="nav-icon fas fa-user-times" style="color: #59CBFF;"></i>
    <?= $this->Html->link(__('Sair'), ['controller' => 'users','action' => 'logout', 'plugin' => 'Usermgmt']) ?>
  </li>
</div>
