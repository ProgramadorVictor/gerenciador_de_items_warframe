@extends('template.template_front')
@section('conteudo')
<style>
</style>
<input type="text" id="inventario" onkeyup="pesquisarInventario()" placeholder="Buscar no inventário" class="col-12" style="border: none;">
<table id="tabelaInventario" class="col-12">
    <thead class="col-12">
        <tr class="col-12">
            <th class="text-sm">IMG</th>
            <th class="text-sm">NOME</th>
            <th class="text-sm">ESTOQUE</th>
            <th class="text-sm">COMPRADO</th>
            <th class="text-sm">MENOR</th>
            <th class="text-sm">MÉDIA</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($estoque as $inventario)
        <tr class="">
            <td class="">
                IMG
            </td>
            <td class="">
                <span class="text-sm">{{ $inventario['nome'] }}</span>
            </td>
            <td class="">
                <span>{{$inventario['quantidade']}}</span>
            </td>
            <td class="">
                0
            </td>
            <td class="">
                0
            </td>
            <td class="">
                0
            </td>
            <td class="">
                0
            </td>
            <td class="">
                <button class="btn btn-danger"name="id" value="{{$inventario->id_item}}" onclick="(selecionado({{$inventario->id_item}}))" data-bs-toggle="modal" data-bs-target="#modal-venda">-</button>
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