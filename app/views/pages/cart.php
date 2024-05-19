<?php require_once APPROOT.'/views/inc/header.php' ?>

<section class="hd">
        <h3>shopping cart</h3>
         <p> <a  href="<?php echo URLROOT;?>/pages/index" >home</a> / cart </p>
        </section>

        <!--*******************************  -->
        <section class="shopping-cart">
				<h1 class="title">product added</h1>
				<div class="box-container">
          <?php if(isLoggedIn()): ?>
            
        <?php $grand_total =0 ; ?>
				   <?php foreach($data['cart'] as $cr): ?>
              
            <div class="box">
                <a href="<?php echo URLROOT;?>/carts/deletFromCart/<?php echo $cr->id_cart ; ?>" class="fas fa-times" ></a>
                <!-- <a href="" class="fas fa-eye"></a> -->
                <img src="<?php echo URLROOT;?>/public/uploaded_img/<?php echo $cr->image ;?>" alt="" class="image">
                <div class="name"><?php echo $cr->nom_pr ; ?></div>
                <div class="price">$<?php echo $cr->price_pr ; ?>/-</div>

                  <form action="<?php echo URLROOT;?>/carts/updateCart" method="post">
                    <input type="hidden" value="<?php echo $cr->id_cart ; ?>" name="cart_id">
                    <input type="number" min="1" value="<?php echo $cr->quntite ; ?>" name="cart_quantity" class="qty">
                    <input type="submit" value="update" class="option-btn" name="update_quantity">
                </form>

              <div class="sub-total">sub-total :  <span><?php echo  $sub_total= $cr->quntite *  $cr->price_pr; ?></span> </div>
                
            </div>
           <?php $grand_total +=  $sub_total ; ?>
   
            <?php endforeach;?>

       


          <?php else: ?>

              <?php if(isset($_SESSION['cart'])): ?>
                <?php $grand_total =0 ; ?>
                      <?php foreach($data['cart'] as $cr): ?>
                          
                        <div class="box">
                            <a href="<?php echo URLROOT;?>/carts/deletFromSession/<?php echo $cr->id_pr ; ?>" class="fas fa-times" ></a>
                            <!-- <a href="" class="fas fa-eye"></a> -->
                            <img src="<?php echo URLROOT;?>/public/uploaded_img/<?php echo $cr->image ;?>" alt="" class="image">
                            <div class="name"><?php echo $cr->nom_pr ; ?></div>
                            <div class="price">$<?php echo $cr->price_pr ; ?>/-</div>

                              <form action="<?php echo URLROOT;?>/carts/updateCart" method="post">
                                <input type="hidden" value="<?php echo $cr->id_pr ; ?>" name="cart_id" class='id'>
                                <?php 
                                 foreach($_SESSION['cart'] as $crt=>$value){
                                  if($value['product_id']==$cr->id_pr){
                                    echo' <input type="number" min="1" value="'.$_SESSION['cart'][$crt][$cr->id_pr].'" name="cart_quantity" class="qty">';
                                   
                                  }
                                }
                                
                                ?>
                               
                                <a href="" class="option-btn updt" >update</a>
                                
                            </form>

                          <div class="sub-total">  </div>
                            
                        </div>
                      <?php $grand_total ; ?>
              
                        <?php endforeach;?>

                        
                <?php endif; ?>

            <?php endif; ?>
				</div>


        <?php if(isLoggedIn()): ?>
          
              <div class="more-btn">
                <a href="<?php echo URLROOT;?>/carts/deleteAllCarts/<?php echo $cr->id_user;?>" class="delete-btn  ">delete all</a>
              </div>

                  <div class="cart-total">
                      <p>grand total : <span>$<?php echo $grand_total ; ?>/-</span></p>
                      <a href="shop.php" class="option-btn">continue shopping</a>
                      <a href="<?php echo URLROOT;?>/pages/checkout" class="btn">procced to checkout</a>
                    
             </div>

    <?php else: ?>

          <?php if(isset($_SESSION['cart'])): ?>

            <div class="more-btn">
          <a href="<?php echo URLROOT;?>/carts/deleteAllSession" class="delete-btn  ">delete all</a>
        </div>

            <div class="cart-total sess">
            
              
            </div>


          <?php endif; ?>

			 <?php endif; ?>	

			</section>

      <script>
        const qt=document.querySelectorAll('.qty');
        const price=document.querySelectorAll('.price');
        const subTotal=document.querySelectorAll('.sub-total');
        const grandT=document.querySelector('.grand_t');
        const sess=document.querySelector('.sess');
        const ubdt=document.querySelectorAll('.updt');
        const ids=document.querySelectorAll('.id');
        var gt=0;
        var pr=0;
        var ctx;
        for(var i=0;i<price.length;i++){
          cnt=price[i].textContent
          pr=cnt.slice(
                        cnt.indexOf('$') + 1,
                        cnt.lastIndexOf('/'),
                              );
      
          subTotal[i].innerHTML=`sub-total : <span>$${pr*qt[i].value}/-</span> `;
          ubdt[i].href=`<?php echo URLROOT;?>/carts/updateSession/${ids[i].value}/${qt[i].value}`
          console.log(pr*qt[i].value);

          gt+=pr*qt[i].value;
        }
        

        // grandT.innerHTML=`$${gt}/-`
        sess.innerHTML=`
        <p>grand total : <span class='grand_t'>$${gt}/-</span></p>
        <a href="shop.php" class="option-btn">continue shopping</a>
        <a href="<?php echo URLROOT;?>/pages/checkoute/${gt}" class="btn">procced to checkout</a>
        `;


        
        // const pr=price.slice(
        //                       price.indexOf('$') + 1,
        //                       price.lastIndexOf('/'),
        //                       );

        // const total=document.querySelector('sub-total');

        // total.innerHTML=`<span>${qt*price}</span> `;
        
        qt.forEach((q,a)=>{
          q.addEventListener('change',()=>{
            ubdt[a].href=`<?php echo URLROOT;?>/carts/updateSession/${ids[a].value}/${q.value}`
          })
        })
        




      </script>

<?php require_once APPROOT.'/views/inc/footer.php' ?>