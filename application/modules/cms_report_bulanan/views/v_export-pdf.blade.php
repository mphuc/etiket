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
                    <tr>
                        <th style="text-align: left">Vendor :</th>
                        <td style="text-align: right">{{ $filter_vendor ? implode(', ', $filter_vendor_title) : 'All' }}</td>
                    </tr>
                </table>
                <br>
                @if( count( $wahana ) > 0 )
                <table class="uk-table uk-table-striped" border="1" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Bulan</th>
                        @foreach ($wahana as $key => $value)
                            <th>{{$value['product_title']}}</th>
                        @endforeach
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ( $result as $k => $v )
                        <tr>
                            <td>{{$result[$k][0]['month']}}</td>
                            @foreach ($result[$k] as $k2 => $v2)
                                <td style="text-align: right">{{my_number($v2['total_nominal']-$v2['total_discount'])}}</td>
                            @endforeach
                            <th style="text-align: right">{{my_number($result_total_right[$k]['all_nominal']-$result_total_right[$k]['all_discount'])}}</th>
                        </tr>
                    @endforeach
                    <tr>
                        <td>Total</td>
                        @foreach ($result_total_bottom as $key => $value)
                            <th style="text-align: right">{{my_number($value-$total_arr_discount[$key])}}</th>
                        @endforeach
                        <th style="text-align: right">{{my_number($result_total_all-$total_discount_all)}}</th>
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
