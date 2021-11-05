<div class="asM p-3" >
  <li class="nav-item d-sm-block">
    <i class="nav-icon fas fa-tools"></i>
    <?= $this->Html->link(__('Configurações'), ['controller' => 'users','action' => 'dashboard', 'plugin' => 'Usermgmt']) ?>
  </li>
  <li class="nav-item d-sm-block">
    <i class="nav-icon fas fa-user-times"></i>
    <?= $this->Html->link(__('Sair'), ['controller' => 'users','action' => 'logout', 'plugin' => 'Usermgmt']) ?>
  </li>
</div>
