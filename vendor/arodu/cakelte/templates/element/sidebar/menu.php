<?php

$now = date('d-m-Y');

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
try {
  const response = axios.get('/caixas/getCaixaaberto/').then(function (response) { // handle success
    caixa(response.data)
  })
} catch (error) {
  console.error(error);
}

function caixa(is)
{
  if(is == true){
    console.log(is);
    $('.caixa').addClass('bg-red')
    document.getElementById('caixa').innerHTML = 'Fechar Caixa'
  }else{
    $('.caixa').addClass('bg-green')
    document.getElementById('caixa').innerHTML = 'Abrir Caixa'
  }
}
</script>

<li class="nav-item" style="color: #E1E7E0">
<a href="/relatorios/home" class="nav-link" style="color: #E1E7E0">
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
  <a href="<?php echo '/caixas/abrir/' . $now; ?>" class="caixa nav-link" style="color: #E1E7E0" >
    <i class="nav-icon fas fa-th" style="color: #E1E7E0"></i>
    <p id="caixa">
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
      <a href="/relatorios/index" class="nav-link" style="color: #E1E7E0; margin-left: 25px;">
        <i class="far fa-circle nav-icon" style="color: #E1E7E0"></i>
        <p>Sobre</p>
      </a>
    </li>
    <li class="nav-item" style="color: #E1E7E0">
      <a href="<?= $this->Url->build('/relatorios/dre', ['fullBase' => true]); ?>" class="nav-link" style="color: #E1E7E0; margin-left: 25px;">
        <i class="far fa-circle nav-icon" style="color: #E1E7E0"></i>
        <p>DRE</p>
      </a>
    </li>
    <li class="nav-item" style="color: #E1E7E0">
      <a href="/relatorios/fluxodecaixa" class="nav-link" style="color: #E1E7E0; margin-left: 25px;">
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
      <a href="/relatorios/gerencial" class="nav-link" style="color: #E1E7E0; margin-left: 25px;">
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
