<?php

$now = date('d-m-Y');
$teste = null;
?>
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
    $teste = 'off.png'
  }else{
    $('.caixa').addClass('bg-green')
    document.getElementById('caixa').innerHTML = 'Abrir Caixa'
    document.getElementById('caixa').atr
  }
}
</script>



<li class="nav-item" style="color: #59CBFF;">

  <a href="<?php echo '/caixas/abrir/' . $now; ?>" class="caixa nav-link" style="color: #59CBFF;" >

<i class="nav-icon fas fa-th" style="color: #59CBFF;"></i>

    <p id="caixa">

      Abrir Caixa

    </p>

  </a>

</li>

<li class="nav-item" style="color: #59CBFF;">
<a href="/relatorios/#" class="nav-link" style="color: #59CBFF;">
    <i class="nav-icon fas fa-th" style="color: #59CBFF;"></i>
    <p>
      Home
    </p>
  </a>
</li>

<li class="nav-item has-treeview " style="color: #59CBFF;">
  <a class="nav-link" style="color: #59CBFF;">
    <i class="nav-icon fas fa-th" style="color: #59CBFF;"></i>
    <p>
      Lançamentos
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview" id="it">
    <li class="nav-item" style="color: #59CBFF;">
      <a href="/lancamentos/add" class="nav-link" style="color: #59CBFF;; ">
        <i class="far fa-circle nav-icon" style="color: #59CBFF;"></i>
        <p>Novo Lançamento</p>
      </a>
    </li>
    <li class="nav-item" style="color: #59CBFF;">
      <a href="/lancamentos/index" class="nav-link" style="color: #59CBFF;; ">
        <i class="far fa-circle nav-icon" style="color: #59CBFF;"></i>
        <p>Seus Lançamentos</p>
      </a>
    </li>
  </ul>
</li>

<li class="nav-item has-treeview " style="color: #59CBFF;">
  <a class="nav-link" style="color: #59CBFF;">
    <i class="nav-icon fas fa-th" style="color: #59CBFF;"></i>
    <p>
      Plano de Contas
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview" id="it">
    <li class="nav-item" style="color: #59CBFF;">
      <a class="nav-link" style="color: #59CBFF;; ">
        <i class="far fa-circle nav-icon" style="color: #59CBFF;"></i>
        <p>Contas</p>
      </a>
        <ul class="nav nav-treeview" id="it">

          <li class="nav-item" style="color: #59CBFF;">

          <a href="/fluxocontas/add" class="nav-link" style="color: #59CBFF;; ">

        <i class="far fa-circle nav-icon" style="color: #59CBFF;"></i>

        <p>Adicionar</p>

      </a>

        

    </li>

    <li class="nav-item" style="color: #59CBFF;">

      <a href="/fluxocontas/index" class="nav-link" style="color: #59CBFF;; ">

        <i class="far fa-circle nav-icon" style="color: #59CBFF;"></i>

        <p>Disponíveis</p>

      </a>

    </li>

  </ul>
  </li>
    <li class="nav-item" style="color: #59CBFF;">
      <a class="nav-link" style="color: #59CBFF;; ">
        <i class="far fa-circle nav-icon" style="color: #59CBFF;"></i>
        <p>Subgrupos</p>
      </a>
        <ul class="nav nav-treeview" id="it">

    <li class="nav-item" style="color: #59CBFF;">

      <a href="/fluxosubgrupos/add" class="nav-link" style="color: #59CBFF;; ">

        <i class="far fa-circle nav-icon" style="color: #59CBFF;"></i>

        <p>Adicionar</p>

      </a>

        

    </li>

    <li class="nav-item" style="color: #59CBFF;">

      <a href="/fluxosubgrupos/index" class="nav-link" style="color: #59CBFF;; ">

        <i class="far fa-circle nav-icon" style="color: #59CBFF;"></i>

        <p>Disponíveis</p>

      </a>

    </li>

  </ul>
    </li>
  </ul>
</li>

<li class="nav-item has-treeview " style="color: #59CBFF;">
  <a class="nav-link" style="color: #59CBFF;">
    <i class="nav-icon fas fa-th" style="color: #59CBFF;"></i>
    <p>
      Fornecedores
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview" id="it">
    <li class="nav-item" style="color: #59CBFF;">
      <a href="/fornecedores/add" class="nav-link" style="color: #59CBFF;; ">
        <i class="far fa-circle nav-icon" style="color: #59CBFF;"></i>
        <p>Novo Fornecedor</p>
      </a>
    </li>
    <li class="nav-item" style="color: #59CBFF;">
      <a href="/fornecedores/index" class="nav-link" style="color: #59CBFF;; ">
        <i class="far fa-circle nav-icon" style="color: #59CBFF;"></i>
        <p>Seus Fornecedores</p>
      </a>
    </li>
  </ul>
</li>

<li class="nav-item has-treeview " style="color: #59CBFF;">
  <a class="nav-link" style="color: #59CBFF;">
    <i class="nav-icon fas fa-th" style="color: #59CBFF;"></i>
    <p>
      Clientes
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview" id="it">
    <li class="nav-item" style="color: #59CBFF;">
      <a href="/clientes/add" class="nav-link" style="color: #59CBFF;; ">
        <i class="far fa-circle nav-icon" style="color: #59CBFF;"></i>
        <p>Novo Cliente</p>
      </a>
    </li>
    <li class="nav-item" style="color: #59CBFF;">
      <a href="/clientes/index" class="nav-link" style="color: #59CBFF;; ">
        <i class="far fa-circle nav-icon" style="color: #59CBFF;"></i>
        <p>Seus Clientes</p>
      </a>
    </li>
  </ul>
</li>

<li class="nav-item" style="color: #59CBFF;">
  <a href="<?php echo '/caixas/abrir/' . $now; ?>" class="caixa nav-link" style="color: #59CBFF;" >
    <!-- <i class="nav-icon fas fa-th" style="color: #59CBFF;"></i> -->
    <!-- <p id="caixa">
      Abrir Caixa
    </p> -->
    <i class="bi bi-toggle-off"></i>
  <!-- <img src="off.png" alt="" id=""> -->
    <!-- <?= $this->Html->image($teste,)?> -->
  </a>
</li>

<li class="nav-item has-treeview " style="color: #59CBFF;">
  <a class="nav-link" style="color: #59CBFF;">
    <i class="nav-icon fas fa-th" style="color: #59CBFF;"></i>
    <p>
      Relatórios
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview" id="it">
    <li class="nav-item" style="color: #59CBFF;">
      <a href="/caixas/index" class="nav-link" style="color: #59CBFF;; ">
        <i class="far fa-circle nav-icon" style="color: #59CBFF;"></i>
        <p>Caixa</p>
      </a>
    </li>
    <li class="nav-item" style="color: #59CBFF;">
      <a href="/relatorios/caixadiario" class="nav-link" style="color: #59CBFF;; ">
        <i class="far fa-circle nav-icon" style="color: #59CBFF;"></i>
        <p>Caixa Diário</p>
      </a>
    </li>
    <li class="nav-item" style="color: #59CBFF;">
      <a href="/relatorios/gerencial" class="nav-link" style="color: #59CBFF;; ">
        <i class="far fa-circle nav-icon" style="color: #59CBFF;"></i>
        <p>Caixa Gerencial</p>
      </a>
    </li>
    <li class="nav-item" style="color: #59CBFF;">
      <a href="/relatorios/fluxodecaixa" class="nav-link" style="color: #59CBFF;; ">
        <i class="far fa-circle nav-icon" style="color: #59CBFF;"></i>
        <p>Fluxo de Caixa</p>
      </a>
    </li>
  </ul>
</li>

<li class="nav-item" style="color: #59CBFF;">
  <a href="/lancamentos/painel" class="nav-link" style="color: #59CBFF;">
    <i class="nav-icon fas fa-th" style="color: #59CBFF;"></i>
    <p>
    Painel
    </p>
  </a>
</li>

