<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Form Registrasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- LINEARICONS -->
    <link rel="stylesheet" href="Assetlogin/fonts/linearicons/style.css">
    
    <!-- STYLE CSS -->
    <link rel="stylesheet" href="Assetlogin/css/style.css">
  </head>

  <body>

    <div class="wrapper">
      <div class="inner">
        <img src="Assetlogin/images/image-1.png" alt="" class="image-1">
        <form action="/registeractiontr" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          <h3>Registrasi Admin / Pelanggan</h3>

                <div class="form-holder">
                <select class="form-control" id="LEVEL" name="LEVEL" >
                            <option value="2">Admin</option>
                            <option value="3">Pelanggan</option>
                </select>
                </div>
                                           
          <div class="form-holder">
            <span class="lnr lnr-user"></span>
            <input type="text" class="form-control" placeholder="Nama" id="NAMA" name="NAMA">
          </div>
          <div class="form-holder">
            <span class="lnr lnr-user"></span>
            <input type="text" class="form-control" placeholder="Username" id="USERNAME" name="USERNAME">
          </div>
          <div class="form-holder">
            <span class="lnr lnr-lock"></span>
            <input type="password" class="form-control" placeholder="Password" id="PASSWORD" name="PASSWORD">
          </div>
          <div class="form-holder">
            <span class="lnr lnr-envelope"></span>
            <input type="text" class="form-control" placeholder="Alamat" id="ALAMAT" name="ALAMAT">
          </div>
          <div class="form-holder">
            <span class="lnr lnr-phone-handset"></span>
            <input type="text" class="form-control" placeholder="No Telepon" id="NO_TELP" name="NO_TELP">
          </div>
          <div class="form-holder">
            <span class="lnr lnr-envelope"></span>
            <input type="text" class="form-control" placeholder="E-Mail" id="EMAIL" name="EMAIL">
          </div>
         
          <button type="submit">
            Register
          </button>
        </form>
        <img src="Assetlogin/images/image-2.png" alt="" class="image-2">
      </div>
      
    </div>
    
    <script src="Assetlogin/js/jquery-3.3.1.min.js"></script>
    <script src="Assetlogin/js/main.js"></script>
  </body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>