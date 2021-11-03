<html lang="en">

<head>
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

        img{
            border-radius: 70px;
        }

       .tes img{
            width: 125px;
            height: 125px;
            margin-top: 5%;

        }


</style>


    <script>
        function realizado() {
            document.getElementById('real').style.display = 'block';
            document.getElementById('teste').style.display = 'block';
            document.getElementById('prev').style.display = 'none';
        }

        function previsto() {
            document.getElementById('real').style.display = 'none';
            document.getElementById('teste').style.display = 'block';
            document.getElementById('prev').style.display = 'block';
        }
    </script>


</head>

<body>
    <!-- 2°: Brown #7A3E26 / Coral #CF6856 / Champagne #F7E7CE /
         White #FFFFFF {check} -->


         <div class="position-relative overflow-hidden p-3 p-md-5 text-center" >
            <div class="container-fluid vh-50 m-0 py-5 justify-content-center">

            <div class="row">
              <div class="col-md-12 col-lg-6 col-xl-4">
                <div class="test card mb-2 " style="border-radius: 20px;border: solid 2px #7A3E26;">
                <div class="card-header bg-white" style="border-radius: 20px 20px 0px 0px ;">
                    <div class="m-auto h-75 w-75">
                        <?= $this->Html->image('fct.jpg') ?>
                    </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-end" style="background-color: #7A3E26;">
                    <h5 class="card-title" style="width: 50%;margin-left: 25%; color: #F7E7CE;">Fluxo de Caixa</h5>
                    <p class="card-text pb-2 pt-1" style="color: #F7E7CE;font-size: 14px;">Aqui você visualiza os registros das entradas <br> e saídas da empresa</p>
                </div>
                <div class="card-footer" style="border-radius: 0px 0px 14px 14px;background-color: #7A3E26;">
                   <a href="/relatorios/fluxodecaixa"> <p style="color: #F7E7CE;"> Visualizar <i class="fas fa-arrow-circle-right" style="color: #F7E7CE;"></i></p></a>
                </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-6 col-xl-4">
              <div class="test card mb-2 " style="border-radius: 20px;border: solid 2px #7A3E26;">
              <div class="card-header bg-white" style="border-radius: 20px 20px 0px 0px ;">
                    <div class="m-auto h-75 w-75">
                        <?= $this->Html->image('cgt.jpg') ?>
                    </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-end" style="background-color: #7A3E26;">
                    <h5 class="card-title" style="width: 50%;margin-left: 25%;color: #F7E7CE;">Caixa Gerencial</h5>
                    <p class="card-text pb-2 pt-1" style="color: #F7E7CE;font-size: 14px;">Aqui você verifica o controle de seu <br> fluxo de caixa</p>
                </div>
                <div class="card-footer" style="border-radius: 0px 0px 14px 14px;background-color: #7A3E26;">
                <a href="/relatorios/gerencial"> <p style="color: #F7E7CE;"> Verificar <i class="fas fa-arrow-circle-right" style="color: #F7E7CE;"></i></p></a>
                </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-6 col-xl-4">
              <div class="test card mb-2 " style="border-radius: 20px;border: solid 2px #7A3E26;">
              <div class="card-header bg-white" style="border-radius: 20px 20px 0px 0px ;">
                    <div class="m-auto h-75 w-75">
                        <?= $this->Html->image('cdt.jpg') ?>
                    </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-end" style="background-color: #7A3E26;">
                    <h5 class="card-title" style="width: 50%;margin-left: 25%;color: #F7E7CE;">Caixa Diário</h5>
                    <p class="card-text pb-2 pt-1" style="color: #F7E7CE;font-size: 14px;">Aqui você irá direto para o acompanhamento diário das entradas <br> e saídas de acordo com sua abertura de atividades até seu fechamento</p>
                </div>
                <div class="card-footer" style="border-radius: 0px 0px 14px 14px; background-color: #7A3E26;">
                <a href="/relatorios/caixadiario"> <p style="color: #F7E7CE;"> Acompanhar <i class="fas fa-arrow-circle-right" style="color: #F7E7CE;"></i></p></a>
                </div>
                </div>
          </div>
        </div>
                <!-- <ul class="row nav nav-pills">
                    <li class="col-4 nav-item">
                        <div class="d-flex justify-content-center">
                            <div class="bd-placeholder-img rounded-circle" style="width: 140px; height: 140px;"> <?= $this->Html->image('fc.jpg') ?></div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h2 class="text-center text-green">Fluxo de Caixa</h2>
                        </div>
                        <div class="d-flex justify-content-center" style="height: 100px;">
                            <p class="text-center text-cyan">Aqui você observa os registros das entradas e saídas da empresa</p>
                        </div>
                        <a class="nav-link bg-info w-50" style="margin-left: 25%;" href="#tab_2" data-toggle="tab">Fluxo de Caixa</a>
                    </li>
                    <li class="col-4 nav-item">
                        <div class="d-flex justify-content-center">
                            <div class="bd-placeholder-img rounded-circle" style="width: 140px; height: 140px;  background-color: white;"> <?= $this->Html->image('deposit-box.png') ?></div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h2 class="text-center text-green">Caixa Gerencial</h2>
                        </div>
                        <div class="d-flex justify-content-center" style="height: 100px;">
                            <p class="text-center text-cyan">Aqui você observa o controle de seu fluxo de caixa</p>
                        </div>
                        <a class="nav-link bg-info w-50" style="margin-left: 25%;" href="#tab_1" data-toggle="tab">Caixa Gerencial</a>
                    </li>
                    <li class="col-4 nav-item">
                        <div class="d-flex justify-content-center">
                            <div class="tes bd-placeholder-img rounded-circle" style="width: 140px; height: 140px; background-color: white;"> <?= $this->Html->image('caixa-registradora (1).png') ?> </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h2 class="text-center text-green">Caixa Diário</h2>
                        </div>
                        <div class="d-flex justify-content-center" style="height: 100px;">
                            <p class="text-center text-cyan">Aqui você irá direto para o acompanhamento diário das entradas e saídas de acordo com sua abertura de atividades até seu fechamento</p>
                        </div>
                        <a class="nav-link bg-info w-50" style="margin-left: 25%;" href="/relatorios/caixadiario">Caixa Diário</a>

                    </li>
                </ul>
                <div id="teste" class="container-fluid vh-50 m-0 py-5 mt-4 justify-content-center" style="background-color: white; border-radius: 20px;">

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <?= $this->element('relatorios/gerencial', ['obj' => $gerencial]) ?>
                        </div>
                         /.tab-pane
                        <div class="tab-pane" id="tab_2">
                            <?= $this->element('relatorios/fluxodecaixa', ['obj' => $fluxo]) ?>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>


    <!-- <script>
        function fc() {
            $('.cai').removeClass('d-none');
            $('.cai').removeClass('d-sm-block');
            $('.ger').addClass('d-none');
        }

        function cg() {
            $('.ger').removeClass('d-none');
            $('.ger').removeClass('d-sm-block');
            $('.cai').addClass('d-none');
        }
    </script> -->

    <script src="/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>

</html>
