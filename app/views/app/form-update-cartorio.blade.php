<form name="cartorio">
    <div class="preload"></div>
    <div class="erros">
        <div class="message alert alert-danger" style="display: none"></div>
    </div>
    <div class="row">
        <input type="hidden" name="id" value="{{ $cartorio->id }}">
        <div class="col-md-12 col-sm-12">
            <label for="nome">Nome: <span class="text-danger">*</span></label>
            <input type="text" name="nome" id="nome" class="form-control required" value="{{ $cartorio->nome }}">
        </div>
        <div class="col-md-12 col-sm-12">
            <label for="razao">Razão social: <span class="text-danger">*</span></label>
            <input type="text" name="razao" id="razao" class="form-control required" value="{{ $cartorio->razao }}">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="tabeliao">Tabelião: <span class="text-danger">*</span></label>
            <input type="text" name="tabeliao" id="tabeliao" class="form-control required" value="{{ $cartorio->tabeliao }}">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="email">E-mail: <span class="text-danger">*</span></label>
            <input type="email" name="email" id="email" class="form-control required" value="{{ $cartorio->email }}">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="tipo_documento">Tipo documento: <span class="text-danger">*</span></label>
            <select name="tipo_documento" id="tipo_documento" class="form-control required" readonly>
                <option value="">Selecione...</option>
                <option value="1"{{ $cartorio->tipo_documento === '1' ? " selected": '' }}>CPF</option>
                <option value="2"{{ $cartorio->tipo_documento === '2' ? " selected": '' }}>CNPJ</option>
            </select>
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="documento">Documento: <span class="text-danger">*</span></label>
            <input type="text" name="documento" id="documento" class="cpf_cnpj form-control required"
                   value="{{ $cartorio->documento }}" readonly>
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="telefone">Telefone: <span class="text-danger">*</span></label>
            <input type="text" name="telefone" id="telefone" class="phone form-control required"
                   value="{{ $cartorio->telefone }}">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="endereco">Endereço: <span class="text-danger">*</span></label>
            <input type="text" name="endereco" id="endereco" class="form-control required"
                   value="{{ $cartorio->endereco()->nome }}">
        </div>
        <div class="col-md-6">
            <label for="uf">UF: <span class="text-danger">*</span></label>
            <select name="uf" id="uf" class="form-control required">
                <option value="">Selecione...</option>
                @foreach($ufs as $uf)
                    <option value="{{ $uf['name'] }}"
                            {{$cartorio->endereco()->uf === $uf['name'] ? 'selected':''}}>
                        {{ $uf['description'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="cidade">Cidade: <span class="text-danger">*</span></label>
            <input type="text" name="cidade" id="cidade" class="form-control required"
                   value="{{ $cartorio->endereco()->cidade }}">
        </div>
        <div class="col-md-4 col-sm-12">
            <label for="bairro">Bairro: <span class="text-danger">*</span></label>
            <input type="text" name="bairro" id="bairro" class="form-control required"
                   value="{{ $cartorio->endereco()->bairro }}">
        </div>
        <div class="col-md-4 col-sm-12">
            <label for="cep">CEP: <span class="text-danger">*</span></label>
            <input type="text" name="cep" id="cep" class="cep form-control required"
                   value="{{ $cartorio->endereco()->cep }}">
        </div>
        <div class="col-md-4 col-sm-12">
            <label for="status">Status: <span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-control required">
                <option value="">Selecione...</option>
                <option value="1" {{$cartorio->status === '1' ? 'selected':''}}>Ativo</option>
                <option value="0" {{$cartorio->status === '0' ? 'selected':''}}>Inativo</option>
            </select>
        </div>
    </div>
</form>