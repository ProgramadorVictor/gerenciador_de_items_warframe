<input type="text" id="itens" onkeyup="pesquisarItens()" placeholder="Buscar itens no jogo (Não esta funcionando)" class="col-12 border-0">
<table id="tabelaItens" border="1" class="col-12 table">
    <thead>
        <tr class="d-flex justify-content-around">
            <th class="col-2 text-sm p-0">IMG</th>
            <th class="col-3 text-sm p-0">NOME</th>
            <th class="col-3 text-sm p-0">ITEM</th>
            <th class="col-4 text-sm p-0">AÇÃO</th>
        </tr>
    </thead>
    <tbody>
        @foreach($itens as $item)
            <tr class="d-flex justify-content-around">
                <td class="col-2 p-0">NULL</td>
                <td class="col-3 p-0"><span class="text-sm">{{ $item->nome }}</span></td>
                <td class="col-3 p-0"><span class="text-sm">{{ $item->item }}</span></td>
                <td class="col-4 d-flex justify-content-between">
                    <div class="col-6 m-1">
                        {{-- <button class="btn btn-success rounded-0" data-bs-toggle="modal" data-bs-target="#modal-adicionar-item">ADC</button> --}}
                        <a href="{{route('front-adicionar', $item->id)}}">TEM QUE DESATIVAR ESSE E ATIVA O OUTRO</a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    function pesquisarItens() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("itens");
        filter = input.value.toUpperCase();
        table = document.getElementById("tabelaItens");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            for (var j = 0; j < td.length; j++) {
                if (td[j]) {''
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