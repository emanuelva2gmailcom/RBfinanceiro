<?php

$now = date('d-m-Y');

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
  }else{
    $('.caixa').addClass('bg-green')
    document.getElementById('caixa').innerHTML = 'Abrir Caixa'
  }
}
</script>

<li class="nav-item" style="color: #59CBFF;">
<a href="/relatorios/#" class="nav-link" style="color: #59CBFF;">
    <i class="nav-icon fas fa-th" style="color: #59CBFF;"></i>
    <p>
      Home
    </p>
  </a>
</li>

<li class="nav-item" style="color: #59CBFF;">
  <a href="/lancamentos/add" class="nav-link" style="color: #59CBFF;">
    <i class="nav-icon fas fa-th" style="color: #59CBFF;"></i>
    <p>
      Novo Lançamento
    </p>
  </a>
</li>

<li class="nav-item" style="color: #59CBFF;">
  <a href="<?php echo '/caixas/abrir/' . $now; ?>" class="caixa nav-link" style="color: #59CBFF;" >
    <i class="nav-icon fas fa-th" style="color: #59CBFF;"></i>
    <p id="caixa">
      Abrir Caixa
    </p>
  </a>
</li>

<li class="nav-item has-treeview " style="color: #59CBFF;">
  <a href="/relatorios/index" class="nav-link" style="color: #59CBFF;">
    <i class="nav-icon fas fa-th" style="color: #59CBFF;"></i>
    <p>
      Relatórios
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview" id="it">
    <li class="nav-item" style="color: #59CBFF;">
      <a href="/relatorios/fluxodecaixa" class="nav-link" style="color: #59CBFF;; margin-left: 25px;">
        <i class="far fa-circle nav-icon" style="color: #59CBFF;"></i>
        <p>Fluxo de Caixa</p>
      </a>
    </li>
    <li class="nav-item" style="color: #59CBFF;">
      <a href="/lancamentos/index" class="nav-link" style="color: #59CBFF;; margin-left: 25px;">
        <i class="far fa-circle nav-icon" style="color: #59CBFF;"></i>
        <p>Lançamentos</p>
      </a>
    </li>
    <li class="nav-item" style="color: #59CBFF;">
      <a href="/relatorios/gerencial" class="nav-link" style="color: #59CBFF;; margin-left: 25px;">
        <i class="far fa-circle nav-icon" style="color: #59CBFF;"></i>
        <p>Caixa Gerencial</p>
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

