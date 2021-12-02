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
    <div>
        <a href="/Lancamentos/caixa">
            <button type="button" class="btn btn-primary btn-lg btn-block">Relatorio de Caixa</button>
        </a>
       

        <a href="/Lancamentos/dre">
            <button type="button" class="btn btn-secondary btn-lg btn-block">Relatorio de Dre</button>
        </a>

    </div>
</body>

</html>