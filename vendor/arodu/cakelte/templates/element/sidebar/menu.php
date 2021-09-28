<?php

$now = date('d-m-Y');

?>

<li class="nav-item" style="color: #E1E7E0">
  <a href="<?= $this->Url->build([
              'controller' => 'users',
              'action' => 'dashboard',
              'plugin' => 'Usermgmt',
            ]); ?>" class="nav-link" style="color: #E1E7E0">
    <i class="nav-icon fas fa-th" style="color: #E1E7E0"></i>
    <p>
      Home
    </p>
  </a>
</li>

<li class="nav-item" style="color: #E1E7E0">
  <a href="/lancamentos/add" class="nav-link" style="color: #E1E7E0">
    <i class="nav-icon fas fa-th" style="color: #E1E7E0"></i>
    <p>
      Novo Lançamento
    </p>
  </a>
</li>

<li class="nav-item" style="color: #E1E7E0">
  <a href="<?php echo '/caixas/abrir/' . $now; ?>" class="nav-link" style="color: #E1E7E0">
    <i class="nav-icon fas fa-th" style="color: #E1E7E0"></i>
    <p>
      Abrir Caixa
    </p>
  </a>
</li>

<li class="nav-item has-treeview " style="color: #E1E7E0">
  <a href="/relatorios/index" class="nav-link" style="color: #E1E7E0">
    <i class="nav-icon fas fa-th" style="color: #E1E7E0"></i>
    <p>
      Relatórios
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview" id="it">
    <li class="nav-item" style="color: #E1E7E0">
      <a href="<?= $this->Url->build('/drecontas/index', ['fullBase' => true]); ?>" class="nav-link" style="color: #E1E7E0; margin-left: 25px;">
        <i class="far fa-circle nav-icon" style="color: #E1E7E0"></i>
        <p>DRE</p>
      </a>
    </li>
    <li class="nav-item" style="color: #E1E7E0">
      <a href="/caixas/index" class="nav-link" style="color: #E1E7E0; margin-left: 25px;">
        <i class="far fa-circle nav-icon" style="color: #E1E7E0"></i>
        <p>Fluxo de Caixa</p>
      </a>
    </li>
    <li class="nav-item" style="color: #E1E7E0">
      <a href="/lancamentos/index" class="nav-link" style="color: #E1E7E0; margin-left: 25px;">
        <i class="far fa-circle nav-icon" style="color: #E1E7E0"></i>
        <p>Lançamentos</p>
      </a>
    </li>
    <li class="nav-item" style="color: #E1E7E0">
      <a href="/caixaregistros/index" class="nav-link" style="color: #E1E7E0; margin-left: 25px;">
        <i class="far fa-circle nav-icon" style="color: #E1E7E0"></i>
        <p>Caixa Gerencial</p>
      </a>
    </li>
  </ul>
</li>

<li class="nav-item" style="color: #E1E7E0">
  <a href="<?= $this->Url->build([
              'controller' => 'users',
              'action' => 'dashboard',
              'plugin' => 'Usermgmt',
            ]); ?>" class="nav-link" style="color: #E1E7E0">
    <i class="nav-icon fas fa-th" style="color: #E1E7E0"></i>
    <p>
      Painel
    </p>
  </a>
</li>
