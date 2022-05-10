<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no , maximum-scale=1, user-scalable=no">
    <link rel="icon" type="image/png" href="{{ base_url() }}assets_frontend/images/kemendikbud1.png" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ base_url() }}assets_frontend/images/kemendikbud1.png" sizes="32x32">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ base_url() }}assets_frontend/css/myStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <!-- <script src='https://www.google.com/recaptcha/api.js' async defer></script> -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <style>
      html{
        font-size: 14px;
      }

      @media (min-width: 576px) {
        .layout-class {
          position: absolute;
          top: 90px;
          width: 100%;
        }
      }

      @media (max-width : 500px){
        table{
          font-size: 12px;
        }

        /* .g-recaptcha .validation{
          width: 100px;
        } */
      }

      @media (min-width: 768px) {
        .layout-class {
          position: absolute;
          top: 90px;
          width: 100%;
        }
      }

      @media (min-width: 992px) {
        .layout-class {
          position: absolute;
          top: 90px;
          width: 100%;
        }
      }

      @media (min-width: 1200px){
        .layout-class {
          position: absolute;
          top: 90px;
          width: 100%;
        }
      }
    </style>

    <title>Museum Nasional</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #38A7BB;">
      <div class="container">
        <a class="navbar-brand" href="{{ base_url() }}cms/tiket_lokal/" style="margin-right: 10%;">
            <img src="{{ base_url() }}assets_frontend/images/kemendikbud1.png" style="float: left; margin-right : 5px;" alt="">
            <p class="text-white" style="font-size: 12px; padding-top : 10px;">
              <b>KEMENTRIAN <br>PENDIDIKAN, KEBUDAYAAN,<br>RISET dan TEKNOLOGI</b>
            </p>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          
        <form class="form-inline my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active" style="padding-right : 20px;">
                <a class="nav-link text-white" href="{{ base_url() }}cms/">Beranda <span class="sr-only">(current)</span></a>
              </li>
              

            </ul>
          </form>
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            {{-- code --}}
          </ul>
          
        </div>
      </div>
    </nav>

    {{-- <a href="{{ base_url() }}cms/tiket_lokal/testTicket" target="blank">test</a> --}}
    <div class="container-lg mt-3">
      @php
          $CI = &get_instance();
          if($CI->session->flashdata('success')){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert' align='center'>
              <strong>".$CI->session->flashdata('success')."</strong>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
          }
          else if($CI->session->flashdata('error')){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert' align='center'>
              <strong>".$CI->session->flashdata('error')."</strong>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
          }
      @endphp
    </div>

    {{-- content  --}}
    <div class="content mt-5">
      <div class="container-lg">
        <div class="card">
          {{-- menu --}}
          <div class="card-header" style="background-color: #38A7BB; height : 70px;">
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist" align="center">
                <a id="nav-home-tab" style="width: 33%; text-decoration:none;" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" onclick="clearTable()">
                  <button type="button" class="btn btn-light btn-sm" style="width : 30px; height:30px; border-radius: 100%">1</button>
                  <p class="text-white"><small>Pilih Tiket</small></p>
                </a>
                <a id="nav-profile-tab" style="width: 33%; text-decoration:none;" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" onclick="clearTable()">
                  <button type="button" class="btn btn-light btn-sm" style="width : 30px; height:30px; border-radius: 100%">2</button>
                  <p class="text-white"><small>Biodata Pembeli</small></p>
                </a>
                <a id="nav-contact-tab" style="width: 33%; text-decoration:none;" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false" onclick="konfirmasi()">
                  <button type="button" class="btn btn-light btn-sm" style="width : 30px; height:30px; border-radius: 100%">3</button>
                  <p class="text-white"><small>Check Out</small></p>
                </a>
              </div>
            </nav>
          </div>

          <div class="card-body">
            <div class="tab-content" id="nav-tabContent">

              {{-- form pembelian tiket --}}
              <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row">
                  <div class="col-md-8"></div>
                  <div class="col-md-4 col-sm-12">
                    <div class="card">                      
                      <div class="card-body" style="height: 500px;">
                        <form action="">
                          <div class="form-group">
                            <label >Pilihan Tiket</label>
                            {{-- <input type="text" class="form-control"  value="Ticket" readonly> --}}
                            <select name="ticket" id="ticket" class="js-example-basic-single" style="width: 100%" onchange="check_tiket()">
                              <option value="">-- Pilih Tiket--</option>
                              @foreach ($product as $item)
                                  <option value="{{ $item->product_id }}" nama="{{ $item->product_title }}" harga="{{ $item->product_price }}" product_min="{{ $item->product_min }}">{{ $item->product_title }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group mt-5">
                            <label >Harga</label>
                            <input type="text" id="harga" value="" class="form-control" readonly>
                          </div>
                          <div class="form-group mt-5">
                            <label >Jumlah Tiket</label>
                            <input type="text" id="jumlah" class="form-control" onkeypress="return hanyaAngka(event)">
                          </div>
                          {{-- <div class="form-group mt-5">
                            <label >Jumlah Tiket Regional</label>
                            <input type="text" class="form-control" onkeypress="return hanyaAngka(event)">
                          </div> --}}
                          <div class="form-group mt-5">
                            <button type="button" id="add_ticket" class="btn btn-warning addRow" style="width: 100%">Tambahkan</button>
                          </div>

                          {{-- <button type="button" onclick="konfirmasi()">konfirmasi</button> --}}
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-8 col-sm-12 layout-class">
                    <div class="card">
                      <div class="card-header" style="height: 100px;" id="pmb">
                        <h5>Daftar Pembelian</h5>
                        <p style="font-size: 14px;">Dibawah ini adalah tiket yang akan anda pesan</p>
                      </div>
                      <div class="card-body" style="min-height: 400px;">
                        <table class="table table-striped" id="list_booking">
                          <thead>
                            <tr>
                              <td scope="col" width="35%">Jenis Tiket</td>
                              <td scope="col" width="15%">Jumlah</td>
                              <td scope="col" width="25%">Sub Total</td>
                              <td scope="col" width="25%" align="center">Pilihan</td>
                            </tr>
                          </thead>
                          <tbody id="tbl-ticket">
                            
                          </tbody>
                        </table>
                      </div>
                    </div>

                  </div>

                </div>

                <div class="row mt-3">
                    <div class="col-md-8">
                      <div class="card-body mt-3" style="height : 60px; border :3px dashed #38A7BB;">
                        <div class="form-group row" style="position : relative; top: -12px;">
                          {{-- <div class="col-4"></div> --}}
                          <label for="staticEmail" class="col-md-6 col col-form-label" align="right">Total</label>
                          <div class="col-6">
                            <input type="text" id="total" class="form-control" style="text-align:right;" value="Rp. " readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="card mt-3">
                        <div class="card-body" style="height: 60px;">
                          <div class="form-group" style="position : relative; top: -10px; width:100%" id="profile-next">
                            
                          </div>
                        </div>
                      </div>
                    </div>
                </div>

                
              </div>

              {{-- form biodata --}}
              <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="card">
                  <div class="card-body">
                    <form action="">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label >Nama Lengkap *</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $full_name != '' ? $full_name : '' }}" {{ $full_name != '' ? 'readonly' : '' }} required>
                          </div>
                          <div class="form-group">
                            <label >Telepon</label>
                            <input type="text" class="form-control" id="telp" name="telp" maxlength="13" onkeypress="return hanyaAngka(event)" value="{{ $phone != '' ? $phone : '' }}" {{ $phone != '' ? 'readonly' : '' }}>
                          </div>
                          <div class="form-group">
                            <label >Email *</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $email != '' ? $email : '' }}" {{ $email != '' ? 'readonly' : '' }} required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label >Tanggal Digunakan *</label>
                            <input type="text" id="date" class="form-control" name="date" required autocomplete="off" readonly onkeydown="return false">
                          </div>
                          <div class="form-group">
                            <label >Jenis Tiket *</label>
                            <br>
                            <input type="radio" checked name="jenis" id="individu" value="individu" onclick="showDetail()" style="margin-left: 10px;"> individu
                            <input type="radio" name="jenis" id="rombongan" value="rombongan" onclick="showDetail()" style="margin-left: 10px;"> rombongan
                            <br>
                            <small>
                                <span>* individu : untuk 1 pengunjung</span>
                                <br>
                                <span>* rombongan : untuk lebih dari 1 pengunjung</span>
                            </small>
                           
                          </div>
                          <div class="form-group nama-rombongan" style="display: none">
                            <label >Nama Rombongan *</label>
                            <input type="text" id="nama_rombongan" name="nama_rombongan" class="form-control" >
                          </div>
                          <div class="form-group jumlah-rombongan" style="display: none">
                            <label >Jumlah Rombongan *</label>
                            <input type="text" id="jumlah_rombongan" name="jumlah_rombongan" class="form-control" onkeypress="return hanyaAngka(event)">
                          </div>
                          <!-- {{-- <div class="form-group mt-3"> --}}
                            {{-- <input type="checkbox" id="validasi" aria-label="Checkbox for following text input"> <span>I am not robot</span> --}}
                          <div class="g-recaptcha" data-sitekey="6LcfTOYeAAAAAC9zx-XPXu_BOO6lPwFfn3viIogJ" style="transform:scale(0.80);-webkit-transform:scale(0.80);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                          {{-- </div> --}} -->
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                <div class="mt-3">
                  <div class="row" id="load_tab">
                    <div class="col-6" align="left" id="prev-tiket">
                                            
                    </div>
                    <div class="col-6" align="right" id="next-checkout">
                      
                    </div>
                  </div>
                </div>
              </div>

              {{-- form checkout --}}
              <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="row">
                  <div class="col-md-8">
                    <div class="card">
                      <div class="card-body" style="min-height: 300px;">
                        <table class="table table-striped" id="list_checkout">
                          <thead>
                            <tr>
                              <th scope="col" width="35%">Jenis Tiket</th>
                              <th scope="col" width="30%">Jumlah</th>
                              <th scope="col" width="35%">Sub Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                          
                        </table>     
                        
                      </div>

                      <div class="card-body" style="min-height: 150px">
                        <div class="row">
                          <div class="col-8" align="right">
                            <p>Sub Total</p>
                          </div>
                          <div class="col-4" align="right">
                            <p id="subtotal"></p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-8" align="right">
                            <p>Biaya Admin</p>
                          </div>
                          <div class="col-4" align="right">
                            <p id="ppn"></p>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-8" align="right">
                            <h6>Total</h6>
                          </div>
                          <div class="col-4" align="right">
                            <p id="total_akhir"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-body" style="min-height: 490px">
                        <p align="center">Metode pembayaran</p>

                        <div class="row">

                          <div class="col-12">
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="payment_ewallet" name="payment" class="custom-control-input" value="ewallet" onclick="payment()">
                              <label class="custom-control-label" for="payment_ewallet">Ewallet ( OVO )</label>
                            </div>
                            <br />
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="payment_virtual" name="payment" class="custom-control-input" value="virtual" onclick="payment()">
                              <label class="custom-control-label" for="payment_virtual">Virtual Account</label>
                            </div>
                            <br />
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="payment_qrcode" name="payment" class="custom-control-input" value="qris" onclick="payment()">
                              <label class="custom-control-label" for="payment_qrcode">QR Code</label>
                            </div>
                            
                          </div>                         

                        </div>

                        <div class="row mt-3">
                          <div class="col-12 ewallet" style="display: none">
                            <p style="float: left">OVO</p>
                            <img src="{{ base_url() }}assets_frontend/images/ovo.png" alt="" style="float: right; width: 30px; margin-right : 10px;">
                          </div>

                          <div class="col-12">
                            <div class="form-group ewallet" style="display: none">
                              <label >Nomor Akun OVO *</label>
                              <input type="text" id="ovo_number" name="ovo_number" class="form-control" onkeypress="return hanyaAngka(event)" maxlength="13">
                            </div>
                          </div>

                          <div class="col-12 ewallet" style="display: none">
                            <label for="">Notice : </label>
                            <small>
                              <ul>
                                <li>
                                  <p style="text-align: justify">Pembayaran dengan E-Wallet hanya dapat dilakukan selama 30 detik</p>
                                </li>
                                <li>
                                  <p style="text-align: justify">Jika melampaui batas tersebut, anda dapat melakukan transaksi kembali atau dapat masuk ke menu history dan klik kirim pembayaran ulang (bagi yang mempunyai akun)</p>
                                </li>
                                <li>
                                  <p style="text-align: justify">Untuk Mendapatkan E-Tiket Harap Konfirmasi Pembayaran Secara Manual</p>
                                </li>
                              </ul>
                            </small>
                          </div>
                        </div>

                        <div class="row mt-3">
                          <div class="col-12 VA" style="display: none">
                            <p style="float: left">Bank Mandiri</p>
                            <img src="{{ base_url() }}assets_frontend/images/bank-mandiri.png" alt="" style="float: right">
                          </div>
                          
                          <div class="col-12 VA" style="display: none">
                            <p style="float: left">Bank BRI</p>
                            <img src="{{ base_url() }}assets_frontend/images/bank-bri.png" alt="" style="float: right; margin-right : 10px;">
                          </div>
                          
                          <div class="col-12 VA" style="display: none">
                            <p style="float: left">Bank BNI</p>
                            <img src="{{ base_url() }}assets_frontend/images/BNI-logo.png" alt="" style="float: right; width: 40px; margin-top : 5px; margin-right : 10px;">
                          </div>
                          
                          <div class="col-12 VA" style="display: none">
                            <p style="float: left">Bank Permata</p>
                            <img src="{{ base_url() }}assets_frontend/images/PermataBank.png" alt="" style="float: right; width: 30px; margin-right : 10px;">
                          </div>

                          <div class="col-12 VA" style="display: none">
                            <label for="">Notice : </label>
                            <small>
                              <ul>
                                <li>
                                  <p style="text-align: justify">Konfirmasi Pembayaran akan di verifikasi otomatis oleh sistem</p>
                                </li>
                              </ul>
                            </small>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>

                <div class="mt-3">
                  <div class="row" id="load_tab">
                    <div class="col-6" align="left" id="prev-profile">
                                           
                    </div>
                    <div class="col-6" align="right">
                      <button type="button" class="btn btn-success" onclick="saveData()">Simpan </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="content mt-5">
      <div class="container-lg">
        <span>
            Nb : 
            <ul>
              {!! $notes !!}
            </ul>
        </span>
      </div>


      {{-- modal tentang kami --}}
      <div class="modal fade" id="tentangKami" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Tentang Kami</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p style="text-align: justify">
                @foreach ($tentang as $item)
                  {{ $item->desc }}
                @endforeach
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
            </div>
          </div>
        </div>
      </div>

      {{-- modal kontak kami --}}
      <div class="modal fade" id="kontakKami" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Kontak Kami</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p style="text-align: justify">
                @foreach ($kontak as $item)
                  <b>{{ $item->tittle }}</b>
                  <br>{{ $item->desc }}<br><br>
                @endforeach
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
            </div>
          </div>
        </div>
      </div>

      {{-- modal syarat dan ketentuan --}}
      <div class="modal fade" id="syaratKetentuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Syarat Dan ketentuan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              @foreach ($syarat as $item)
                <b>{{ $item->tittle }}</b>
                <br>{{ $item->desc }}<br><br>
              @endforeach
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
            </div>
          </div>
        </div>
      </div>

      {{-- modal konfirmasi pembayaran --}}
      <div class="modal fade" id="konfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Pembayaran</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="<?=base_url('verifyEwallet')?>" method="POST">
                <div class="form-group">
                  <label >Kode Booking </label>
                  <input type="text" class="form-control" name="kd_booking" placeholder="Masukkan Kode Booking" maxlength="5" required>
                </div>
                <div class="form-group">
                  <label >Nama Pemesan </label>
                  <input type="text" class="form-control" name="nama_pemesan" placeholder="Masukkan Nama Pemesan" required>
                </div>
                <div class="form-group">
                  <label >Nominal </label>
                  <input type="text" class="form-control" name="nominal" id="nominal" placeholder="Masukkan Nominal" onkeypress="return hanyaAngka(event)" required>
                </div>
                <!-- <div class="g-recaptcha" data-sitekey="6LcfTOYeAAAAAC9zx-XPXu_BOO6lPwFfn3viIogJ" style="transform:scale(0.80);-webkit-transform:scale(0.80);transform-origin:0 0;-webkit-transform-origin:0 0;"></div> -->
                <div class="form-group mt-3">
                  <button type="submit" style="width: 100%" class="btn btn-info">Konfirmasi</button>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
              {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
            </div>
          </div>
        </div>
      </div>

      {{-- modal login --}}
      <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Login</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row" style="margin : 1px;">
                <div class="col-md-5" style="background: url('{{ base_url() }}assets_frontend/images/bg-login3.png'); ">

                </div>
                <div class="col-md-7">
                  <form action="login" method="POST" class="mt-3">
                    <h3>Masuk</h3>

                    <div class="form-group mt-5">
                      <label >Email </label>
                      <input type="email" class="form-control" name="email" placeholder="Masukkan email anda" required>
                    </div>
                    <div class="form-group">
                      <label >Password </label>
                      <input type="password" class="form-control" name="password" placeholder="Masukkan password anda" required>
                    </div>

                    <div class="row mt-5">
                      <div class="col-6">
                        <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#forgetPassword">
                          Lupa Password
                        </a>
                      </div>
                      <div class="col-6" align="right">
                        <button type="submit" name="login" class="btn btn-info">Masuk</button>
                      </div>
                    </div>


                    <div class="row mt-5">
                      <div class="col-12">
                        <a href="#" data-toggle="modal" data-target="#register" data-dismiss="modal" class="btn btn-outline-info" style="width : 100%">
                            Belum punya akun ? <b>Daftar Disini</b>
                        </a>
                      </div>
                    </div>
                    <br>
                    <br>              
                  </form>
                </div>
              </div>
            </div>
            {{-- <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div> --}}
          </div>
        </div>
      </div>

      {{-- modal register --}}
      <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
          <div class="modal-content">
            {{-- <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Register</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> --}}
            <div class="modal-body">
              <div class="row" style="margin : 1px;">
                <div class="col-md-5" style="background: url('{{ base_url() }}assets_frontend/images/bg-login3.png'); ">

                </div>
                <div class="col-md-7">
                  <form action="register" method="POST">
                    <h3>Buat Akun</h3>
                    <span>
                      Silahkan lengkapi  data diri anda dibawah ini
                    </span>

                    <div class="row mt-3">
                      <div class="col-12">
                        <div class="form-group">
                          <label >Nama Lengkap </label>
                          <input type="text" class="form-control" name="full_name" placeholder="isikan nama lengkap anda" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label >Password </label>
                          <input type="password" class="form-control" name="password" placeholder="isikan password anda" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                          <label >Email </label>
                          <input type="email" class="form-control" name="email" placeholder="isikan email anda" required>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                          <label >Telepon </label>
                          <input type="text" class="form-control" name="phone" placeholder="isikan no telepon anda" onkeypress="return hanyaAngka(event)" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label >Alamat </label>
                          <input type="text" class="form-control" name="addres" placeholder="isikan alamat anda" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12" align="right">
                        <div class="form-group">
                          <button type="submit" class="btn btn-info">Daftar</button>
                        </div>
                      </div>
                    </div>
                    
                    <br>

                  </form>
                </div>
              </div>
            </div>
            {{-- <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div> --}}
          </div>
        </div>
      </div>

      {{-- history --}}
      <div class="modal fade" id="history" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">History Pembelian Tiket</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="min-height: 400px;">
              <table class="table table-striped table-bordered" style="width:100%" id="example">
                <thead>
                  <tr>
                    <th scope="col">Tanggal Pembelian</th>
                    <th scope="col">Digunakan</th>
                    <th scope="col">Jenis Tiket ( Qty )</th>
                    <th scope="col">Resend Payment</th>
                    <th scope="col">Status</th>
                    <th scope="col">Total</th>
                    {{-- <th scope="col">Aksi</th> --}}
                  </tr>                  
                </thead>
                <tbody id="history_list">
                  {{-- code --}}
                  @php
                      function rupiah($angka){
	
                        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
                        return $hasil_rupiah;
                      
                      }
                  @endphp
                  @foreach ($transaction as $item)
                      <tr>
                        <td>{{ date('d-m-Y', strtotime($item->transaction_created)) }}</td>
                        <td>
                          {{ date('d-m-Y', strtotime($item->transaction_date_used)) }}   

                          @if (date('d', strtotime($item->transaction_date_used)) < date('d') & date('m', strtotime($item->transaction_date_used)) > date('m') )
                                <button type="button" style="display : inline" id="ubah_jdwl" 
                                  data-toggle="modal" data-id="{{ $item->transaction_id }}" 
                                  data-tgl="{{ date('Y/m/d', strtotime($item->transaction_date_used)) }}"
                                  data-target="#ubahjadwal" class="badge badge-info">ubah</button>                                                  
                          @endif                         

                          @if (date('d', strtotime($item->transaction_date_used)) > date('d') & date('m', strtotime($item->transaction_date_used)) >= date('m') )
                                <button type="button" style="display : inline" id="ubah_jdwl" 
                                  data-toggle="modal" data-id="{{ $item->transaction_id }}" 
                                  data-tgl="{{ date('Y/m/d', strtotime($item->transaction_date_used)) }}"
                                  data-target="#ubahjadwal" class="badge badge-info">ubah</button>                                                  
                          @endif
                        </td>
                        <td>
                          @foreach ($history as $x)
                              @if ($x->transaction_id == $item->transaction_id)
                                  <li>{{ $x->product_title }} [{{ $x->transaction_detail_qty }}]</li> 
                              @endif                             
                          @endforeach
                        </td>
                        <td align="center">
                          @if ($item->transaction_payment == "ewallet" && $item->transaction_paid != 1)
                            @if (date('d', strtotime($item->transaction_date_used)) < date('d') & date('m', strtotime($item->transaction_date_used)) > date('m') )
                              <a href="<?=base_url('resendPayment/'.$item->transaction_id)?>" class="badge badge-primary">Kirim Ulang</a>                                                 
                            @endif                         

                            @if (date('d', strtotime($item->transaction_date_used)) > date('d') & date('m', strtotime($item->transaction_date_used)) >= date('m') )
                              <a href="<?=base_url('resendPayment/'.$item->transaction_id)?>" class="badge badge-primary">Kirim Ulang</a>                                                  
                            @endif
                              
                          @endif
                        </td>
                        <td>
                          {{ $item->transaction_paid == 0 ? 'Menunggu' : 'Sukses' }}
                        </td>
                        <td>
                          {{ rupiah($item->transaction_total) }}
                        </td>
                      </tr>
                  @endforeach
                  {{-- @foreach ($history as $item)
                      <tr>
                        <td>{{ date('d-m-Y', strtotime($item->transaction_created)) }}</td>
                        <td>
                          {{ date('d-m-Y', strtotime($item->transaction_date_used)) }}   

                          @if (date('d', strtotime($item->transaction_date_used)) < date('d') & date('m', strtotime($item->transaction_date_used)) > date('m') )
                                <button type="button" style="display : inline" id="ubah_jdwl" 
                                  data-toggle="modal" data-id="{{ $item->transaction_id }}" 
                                  data-tgl="{{ date('Y/m/d', strtotime($item->transaction_date_used)) }}" data-detail="{{ $item->transaction_detail_id }}"
                                  data-target="#ubahjadwal" class="badge badge-info">ubah</button>                                                  
                          @endif                         

                          @if (date('d', strtotime($item->transaction_date_used)) > date('d') & date('m', strtotime($item->transaction_date_used)) >= date('m') )
                                <button type="button" style="display : inline" id="ubah_jdwl" 
                                  data-toggle="modal" data-id="{{ $item->transaction_id }}" 
                                  data-tgl="{{ date('Y/m/d', strtotime($item->transaction_date_used)) }}" data-detail="{{ $item->transaction_detail_id }}"
                                  data-target="#ubahjadwal" class="badge badge-info">ubah</button>                                                  
                          @endif
                         
                          
                        
                        </td>
                        <td>{{ $item->product_title }}</td>
                        <td>{{ $item->transaction_detail_qty }}</td>
                        <td><span class="badge {{ $item->transaction_paid == 0 ? 'badge-warning' : 'badge-success' }}">{{ $item->transaction_paid == 0 ? 'Menunggu' : 'Sukses' }}</span></td>
                        <td>{{ rupiah($item->transaction_detail_subtotal) }}</td>

                      </tr>
                  @endforeach --}}
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            </div>
          </div>
        </div>
      </div>

      <script>
        $(document).on("click", "#ubah_jdwl", function(){
            var id        = $(this).data('id');
            var tgl_old   = $(this).data('tgl');
            
            $("#ubahjadwal #id_trx").val(id);
            $("#ubahjadwal #tgl_old").val(tgl_old);
        })

      </script>

      {{-- ubah jadwal pemakaian --}}
      <div class="modal fade" id="ubahjadwal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header" align="center">
              <p class="modal-title" style="width: 100%" id="staticBackdropLabel">
                <b>Ubah Tanggal Digunakan</b>
              </p>
            </div>
            <div class="modal-body">
              <div class="row" style="margin : 1px;">
                <div class="col-md-12">
                  <form action="#" method="POST">
                    
                    <div class="form-group">
                      <label >Tanggal Sebelumnya</label>
                      <input type="text" class="form-control" id="tgl_old" readonly>
                      <input type="hidden" class="form-control" name="id_trx" id="id_trx" readonly>
                    </div>

                    <div class="form-group">
                      <label >Tanggal Digunakan</label>
                      <input type="text" id="date2" class="form-control" name="date2" required autocomplete="off" readonly onkeydown="return false">
                    </div>

                    <div class="row mt-3">
                      <div class="col-12">
                        <button type="button" style="width: 100%" name="reset" onclick="reschedule()" class="btn btn-info">Ubah Jadwal</button>
                      </div>
                    </div>

                    <br>              
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- forget password --}}
      <div class="modal fade" id="forgetPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header" align="center">
              <p class="modal-title" style="width: 100%" id="staticBackdropLabel">
                <b>Lupa Password</b>
                <br>
                <span>
                  Silahkan masukan Email untuk melakukan reset password
                </span>
              </p>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row" style="margin : 1px;">
                <div class="col-md-12">
                  <form action="#" method="POST">

                    <div class="form-group">
                      <label >Email </label>
                      <input type="email" class="form-control" name="email" id="reset_email" placeholder="Masukkan email anda" required>
                    </div>

                    <div class="row mt-3">
                      <div class="col-12">
                        <button type="button" style="width: 100%" name="reset" onclick="reset_pass()" class="btn btn-info">Reset Password</button>
                      </div>
                    </div>

                    <br>              
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
      $(document).ready(function() {
          window.setTimeout(function() {
              $(".alert").fadeTo(500, 0).slideUp(500, function(){
                  $(this).remove();
              });
          }, 3000);
      });    
    </script>

    <script>
      $(document).ready(function() {
        var next_pr = "<a id='nav-profile-tab' style='width: 33%; text-decoration:none;' data-toggle='tab' href='#nav-profile' aria-controls='nav-profile' aria-selected='false' onclick='reset();clearTable()'><button type='button' class='btn btn-outline-success' style='width: 100%'>Selanjutnya >></button></a>";

        var prev_tiket = "<a id='nav-home-tab' style='width: 33%; text-decoration:none;' data-toggle='tab' href='#nav-home' role='tab' aria-controls='nav-home' aria-selected='false' onclick='reset();clearTable()'><button type='button' class='btn btn-outline-info' ><< Sebelumnya</button></a> ";

        var next_checkout = "<button type='button' data-toggle='tab' href='#nav-contact' role='tab' aria-controls='nav-contact' aria-selected='false' class='btn btn-outline-success' onclick='reset();konfirmasi()'>Selanjutnya >></button>";

        var prev_profile = "<a id='nav-home-tab' style='width: 33%; text-decoration:none;' data-toggle='tab' href='#nav-profile' role='tab' aria-controls='nav-profile' aria-selected='false' onclick='reset();clearTable()'><button type='button' class='btn btn-outline-info' ><< Sebelumnya</button> </a> ";

        document.getElementById("profile-next").innerHTML = next_pr;
        document.getElementById("prev-tiket").innerHTML = prev_tiket;
        document.getElementById("next-checkout").innerHTML = next_checkout;
        document.getElementById("prev-profile").innerHTML = prev_profile;
      });

      function reset(){
        var next_pr = "<a id='nav-profile-tab' style='width: 33%; text-decoration:none;' data-toggle='tab' href='#nav-profile' aria-controls='nav-profile' aria-selected='false' onclick='reset();clearTable()'><button type='button' class='btn btn-outline-success' style='width: 100%'>Selanjutnya >></button></a>";
        
        var prev_tiket = "<a id='nav-home-tab' style='width: 33%; text-decoration:none;' data-toggle='tab' href='#nav-home' role='tab' aria-controls='nav-home' aria-selected='false' onclick='reset();clearTable()'><button type='button' class='btn btn-outline-info' ><< Sebelumnya</button></a> ";

        var next_checkout = "<button type='button' data-toggle='tab' href='#nav-contact' role='tab' aria-controls='nav-contact' aria-selected='false' class='btn btn-outline-success' onclick='reset();konfirmasi()'>Selanjutnya >></button>";

        var prev_profile = "<a id='nav-home-tab' style='width: 33%; text-decoration:none;' data-toggle='tab' href='#nav-profile' role='tab' aria-controls='nav-profile' aria-selected='false' onclick='reset();clearTable()'><button type='button' class='btn btn-outline-info' ><< Sebelumnya</button> </a> "

        $('#profile-next').empty();  
        $('#profile-next').append(next_pr);  

        $('#prev-tiket').empty();  
        $('#prev-tiket').append(prev_tiket); 

        $('#next-checkout').empty();  
        $('#next-checkout').append(next_checkout); 

        $('#prev-profile').empty();  
        $('#prev-profile').append(prev_profile); 
      }
    </script>

    <script>
      var nominal_rp = document.getElementById('nominal');
      nominal_rp.addEventListener('keyup', function(e){
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatnominal_rp() untuk mengubah angka yang di ketik menjadi format angka
        nominal_rp.value = formatRupiah(this.value, 'Rp. ');
      });

      function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
  
        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
        }
  
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
      }
    
      $(document).ready(function() {
          $('.js-example-basic-single').select2();

          $("#date").datepicker({
              dateFormat: "yy/mm/dd",
              changeMonth: true,
              changeYear: true ,
              yearRange: "-100:+0",
              // showOn: "button",
              // buttonImageOnly: true,
              minDate: new Date(),
              beforeShowDay: closed
          });

          $("#date2").datepicker({
              dateFormat: "yy/mm/dd",
              changeMonth: true,
              changeYear: true ,
              yearRange: "-100:+0",
              // showOn: "button",
              // buttonImageOnly: true,
              minDate: new Date(),
              beforeShowDay: closed
          });

          function closed(date){
              /*
                0 sunday
                1 monday
                2 tuesda
                3 wed
                4 thue
                5 fri
                6 saturday
               */
                // if (date.getDay() != 2 && date.getDay() != 5 )  /* Monday */
                //       return [ false, "closed", "Closed on Monday" ]
                // else
                //       return [ true, "", "" ]
                // var disabledDays = ["2020-9-7", "2020-9-10"];

                var disabledDays = {!! json_encode($holiday) !!};

                var sun = {{ $sun }};
                var mon = {{ $mon }};
                var tue = {{ $tue }};
                var wed = {{ $wed }};
                var thu = {{ $thu }};
                var fri = {{ $fri }};
                var sat = {{ $sat }};

                var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
                if($.inArray(y + '-' + (m+1) + '-' + d,disabledDays) != -1) return [false];

                if (date.getDay() != sun && date.getDay() != mon && date.getDay() != tue && date.getDay() != wed && date.getDay() != thu && date.getDay() != fri && date.getDay() != sat )  /* Monday */
                  return [true]
                else
                  return [false]
          }

          $('#example').DataTable({
            "ordering" : false
          });

          // $('#history_list').load('{{ base_url() }}cms/tiket_lokal/getHistory');
      });      

      function showDetail(){
        var jenis = $('input[name="jenis"]:checked').val();

        if(jenis == 'individu'){
          $('.nama-rombongan').css("display","none");
          $('.jumlah-rombongan').css("display","none");
        }
        else{
          $('.nama-rombongan').css("display","block");
          $('.jumlah-rombongan').css("display","block");
        }
      }

      function check_tiket(){
        var harga = $('#ticket option:selected').attr('harga');

        if($('#ticket').val() != '')
          $('#harga').val(formatCurrency(harga));
      }

      function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
  
          return false;
        return true;
      }

      $('.addRow').on('click', function(){
        $('#discount').val(0);
        addRow();
        // konfirmasi();
      });

      var data = [];

      function addRow(){

        var min_buy = parseInt($('#ticket option:selected').attr('product_min'));
        var jml =  parseInt($('#jumlah').val());

        if($('#ticket').val() == '' | $('#jumlah').val() == ''){
          // alert('inputan tidak boleh kosong');
          Swal.fire({
            icon: 'warning',
            title: 'Maaf',
            text: 'Inputan tidak boleh kosong!',
          })
        }

        else if(jml >= 20 && min_buy == 1){
          Swal.fire({
            icon: 'warning',
            title: 'Maaf',
            text: 'Jumlah Beli Max 19',
          })
        }

        else if(jml < min_buy && min_buy > 1){
          Swal.fire({
            icon: 'warning',
            title: 'Maaf',
            text: 'Jumlah Beli Minimal '+min_buy,
          })
        }

        else{
          var id = $('#ticket').val();
          var nama = $('#ticket option:selected').attr('nama');
          var harga = $('#ticket option:selected').attr('harga');
          var jumlah =  $('#jumlah').val()
          var subTotal = parseInt(harga) * parseInt(jumlah);

          var dataCheck = [];
          $('#list_booking tbody tr').each(function(row, tr) {
            if ($(tr).find('td:eq(1)').text() == '') {

            } else {
              var x = {
                'id_tiket': $(tr).find('#id_tiket').val(),
                'nama_tiket': $(tr).find('#nama_tiket').val(),
                'harga_tiket': $(tr).find('#harga_tiket').val(),
                'jumlah_item': $(tr).find('#jumlah_item').val(),
                'subT': $(tr).find('#sub').val(),
              };

              dataCheck.push(x);
            }
          });
          
          for(let i = 0; i < dataCheck.length; i++){

            var id_tc = parseInt(dataCheck[i]['id_tiket']);
            var sub   = parseInt(dataCheck[i]['subT']);

            // console.log(id_tc);

            if(id_tc == id){             
              
              $("#list_booking tbody tr").each(function(row, tr) {
                var x = $(tr).find('#id_tiket').val();

                if(parseInt(x) == id){
                  min_total(parseInt($(tr).find('#sub').val()));
                  $(this).closest('tr').remove();
                }
                
              });

              if(min_buy == 1 && (parseInt(dataCheck[i]['jumlah_item']) + parseInt(jumlah)) >= 20){
                
                jumlah = 19;
                subTotal = jumlah * parseInt(harga);

                Swal.fire({
                  icon: 'warning',
                  title: 'Maaf',
                  text: 'Jumlah Beli Tiket Individu Max 19',
                })
                
              }

              else{
                jumlah = parseInt(dataCheck[i]['jumlah_item']) + parseInt(jumlah);
                subTotal = parseInt(dataCheck[i]['subT']) + parseInt(subTotal);
              }
              // id_tc.closest('tr').remove();

              // console.log(jumlah);
            }
          }

          // console.log(tax);

          var row = $('tbody tr').length;
          var tr = '<tr>'+
                          '<td>'+nama+'<input type="hidden" id="id_tiket" value="'+id+'"><input type="hidden" id="nama_tiket" value="'+nama+'"></td>'+                          
                          '<td>'+jumlah+'<input type="hidden" id="jumlah_item" value="'+jumlah+'"></td>'+                          
                          '<td>'+formatCurrency(subTotal)+'<input type="hidden" id="sub" value="'+subTotal+'"><input type="hidden" id="harga_tiket" value="'+harga+'"></td>'+                          
                          '<td align="center">'+
                            '<a href="#" class="badge badge-warning " onclick="del_data(this,'+subTotal+')">Hapus</a>'+
                          '</td>'+
                  '</tr>';

          $('#list_booking tbody:last-child').append(tr);

          set_total(subTotal);

          $('#harga').val('');
          $('#jumlah').val('');
          $('#ticket').val(null).trigger('change');

          dataCheck = []; //clear check data

          // konfirmasi();
        }

      }

      var total = 0;
      var ppn = 0;
      var total_final = 0;
      var payment_method = '';

      function payment(){

        var jns = $('input[name="payment"]:checked').val();

        if (jns == 'ewallet') {
          $('.ewallet').css("display", "block");
          $('.VA').css("display", "none");

          payment_method = 'ewallet';
          set_total();
        }

        else if(jns == 'virtual'){
          $('.ewallet').css("display", "none");
          $('.VA').css("display", "block");

          payment_method = 'virtual_account';
          set_total();
        }

        else if(jns == 'qris'){
          $('.ewallet').css("display", "none");
          $('.VA').css("display", "none");

          payment_method = 'qris';
          set_total();
        } else 
        
        {
          $('.ewallet').css("display", "none");
          $('.VA').css("display", "none");

          payment_method = '';
          set_total();
        }

        // console.log(jns);
      }

      $(document).ready(function() {
        if (total < 10000) {
          // document.getElementById("payment_virtual").disabled = true;
        }
      }); 

      function cek_total(){
        if (total < 10000) {
          // document.getElementById("payment_virtual").disabled = true;
          // document.getElementById('payment_virtual').checked = false;
          // $('.VA').css("display", "none");
          // payment_method = 'ewallet';
          // document.getElementById('payment_ewallet').checked = true;
          // $('.ewallet').css("display", "block");
        }
        else{
          document.getElementById("payment_virtual").disabled = false;
        }
      }

      function set_total(subTotal = null){
        
        total += subTotal;

        cek_total();

        if(payment_method == 'ewallet' & total != 0){
          ppn = (total * 0.015) + ((total * 0.015) * 0.1 ); //0,015 = fee xendit , 0,1 ppn 10 %
        }

        else if(payment_method == 'virtual_account' & total != 0){
          ppn = 4500 + (4500 * 0.1);
        }

        else{
          ppn = 0;
        }

        $('#total').val(formatCurrency(total));
        document.getElementById("total_akhir").innerHTML = formatCurrency(total + ppn);
        document.getElementById("subtotal").innerHTML = formatCurrency(total);
        document.getElementById("ppn").innerHTML = formatCurrency(ppn);
        
      }

      function min_total(subTotal){
        total = total - subTotal;

        cek_total();

        if(payment_method == 'ewallet' & total != 0){
          ppn = (total * 0.015) + ((total * 0.015) * 0.1 ); //0,015 = fee xendit , 0,1 ppn 10 %
        }

        else if(payment_method == 'virtual_account' & total != 0){
          ppn = 4500 + (4500 * 0.1);
        }

        else{
          ppn = 0;
        }

        $('#total').val(formatCurrency(total));
        document.getElementById("total_akhir").innerHTML = formatCurrency(total + ppn);
        document.getElementById("subtotal").innerHTML = formatCurrency(total);
        document.getElementById("ppn").innerHTML = formatCurrency(ppn);
      }

      function del_data(id, subTotal){

        total = total - subTotal;

        cek_total();

        if(payment_method == 'ewallet' & total != 0){
          ppn = (total * 0.015) + ((total * 0.015) * 0.1 ); //0,015 = fee xendit , 0,1 ppn 10 %
        }

        else if(payment_method == 'virtual_account' & total != 0){
          ppn = 4500 + (4500 * 0.1);
        }

        else{
          ppn = 0;
        }

        $('#total').val(formatCurrency(total));
        document.getElementById("total_akhir").innerHTML = formatCurrency(total + ppn);
        document.getElementById("subtotal").innerHTML = formatCurrency(total);
        document.getElementById("ppn").innerHTML = formatCurrency(ppn);

        data = [];

        $("#list_checkout tbody tr").remove(); 

        id.closest('tr').remove();
      }

      function formatCurrency(num){
        num = num.toString().replace(/\$|\,/g,'');
        if(isNaN(num)) num = "0";
        cents = Math.floor((num*100+0.5)%100);
        num = Math.floor((num*100+0.5)/100).toString();
        if(cents < 10) cents = "0" + cents;
        for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
        num = num.substring(0,num.length-(4*i+3))+'.'+num.substring(num.length-(4*i+3));
        return ("Rp. " + num);
      }

      function clearTable(){
        data = [];

        $("#list_checkout tbody tr").remove(); 
      }

      function konfirmasi() {

        if(data == ''){
          $('#list_booking tbody tr').each(function(row, tr) {
            if ($(tr).find('td:eq(1)').text() == '') {

            } else {
              var x = {
                'id_tiket': $(tr).find('#id_tiket').val(),
                'nama_tiket': $(tr).find('#nama_tiket').val(),
                'harga_tiket': $(tr).find('#harga_tiket').val(),
                'jumlah_item': $(tr).find('#jumlah_item').val(),
                'subT': $(tr).find('#sub').val(),
              };

              data.push(x);
            }
          });
          // console.log(data);
          var tr

          for(let i = 0; i < data.length; i++){
                tr  = '<tr>'+
                            '<td>'+data[i]['nama_tiket']+'</td>'+                          
                            '<td>'+data[i]['jumlah_item']+'</td>'+                          
                            '<td>'+formatCurrency(data[i]['subT'])+'</td>'+
                    '</tr>';
                $('#list_checkout tbody:last-child').append(tr);
          }
        }    
        
      }      

      function saveData(){    
        var nama = $('#full_name').val();
        var telepon = $('#telp').val();
        var email = $('#email').val();
        var date = $('#date').val();
        var nama_rombongan = '';
        var jumlah_rombongan = '';
        var jenis = $('input[name="jenis"]:checked').val();
        // var response = grecaptcha.getResponse();
        var radio_payment = document.getElementsByName("payment");
        var check_payment = false;
        var i = 0;
        var ovo = $('#ovo_number').val();
        nama_rombongan = $('#nama_rombongan').val();
        jumlah_rombongan = $('#jumlah_rombongan').val();

        while (!check_payment && i < radio_payment.length) {
          if (radio_payment[i].checked) check_payment = true;
          i++;        
        }

        // if(response.length != 0){
          // validasi payment
          if (!check_payment) {
            Swal.fire({
              icon: 'warning',
              title: 'Maaf',
              text: 'Harap Memilih Jenis Pembayaran',
            })
          }

          else if(check_payment && payment_method == 'ewallet' && ovo == ''){
            Swal.fire({
              icon: 'warning',
              title: 'Maaf',
              text: 'Harap Mengisi Nomor OVO Anda',
            })
          }

          // validasi biodata
          else if (nama == '') {
            Swal.fire({
              icon: 'warning',
              title: 'Maaf',
              text: 'Kolom Nama Harus Diisi Lengkap',
            })
          }

          else if(telepon == ''){
            Swal.fire({
              icon: 'warning',
              title: 'Maaf',
              text: 'Kolom Telepon Harus Diisi Lengkap',
            })
          }

          else if(email == ''){
            Swal.fire({
              icon: 'warning',
              title: 'Maaf',
              text: 'Kolom Email Harus Diisi Lengkap',
            })
          }

          else if(date == ''){
            Swal.fire({
              icon: 'warning',
              title: 'Maaf',
              text: 'Kolom Tanggal Digunakan Harus Diisi Lengkap',
            })
          }

          else if(data == ''){
            Swal.fire({
              icon: 'warning',
              title: 'Maaf',
              text: 'Tiket Beli Tidak Masih kosong!',
            })
          }

          else if(jenis != 'individu'){

            if (nama_rombongan == '') {
              Swal.fire({
                icon: 'warning',
                title: 'Maaf',
                text: 'Kolom Nama Rombongan Harus Diisi Lengkap',
              }) 
            }

            else if(jumlah_rombongan == ''){
              Swal.fire({
                icon: 'warning',
                title: 'Maaf',
                text: 'Kolom Jumlah Rombongan Harus Diisi Lengkap',
              }) 
            }

            else{
              save(nama, telepon, email, date, nama_rombongan, jumlah_rombongan, jenis, payment_method, ovo);
            }
          }

          else{
            save(nama, telepon, email, date, nama_rombongan, jumlah_rombongan, jenis, payment_method, ovo);
          }

        // }

        // else{
        //   // validasi iam not robot
        //   Swal.fire({
        //     icon: 'warning',
        //     title: '',
        //     text: 'Mohon check validasi "i am not robot" ',
        //   })
        // }
      }

      function reset_pass(){
        var email_reset = $('#reset_email').val();

        if(email_reset == ''){
          Swal.fire({
            icon: 'warning',
            title: 'Maaf',
            text: 'Kolom Email Harus Diisi',
          })
        }

        else{
          $.ajax({
            url     : "{{ base_url() }}cms/tiket_lokal/resetPassword",
            type    : "post",
            data    : {
              // kebutuhan data transaksi
              email : email_reset                
            },
            async   : true,
            dataType  : "json",
            success   : function(x){
              if(x.status != 'failed'){

                console.log(x.id);

                $.ajax({
                  url     : "{{ base_url() }}cms/tiket_lokal/sendMailResetPassword/"+x.id,
                  type    : "get",
                });

                Swal.fire({
                  icon: 'success',
                  title: 'Email Ditemukan',
                  text: 'silahkan cek email anda untuk reset password',
                  showConfirmButton: false,
                  timer: 3000
                })      

                location.replace("{{ base_url() }}cms/tiket_lokal/"); 

              }

              else{
                Swal.fire({
                  icon: 'warning',
                  title: 'Maaf',
                  text: 'Email Tidak Ditemukan',
                })
              }
            }
          });
        }
        
      }

      function save(nama, telepon, email, date, nama_rombongan, jumlah_rombongan, jenis, paye, ovo){
        
        $.ajax({
          url     : "{{ base_url() }}cms/tiket_lokal/saveTransaction",
          type    : "post",
          data    : {
            // kebutuhan data transaksi
            nama    : nama,
            email   : email,
            telepon : telepon,
            date    : date,
            total   : parseInt((total + ppn)),
            ppn     : parseInt(ppn),
            jenis   : jenis,
            group   : nama_rombongan,
            qty     : jumlah_rombongan,
            paye    : paye,
            ovo     : ovo,
            data    : data,                
          },
          async   : true,
          dataType  : "json",
          success   : function(x){
            console.log(x.status);
            let y_external_id = '';
            var x_id = x.id;    

            $.ajax({
              url     : "{{ base_url() }}saveAndSendMail/"+x_id,
              type    : "get",
              async   : true,
              dataType  : "json",
              success   : function(y){
              console.log(y.qr_string);
              console.log(y.external_id);
              var y_qr_string = y.qr_string;
              y_external_id = "{{ base_url() }}assets/uploads/barcode/"+y.external_id+".png"; 
              if (paye == 'qris') {
              console.log(y_external_id);
              Swal.fire({
                icon: 'success',
                html: `<img src="${y_external_id}" style="width:250px;height:250px;" alt="QRIS">`,
                title: 'QRIS',
                text: 'Silahkan scan QRIS',
                allowOutsideClick: () => {
                  const popup = Swal.getPopup()
                  popup.classList.remove('swal2-show')
                  setTimeout(() => {
                    popup.classList.add('animate__animated', 'animate__headShake')
                  })
                  setTimeout(() => {
                    popup.classList.remove('animate__animated', 'animate__headShake')
                  }, 500)
                  return false
                }
              }).then(function() {
                location.replace("{{ base_url() }}cms/tiket_lokal/"); 
                });
              
            } else {
              Swal.fire({
                icon: 'success',
                title: 'Selamat',
                text: 'Pemesanan Berhasil, silahkan cek email anda',
                showConfirmButton: false,
                timer: 3000
              })  
              location.replace("{{ base_url() }}cms/tiket_lokal/"); 
            }
              }
            }); 

            
          }
        });
      }

      function reschedule(){
        var id = $('#id_trx').val();
        var id_dt = $('#id_dt_trx').val();
        var tgl = $('#date2').val();

        var validformat=/^\d{4}\/\d{2}\/\d{2}$/

        

        if(tgl == ''){
          Swal.fire({
              icon: 'warning',
              title: 'Maaf',
              text: 'Tanggal Perubahan Harus Diisi !!',
            })
        }

        else{
          if(!validformat.test(tgl)){
            Swal.fire({
              icon: 'warning',
              title: 'Maaf',
              text: 'Format Tanggal Tidak Sesuai !!',
            })
            $('#date2').val('');
          }

          else{
            // console.log(id, tgl);
            $.ajax({
              url       : '{{ base_url() }}cms/tiket_lokal/reschedule',
              type      : 'post',
              data      :{
                id    : id,
                id_dt : id_dt,
                tgl   : tgl
              },
              async   : true,
              dataType  : "json",
              success   : function(x){
                // console.log(x.status);   
                if (x.ticket == 'created') {
                  $.ajax({
                  url     : "{{ base_url() }}cms/tiket_lokal/resendTicket/"+id,
                    type    : "get",
                  });
                } 

                Swal.fire({
                  icon: 'success',
                  title: 'Selamat',
                  text: 'Perubahan Tanggal Berhasil',
                  showConfirmButton: false,
                  timer: 3000
                })      

                location.replace("{{ base_url() }}cms/tiket_lokal/");       
              
              }

            });
          }
          
        }

        
      }

      $('.log-out').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: "Mengakhiri Sesi ",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes !'
        }).then((result) => {
          if (result.value) {
            document.location.href = href;
          }
        })
      });
      

    </script>
    
  </body>
</html>
