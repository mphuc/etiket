<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject }}</title>
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
                        <th style="text-align: center" colspan="5">{{ $subject }}</th>
                    </tr>
                    <tr>
                        <th style="text-align: left">Bulan :</th>
                        <td style="text-align: right">{{ $filter_month }}</td>
                    </tr>
                    <tr>
                        <th style="text-align: left">Tahun :</th>
                        <td style="text-align: right">{{ $filter_year }}</td>
                    </tr>
                    <tr>
                        <th style="text-align: left">Loket :</th>
                        <td style="text-align: right">{{ $filter_user }}</td>
                    </tr>
                    <tr>
                        <th style="text-align: left">Wahana :</th>
                        <td style="text-align: right">{{ $filter_wahana ? implode(', ', $filter_wahana_title) : 'All' }}</td>
                    </tr>
{{--                     <tr>
                        <th style="text-align: left">Vendor :</th>
                        <td style="text-align: right">{{ $filter_vendor ? implode(', ', $filter_vendor_title) : 'All' }}</td>
                    </tr> --}}
                </table>
                <br>
                @if( count( $result ) > 0 )
                <table class="uk-table uk-table-striped" border="1" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th style="text-align: center" rowspan="2">Hari</th>
                        <th style="text-align: center" rowspan="2">Tanggal</th>
                        <th style="text-align: center" colspan="2">{{ $filter_month_name.' - '.$filter_year }}</th>
                        <th style="text-align: center" rowspan="2">Diskon</th>
                        <th style="text-align: center" rowspan="2">Total</th>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <th>SubTotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($result as $v )
                        <tr>
                            <td>{{ $v['day'] }}</td>
                            <td>{{ $v['date'] }}</td>
                            <td style="text-align: center">{{ my_format($v['lembar']) }}</td>
                            <td style="text-align: right">{{ my_format($v['sub_total']) }}</td>
                            <td style="text-align: right">{{ my_format($v['discount']) }}</td>
                            <td style="text-align: right">{{ my_format($v['total']) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">TOTAL</td>
                        <th style="text-align: center">{{ my_format($total_lembar) }}</th>
                        <th style="text-align: right">{{ my_format($total_subtotal) }}</th>
                        <th style="text-align: right">{{ my_format($total_discount) }}</th>
                        <th style="text-align: right">{{ my_format($total_nominal) }}</th>
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
