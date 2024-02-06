@extends('template.template_front')
@section('conteudo')
<input type="text" id="inventario" onkeyup="pesquisarInventario()" placeholder="Buscar no inventário" class="col-12 border-0">
<input type="hidden" id="txtPlataforma" name="Plataforma" value="pc">
<table id="tabelaInventario" class="col-12 table">
    <thead>
        <tr class="d-flex justify-content-around">
            <th class="col-1 text-sm p-0">IMG</th>
            <th class="col-2 text-sm p-0">NOME</th>
            <th class="col-2 text-sm p-0">ESTOQUE</th>
            <th class="col-2 text-sm p-0">RECOMENDO</th>
            <th class="col-2 text-sm p-0">MÉDIA</th>
            <th class="col-3 text-sm p-0">AÇÃO</th>
        </tr>
    </thead>
    <tbody>
        @foreach($estoque as $inventario)
            <tr class="d-flex justify-content-around">
                <td class="col-1 p-0">NULL</td>
                <td class="col-2 p-0"><span class="text-sm">{{ $inventario['nome'] }}</span></td>
                <td class="col-2 p-0"><span>{{$inventario['quantidade']}}</span></td>
                {{-- quantidade troca para estoque --}}
                {{-- DIFERENCIRA OS REQ --}}
                <td id="txtRecomendavel{{ $inventario->id_item }}" class="col-2 p-0">0</td>
                <td id="txtMedia{{ $inventario->id_item }}" class="col-2 p-0"></td>
                <td class="col-3 d-flex p-0">
                    <div class="col-6 m-1">
                        <button class="btn btn-danger rounded-0" name="id" value="{{$inventario->id_item}}" onclick="(selecionado({{$inventario->id_item}}))" data-bs-toggle="modal" data-bs-target="#modal-venda">SELL</button>
                    </div>
                    <div class="col-6 m-1">
                        <button class="btn btn-warning rounded-0 btn-req" id="txtReq{{$inventario->id_item}}" data-item="{{$inventario->item}}" onclick="fetchWarframeMarketData(this)">REQ</button>
                        {{-- <button class="btn btn-warning rounded-0 " name="txtReq" value="{{$inventario->item_vendido}}" onclick="console.log('Item:', '{{$inventario->item_vendido}}'); fetchWarframeMarketData('{{$inventario->item_vendido}}')">REQ</button> --}}
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            if($('#errors').val()){
                $('#modal-venda').modal('show');
            }
        });
        function selecionado(id) {
            $.ajax({
                url: '/obter-detalhes-de-venda/' + id,
                type: 'GET',
                success: function(data) {
                    $('#id').val(data.detalhes.id_item);
                    $('#estoque').val(data.detalhes.quantidade);
                    $('#item').val(data.detalhes.item);
                    var detalhes = data.detalhes;
                },
                error: function(error) {
                    console.error('Erro ao obter dados:', error);
                }
            });
        }
        function pesquisarInventario() {
            var filter = $("#inventario").val().toUpperCase();
            var table = $("#tabelaInventario");
            var tr = table.find("tr");
            tr.each(function () {
                var found = false;
                var td = $(this).find("td");
                td.each(function () {
                    var txtValue = $(this).text().toUpperCase();
                    if (txtValue.indexOf(filter) > -1) {
                        found = true;
                        return false; 
                    }
                });
                var buttons = $(this).find('.btn');
                td.each(function () {
                    if (found) {
                        $(this).css("display", "");
                        buttons.show();
                    } else {
                        $(this).css("display", "none");
                        buttons.hide();
                    }
                });
            });
        }
        function fetchWarframeMarketData(item_parametro) {
            var plataforma = $("#txtPlataforma").val();
            var item = $(item_parametro).data("item");
            var id = parseInt($(item_parametro).attr("id").slice(-1), 10);
            $.ajax({
                url: '/fetch-warframe-market/' + plataforma + '/' + item,
                type: 'GET',
                data: { plataforma: plataforma, item: item },
                success: function(dados) {
                    var platinum = [];
                    var medio = 0;
                    var baixo;
                    dados.forEach(function(orders) {
                        platinum.push(orders['platinum']);
                        medio += orders['platinum'];
                    });
                    platinum.sort();
                    baixo = platinum[0];
                    var middleIndex = Math.floor(platinum.length / 2);
                    var recomendavel = (platinum.length % 2 === 0) ? (platinum[middleIndex - 1] + platinum[middleIndex]) / 2 : platinum[middleIndex];
                    $('#txtMedia'+id).html(medio);
                    $('#txtRecomendavel'+id).html(recomendavel+baixo);
                    $('#txtMediaModal'+id).html(medio);
                    //Como implementar um recomendavel valor, entender melhor?
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    </script>
@endsection

