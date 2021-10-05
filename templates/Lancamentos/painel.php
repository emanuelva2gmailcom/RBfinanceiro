<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
</head>

<body>
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Donut Chart</h3>
        </div>
        <div class="card-body">
            <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            <table class="table text-nowrap">
                <thead>
                    <tr>

                        <th class="teste"><?= ('Grupo FC') ?></th>
                        <th class="teste"><?= ('Conta FC') ?></th>
                        <th class="teste"><?= ('total') ?></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($obj as $lancamento) : ?>
                        <tr>

                            <td><?= h($lancamento[0]) ?></td>
                            <td><?= h($lancamento[1]) ?></td>
                            <td><?= h($lancamento[2]) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th><?= h('total') ?></th>
                        <th><?= h('') ?></th>
                        <th><?= h($total) ?></th>
                    </tr>
                </tbody>

            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        try {
            const response = axios.get('/lancamentos/getPainel/').then(function(response) { // handle success
                // console.log(response.data.entrada.total)
                let donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                let donutData = {
                    labels: [
                        'Entradas',
                        'Saidas',
                        'Total'
                    ],
                    datasets: [{
                        data: [response.data.entrada.total, response.data.saida.total, response.data.total],
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
            })
        } catch (error) {
            console.error(error);
        }
    </script>
</body>

</html>