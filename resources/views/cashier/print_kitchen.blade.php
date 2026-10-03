<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Dapur - {{ $order->order_code }}</title>
    <style>
        body { font-family: monospace; width: 58mm; padding: 5px; margin: 0; }
        .center { text-align: center; }
        .line { border-bottom: 1px dashed #000; margin: 5px 0; }
        .bold { font-weight: bold; }
        .item { margin-bottom: 5px; }
        .note { font-size: 11px; padding-left: 10px; }
    </style>
</head>
<body onload="window.print()">
    <div class="center bold">
        *** STRUK DAPUR ***<br>
        {{ $order->order_code }}
    </div>
    <div class="line"></div>
    <div>
        Meja: <span class="bold" style="font-size: 16px;">{{ $order->table_number }}</span><br>
        Pemesan: {{ $order->customer_name }}<br>
        Waktu: {{ $order->created_at->format('d/m/Y H:i') }}
    </div>
    <div class="line"></div>
    <div>
        @foreach($order->items as $item)
            <div class="item">
                <span class="bold" style="font-size: 14px;">{{ $item->quantity }}x {{ $item->menu->name }}</span>
                @if($item->notes)
                    <div class="note">-> Catatan: {{ $item->notes }}</div>
                @endif
            </div>
        @endforeach
    </div>
    @if($order->general_notes)
        <div class="line"></div>
        <div class="note">
            <span class="bold">Catatan Umum:</span><br>
            {{ $order->general_notes }}
        </div>
    @endif
    <div class="line"></div>
</body>
</html>