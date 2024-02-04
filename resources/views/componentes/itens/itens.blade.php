<input type="text" id="itens" onkeyup="pesquisarItens()" placeholder="Procurar" class="col-12">
<table id="tabelaItens" border="1" class="col-12">
    <thead>
        <tr>
            <p>Notes: Fazer fica igual inventario</p>
            <th>NOME</th>
            <th>ITEM</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($itens as $item)
        <tr>
            <td>
                <span>{{ $item->nome }}</span>
            </td>
            <td>
                <span>{{ $item->item }}</span>
            </td>
            
            <td class="col-12 d-flex justify-content-between">
                <a href="{{route('front-adicionar', $item->id)}}"><button class="btn btn-success">+</button></a>
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












{{-- <input type="hidden" id="txtPlataforma" name="Plataforma" value="pc">
<label>Enter Item Name:</label>
<input type="text" id="txtItem" name="Item" value="mirage_prime_systems">
<button onclick="fetchWarframeMarketData()">Fetch Data</button>
<div id="result"></div>
<script>
    function fetchWarframeMarketData() {
        var plataforma = $("#txtPlataforma").val();
        var item = $("#txtItem").val();
        $.ajax({
            url: '/fetch-warframe-market/' + plataforma + '/' + item,
            type: 'GET',
            data: { plataforma: plataforma, item: item },
            success: function(dados) {
                console.log(dados);
                

                // window.location.href = dados.url;

                // var vendas = [];
                // for(var i = 0; i < dados.payload.orders.length; i++){
                //     if (dados.payload.orders[i].user.status === 'ingame') {
                //         vendas.push(dados.payload.orders[i]);
                //     }
                // }
                // console.log(vendas[0]);
            },
            error: function(error) {
                console.error(error);
            }
        });
    }
</script>    --}}
