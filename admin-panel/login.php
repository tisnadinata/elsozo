<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
		
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
		  <?php
			if(isset($_POST['login'])){
				if($_POST['username'] == 'elsozo.com' AND $_POST['password'] == 'elsozo123'){
					session_start();
					$_SESSION['login'] = 'elsozo.com';
					echo'
						<meta http-equiv="Refresh" content="0; URL=index.php?page=beranda">
					';
				}else{
					echo"<div class='alert alert-danger'>USERNAME ATAU PASSWORD SALAH</div>";
				}
			}
		  ?>
            <form action="" method="post">
              <h1>Login elsozo Admin</h1>
              <div>
                <input type="text" name="username" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-default submit" name="login" >MASUK SEBAGAI ADMIN</button>
              </div>

            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
