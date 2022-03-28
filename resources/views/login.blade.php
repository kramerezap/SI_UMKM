<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="Assetlogin/style.css">

</head>
<br><br><br><br><br><br><br>
<body>
<!-- partial:index.partial.html -->
<body>
<div class="container">
	<section id="content">
		<form action="/loginaction" method="post">
			{{csrf_field()}}
			<h1>Login Form</h1>
			<?php if(Session::get('berhasil')){ ?>
                            <div class="alert" style="color: #155724;background-color: #d4edda;border-color: #c3e6cb;margin-bottom: 0px;padding: 10px; margin-bottom: 10px">
                             <!--    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button> -->
                                 Login Berhasil
                            </div>
                        <?php }else if(Session::get('nonaktif')){ ?>
                            <div class="alert alert-success" style=" color: #721c24; background-color: #FFF3CD; border-color: #FFEEBA;margin-bottom: 0px; padding: 10px; margin-bottom: 10px">
                               <!--  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button> -->
                                 Maaf Akun sedang Nonaktif
                            </div>
                             <?php }else if(Session::get('seslog')){ ?>
                            <div class="alert alert-success" style=" color: #721c24; background-color: #FFF3CD; border-color: #FFEEBA;margin-bottom: 0px; padding: 10px;margin-bottom: 10px">
                               <!--  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button> -->
                                 Anda Harus Login Terlebih Dahulu
                            </div>
                        <?php }else if(Session::get('gagal')){ ?>
                          <div class="alert alert-success" style=" color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;margin-bottom: 0px; padding: 10px; margin-bottom: 10px">
                               <!--  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button> -->
                                 Username atau Password Salah
                            </div>
                        <?php } ?>
			<div>
				<input type="text" placeholder="Username" required="" id="USERNAME" name="USERNAME"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" id="PASSWORD" name="PASSWORD"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
        
        @if($data == null)
				<a href="/registerpm">Register Pemilik</a>
        @else
				<a href="/register">Register</a>
        @endif
			</div>
		</form><!-- form -->
		
		
	</section><!-- content -->
</div><!-- container -->
</body>
<!-- partial -->
  <script  src="Assetlogin/script.js"></script>

</body>
</html>
