<div class="p-3" >
  <li class="nav-item d-sm-block" style="list-style: none;">
    <?= $this->Html->link(__('Configurações'), ['controller' => 'users','action' => 'logout'], ['class' => 'nav-link']) ?>
  </li>
  <li class="nav-item d-sm-block" style="list-style: none;">
    <?= $this->Html->link(__('Sair'), ['controller' => 'users','action' => 'logout'], ['class' => 'nav-link']) ?>
  </li>
</div>
