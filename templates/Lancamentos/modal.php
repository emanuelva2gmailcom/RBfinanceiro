
<!-- Modal -->
<div class="modal fade mt-5" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content contentMODAL">
            <!-- <div class="modal-header headerMODAL">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close">
                    <a href="/Relatorios/index"> <span aria-hidden="true">&times;</span></a>
                </button>
            </div> -->
            <div class="modal-body bodyMODAL justify-content-center d-flex mt-3">
                <h5>Deseja adicionar mais algum lançamento?</h5>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn botaoMODAL btn-sm"><a href="/Relatorios/index">Cancelar</a></button>
                <button type="button" class="btn botaoMODAL btn-sm"><a href="/Lancamentos/opcao">Novo Lançamento</a></button>
            </div>
        </div>
    </div>
</div>
<script>
    $('document').ready(function() {
        $('#exampleModal').modal('show');
    })
</script>
