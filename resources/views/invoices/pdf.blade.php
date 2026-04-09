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
            width: 90%;
            margin: 50px auto;
        }
        .header {
            border-bottom: 2px solid #4f46e5;
            padding-bottom: 20px;
            margin-bottom: 40px;
        }
        .header table {
            width: 100%;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #4f46e5;
            text-transform: uppercase;
        }
        .invoice-label {
            font-size: 36px;
            font-weight: 900;
            color: #1e1b4b;
            text-align: right;
            text-transform: uppercase;
        }
        .info-section {
            margin-bottom: 40px;
        }
        .info-section table {
            width: 100%;
        }
        .info-title {
            font-size: 12px;
            font-weight: bold;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }
        .info-content {
            font-size: 14px;
            color: #1e293b;
        }
        .info-content.bold {
            font-weight: bold;
            font-size: 16px;
        }
        .details-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 40px;
        }
        .details-title {
            font-size: 13px;
            font-weight: bold;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 12px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 8px;
        }
        .details-content {
            font-size: 14px;
            color: #334155;
            white-space: pre-wrap;
        }
        .total-section {
            margin-top: 50px;
            text-align: right;
        }
        .total-box {
            display: inline-block;
            width: 300px;
            background-color: #4f46e5;
            color: white;
            padding: 15px 25px;
            border-radius: 6px;
            font-size: 20px;
            font-weight: bold;
        }
        .footer {
            margin-top: 80px;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            border-top: 1px solid #f1f5f9;
            padding-top: 20px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table th {
            background-color: #f1f5f9;
            color: #4f46e5;
            text-align: left;
            padding: 12px;
            font-size: 10px;
            text-transform: uppercase;
            border-bottom: 2px solid #e2e8f0;
        }
        .items-table td {
            padding: 15px 12px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
            color: #334155;
        }
        .items-table .amount {
            text-align: right;
            font-weight: bold;
        }
        .total-section {
            margin-top: 30px;
            text-align: right;
        }
        .total-box {
            display: inline-block;
            width: 250px;
            background-color: #1e1b4b;
            color: white;
            padding: 20px;
            border-radius: 12px;
            font-size: 24px;
            font-weight: 900;
        }
        .total-label {
            display: block;
            font-size: 10px;
            text-transform: uppercase;
            opacity: 0.7;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <table>
                <tr>
                    <td>
                        <img src="{{ public_path('logo.png') }}" style="height: 60px; width: auto; margin-bottom: 5px;">
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
                        <div class="info-content bold" style="color: #4f46e5;">Koala Roofer Management</div>
                        <div class="info-content">123 Narayani Way</div>
                        <div class="info-content">Bharatpur, Chitwan 4400, Nepal</div>
                        <div class="info-content" style="color: #f97316; font-weight: bold; margin-top: 5px;">billing@koalaroofer.com</div>
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
                    <th>Service Description</th>
                    <th width="120" style="text-align: right;">Amount ($)</th>
                </tr>
            </thead>
            <tbody>
                @if(is_array($invoice->items))
                    @foreach($invoice->items as $item)
                        <tr>
                            <td>{{ $item['description'] }}</td>
                            <td class="amount">{{ number_format($item['amount'], 2) }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>{{ $invoice->work_description }}</td>
                        <td class="amount">{{ number_format($invoice->amount, 2) }}</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <div class="total-section">
            <div style="margin-bottom: 8px; color: #64748b; font-size: 13px; font-weight: bold; padding-right: 15px;">
                SUBTOTAL: ${{ number_format($invoice->amount, 2) }}
            </div>
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
