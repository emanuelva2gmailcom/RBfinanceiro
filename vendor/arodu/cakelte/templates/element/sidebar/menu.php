
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
          <a href="/subcontas/add" class="terceiro nav-link">
        <i class="terceiro fas fa-donate nav-icon"></i>
        <p class="terceiro">Adicionar</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/subcontas/index" class="terceiro nav-link">
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
      <a href="/subgrupos/add" class="terceiro nav-link">
        <i class="terceiro fas fa-user-plus nav-icon"></i>
        <p class="terceiro">Adicionar</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/subgrupos/index" class="terceiro nav-link">
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
    <li class="nav-item">
      <a href="/relatorios/dre" class="segundo nav-link">
        <i class="segundo far fa-chart-bar nav-icon"></i>
        <p class="segundo">DRE</p>
      </a>
    </li>
  </ul>
</li>

<li class="sidebarMenu nav-item">
  <a href="/lancamentos/painel" class="primeiro nav-link">
    <i class="primeiro nav-icon fas fa-chart-pie"></i>
    <p class="primeiro">
      Painel
    </p>
  </a>
</li>
