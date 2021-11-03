<style>
  .tes a{
    margin-left: 2%;
  }

  .tes li{
    margin-bottom: 5%;
  }

  .duo a{
    color: #F7E7CE;
  }

</style>

<div class="tes p-3" >
  <li class="duo nav-item d-sm-block" style="list-style: none;">
    <i class="nav-icon fas fa-tools" style="color:#F7E7CE;"></i>
    <?= $this->Html->link(__('Configurações'), ['controller' => 'users','action' => 'dashboard', 'plugin' => 'Usermgmt']) ?>
  </li>
  <li class="duo nav-item d-sm-block" style="list-style: none;">
    <i class="nav-icon fas fa-user-times" style="color:#F7E7CE;"></i>
    <?= $this->Html->link(__('Sair'), ['controller' => 'users','action' => 'logout', 'plugin' => 'Usermgmt']) ?>
  </li>
</div>
