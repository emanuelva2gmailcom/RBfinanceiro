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
    $('.caixa').css({backgroundColor: "#CF6856", color: "#F7E7CE"})
    $('.fa-power-off').css({color: "#F7E7CE"})
    document.getElementById('caixa').innerHTML = 'Fechar Caixa'
  }else{
    $('.caixa').css({backgroundColor: "#F7E7CE", color: "#CF6856"})
    $('.fa-power-off').css({color: "#CF6856"})
    document.getElementById('caixa').innerHTML = 'Abrir Caixa'
  }
}
</script>



<li class="nav-item" >

  <a href="<?php echo '/caixas/abrir/'; ?>" class="caixa nav-link"  >

<i class="nav-icon fas fa-power-off" ></i>

    <p>

      Abrir Caixa

    </p>

  </a>

</li>

<li class="sidME nav-item">
<a href="/relatorios/#" class="prim nav-link">
    <i class="prim nav-icon fas fa-home"></i>
    <p class="prim">
      Home
    </p>
  </a>
</li>


<li class="sidME nav-item has-treeview ">
  <a class="prim nav-link">
    <i class="prim nav-icon fas fa-rocket"></i>
    <p class="prim">
      Lançamentos
      <i class="prim right far fa-caret-square-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="/lancamentos/add" class="seg nav-link">
      <i class="seg fas fa-check nav-icon"></i>
      <p class="seg">Novo Lançamento</p>
    </a>
  </li>
  <li class="nav-item">
    <a href="/lancamentos/index" class=" seg nav-link">
    <i class="seg fab fa-rocketchat nav-icon"></i>
    <p class="seg">Seus Lançamentos</p>
  </a>
</li>
</ul>
</li>

<li class="sidME nav-item has-treeview ">
  <a class="prim nav-link">
    <i class="prim nav-icon fas fa-boxes"></i>
    <p class="prim">
      Caixas
      <i class="prim right far fa-caret-square-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="/caixas/index" class="seg nav-link">
        <i class="seg fas fa-box-open nav-icon"></i>
        <p class="seg">Abertos e Fechados</p>
      </a>
    </li>
    <li class="nav-item">
      <a class="seg nav-link">
        <i class="seg fas fa-money-check nav-icon"></i>
        <p class="seg">Pagamentos</p>
        <i class="seg right far fa-caret-square-left"></i>
      </a>
      <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="/tipopagamentos/add" class="terc nav-link">
        <i class="terc fas fa-dollar-sign nav-icon"></i>
        <p class="terc">Adicionar</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/tipopagamentos/index" class="terc nav-link">
        <i class="terc fas fa-wallet nav-icon"></i>
        <p class="terc">Disponiveis</p>
      </a>
    </li>
  </ul>
    </li>
  </ul>
</li>

<li class="sidME nav-item has-treeview ">
  <a class="prim nav-link">
    <i class="prim nav-icon fas fa-file-invoice-dollar"></i>
    <p class="prim">
      Plano de Contas
      <i class="prim right far fa-caret-square-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a class="seg nav-link">
        <i class="seg fas fa-money-check-alt nav-icon"></i>
        <p class="seg">Contas</p>
        <i class="seg right far fa-caret-square-left"></i>
      </a>
        <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="/fluxocontas/add" class="terc nav-link">
        <i class="terc fas fa-donate nav-icon"></i>
        <p class="terc">Adicionar</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/fluxocontas/index" class="terc nav-link">
        <i class="terc fas fa-hand-holding-usd nav-icon"></i>
        <p class="terc">Disponíveis</p>
      </a>
    </li>
  </ul>
  </li>
    <li class="nav-item">
      <a class="seg nav-link">
        <i class="seg fas fa-user-friends nav-icon"></i>
        <p class="seg">Subgrupos</p>
        <i class="seg right far fa-caret-square-left"></i>
      </a>
        <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="/fluxosubgrupos/add" class="terc nav-link">
        <i class="terc fas fa-user-plus nav-icon"></i>
        <p class="terc">Adicionar</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/fluxosubgrupos/index" class="terc nav-link">
        <i class="terc fas fa-users nav-icon"></i>
      <p class="terc">Disponíveis</p>
      </a>
    </li>
  </ul>
    </li>
  </ul>
</li>

<li class="sidME nav-item has-treeview ">
  <a class="prim nav-link">
    <i class="prim nav-icon fas fa-user-tie"></i>
    <p class="prim">
      Fornecedores
      <i class="prim right far fa-caret-square-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="/fornecedores/add" class="seg nav-link">
        <i class="seg fas fa-user-plus nav-icon"></i>
        <p class="seg">Adicionar</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/fornecedores/index" class="seg nav-link">
        <i class="seg fas fa-users nav-icon"></i>
        <p class="seg">Disponíveis</p>
      </a>
    </li>
  </ul>
</li>

<li class="sidME nav-item has-treeview ">
  <a class="prim nav-link">
    <i class="prim nav-icon fas fa-user"></i>
    <p class="prim">
      Clientes
      <i class="prim right far fa-caret-square-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="/clientes/add" class="seg nav-link">
        <i class="seg fas fa-user-plus nav-icon"></i>
        <p class="seg">Adicionar</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/clientes/index" class="seg nav-link">
        <i class="seg fas fa-users nav-icon"></i>
        <p class="seg">Disponíveis</p>
      </a>
    </li>
  </ul>
</li>

<li class="sidME nav-item has-treeview ">
  <a class="prim nav-link">
    <i class="prim nav-icon fas fa-clipboard-list"></i>
    <p class="prim">
      Relatórios
      <i class="prim right far fa-caret-square-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="/relatorios/caixadiario" class="seg nav-link">
        <i class="seg fas fa-cash-register nav-icon"></i>
        <p class="seg">Caixa Diário</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/relatorios/gerencial" class="seg nav-link">
        <i class="seg fas fa-sitemap nav-icon"></i>
        <p class="seg">Caixa Gerencial</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/relatorios/fluxodecaixa" class="seg nav-link">
        <i class="seg fas fa-sync-alt nav-icon"></i>
        <p class="seg">Fluxo de Caixa</p>
      </a>
    </li>
  </ul>
</li>

<li class="sidME nav-item">
  <a href="/lancamentos/painel" class="prim nav-link">
    <i class="prim nav-icon far fa-chart-bar"></i>
    <p class="prim">
      Painel
    </p>
  </a>
</li>
