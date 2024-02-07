<div class="modal fade" id="modal-venda" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center bg-gray">
                <h5 class="modal-title d-flex align-items-center text-white bg-gray" id="exampleModalLabel">FORMULÁRIO DE VENDA</h5>
            </div>
            <input type="hidden" name="errors" id="errors" value="{{ $errors->any() }}">
            <form autocomplete="off" action="{{route('front-remover')}}" method="post" id="ajax-form">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{old('id')}}">
                    <label for="item" class="fw-bolder col-12">Item: <span class="text-sm">(Este é o item que você vai vender!)</span></label>
                    <input class="col-12 ps-2" type="text" id="item" name="item" value="{{old('item')}}" readonly>
                    <span class="text-danger">{{$errors->has('item') ? $errors->first('item') : ''}}</span>
                    <label for="estoque" class="fw-bolder col-12">Estoque: <span class="text-sm">(Quantos você tem no estoque?)</span></label>
                    <input class="col-12 ps-2" type="text" id="estoque" name="estoque" value="{{old('estoque')}}" readonly>
                    <span class="text-danger">{{$errors->has('estoque') ? $errors->first('estoque') : ''}}</span>
                    <label for="quantidade" class="fw-bolder col-12">Quantidade: <span class="text-sm">(Quantos você vai vender?)</span></label>
                    <input class="col-12 ps-2" type="text" id="quantidade" name="quantidade" value="{{old('quantidade') ?? 1}}">
                    <span class="text-danger">{{$errors->has('quantidade') ? $errors->first('quantidade') : ''}}</span>
                    <label for="preco" class="fw-bolder col-12">Preço: <span class="text-sm">(Qual o preço a ser vendido?)</span></label>
                    <input class="col-12 ps-2" type="text" id="preco" name="preco" value="{{old('preco')}}" placeholder="Recomendamos 30 por unidade. (Fazer alteração com JS)">
                    <span class="text-danger">{{$errors->has('preco') ? $errors->first('preco') : ''}}</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">FECHAR</button>
                    <button type="submit" class="btn btn-primary">VENDIDO</button>
                </div>
            </form>
        </div>
    </div>
</div>