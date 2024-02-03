<input type="hidden" id="platform" name="platform" value="pc">
<label for="itemName">Enter Item Name:</label>
<input type="text" id="itemName" name="itemName" value="mirage_prime_systems">
<button onclick="fetchWarframeMarketData()">Fetch Data</button>
<div id="result">
</div>
<script>
    function fetchWarframeMarketData() {
    var platform = $("#platform").val();
    var itemName = $("#itemName").val();

    $.ajax({
        url: '/fetch-warframe-market/' + platform + '/' + itemName,
        type: 'GET',
        data: { platform: platform, itemName: itemName },
        success: function(response) {
            // Verificar se a resposta foi bem-sucedida
            if (response.payload && response.payload.orders) {
                // Iterar sobre as ordens e exibir informações
                var orders = response.payload.orders;
                var resultHtml = '';

                for (var i = 0; i < orders.length; i++) {
                    var order = orders[i];
                    resultHtml += '<p>Order ID: ' + order.id + '</p>';
                    resultHtml += '<p>Platinum: ' + order.platinum + '</p>';
                    resultHtml += '<p>Online: ' + order.order_type + '</p>';
                    // Adicione mais campos conforme necessário
                    resultHtml += '<hr>';
                    console.log(orders);
                }

                // Exibir os resultados na div 'result'
                $("#result").html(resultHtml);
            } else {
                $("#result").html('Nenhuma ordem encontrada para este item.');
            }
        },
        error: function(error) {
            console.log(error);
            $("#result").html('Erro ao buscar dados.');
        }
    });
}
</script>







{{-- <input type="text" id="itens" onkeyup="pesquisarItens()" placeholder="Procurar" class="col-12">
<table id="tabelaItens" border="1" class="col-12">
    <thead>
        <tr>
            <th>Item</th>
            <th>Ducats</th>
            <th>Platina</th>
        </tr>
    </thead>
    <tbody>
        @foreach($itens as $item)
        <tr>
            <td class="col-12 d-flex justify-content-between">
                <span>{{ $item->item }}</span>
                <a href="{{route('front-adicionar', $item->id)}}"><button>Adicionar</button></a>
            </td>
            <td>
                <span class="d-flex justify-content-end">{{$item['ducats']}}</span>
            </td>
            <td>
                <span class="d-flex justify-content-end">{{$item['platina']}}</span>
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
</script> --}}