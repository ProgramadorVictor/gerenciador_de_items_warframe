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
        <input id="txtTamanho" type="hidden" value="{{ count($estoque) }}">
        @foreach($estoque as $inventario)
            <tr class="d-flex justify-content-around">
                <input id="txtItem{{$inventario->id_item}}" type="hidden" value="{{$inventario->item}}">
                <td id="txtImagem" class="col-1 p-0">
                    <img id="imagem" src="" style="max-width: 50px; max-height: 50px;">
                </td>
                <td class="col-2 p-0"><span class="text-sm">{{ $inventario['nome'] }}</span></td>
                <td class="col-2 p-0"><span>{{$inventario['quantidade']}}</span></td>
                <td id="txtRecomendavel{{ $inventario->id_item }}" class="col-2 p-0">0</td>
                <td id="txtMedia{{ $inventario->id_item }}" class="col-2 p-0"></td>
                <td class="col-3 d-flex p-0">
                    <div class="col-6 m-1">
                        <button class="btn btn-danger rounded-0" name="id" value="{{$inventario->id_item}}" onclick="(selecionado({{$inventario->id_item}}))" data-bs-toggle="modal" data-bs-target="#modal-venda">SELL</button>
                    </div>
                    <div class="col-6 m-1">
                        <button class="btn btn-warning rounded-0 btn-req" id="txtReq{{$inventario->id_item}}" data-item="{{$inventario->item}}" onclick="fetchWarframeMarketData(this)">REQ</button>
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
            var plataforma = $("#txtPlataforma").val();
            var item = [];
            var tamanho = parseInt($('#txtTamanho').val()) + 1;
            for(var i = 1; i < tamanho; i++){
                item.push($('#txtItem'+i).val());
            }

            var filename = 'systems.webp';
            $.ajax({
                url: '/storage/' + filename,
                method: 'GET',
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(data) {
                    console.log('AJAX success');
                    var imageUrl;
                    var tamanho = parseInt($("#txtTamanho").val());
                    var name = [];
                    for (var i = 0; i < tamanho; i++) {
                        name.push($('#txtItem' + (i + 1)).val());
                        console.log('Item name:', name[i]);
                        if (name[i].indexOf('systems') !== -1) {
                            imageUrl = '/storage/systems.webp';
                        } else if (name[i].indexOf('blueprint') !== -1) {
                            imageUrl = '/storage/blueprint.webp';
                        } else if (name[i].indexOf('neuroptics') !== -1) {
                            imageUrl = '/storage/helmet.webp';
                        } else if (name[i].indexOf('chassis') !== -1) {
                            imageUrl = '/storage/chassis.webp';
                        }
                        $('#tabelaInventario tbody tr:eq(' + i + ') #imagem').attr('src', imageUrl);
                    }
                    
                },
                error: function(xhr, status, error) {
                    // Se ocorrer algum erro na requisição, exibir uma mensagem de erro
                    console.error('Erro ao carregar imagem:', status, error);
                }
            });







            // $.ajax({
            //     url:'/fetch-warframe-img/' + plataforma + '/' + item,
            //     type: 'GET',
            //     data: { 
            //         plataforma: plataforma,
            //         item: item
            //     },
            //     success: function(dados) {
            //         console.log(dados);
            //         dados.forEach(function(url, index) {
            //             // Cria um novo elemento de imagem
            //             var img = document.createElement('img');
                        
            //             // Atribui o URL da imagem ao atributo src
            //             img.src = url;
                        
            //             // Adiciona a classe se desejar (opcional)
            //             img.className = 'imagem-warframe';
                        
            //             // Encontra o elemento td correspondente à coluna de imagem pelo identificador único (id)
            //             var tdImagem = document.getElementById('txtImagem' + index); // Removi o parêntese extra nesta linha
                                
            //             // Verifica se o elemento td foi encontrado antes de tentar adicionar a imagem
            //             if (tdImagem) {
            //                 // Limpa o conteúdo anterior da célula de imagem
            //                 tdImagem.innerHTML = '';
                            
            //                 // Adiciona a imagem ao elemento td
            //                 tdImagem.appendChild(img);
            //             } else {
            //                 console.error('Elemento de imagem não encontrado para o índice ' + index);
            //             }
            //         });
            //     },
            //     error: function(error) {
            //         console.error(error);
            //     }
            // });
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

