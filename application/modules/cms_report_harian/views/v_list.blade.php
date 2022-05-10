@extends('app')

@section('body')
    <div id="page_content" ng-controller="listController">
        <div id="page_content_inner">
            <div class="md-card">
                <div class="md-card-toolbar">
                    <h3 class="md-card-toolbar-heading-text"> Filter Laporan Harian - {{$cabang}} </h3>
                </div>
                <div class="md-card-content">
                    <form action="">
                        <div class="uk-grid" data-uk-grid-margin="">
                            <div class="uk-width-medium-1-6">
                                <div class="md-input-wrapper md-input-filled">
                                    <select class="multi-s" id="wahana-multiple" name="wahana[]" multiple>
                                        @foreach( $all_wahana as $item )
                                            <option value="{{$item['product_id']}}" @if( in_array($item['product_id'], $filter_wahana) ) selected @endif>{{$item['product_title']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="md-input-bar "></span>
                                </div>
                                <span class="uk-form-help-block">Pilih Wahana</span>
                            </div>

                            <div class="uk-width-medium-1-10">
                                <div class="md-input-wrapper md-input-filled">
                                    <select id="filter-year" class="md-input" name="year">
                                        <option disabled="" selected="" value="">Tahun</option>
                                        @for($year=date('Y');$year>=2010;$year--)
                                        <option value="{{$year}}"
                                            @if(get_instance()->input->get('year') == $year )
                                                selected
                                            @elseif( $year == date('Y') )
                                                selected
                                            @endif
                                            > {{$year}}</option>
                                        @endfor
                                    </select>
                                    <span class="md-input-bar "></span>
                                </div>
                                <span class="uk-form-help-block">Pilih Tahun</span>
                            </div>

                            <div class="uk-width-medium-1-6">
                                <div class="md-input-wrapper md-input-filled">
                                    <select id="filter-month" class="md-input" name="month">
                                        <option disabled="" selected="" value="">Bulan</option>
                                        @foreach ($months as $key => $month)
                                        <option value="{{$key+1}}"
                                            @if( get_instance()->input->get('month') )
                                                @if( get_instance()->input->get('month') == $key+1 ) selected @endif
                                            @else
                                                @if( date('m') == $key+1 ) selected @endif
                                            @endif
                                            > {{$month}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="md-input-bar "></span>
                                </div>
                                <span class="uk-form-help-block">Pilih Bulan</span>
                            </div>

                            <div class="uk-width-medium-1-6">
                                <div class="md-input-wrapper md-input-filled">
                                    <select id="filter-user" class="md-input" name="user">
                                        <option disabled="" selected="" value="">Nama User Loket</option>
                                        @foreach ( $user_loket as $item )
                                        <option value="{{ $item['user_id'] }}" @if( get_instance()->input->get('user') == $item['user_id'] ) selected @endif>({{ $item['username'] }}) {{ $item['user_display_name'] }}</option>
                                        @endforeach
                                    </select>
                                    <span class="md-input-bar "></span>
                                </div>
                                <span class="uk-form-help-block">Pilih Nama User Loket</span>
                            </div>
{{-- 
                            <div class="uk-width-medium-1-5">
                                <div class="md-input-wrapper md-input-filled">
                                    <select id="input-type" class="md-input" name="type">
                                        <option disabled="" selected="" value="">Payment</option>
                                        @foreach( $payment_type as $item )
                                            <option value="{{$item['id']}}" @if( get_instance()->input->get('type') == $item['id'] ) selected @endif>{{$item['title']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="md-input-bar "></span>
                                </div>
                                <span class="uk-form-help-block">Payment</span>
                            </div>
 --}}
                       {{--      <div class="uk-width-medium-1-6">
                                <div class="md-input-wrapper md-input-filled">
                                    <select class="multi-s" id="vendor-multiple" class="md-input" name="vendor[]" multiple>
                                        @foreach( $vendors as $item )
                                            <option value="{{$item['vendor_slug']}}" @if( in_array($item['vendor_slug'], $filter_vendor) ) selected @endif>{{$item['vendor_name']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="md-input-bar "></span>
                                </div>
                                <span class="uk-form-help-block">Pilih Vendor</span>
                            </div> --}}

                            <div class="uk-width-medium-1-5">
                                <div class="md-input-wrapper md-input-filled">
                                    <select class="multi-s" id="gate-multiple" class="md-input" name="gate[]" multiple>
                                        @foreach( $gates as $item )
                                            <option value="{{$item['gate_name']}}" @if( in_array($item['gate_name'], $filter_gate) ) selected @endif>{{$item['gate_name']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="md-input-bar "></span>
                                </div>
                                <span class="uk-form-help-block">Gate</span>
                            </div>

                            <div class="uk-width-medium-1-6">
                                <div class="md-input-wrapper md-input-filled">
                                    <select class="multi-s" id="bankget" class="md-input" name="bankget[]" multiple>
                                         @foreach( $bankget as $item )
                                            <option value="{{$item['bank_id']}}" @if( in_array($item['bank_id'], $filter_bankget) ) selected @endif>{{$item['bank_name']}} - {{ $item['card_type_name'] }}</option>
                                        @endforeach
                                    </select>
                                    <span class="md-input-bar "></span>
                                </div>
                                <span class="uk-form-help-block">Nama Bank Pengunjung</span>
                            </div>


                            <div class="uk-width-medium-1-6 width-100 text-right">
                                <span class="uk-input-group-addon width-0">
                                    <input type="submit" class="md-btn md-btn-primary" value="Filter">
                                </span>
                                <span class="uk-input-group-addon  width-0">
                                    <a href="{{base_url("cms/$module")}}" class="md-btn">Reset</a>
                                </span>
                                <span class="uk-input-group-addon width-0">
                                    <input type="button" id="export-excel" class="md-btn" value="Export">
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-toolbar">
                    <h3 class="md-card-toolbar-heading-text">{{ $title }}</h3>
                </div>
                <div class="md-card-content">
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
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        var app = angular.module( '{{ $module }}', ['ngSanitize']);
        app.controller('listController',function($scope, $http){});

        $document.ready(function () {
            $("#export-pdf").click(function () {
                $('form').append('<input type="hidden" name="export" value="pdf" />').attr('target', '_self').submit();
                $('form').removeAttr("target");
                $("form").find('input[type="hidden"][name="export"]').remove();
            });
            $("#export-excel").click(function () {
                $('form').append('<input type="hidden" name="export" value="excel" />').attr('target', '_self').submit();
                $('form').removeAttr("target");
                $("form").find('input[type="hidden"][name="export"]').remove();
            });
        });
    </script>
@endsection