@extends('app')

@section('body')
<div id="page_content" ng-controller="listController">
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-toolbar">
                <h3 class="md-card-toolbar-heading-text"> Filter Laporan Hari ini - {{$cabang}} </h3>
            </div>
            <div class="md-card-content">
                <form action="">
                    <div class="uk-grid" data-uk-grid-margin="">
                        <div class="uk-width-medium-1-5">
                            <div class="md-input-wrapper md-input-filled">
                                <select class="multi-s" id="wahana-multiple" name="wahana[]" multiple>
                                    @foreach( $all_wahana as $item )
                                        <option value="{{$item['product_id']}}" @if( in_array($item['product_id'], $filter_wahana) ) selected @endif>{{$item['product_title']}}</option>
                                    @endforeach
                                </select>
                                <span class="md-input-bar "></span>
                            </div>
                            <span class="uk-form-help-block">Produk</span>
                        </div>

                        <div class="uk-width-medium-1-5">
                            <div class="md-input-wrapper md-input-filled">
                                    <input id="filter-date" name="date" value="@if( $filter_date ){{$filter_date}}@else{{date('Y-m-d')}}@endif" type="text" required/>
                                <span class="md-input-bar "></span>
                            </div>
                            <span class="uk-form-help-block">Tanggal</span>
                        </div>

                        <div class="uk-width-medium-1-5">
                            <div class="md-input-wrapper md-input-filled">
                                <select id="" class="md-input" name="user">
                                    <option disabled="" selected="" value="">User Loket</option>
                                    @foreach( $user_loket as $item )
                                        <option value="{{$item['id']}}" @if( get_instance()->input->get('user') == $item['id'] ) selected @endif>{{$item['username']}}</option>
                                    @endforeach
                                </select>
                                <span class="md-input-bar "></span>
                            </div>
                            <span class="uk-form-help-block">Admin Loket</span>
                        </div>

              {{--           <div class="uk-width-medium-1-5">
                            <div class="md-input-wrapper md-input-filled">
                                <select class="multi-s" id="vendor-multiple" class="md-input" name="vendor[]" multiple>
                                    @foreach( $vendors as $item )
                                        <option value="{{$item['vendor_slug']}}" @if( in_array($item['vendor_slug'], $filter_vendor) ) selected @endif>{{$item['vendor_name']}}</option>
                                    @endforeach
                                </select>
                                <span class="md-input-bar "></span>
                            </div>
                            <span class="uk-form-help-block">Pencatat</span>
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

                        <div class="uk-width-medium-1-5">
                            <div class="md-input-wrapper md-input-filled">
                                <select class="multi-s" id="gate-multiple" class="md-input" name="payee[]" multiple>
                                    @foreach( $payee as $item )
                                        <option value="{{$item['payee_id']}}" @if( in_array($item['payee_id'], $filter_payee) ) selected @endif>{{$item['payee_name']}}</option>
                                    @endforeach
                                </select>
                                <span class="md-input-bar "></span>
                            </div>
                            <span class="uk-form-help-block">Penerima Pembayaran</span>
                        </div>

                        <div class="uk-width-medium-1-5">
                            <div class="md-input-wrapper md-input-filled">
                                <select class="multi-s" id="gate-multiple" class="md-input" name="cardtypeget[]" multiple>
                                    @foreach( $cardtypeget as $item )
                                    <option value="{{$item['card_type_id']}}" @if( in_array($item['card_type_id'], $filter_cardtype) ) selected @endif>{{$item['card_type_name']}}</option>
                                    @endforeach
                                </select>
                                <span class="md-input-bar "></span>
                            </div>
                            <span class="uk-form-help-block">Tipe kartu</span>
                        </div>

                        <div class="uk-width-medium-1-5">
                            <div class="md-input-wrapper md-input-filled">
                                <select class="multi-s" id="gate-multiple" class="md-input" name="bankget[]" multiple>
                                     @foreach( $bankget as $item )
                                        <option value="{{$item['bank_id']}}" @if( in_array($item['bank_id'], $filter_bankget) ) selected @endif>{{$item['bank_name']}} - {{ $item['card_type_name'] }}</option>
                                    @endforeach
                                </select>
                                <span class="md-input-bar "></span>
                            </div>
                            <span class="uk-form-help-block">Nama Bank Pengunjung</span>
                        </div>

                        <div class="uk-width-medium-1-5 width-100 text-right">
                            <span class="uk-input-group-addon width-0">
                                <input type="submit" class="md-btn md-btn-primary" value="Filter">
                            </span>
                            <span class="uk-input-group-addon  width-0">
                                <a href="{{base_url("cms/$module")}}" class="md-btn">Reset</a>
                            </span>
                            <span class="uk-input-group-addon width-0">
                            <input type="button" id="export-excel" class="md-btn" value="Export">
                            <input type="button" id="export-print" class="md-btn" value="Print">
                        </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="md-card uk-margin-medium-bottom">
            <div class="md-card-toolbar">
                <h3 class="md-card-toolbar-heading-text">{{$title}}</h3>
            </div>
            <div class="md-card-content">
                <div class="uk-overflow-container">
                <table class="uk-table uk-table-striped" border="1" width="100%">
                    <thead>
                    <tr>
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
                    {{-- @foreach ($total_payee as $key => $value)
                    <tr>
                        <td>Total {{$key}}</td>
                        <th style="text-align: center;"></th>
                        <th colspan="2" style="text-align: right;"></th>
                        <th style="text-align: right;"></th>
                        <th style="text-align: right;">{{ my_format($value) }}</th>
                    </tr>
                    @endforeach --}}
                    {{-- <tr>
                        <td>Total Cash</td>
                        <th style="text-align: center;"></th>
                        <th colspan="2" style="text-align: right;"></th>
                        <th style="text-align: right;"></th>
                        <th style="text-align: right;">{{ my_format($total_all_cash) }}</th>
                    </tr>
                    <tr>
                        <td>Total EDC</td>
                        <th style="text-align: center;"></th>
                        <th colspan="2" style="text-align: right;"></th>
                        <th style="text-align: right;"></th>
                        <th style="text-align: right;">{{ my_format($total_all_edc) }}</th>
                    </tr> --}}
                    <tr>
                        <td>Total All</td>
                        <th style="text-align: center;">{{ my_format($total_lembar_all) }}</th>
                        <th colspan="2" style="text-align: right;">{{ my_format($total_all_subtotal) }}</th>
                        <th style="text-align: right;">{{ my_format($total_all_discount) }}</th>
                        <th style="text-align: right;">{{ my_format($total_all) }}</th>
                    </tr>
                    </tbody>
                </table>
                </div>
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
            $("#filter-date").kendoDatePicker({
                format: "yyyy-MM-dd",
                max: new Date()
            });
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
            $("#export-print").click(function () {
                $('form').append('<input type="hidden" name="export" value="print" />').attr('target', '_self').submit();
                $('form').removeAttr("target");
                $("form").find('input[type="hidden"][name="export"]').remove();
            });
        });
    </script>
@endsection