<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    @includeFirst(['emails.style', 'iauctions::emails.base.style'])

</head>

<body>
<div id="body">
    <div id="template-mail">
        @php
            $date=strftime("%d de %B de %Y",strtotime("now"));
            $fields=$user->fields()->get();
            $business=json_decode($fields->where('name','juridic')->first())->value->businessName??null;
            $cityBusiness=json_decode($fields->where('name','basic')->first())->value->city;
            $product=$auction->winner->product;
            $bid=$auction->winner;
            $total=$bid->price*$auction->quantity;

        @endphp
        @includeFirst(['emails.header', 'iauctions::emails.base.header'])

        {{-- ***** Order Content  ***** --}}
        <div id="contend-mail" class="p-3">

            <p class="px-3">
                <strong>Ambalema,</strong> {{$date}}
            </p>
            <br>
            <p class="px-3">
                Señores </br>
                @if(isset($business) && !empty($business))
                    <strong>{{$business}}</strong> <br>
                @endif
                Ant:{{$user->first_name}} {{$user->last_name}}<br>
                {{$cityBusiness}}
            </p>

            <div class="px-3" style="margin-bottom: 5px">
                <p>
                    Apreciando(a) Ing.
                </p>
                <p>
                    Atendiendo lo establecido en la cotización de fecha <strong>{{$date}}</strong> presentada por
                    ustedes y aceptada por parte de Organización Pajonales S.A.S mediante el oficio JC-{{$auction->id}}
                    de fecha <strong>{{strftime("%d de %B de %Y",strtotime($auction->created_at))}}</strong> y de
                    acuerdo de acuerdo a la licitación No {{$auction->id}}, realizada por nuestro sistema con la
                    siguiente descripción:
                </p>
                <p>
                    {!! $auction->description!!}
                </p>
                <p>
                    Nos permitimos hacer la solicitud del siguiente producto:
                </p>
                <style>
                    .description, th, td{
                        font-size: 12px;
                        border: #e2e2e2 solid 1px
                    }
                </style>
                <table class="description">
                    <thead>
                    <tr>
                        <th>REQ</th>
                        <th>NOMBRE COMERCIAL</th>
                        <th>PRECIO UNIDAD</th>
                        <th>PLAZO</th>
                        <th>TOTAL CANTIDAD REQUERIDA</th>
                        <th>PRESENTACION EMPAQUE</th>
                        <th>VALOR TOTAL PRODUCTO</th>
                        <th>FECHA DE ENTREGA</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            {{$auction->req??""}}
                        </td>
                        <td>
                            {{$product->name}}
                        </td>
                        <td>
                            {{$bid->price}}
                        </td>
                        <td>
                            {{$bid->longer_term}}
                        </td>
                        <td>
                            {{$auction->quantity??""}}
                        </td>
                        <td>
                            {{$auction->product_unit??""}}
                        </td>
                        <td>
                            {{$total}}
                        </td>
                        <td>
                            {{$auction->date_delivery??date('Y/m/d')}}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <br>
                <strong>ENTREGA: {{$auction->place_delivery??''}}</strong>
                <p>
                    <strong>Entrega:</strong> Los productos deben ser entregados en las fechas y dirección establecida en cada cuadro, en buenas condiciones, por cuenta y riesgo del proveedor y dentro de los siguientes horarios </p>
                <p>
                    Lunes a viernes: 6:30 A 11:30 a.m y de  1:30 A 3:30 p.m
                    <br>
                    sabado: 6:30 A 11:30 a.m y de 1:30 a 2:30 p.m
                </p>
                <p>
                    Los vehículos de 35 to. Deben llegar a pesar en la Planta Agroindustrial, ubicada en Ambalema salida KM-96, entregar el producto en la Hacienda indicada y retornar a pesar para obtener la cantidad neta del producto recibido
                </p>
                <p>
                    <strong>Radicación factura:</strong> Se entrega factura original junto a la orden de compra autorizada en las oficinas de Organización Pajonales SAS.
                </p>
                <p>
                    <strong>Vencimiento:</strong> el producto deberá contar con un mínimo de 18 meses de vencimiento después de la entrega.
                </p>
                <p>
                    <strong>Descargue del Fertilizante:</strong> Organización Pajonales realizará el descargue del fertilizante. Favor informar con 24 horas de anticipación la llegada de los vehículos
                </p>
                <p>
                    <strong>Opción de compra:</strong> El proveedor otorga la opción a Organización Pajonales S.A.S de comprar una cantidad adicional igual al 100% del pedido efectuado en este oficio. Esta opción de compra vence 30 días correspondientes a la última entrega del producto facturado, conservará las condiciones en valor, plazos y la proporcionalidad en el tipo de presentación sobre la cual se está haciendo esta compra en firme.
                </p>
                <p>
                    <strong>Observaciones:</strong> El proveedor garantizara el buen desempeño del producto así como su efectividad y se compromete a realizar acompañamiento técnico a la Compañía.
                </p>
                <p>
                    Cordialmente
                </p>
                <p>
                    <strong>Diana Milena Pedraza Salamaca</strong><br>
                    Jefe de Compras<br>
                    <a href="mailto:compras@pajonales.com" target="_blank">compras@pajonales.com</a>
                </p>
            </div>

        </div>


        @includeFirst(['emails.footer', 'iauctions::emails.base.footer'])


    </div>
</div>
</body>

</html>