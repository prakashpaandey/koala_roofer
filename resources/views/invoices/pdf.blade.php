<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice - {{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .container {
            width: 92%;
            margin: 20px auto;
        }
        .header {
            border-bottom: 2px solid #4f46e5;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }
        .header table {
            width: 100%;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #4f46e5;
            text-transform: uppercase;
        }
        .invoice-label {
            font-size: 28px;
            font-weight: 900;
            color: #1e1b4b;
            text-align: right;
            text-transform: uppercase;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-section table {
            width: 100%;
        }
        .info-title {
            font-size: 10px;
            font-weight: bold;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }
        .info-content {
            font-size: 12px;
            color: #1e293b;
        }
        .info-content.bold {
            font-weight: bold;
            font-size: 14px;
        }
        .details-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        .details-title {
            font-size: 11px;
            font-weight: bold;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 8px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
        }
        .details-content {
            font-size: 12px;
            color: #334155;
            white-space: pre-wrap;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #94a3b8;
            border-top: 1px solid #f1f5f9;
            padding-top: 10px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .items-table th {
            background-color: #f1f5f9;
            color: #4f46e5;
            text-align: left;
            padding: 10px;
            font-size: 9px;
            text-transform: uppercase;
            border-bottom: 2px solid #e2e8f0;
        }
        .items-table td {
            padding: 10px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 12px;
            color: #334155;
        }
        .items-table .amount {
            text-align: right;
            font-weight: bold;
        }
        .total-section {
            margin-top: 15px;
            text-align: right;
        }
        .total-box {
            display: inline-block;
            width: 220px;
            border-top: 2px solid #1e1b4b;
            border-bottom: 2px solid #1e1b4b;
            color: #1e1b4b;
            background-color: transparent;
            padding: 10px 0;
            font-size: 20px;
            font-weight: 900;
        }
        .total-label {
            display: block;
            font-size: 9px;
            text-transform: uppercase;
            color: #64748b;
            margin-bottom: 3px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <table>
                <tr>
                    <td>
                        @php
                            $logoPath = public_path('favicon.png');
                            $logoData = base64_encode(file_get_contents($logoPath));
                            $logoSrc = 'data:image/png;base64,' . $logoData;
                        @endphp
                        <img src="{{ $logoSrc }}" style="height: 64px; width: auto; border-radius: 8px;">
                    </td>
                    <td class="invoice-label">Invoice</td>
                </tr>
            </table>
        </div>

        <div class="info-section">
            <table width="100%">
                <tr>
                    <td width="55%" valign="top">
                        <div class="info-title">Bill From</div>
                        <div class="info-content bold" style="color: #4f46e5;">Koalaroofers Pty Limited</div>
                        <div class="info-content">10/21 Colbee Ct, Phillip</div>
                        <div class="info-content">ACT 2606, Australia</div>
                        <div class="info-content" style="color: #f97316; font-weight: bold; margin-top: 5px;">billing@koalaroofer.com</div>
                        <div class="info-content" style="font-weight: bold; margin-top: 2px;">+61 452 456 626</div>
                    </td>
                    <td width="45%" valign="top" align="right">
                        <div>
                            <span class="info-title">Invoice Number:</span><br>
                            <span class="info-content bold" style="font-size: 20px;">{{ $invoice->invoice_number }}</span>
                        </div>
                        <div style="margin-top: 15px;">
                            <span class="info-title">Date of Issue:</span><br>
                            <span class="info-content">{{ \Carbon\Carbon::parse($invoice->date)->format('d M, Y') }}</span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="info-section" style="background-color: #f8fafc; padding: 25px; border-radius: 15px; border: 1px solid #f1f5f9;">
            <div class="info-title">Issued To (Customer)</div>
            <div class="info-content bold" style="font-size: 18px; margin-bottom: 5px;">{{ $invoice->customer_name }}</div>
            <div class="info-content" style="white-space: pre-line; line-height: 1.4;">{{ $invoice->customer_address ?: 'No address provided' }}</div>
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th width="30">S.N.</th>
                    <th>Service Description</th>
                    <th width="120" style="text-align: right;">Amount ($)</th>
                </tr>
            </thead>
            <tbody>
                @if(is_array($invoice->items))
                    @foreach($invoice->items as $index => $item)
                        <tr>
                            <td style="color: #94a3b8; font-weight: bold;">{{ $index + 1 }}.</td>
                            <td>{{ $item['description'] }}</td>
                            <td class="amount">{{ number_format($item['amount'], 2) }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td style="color: #94a3b8; font-weight: bold;">1.</td>
                        <td>{{ $invoice->work_description }}</td>
                        <td class="amount">{{ number_format($invoice->amount, 2) }}</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <div class="total-section">
            <div style="width: 250px; display: inline-block; text-align: right; margin-bottom: 8px;">
                <span style="color: #64748b; font-size: 11px; font-weight: bold; text-transform: uppercase;">Subtotal:</span>
                <span style="color: #1e293b; font-size: 13px; font-weight: bold; margin-left: 10px;">${{ number_format($invoice->amount - $invoice->tax_amount, 2) }}</span>
            </div>
            <br>
            <div style="width: 250px; display: inline-block; text-align: right; margin-bottom: 12px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                <span style="color: #64748b; font-size: 11px; font-weight: bold; text-transform: uppercase;">Tax ({{ number_format($invoice->tax_percentage, 0) }}%):</span>
                <span style="color: #1e293b; font-size: 13px; font-weight: bold; margin-left: 10px;">${{ number_format($invoice->tax_amount, 2) }}</span>
            </div>
            <br>
            <div class="total-box">
                <span class="total-label">Grand Total Bill</span>
                ${{ number_format($invoice->amount, 2) }}
            </div>
        </div>

        <div class="footer">
            Generated on {{ now()->format('d M Y H:i:s') }}<br>
            © 2026 Koala Roofer Management System. All rights reserved.
        </div>
    </div>
</body>
</html>
