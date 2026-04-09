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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <table>
                <tr>
                    <td>
                        <div class="logo">Koala Roofer</div>
                        <div class="info-content">Premium Roofing Services</div>
                    </td>
                    <td class="invoice-label">Invoice</td>
                </tr>
            </table>
        </div>

        <div class="info-section">
            <table>
                <tr>
                    <td width="50%" valign="top">
                        <div class="info-title">Bill From</div>
                        <div class="info-content bold">Koala Roofer Management</div>
                        <div class="info-content">123 Narayni Road</div>
                        <div class="info-content">Narayanghat, Chitwan 4400</div>
                        <div class="info-content">Nepal</div>
                    </td>
                    <td width="50%" valign="top" align="right">
                        <div>
                            <span class="info-title">Invoice Number:</span>
                            <span class="info-content bold">{{ $invoice->invoice_number }}</span>
                        </div>
                        <div style="margin-top: 10px;">
                            <span class="info-title">Date:</span>
                            <span class="info-content">{{ \Carbon\Carbon::parse($invoice->date)->format('d M Y') }}</span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="info-section">
            <div class="info-title">Bill To (Tradie)</div>
            <div class="info-content bold">{{ $invoice->tradie->name }}</div>
            <div class="info-content">{{ $invoice->tradie->address ?: 'No address provided' }}</div>
            <div class="info-content">Phone: {{ $invoice->tradie->contact_number }}</div>
        </div>

        <div class="details-box">
            <div class="details-title">Work Description</div>
            <div class="details-content">{{ $invoice->work_description }}</div>
        </div>

        <div class="total-section">
            <div style="margin-bottom: 10px; color: #64748b;">
                Subtotal: ${{ number_format($invoice->amount, 2) }}
            </div>
            <div class="total-box">
                Total Amount: ${{ number_format($invoice->amount, 2) }}
            </div>
        </div>

        <div class="footer">
            Generated on {{ now()->format('d M Y H:i:s') }}<br>
            © 2026 Koala Roofer Management System. All rights reserved.
        </div>
    </div>
</body>
</html>
