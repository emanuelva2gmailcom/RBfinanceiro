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


<li class="nav-item">
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
    $('.caixa').css({backgroundColor: "#046076", color: "#FFFFFF"})
    $('.fa-power-off').css({color: "#FFFFFF"})
    document.getElementById('caixa').innerHTML = 'Fechar Caixa'
  }else{
    $('.caixa').css({backgroundColor: "#FFFFFF", color: "#046076"})
    $('.fa-power-off').css({color: "#046076"})
    document.getElementById('caixa').innerHTML = 'Abrir Caixa'
  }
}
</script>



<li class="nav-item" >

  <a href="<?php echo '/caixas/abrir/'; ?>" class="caixa nav-link"  >

<i class="nav-icon fas fa-power-off" ></i>

    <p id="caixa">

      Abrir Caixa

    </p>

  </a>

</li>

<li class="sidebarMenu nav-item">
<a href="/relatorios/#" class="primeiro nav-link">
    <i class="primeiro nav-icon fas fa-home"></i>
    <p class="primeiro">
      Home
    </p>
  </a>
</li>


<li class="sidebarMenu nav-item has-treeview ">
  <a class="primeiro nav-link">
    <i class="primeiro nav-icon fas fa-rocket"></i>
    <p class="primeiro">
      Lançamentos
      <i class="primeiro right far fa-caret-square-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="/lancamentos/add" class="segundo nav-link">
      <i class="segundo fas fa-check nav-icon"></i>
      <p class="segundo">Novo Lançamento</p>
    </a>
  </li>
  <li class="nav-item">
    <a href="/lancamentos/index" class=" segundo nav-link">
    <i class="segundo fab fa-rocketchat nav-icon"></i>
    <p class="segundo">Seus Lançamentos</p>
  </a>
</li>
</ul>
</li>

<li class="sidebarMenu nav-item has-treeview ">
  <a class="primeiro nav-link">
    <i class="primeiro nav-icon fas fa-boxes"></i>
    <p class="primeiro">
      Caixas
      <i class="primeiro right far fa-caret-square-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="/caixas/index" class="segundo nav-link">
        <i class="segundo fas fa-box-open nav-icon"></i>
        <p class="segundo">Abertos e Fechados</p>
      </a>
    </li>
    <li class="nav-item">
      <a class="segundo nav-link">
        <i class="segundo fas fa-money-check nav-icon"></i>
        <p class="segundo">Pagamentos</p>
        <i class="segundo right far fa-caret-square-left"></i>
      </a>
      <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="/tipopagamentos/add" class="terceiro nav-link">
        <i class="terceiro fas fa-dollar-sign nav-icon"></i>
        <p class="terceiro">Adicionar</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/tipopagamentos/index" class="terceiro nav-link">
        <i class="terceiro fas fa-wallet nav-icon"></i>
        <p class="terceiro">Disponiveis</p>
      </a>
    </li>
  </ul>
    </li>
  </ul>
</li>

<li class="sidebarMenu nav-item has-treeview ">
  <a class="primeiro nav-link">
    <i class="primeiro nav-icon fas fa-file-invoice-dollar"></i>
    <p class="primeiro">
      Plano de Contas
      <i class="primeiro right far fa-caret-square-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a class="segundo nav-link">
        <i class="segundo fas fa-money-check-alt nav-icon"></i>
        <p class="segundo">Contas</p>
        <i class="segundo right far fa-caret-square-left"></i>
      </a>
        <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="/fluxocontas/add" class="terceiro nav-link">
        <i class="terceiro fas fa-donate nav-icon"></i>
        <p class="terceiro">Adicionar</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/fluxocontas/index" class="terceiro nav-link">
        <i class="terceiro fas fa-hand-holding-usd nav-icon"></i>
        <p class="terceiro">Disponíveis</p>
      </a>
    </li>
  </ul>
  </li>
    <li class="nav-item">
      <a class="segundo nav-link">
        <i class="segundo fas fa-user-friends nav-icon"></i>
        <p class="segundo">Subgrupos</p>
        <i class="segundo right far fa-caret-square-left"></i>
      </a>
        <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="/fluxosubgrupos/add" class="terceiro nav-link">
        <i class="terceiro fas fa-user-plus nav-icon"></i>
        <p class="terceiro">Adicionar</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/fluxosubgrupos/index" class="terceiro nav-link">
        <i class="terceiro fas fa-users nav-icon"></i>
      <p class="terceiro">Disponíveis</p>
      </a>
    </li>
  </ul>
    </li>
  </ul>
</li>

<li class="sidebarMenu nav-item has-treeview ">
  <a class="primeiro nav-link">
    <i class="primeiro nav-icon fas fa-user-tie"></i>
    <p class="primeiro">
      Fornecedores
      <i class="primeiro right far fa-caret-square-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="/fornecedores/add" class="segundo nav-link">
        <i class="segundo fas fa-user-plus nav-icon"></i>
        <p class="segundo">Adicionar</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/fornecedores/index" class="segundo nav-link">
        <i class="segundo fas fa-users nav-icon"></i>
        <p class="segundo">Disponíveis</p>
      </a>
    </li>
  </ul>
</li>

<li class="sidebarMenu nav-item has-treeview ">
  <a class="primeiro nav-link">
    <i class="primeiro nav-icon fas fa-user"></i>
    <p class="primeiro">
      Clientes
      <i class="primeiro right far fa-caret-square-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="/clientes/add" class="segundo nav-link">
        <i class="segundo fas fa-user-plus nav-icon"></i>
        <p class="segundo">Adicionar</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/clientes/index" class="segundo nav-link">
        <i class="segundo fas fa-users nav-icon"></i>
        <p class="segundo">Disponíveis</p>
      </a>
    </li>
  </ul>
</li>

<li class="sidebarMenu nav-item has-treeview ">
  <a class="primeiro nav-link">
    <i class="primeiro nav-icon fas fa-clipboard-list"></i>
    <p class="primeiro">
      Relatórios
      <i class="primeiro right far fa-caret-square-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="/relatorios/caixadiario" class="segundo nav-link">
        <i class="segundo fas fa-cash-register nav-icon"></i>
        <p class="segundo">Caixa Diário</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/relatorios/gerencial" class="segundo nav-link">
        <i class="segundo fas fa-sitemap nav-icon"></i>
        <p class="segundo">Caixa Gerencial</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/relatorios/fluxodecaixa" class="segundo nav-link">
        <i class="segundo fas fa-sync-alt nav-icon"></i>
        <p class="segundo">Fluxo de Caixa</p>
      </a>
    </li>
  </ul>
</li>

<li class="sidebarMenu nav-item">
  <a href="/lancamentos/painel" class="primeiro nav-link">
    <i class="primeiro nav-icon far fa-chart-bar"></i>
    <p class="primeiro">
      Painel
    </p>
  </a>
</li>
