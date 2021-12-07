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
    <div class="container-fluid d-flex align-items-center justify-content-center p-4">
      <div class="cardOPTION card card-outline container p-4">
        <div class="perguntaLANCAMENTO mb-5 justify-content-center d-flex">
            <h2>O que deseja fazer agora?</h2>
        </div>
        <div class="justify-content-center d-flex row">
            <div class="col-lg-2">
                <a href="/Relatorios/index">
                    <button type="button" class="btn btn-lg botaoMODAL">Voltar para a Home</button>
                </a>
            </div>
            <div class="col-lg-2">
                <a href="/Lancamentos/caixa">
                    <button type="button" class="btn btn-lg botaoMODAL">Relatório de Gestão de Caixa</button>
                </a>
            </div>
            <div class="col-lg-2">
                <a href="/Lancamentos/dre">
                    <button type="button" class="btn btn-lg botaoMODAL">Relatório de DRE</button>
                </a>
            </div>
            <div class="col-lg-2">
                <a href="/Lancamentos/index">
                    <button type="button" class="btn btn-lg botaoMODAL">Visualizar Lançamentos</button>
                </a>
            </div>
        </div>
      </div>
    </div>
</body>

</html>
