<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            background: #f5f5f5;
            color: #333;
        }

        .invoice {
            background: #fff;
            padding: 20px;
        }

        .company-name {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .header-table {
            width: 100%;
            margin-bottom: 25px;
        }

        .header-table td {
            vertical-align: top;
            width: 33%;
            padding: 10px;
        }

        .title {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background: #f0f3f4;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 12px;
        }

        .text-right {
            text-align: right;
        }

        .summary-table {
            width: 350px;
            float: right;
            margin-top: 20px;
        }

        .summary-table td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        .grand-total {
            background: #2d353c;
            color: #fff;
            font-weight: bold;
        }

        .invoice-note {
            margin-top: 80px;
            font-size: 12px;
            color: #777;
        }

        .invoice-footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
    </style>

</head>

<body>

    <div class="invoice">

        <!-- Company Name -->
        <div class="company-name">
            {{ $companyData->name }}
        </div>

        <!-- Header -->
        <table class="header-table">

            <tr>

                <!-- From -->
                <td>

                    <div class="title">Vendor Details</div>

                    <strong>{{ $companyData->name }}</strong><br><br>

                    {{ $companyData->address }}
                    {{ $companyData->street }}
                    {{ $companyData->city }}
                    {{ $companyData->state }}
                    {{ $companyData->country }}
                    {{ $companyData->pin_code }}

                    <br><br>
                    TRN Number: {{ $companyData->trn_number }}<br>
                    Phone: {{ $companyData->phone }}<br>
                    Email: {{ $companyData->email }}

                </td>

                <!-- To -->
                <td>

                    <div class="title">Customer Details</div>

                    <strong>{{isset($data->company_name)? $data->company_name :$data->first_name.' '.$data->last_name  }}</strong><br><br>

                    {{ $data->address }}
                    {{ $data->street }}
                    {{ $data->city }}
                    {{ $data->state }}
                    {{ $data->country }}
                    {{ $data->pin_code }}

                    <br><br>
                    TRN Number : {{ isset($data->wat_number)? $data->wat_number :'' }}<br>
                    Phone: {{ $data->phone }}<br>

                    Email: {{ $data->email }}

                </td>

                <!-- Invoice -->
                <td class="text-right">

                    <div class="title">Invoice Details</div>

                    <strong>Invoice No:</strong>
                    {{ $data->order_number }}

                    <br><br>

                    <strong>Order Date:</strong>
                    {{ $data->created_at->format('d M/Y') }}

                    <br><br>

                    <strong>Delivery Date:</strong>

                    {{ \Carbon\Carbon::parse($data->delivery_date)->format('d M/Y') }}

                </td>

            </tr>

        </table>

        <!-- Product Table -->
        <table>

            <thead>

                <tr>
                    <th>Product SKU</th>
                    <th>Product Name</th>
                    <th>Variation</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>

            </thead>

            <tbody>

                @forelse($data->orderProduct as $order)
                    <tr>

                        <td>
                            {{ $order->variation->sku ?? '-' }}
                        </td>

                        <td>
                            {{ $order->product->product_name ?? '-' }}
                        </td>

                        <td>
                            {{ $order->variation->variation_name ?? '-' }}
                        </td>

                        <td>
                            {{ $order->quantity }}
                        </td>

                        <td>
                            ₹{{ number_format($order->price, 2) }}
                        </td>

                        <td>
                            ₹{{ number_format($order->total, 2) }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" style="text-align:center;">
                            No products found
                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

        <!-- Summary -->
        <table class="summary-table">

            <tr>
                <td><strong>Subtotal</strong></td>
                <td class="text-right">
                    ₹{{ number_format($data->subtotal, 2) }}
                </td>
            </tr>

            <tr>
                <td><strong>Discount</strong></td>
                <td class="text-right">
                    ₹{{ number_format($data->discount, 2) }}
                </td>
            </tr>

            <tr>
                <td><strong>Tax</strong></td>
                <td class="text-right">
                    ₹{{ number_format($data->tax, 2) }}
                </td>
            </tr>

            <tr class="grand-total">
                <td><strong>Grand Total</strong></td>
                <td class="text-right">
                    ₹{{ number_format($data->grand_total, 2) }}
                </td>
            </tr>

        </table>

        <div style="clear:both;"></div>

        <!-- Notes -->
        <div class="invoice-note">

            Make all cheques payable to {{ $companyData->name }}<br>

            Payment due within 30 days.<br>

            Contact:
            {{ $companyData->phone }}
            |
            {{ $companyData->email }}

        </div>

        <!-- Footer -->
        <div class="invoice-footer">

            <strong>THANK YOU FOR YOUR BUSINESS</strong>

            <br><br>

            {{ $companyData->website_url }}

            <br>

            {{ $companyData->phone }}

            <br>

            {{ $companyData->email }}

        </div>

    </div>

</body>

</html>
