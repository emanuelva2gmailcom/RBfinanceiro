<html lang="en"><head>
    <meta charset="utf-8">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/product/">



    <!-- Bootstrap core CSS -->
<link href="/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

    </style>
    <style>
    .teste {
        color: #E1E7F0;
    }
</style>
<script>
function realizado() {
    document.getElementById('real').style.display= 'block';
    document.getElementById('teste').style.display= 'block';
    document.getElementById('prev').style.display= 'none';
  }

  function previsto(){
    document.getElementById('real').style.display= 'none';
    document.getElementById('teste').style.display= 'block';
    document.getElementById('prev').style.display= 'block';
  }
</script>


  </head>
  <body>

<main>
  <div class="position-relative overflow-hidden p-3 p-md-5 text-center bg-gray" style="min-height: 100vh;">
    <div class="container-fluid vh-50 bg-red m-0 py-5 justify-content-center">
  <div class="row">
    <div class="col-4">
      <div class="d-flex justify-content-center">
        <div class="bd-placeholder-img rounded-circle bg-blue" style="width: 140px; height: 140px;"></div>
      </div>
      <div class="d-flex justify-content-center">
        <h2 class="text-center">Fluxo de Caixa</h2>
      </div>
      <div class="d-flex justify-content-center">
        <p class="text-center">Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
      </div>
      <div class="d-flex justify-content-center">
        <p class="text-center"><?= $this->Html->link(__('Fluxodecaixa'), ['action' => '#'], ['class' => 'btn btn-primary', 'onclick' => 'realizado()']) ?></p>
      </div>
    </div>
    <div class="col-4">
      <div class="d-flex justify-content-center">
        <div class="bd-placeholder-img rounded-circle bg-blue" style="width: 140px; height: 140px;"></div>
      </div>
      <div class="d-flex justify-content-center">
        <h2 class="text-center">Caixa Gerencial</h2>
      </div>
      <div class="d-flex justify-content-center">
        <p class="text-center">Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
      </div>
      <div class="d-flex justify-content-center">
      <?= $this->Html->link(__('Gerencial'), ['action' => '#'], ['class' => 'btn btn-primary', 'onclick' => 'previsto()']) ?>
      </div>
    </div>
    <div class="col-4">
      <div class="d-flex justify-content-center">
        <div class="bd-placeholder-img rounded-circle bg-blue" style="width: 140px; height: 140px;"></div>
      </div>
      <div class="d-flex justify-content-center">
        <h2 class="text-center">Caixa Diário</h2>
      </div>
      <div class="d-flex justify-content-center">
        <p class="text-center">Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
      </div>
      <div class="d-flex justify-content-center">
      <?= $this->Html->link(__('Caixa diario'), ['controller' => 'relatorios', 'action' => 'caixadiario'], ['class' => 'btn btn-primary btn-sm']) ?>
      </div>
    </div>
  </div>
</div>
<div id="teste" class="container-fluid vh-50 bg-blue m-0 py-5 justify-content-center" style="display: none;">

  <div class="card-body table-responsive p-0">
    <div id='prev' style="display:none;">
        <?= $this->element('relatorios/gerencial', ['obj' => $gerencial]) ?>
    </div>

    <div id='real' style="display:none;">
        <?= $this->element('relatorios/fluxodecaixa', ['obj' => $fluxo]) ?>
    </div>
  </div>

  </div>

</main>

<script>
    function fc() {
     $('.cai').removeClass('d-none');
     $('.cai').removeClass('d-sm-block');
     $('.ger').addClass('d-none');
    }

    function cg(){
     $('.ger').removeClass('d-none');
     $('.ger').removeClass('d-sm-block');
     $('.cai').addClass('d-none');
    }
</script>

<script src="/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>

</html>
