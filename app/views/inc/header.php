
	





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <title><?php  echo SITENAME ;?></title>

</head>
<body>

<!-- header section starts      -->
<?php massege('aa');?>

<header>

    <a href="#" class="logo wt"><i class="fas fa-utensils"></i>resto.</a>

    <nav class="navbar">
        <a class="active" href="<?php echo URLROOT;?>/pages/index/#home">home</a>
        
        <a href="<?php echo URLROOT;?>/pages/index/#about">about</a>
        <a href="<?php echo URLROOT;?>/pages/index/#menu">menu</a>
        <a href="<?php echo URLROOT;?>/pages/index/#contact">contact </a>

       
    </nav>

    <div class="icons wt">
        <i class="fas fa-bars" id="menu-bars"></i>
        <i class="fas fa-search " id="search-icon"></i>
       
        <a href="<?php echo URLROOT;?>/pages/cart" class="fas fa-shopping-cart"><?php echo $data['num'];?></a>
        
        <?php if(isset($_SESSION['user_id'])) :?>
          
            
            <i id="user-btn" class="fas fa-user"></i>

          
        <?php else :?>
            <a href="<?php echo URLROOT;?>/users/register" class="fa fa-user-plus"></a>
        <a href="<?php echo URLROOT;?>/users/login" class="fa fa-sign-in"></a>
        <?php endif; ?>
  
        
    </div>
    

    <div class="account-box">
         <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
         <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
         <a href="<?php echo URLROOT;?>/users/logout" class="delete-btn">logout</a>
        
      </div>

    <!-- <label class="switch">
        <input type="checkbox">
        <span class="slider round"></span>
      </label> -->

</header>

<!-- header section ends-->

<!-- search form  -->

<form action="" id="search-form">
    <div class="ct">
        <input type="search" placeholder="search here..." name="" id="search-box" onkeyup="showSuggestion(this.value)">
         <label for="search-box" class="fas fa-search"></label>
    </div>
    <div class='src'>
        <!-- <div class='data'><a href="">kkk</a></div>
        <div class='data'><a href="">kkk</a></div> -->
    
    
    </div>
    
    <i class="fas fa-times" id="close"></i>
   
  
    
</form>


<script>
		function showSuggestion(str){

            
		
                
                var arr=[];

                if(str.length == 0){
				document.querySelector('.src').innerHTML = "";
			} else {
				// AJAX REQ
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
                        document.querySelector('.src').innerHTML="";

                        var vr= this.responseText;
                            arr=vr.split(',');
                       console.log(arr);

                       arr.forEach(ar =>{
                        document.querySelector('.src').innerHTML += `<div class='data'><a href="<?php echo URLROOT;?>/pages/search/${ar}">${ar}</a></div>`
                       })
                      
                       
					}
				}
				xmlhttp.open("GET", "http://localhost:8081/resto/pages/pst/"+str, true);
				xmlhttp.send();
			}
        }
           
	
			
		
    
        
	</script> 

