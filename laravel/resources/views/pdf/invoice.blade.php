<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #333; line-height: 1.5; }
        .header { border-bottom: 2px solid #2563eb; padding-bottom: 20px; margin-bottom: 20px; }
        .logo { font-size: 24px; font-weight: bold; color: #2563eb; }
        .invoice-title { float: right; font-size: 28px; color: #999; }
        .clear { clear: both; }
        .info-section { margin-bottom: 30px; }
        .info-col { width: 48%; float: left; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th { background: #f8fafc; border-bottom: 1px solid #e2e8f0; padding: 12px; text-align: left; font-size: 13px; color: #64748b; }
        .table td { padding: 12px; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
        .total-section { margin-top: 30px; float: right; width: 300px; }
        .total-row { padding: 10px 0; border-top: 1px solid #eee; }
        .total-label { font-weight: bold; }
        .total-amount { float: right; font-weight: bold; }
        .grand-total { font-size: 20px; color: #2563eb; border-top: 2px solid #2563eb; padding-top: 10px; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <span class="logo">ADNANE BOOKS</span>
        <span class="invoice-title">INVOICE</span>
        <div class="clear"></div>
    </div>

    <div class="info-section">
        <div class="info-col">
            <strong>Billed To:</strong><br>
            {{ $order->user->name }}<br>
            {{ $order->user->email }}
        </div>
        <div class="info-col" style="text-align: right;">
            <strong>Order Details:</strong><br>
            Order ID: #{{ $order->id }}<br>
            Date: {{ $order->created_at->format('M d, Y') }}<br>
            Status: {{ strtoupper($order->status) }}
        </div>
        <div class="clear"></div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Item Description</th>
                <th style="text-align: center;">Price</th>
                <th style="text-align: center;">Qty</th>
                <th style="text-align: right;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>
                    <strong>{{ $item->book->title }}</strong><br>
                    <span style="font-size: 11px; color: #666;">by {{ $item->book->authors->pluck('name')->join(', ') }}</span>
                </td>
                <td style="text-align: center;">${{ number_format($item->price, 2) }}</td>
                <td style="text-align: center;">{{ $item->quantity }}</td>
                <td style="text-align: right;">${{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <div class="total-row">
            <span class="total-label">Subtotal</span>
            <span class="total-amount">${{ number_format($order->total_price, 2) }}</span>
        </div>
        <div class="total-row">
            <span class="total-label">Shipping</span>
            <span class="total-amount">Free</span>
        </div>
        <div class="total-row grand-total">
            <span class="total-label">Grand Total</span>
            <span class="total-amount">${{ number_format($order->total_price, 2) }}</span>
        </div>
    </div>
    <div class="clear"></div>

    <div class="footer">
        © 2026 ADNANE BOOKS. BLOC 46 , Qu Saida II ,SAFI , Morocco. contact@adnanebook.com
    </div>
</body>
</html>
