<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8fafc; color: #334155; margin: 0; padding: 20px; }
        .card { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; border: 1px solid #e2e8f0; padding: 30px; }
        h1 { color: #78350f; font-size: 22px; margin-top: 0; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { text-align: left; padding: 8px; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
        th { color: #64748b; font-weight: bold; }
        .total { text-align: right; font-weight: bold; font-size: 16px; color: #047857; }
        .footer { font-size: 12px; color: #94a3b8; text-align: center; margin-top: 25px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>¡Gracias por tu compra, {{ $pedido->nombre }}!</h1>
        <p>Hemos recibido el pago de tu pedido correctamente. Ya estamos horneando tus productos.</p>

        <h3>Resumen del pedido (#{{ str_pad($pedido->id, 5, '0', STR_PAD_LEFT) }})</h3>
        
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cant.</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedido->articulos as $item)
                    <tr>
                        <td>{{ $item->nombre_producto }}</td>
                        <td>{{ $item->cantidad }}</td>
                        <td>{{ number_format($item->precio_unitario * $item->cantidad, 2) }} €</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total">Total: {{ number_format($pedido->total, 2) }} €</p>

        <p><strong>Dirección de entrega:</strong><br>
        {{ $pedido->direccion }}<br>
        {{ $pedido->codigo_postal }} - {{ $pedido->ciudad }}</p>

        <div class="footer">
            MarioBakery &copy; {{ date('Y') }}. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
