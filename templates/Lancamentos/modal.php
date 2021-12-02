
<!-- Modal -->
<style>
    a {
        text-decoration: none;
        color: black;
    }
</style>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close">

                    <a href="/Relatorios/index"> <span aria-hidden="true">&times;</span></a>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-lg"><a href="/Relatorios/index">Cancelar</a></button>
                <button type="button" class="btn btn-primary btn-lg"><a href="/Lancamentos/add">Novo Lançamento</a></button>
            </div>
        </div>
    </div>
</div>
<script>
    $('document').ready(function() {
        $('#exampleModal').modal('show');
    })
</script>