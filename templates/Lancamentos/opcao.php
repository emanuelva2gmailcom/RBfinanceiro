<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <?php $this->assign('title', __('Adicionar Lançamento')); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <?= $this->Html->css('bs-stepper.min.css'); ?>
</head>


<body>
    <div class="container-fluid d-flex align-items-center justify-content-center p-5">
      <div class="cardCaixaDiario card card-outline container p-5">
        <div class="perguntaLANCAMENTO mb-5 justify-content-center d-flex">
            <h2>O que deseja fazer agora?</h2>
        </div>
        <div class="justify-content-around">
            <a href="/Relatorios/index" class=" mr-5">
                <button type="button" class="btn btn-lg botaoMODAL">Cancelar lançamento</button>
            </a>
            <a href="/Lancamentos/caixa" class="ml-4 mr-4">
                <button type="button" class="btn btn-lg botaoMODAL">Relatorio de Caixa</button>
            </a>
            <a href="/Lancamentos/dre" class="ml-5 mr-4">
                <button type="button" class="btn btn-lg botaoMODAL">Relatorio de Dre</button>
            </a>
            <a href="/Lancamentos/index" class="ml-5">
                <button type="button" class="btn btn-lg botaoMODAL">Visualizar Lançamentos</button>
            </a>
        </div>
      </div>
    </div>
</body>

</html>
