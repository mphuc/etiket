<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style type="text/css">

        table{
            width: 100%;
        }

        table.border {
            border-collapse: collapse;
            width: 100%;
        }

        table.border, table.border th, table.border td {
            border: 1px solid black;
        }

        table.border th, table.border td{
            padding: 5px;
        }

        table.border td{
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div id="">
    <div id="">
        <div class="">
            <div class="">
                <table>
                    <tr>
                        <th style="text-align: center" colspan="5">{{ $title2 }}</th>
                    </tr>
                    <tr>
                        <th style="text-align: left">Tanggal :</th>
                        <td style="text-align: right">{{ $filter_date }}</td>
                    </tr>
                    <tr>
                        <th style="text-align: left">Loket :</th>
                        <td style="text-align: right">{{ $filter_user_title }}</td>
                    </tr>
                    <tr>
                        <th style="text-align: left">Wahana :</th>
                        <td style="text-align: right">{{ $filter_wahana ? implode(', ', $filter_wahana_title) : 'All' }}</td>
                    </tr>
      {{--               <tr>
                        <th style="text-align: left">Vendor :</th>
                        <td style="text-align: right">{{ $filter_vendor ? implode(', ', $filter_vendor_title) : 'All' }}</td>
                    </tr> --}}
                </table>
                <br>
                @if( count( $result_total_bottom ) > 0 )
                <table class="border" width="100%">
                    <thead>
                    <tr style="text-align: center;">
                        <th>Tiket</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>SubTotal</th>
                        <th>Diskon</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($wahana as $key => $value)
                    <tr>
                        <th>{{ $value['product_title'] }}</th>
                        <td style="text-align: center">{{ my_format($result_total_bottom[$key]['all_lembar']) }}</td>
                        <td style="text-align: right">{{ my_format($result_total_bottom[$key]['harga']) }}</td>
                        <td style="text-align: right">{{ my_format($result_total_bottom[$key]['all_subtotal']) }}</td>
                        <td style="text-align: right">{{ my_format($result_total_bottom[$key]['all_discount']) }}</td>
                        <td style="text-align: right">{{ my_format($result_total_bottom[$key]['all_total']) }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th>Total</th>
                        <th style="text-align: center;">{{ my_format($total_lembar_all) }}</th>
                        <th colspan="2" style="text-align: right;">{{ my_format($total_all_subtotal) }}</th>
                        <th style="text-align: right;">{{ my_format($total_all_discount) }}</th>
                        <th style="text-align: right;">{{ my_format($total_all) }}</th>
                    </tr>
                    </tbody>
                </table>

                @else
                <h3 align="center">No Data</h3>
                @endif
            </div>
        </div>

    </div>
</div>

</body>
</html>