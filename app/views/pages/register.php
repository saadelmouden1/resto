
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    	<!-- font awesome cdn -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    

    <!-- custom css file link  -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <title><?php  echo SITENAME ;?></title>

</head>
<body>

<section class="form-container">

   <form action=" <?php echo URLROOT;?>/users/register" method="post">
      <h3>register now</h3>
      <input type="text" name="name" class="box" placeholder="enter your username" value="<?php echo $data['name']; ?>" >
      
      <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
      <input type="email" name="email" class="box" placeholder="enter your email" value="<?php echo $data['email']; ?>" >
     
      <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
      <input type="password" name="pass" class="box" placeholder="enter your password" value="<?php echo $data['pass']; ?>" >
     
      <span class="invalid-feedback"><?php echo $data['pass_err']; ?></span>
      <input type="password" name="cpass" class="box" placeholder="confirm your password"  value="<?php echo $data['cpass']; ?>" >
     
      <span class="invalid-feedback"><?php echo $data['cpass_err']; ?></span>
      <br>
      
      <input type="submit" class="btn" name="submit" value="register now">
      <p>already have an account? <a href="<?php echo URLROOT;?>/users/login">login now</a></p>
   </form>

</section>


<script type="module" src="<?php echo URLROOT ;?>/js/script.js"></script>
</body>
</html>