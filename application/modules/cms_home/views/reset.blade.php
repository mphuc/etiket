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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>
      @media (min-width: 576px) {
        .layout-class {
          position: absolute;
          top: 90px;
          width: 100%;
        }
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

    <title>Museum Nasional Indonesia</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #38A7BB;">
      <div class="container">
        <a class="navbar-brand" href="{{ base_url() }}" style="margin-right: 30%;">
            <img src="{{ base_url() }}assets_frontend/images/kemendikbud1.png" style="float: left; margin-right : 5px;" alt="">
            <p class="text-white" style="font-size: 12px; padding-top : 10px;">
            <b>KEMENTRIAN <br>PENDIDIKAN, KEBUDAYAAN,<br>RISET dan TEKNOLOGI</b>
            </p>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>

    {{-- content  --}}
    <div class="content mt-5">
      <div class="container-lg">
        <form action="{{ base_url() }}reset" method="POST">
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{ $email }}" readonly>
            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">New Password *</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" autocomplete="off" required>
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>

      
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    
  </body>
</html>