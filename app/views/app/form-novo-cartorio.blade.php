<form name="cartorio" class="form-horizontal mt-3">
    <div class="row">
        <div class="col">
            <div class="erros">
                <div class="message alert alert-danger" style="display: none"></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="nome">Nome: <span class="text-danger">*</span></label>
                    <input type="text" name="nome" id="nome" class="form-control required" value="">
                </div>
                <div class="col-md-12">
                    <label for="razao">Razão social: <span class="text-danger">*</span></label>
                    <input type="text" name="razao" id="razao" class="form-control required" value="">
                </div>
                <div class="col-md-6">
                    <label for="tabeliao">Tabelião: <span class="text-danger">*</span></label>
                    <input type="text" name="tabeliao" id="tabeliao" class="form-control required" value="">
                </div>
                <div class="col-md-6">
                    <label for="email">E-mail: </label>
                    <input type="email" name="email" id="email" class="form-control" value="">
                </div>
                <div class="col-md-6">
                    <label for="tipo_documento">Tipo documento: <span class="text-danger">*</span></label>
                    <select name="tipo_documento" id="tipo_documento" class="form-control required">
                        <option value="">Selecione...</option>
                        <option value="1">CPF</option>
                        <option value="2">CNPJ</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="documento">Documento: <span class="text-danger">*</span></label>
                    <input type="text" name="documento" id="documento" class="form-control required"
                           value="" disabled>
                </div>
                <div class="col-md-6">
                    <label for="telefone">Telefone: <span class="text-danger">*</span></label>
                    <input type="text" name="telefone" id="telefone" class="phone form-control required"
                           value="">
                </div>
                <div class="col-md-6">
                    <label for="endereco">Endereço: <span class="text-danger">*</span></label>
                    <input type="text" name="endereco" id="endereco" class="form-control required"
                           value="">
                </div>
                <div class="col-md-6">
                    <label for="uf">UF: <span class="text-danger">*</span></label>
                    <select name="uf" id="uf" class="form-control required">
                        <option value="">Selecione...</option>
                        @foreach($ufs as $uf)
                            <option value="{{ $uf['name'] }}">{{ $uf['description'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="cidade">Cidade: <span class="text-danger">*</span></label>
                    <input type="text" name="cidade" id="cidade" class="form-control required"
                           value="">
                </div>
                <div class="col">
                    <label for="bairro">Bairro: <span class="text-danger">*</span></label>
                    <input type="text" name="bairro" id="bairro" class="form-control required"
                           value="">
                </div>
                <div class="col-md-6">
                    <label for="cep">CEP: <span class="text-danger">*</span></label>
                    <input type="text" name="cep" id="cep" class="cep form-control required"
                           value="">
                </div>
            </div>
        </div>
    </div>
</form>
