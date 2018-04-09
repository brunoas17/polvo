<div class="row">
    <div class="form-group {{ $errors->has('sku') ? 'has-error' : ''}} col-md-6">
        <label for="sku" class="col-md-4 control-label">{{ 'Sku' }}</label>
        <div >
            <input class="form-control" name="sku" type="text" id="sku" value="{{ $produto->sku or ''}}" >
            {!! $errors->first('sku', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}} col-md-6">
        <label for="nome" class="col-md-4 control-label">{{ 'Nome' }}</label>
        <div >
            <input class="form-control" name="nome" type="text" id="nome" value="{{ $produto->nome or ''}}" >
            {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('descricao') ? 'has-error' : ''}} col-md-6">
        <label for="descricao" class="col-md-4 control-label">{{ 'Descricao' }}</label>
        <div >
            <textarea class="form-control" rows="5" name="descricao" type="textarea" id="descricao" >{{ $produto->descricao or ''}}</textarea>
            {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('preco') ? 'has-error' : ''}} col-md-6">
        <label for="preco" class="col-md-4 control-label">{{ 'Preco' }}</label>
        <div >
            <input class="form-control" name="preco" type="decimal" id="preco" value="{{ $produto->preco or ''}}" >
            {!! $errors->first('preco', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-4 pull-right">
                <input class="btn btn-primary pull-right" type="submit" value="{{ 'Salvar' }}">
            </div>
        </div>
    </div>
</div>
