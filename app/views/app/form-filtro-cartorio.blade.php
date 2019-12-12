<form action="/inicio#cartorios" name="form-filtro" method="POST">
    <fieldset class="border p-2">
        <legend class="w-auto">Filtro</legend>
        <div class="form-group">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="razao" class="control-label small">Nome</label>
                        <input type="text" name="razao" id="razao" value="{{ $_REQUEST['razao'] }}"
                               class="form-control">
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="documento" class="control-label small">Documento</label>
                        <input type="text" name="documento" id="documento" value="{{ $_REQUEST['documento'] }}"
                               class="form-control cpfcnpj">
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="email" class="control-label small">E-mail</label>
                        <input type="email" name="email" id="email" value="{{ $_REQUEST['email'] }}"
                               class="form-control">
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-grupo">
                        <label for="status" class="control-label small">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Selecione...</option>
                            <option value="1"
                                    {{ isset($_REQUEST['status']) && $_REQUEST['status'] === '1' ? ' selected':'' }}>
                                Ativo
                            </option>
                            <option value="0"
                                    {{ isset($_REQUEST['status']) && $_REQUEST['status'] === '0' ? ' selected':'' }}>
                                Inativo
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-grupo">
                        <label for="num_registers" class="control-label small">Quantidade</label>
                        <select name="num_registers" id="num_registers" class="form-control">
                            <option value="10"{{ $_REQUEST['num_registers'] === '10' ? ' selected':'' }}>10</option>
                            <option value="50"{{ $_REQUEST['num_registers'] === '50' ? ' selected':'' }}>50</option>
                            <option value="100"{{ $_REQUEST['num_registers'] === '100' ? ' selected':'' }}>100</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-raw clearfix mt-2">
            <div class="col text-right">
                <button type="reset"
                        class="{{ $filtro ? 'limpar-filtro' : 'cancelar-filtro' }} btn btn-outline-danger">
                    {{ $filtro ? 'Limpar' : 'Cancelar' }}
                </button>
                <button type="submit" class="btn btn-outline-success">Filtrar</button>
            </div>
        </div>
    </fieldset>
</form>