<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
        body {
            direction: initial;
            font: small/1.5 Arial, Helvetica, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow-x: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .invoice-details-date {
            text-align: right;
            padding: 10px;
        }

        .invoice-details-box {
            width: calc(50% - 10px);
            padding: 10px;
            text-decoration: none;
        }

        .invoice-details-box:nth-child(odd) {
            margin-right: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .info {
            margin-bottom: 20px;
        }

        .h2 {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="invoice-details-date">
            <p>{{ \Carbon\Carbon::now()->isoFormat('D [de] MMMM [de] YYYY') }}</p>
        </div>

        <div class="invoice-details">
            <div class="invoice-details-box">
                <h2><span style="font-size: 20px">{{ $supplier->name }} ({{ $supplier->id }})</span></h2>
                <p>Email: <strong>{{ $supplier->email }}</strong></p>
                <p>Teléfono: <strong>{{ $supplier->user_detail->phone ?? '--' }}</strong></p>
            </div>
            <div class="invoice-details-box">
                <h2><span style="font-size: 20px">TOTAL: @formatMoney($supplier->products->sum('regular_price') * 0.5)</span></h2>
            </div>
        </div>

        <div class="invoice-details">
            <div class="invoice-details-box">
                <p>Banco: <strong>{{ $supplier->supplier_detail->bank->name }}</strong></p>
                <p>Titular: <strong>{{ $supplier->supplier_detail->account_owner }}</strong></p>
                <p>Alias: <strong>{{ $supplier->supplier_detail->alias }}</strong></p>
            </div>
            <div class="invoice-details-box">
                <p>CBU/CVU: <strong>{{ $supplier->supplier_detail->cbu }}</strong></p>
                <p>Cta Num: <strong>{{ $supplier->supplier_detail->account_number }}</strong></p>
            </div>
        </div>

        <hr>

        <div class="info">
            <p><strong>Información importante:</strong></p>
            <p>Hola 🙋 <strong>{{ $supplier->first_name }}</strong>!! ¿Cómo estás? 😀<br>
                Ya realizamos la transferencia del dinero correspondiente a las ventas del período
                {{ \App\Class\Util::getMonths()[$liquidation->month] . ' ' . $liquidation->year }}!
            </p>
            <p>
                El próximo cierre será el día
                {{ \Carbon\Carbon::createFromDate(null, $liquidation->month, 1)->addMonth()->endOfMonth()->format('d/m') }}
                <br>
                En caso que tengas nuevas ventas te estaremos contactando nuevamente los primeros días del mes de
                {{ ucfirst(\Carbon\Carbon::createFromDate(null, $liquidation->month, 1)->addMonth(2)->isoFormat('MMMM')) }}.
            </p>
            <p>
                <strong>Es muy importante que siempre chequees tus datos bancarios :)</strong>
                <br>
                Si queres contactarte con nosotros podes hacerlo a:
            </p>

            <ul>
                <li><strong>WhatsApp</strong> 1133682563</li>
                <li><strong>Instagram</strong> @@rueditas.caba</li>
            </ul>

            <p>Te mandamos un beso y te agradecemos por seguir confiando en <strong>Rueditas</strong> 💚</p>
        </div>

        <hr>

        <table>
            <thead>
                <tr>
                    <th>Cod</th>
                    <th>Marca</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($supplier->products as $product)
                    <tr>
                        <td>{{ $product->relative_code }}</td>
                        <td>{{ $product->brand->name }}</td>
                        <td>{!! $product->description !!}</td>
                        <td>@formatMoney($product->regular_price)</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Total:</strong></td>
                    <td><strong>@formatMoney($supplier->products->sum('regular_price'))</strong></td>
                </tr>
            </tfoot>
        </table>

    </div>
</body>

</html>
