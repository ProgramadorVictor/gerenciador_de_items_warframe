@extends('template.template_front')
@section('conteudo')
<input type="text" id="inventario" onkeyup="pesquisarInventario()" placeholder="Procurar" class="col-12">
<table id="tabelaInventario" border="1" class="col-12">
    <thead>
        <tr>
            <th>Item</th>
            <th>Quantidade</th>
        </tr>
    </thead>
    <tbody>
        @foreach($estoque as $inventario)
        <tr>
            <td class="col-12 d-flex justify-content-between">
                <span>{{ $inventario['item'] }}</span>
                <button name="id" value="{{$inventario->id_item}}" onclick="(selecionado({{$inventario->id_item}}))" data-bs-toggle="modal" data-bs-target="#modal-venda">Venda</button>
            </td>
            <td>
                <span class="d-flex justify-content-end">{{$inventario['quantidade']}}</span>
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
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("inventario");
            filter = input.value.toUpperCase();
            table = document.getElementById("tabelaInventario");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                for (var j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        }
    </script>
@endsection