<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>{{ $orders->tracking_no }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <a style="text-decoration: none" onclick="window.print()"
                                    href="{{ url('print-invoice/' . $orders->id) }}">
                                    <img src="{{ asset('assets/images/ariecakelogo.png') }}"
                                        style="width: 17%; max-width: 300px" />
                                </a>
                            </td>

                            <td>
                                Dipesan Tanggal : {{ date('d-m-Y', strtotime($orders->created_at)) }}<br />
                                Nomor Pesanan : {{ $orders->tracking_no }}<br />
                                Nama Customer : {{ $orders->fname }}<br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Arie Cake Tart Decoration & Cookies<br />
                                Jl Kotaanyar, Dusun Krajan, Sumberanyar<br />
                                Kecamatan Paiton, Kabupaten Probolinggo
                            </td>

                            <td>
                                ariecakestore.com<br />
                                +6285257436005<br />
                                ariecakestore@gmail.com
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table class="table table-hovered">
            <thead>
                <tr>
                    <th scope="col">Produk</th>
                    <th class="text-center" scope="col">Jumlah</th>
                    <th class="text-center" scope="col">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders->orderItems as $item)
                    <tr>
                        <td>{{ $item->products->name }}</td>
                        <td class="text-center">{{ $item->qty }}</td>
                        <td class="text-center">Rp {{ number_format($item->products->price) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="2">Total</td>
                    <td class="text-center">Rp {{ number_format($orders->total_price) }}</td>
                </tr>
            </tbody>
        </table>
        {{-- <h6 class="px-2">Total Harga: <span class="float-end">Rp {{ number_format($orders->total_price) }}</span></h6> --}}
    </div>
</body>

</html>
