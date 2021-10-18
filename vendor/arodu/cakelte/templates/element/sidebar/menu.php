<!-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  try {
    const response = axios.get('/caixas/getCaixaaberto/').then(function(response) { // handle success
      caixa(response.data)
    })
  } catch (error) {
    console.error(error);
  }

  function caixa(is) {
    if (is == true) {
      console.log(is);
      document.getElementById('customSwitch3').checked = true;

    } else {
      document.getElementById('customSwitch3').checked = false;

    }
  }
</script>


<li class="nav-item" style="color: #59CBFF;">
  <a href="<?php echo '/caixas/abrir/' . $now; ?>" class="caixa nav-link " style="color: #59CBFF; z-index: 2000">
    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
      <input type="checkbox" class="custom-control-input" id="customSwitch3" disabled>
      <label class="custom-control-label" for="customSwitch3" style="color: #59CBFF;">Abrir </label>
    </div>
  </a>
</li> -->

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



<li class="nav-item" style="color: #59CBFF;">

  <a href="<?php echo '/caixas/abrir/'; ?>" class="caixa nav-link" style="color: #59CBFF;" >

<i class="nav-icon fas fa-power-off" style="color: #59CBFF;"></i>

    <p id="caixa">

      Abrir Caixa

    </p>

  </a>

</li>

<li class="nav-item" style="color: #59CBFF;">
<a href="/relatorios/#" class="nav-link" style="color: #59CBFF;">
    <i class="nav-icon fas fa-home" style="color: #59CBFF;"></i>
    <p>
      Home
    </p>
  </a>
</li>

<li class="nav-item has-treeview " style="color: #59CBFF;">
  <a class="nav-link" style="color: #59CBFF;">
    <i class="nav-icon fas fa-rocket" style="color: #59CBFF;"></i>
    <p>
      Lançamentos
      <i class="right far fa-caret-square-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview" id="it">
    <li class="nav-item" style="color:#FFFFFF;">
      <a href="/lancamentos/add" class="nav-link" style="color:#FFFFFF;; ">
        <i class="fas fa-check nav-icon" style="color:#FFFFFF;"></i>
        <p>Novo Lançamento</p>
      </a>
    </li>
    <li class="nav-item" style="color:#FFFFFF;">
      <a href="/lancamentos/index" class="nav-link" style="color:#FFFFFF;; ">
        <i class="fab fa-rocketchat nav-icon" style="color:#FFFFFF;"></i>
        <p>Seus Lançamentos</p>
      </a>
    </li>
  </ul>
</li>

<li class="nav-item has-treeview " style="color: #59CBFF;">
  <a class="nav-link" style="color: #59CBFF;">
    <i class="nav-icon fas fa-file-invoice-dollar" style="color: #59CBFF;"></i>
    <p>
      Plano de Contas
      <i class="right far fa-caret-square-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview" id="it">
    <li class="nav-item" style="color: #FFFFFF;">
      <a class="nav-link" style="color: #FFFFFF;; ">
        <i class="fas fa-money-check-alt nav-icon" style="color: #FFFFFF;"></i>
        <p>Contas</p>
        <i class="right far fa-caret-square-left"></i>
      </a>
        <ul class="nav nav-treeview" id="it">
        <li class="nav-item" style="color: #B5BDB7;">
          <a href="/fluxocontas/add" class="nav-link" style="color: #B5BDB7;; ">
        <i class="fas fa-donate nav-icon" style="color: #B5BDB7;"></i>
        <p>Adicionar</p>
      </a>
    </li>
    <li class="nav-item" style="color: #B5BDB7;">
      <a href="/fluxocontas/index" class="nav-link" style="color: #B5BDB7;; ">
        <i class="fas fa-hand-holding-usd nav-icon" style="color: #B5BDB7;"></i>
        <p>Disponíveis</p>
      </a>
    </li>
  </ul>
  </li>
    <li class="nav-item" style="color: #FFFFFF;">
      <a class="nav-link" style="color: #FFFFFF;; ">
        <i class="fas fa-user-friends nav-icon" style="color: #FFFFFF;"></i>
        <p>Subgrupos</p>
        <i class="right far fa-caret-square-left"></i>
      </a>
        <ul class="nav nav-treeview" id="it">
    <li class="nav-item" style="color: #B5BDB7;">
      <a href="/fluxosubgrupos/add" class="nav-link" style="color: #B5BDB7;; ">
        <i class="fas fa-user-plus nav-icon" style="color: #B5BDB7;"></i>
        <p>Adicionar</p>
      </a>
    </li>
    <li class="nav-item" style="color: #B5BDB7;">
      <a href="/fluxosubgrupos/index" class="nav-link" style="color: #B5BDB7;; ">
        <i class="fas fa-users nav-icon" style="color: #B5BDB7;"></i>
      <p>Disponíveis</p>
      </a>
    </li>
  </ul>
    </li>
  </ul>
</li>

<li class="nav-item has-treeview " style="color: #59CBFF;">
  <a class="nav-link" style="color: #59CBFF;">
    <i class="nav-icon fas fa-user-tie" style="color: #59CBFF;"></i>
    <p>
      Fornecedores
      <i class="right far fa-caret-square-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview" id="it">
    <li class="nav-item" style="color: #FFFFFF;">
      <a href="/fornecedores/add" class="nav-link" style="color: #FFFFFF;; ">
        <i class="fas fa-user-plus nav-icon" style="color: #FFFFFF;"></i>
        <p>Adicionar</p>
      </a>
    </li>
    <li class="nav-item" style="color: #FFFFFF;">
      <a href="/fornecedores/index" class="nav-link" style="color: #FFFFFF;; ">
        <i class="fas fa-users nav-icon" style="color: #FFFFFF;"></i>
        <p>Disponíveis</p>
      </a>
    </li>
  </ul>
</li>

<li class="nav-item has-treeview " style="color: #59CBFF;">
  <a class="nav-link" style="color: #59CBFF;">
    <i class="nav-icon fas fa-user" style="color: #59CBFF;"></i>
    <p>
      Clientes
      <i class="right far fa-caret-square-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview" id="it">
    <li class="nav-item" style="color: #FFFFFF;">
      <a href="/clientes/add" class="nav-link" style="color: #FFFFFF;; ">
        <i class="fas fa-user-plus nav-icon" style="color: #FFFFFF;"></i>
        <p>Adicionar</p>
      </a>
    </li>
    <li class="nav-item" style="color: #FFFFFF;">
      <a href="/clientes/index" class="nav-link" style="color: #FFFFFF;; ">
        <i class="fas fa-users nav-icon" style="color: #FFFFFF;"></i>
        <p>Disponíveis</p>
      </a>
    </li>
  </ul>
</li>

<li class="nav-item has-treeview " style="color: #59CBFF;">
  <a class="nav-link" style="color: #59CBFF;">
    <i class="nav-icon fas fa-tasks" style="color: #59CBFF;"></i>
    <p>
      Relatórios
      <i class="right far fa-caret-square-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview" id="it">
    <li class="nav-item" style="color: #FFFFFF;">
      <a href="/caixas/index" class="nav-link" style="color: #FFFFFF;; ">
        <i class="fas fa-dollar-sign nav-icon" style="color: #FFFFFF;"></i>
        <p>Caixa</p>
      </a>
    </li>
    <li class="nav-item" style="color: #FFFFFF;">
      <a href="/relatorios/caixadiario" class="nav-link" style="color: #FFFFFF;; ">
        <i class="fas fa-cash-register nav-icon" style="color: #FFFFFF;"></i>
        <p>Caixa Diário</p>
      </a>
    </li>
    <li class="nav-item" style="color: #FFFFFF;">
      <a href="/relatorios/gerencial" class="nav-link" style="color: #FFFFFF;; ">
        <i class="fas fa-sitemap nav-icon" style="color: #FFFFFF;"></i>
        <p>Caixa Gerencial</p>
      </a>
    </li>
    <li class="nav-item" style="color: #FFFFFF;">
      <a href="/relatorios/fluxodecaixa" class="nav-link" style="color: #FFFFFF;; ">
        <i class="fas fa-sync-alt nav-icon" style="color: #FFFFFF;"></i>
        <p>Fluxo de Caixa</p>
      </a>
    </li>
  </ul>
</li>

<li class="nav-item" style="color: #59CBFF;">
  <a href="/lancamentos/painel" class="nav-link" style="color: #59CBFF;">
    <i class="nav-icon far fa-chart-bar" style="color: #59CBFF;"></i>
    <p>
      Painel
    </p>
  </a>
</li>