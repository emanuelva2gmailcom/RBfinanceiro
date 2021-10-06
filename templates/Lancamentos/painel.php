<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
</head>

<body onload="onload()">
    <div class="card card-danger" id="cu">
        <div class="card-header">
            <h3 class="card-title">Donut Chart</h3>
        </div>
        <div class="card-body">
            <div class="content">
                <?= $this->Form->create([], ['id' => 'form']) ?>
                <?= $this->Form->control('mes', ['class' => 'form-control mes', 'type' => 'month']); ?>
                <?= $this->Form->select('tipo', ['REALIZADO' => 'Realizado', 'PREVISTO' => 'Previsto'], ['class' => 'form-control tipo', 'id' => 'card']); ?>
                <?= $this->Form->button(__('Submit', ['class' => 'btn btn-dark pull-right'])) ?>
                <?= $this->Form->end() ?>
            </div>
            <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            <table class="table text-nowrap">
                <thead>
                    <tr>
                        <th class="teste"><?= ('Grupo FC') ?></th>
                        <th class="teste"><?= ('Conta FC') ?></th>
                        <th class="teste"><?= ('total') ?></th>
                    </tr>
                </thead>

                <tbody id="table-body">


                </tbody>

            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function show(data) {
            let output = ''
            for (let d of data[0]) {
                output += `<tr>
                            <td>${d[0]}</td>
                            <td>${d[1]}</td>
                            <td>${d[2]}</td>
                        </tr>`
            }
            output += `<tr>
                        <th>total</th>
                        <th> </th>
                        <th>${data[1]}</th>
                    </tr>`

            document.getElementById('table-body').innerHTML = output;
        }

        let donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        let donutData = {
            labels: [
                'Entradas',
                'Saidas',
                'Total'
            ],
            datasets: [{
                data: [],
                backgroundColor: ['#f56954', '#00a65a', '#FF9FFF'],
            }]
        }
        let donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        let donutChart = new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })

        function chart(data) {
            donutChart.data.datasets[0].data = [data.entrada, data.saida, data.total]
            donutChart.update()
        }

        const csrf = document.querySelector("#form").querySelectorAll('input[name ="_csrfToken"]')[0].value;
        console.log(csrf)
        $("button").click(function(event) {
            event.preventDefault();
            $tipo = $(".tipo").val()
            $mes = $(".mes").val()

            try {
                const response = axios.post('/lancamentos/getTablePainel/', [$tipo, $mes], {
                    headers: {
                        "X-CSRF-Token": csrf
                    }
                }).then(function(response) { // handle success
                    chart(response.data[2])
                    show(response.data)
                })
            } catch (error) {
                console.error(error);
            }
        })
        try {
            const response = axios.get('/lancamentos/getTablePainel/').then(function(response) { // handle success
                show(response.data)
                chart(response.data[2])
            })
        } catch (error) {
            console.error(error);
        }
    </script>
</body>

</html>