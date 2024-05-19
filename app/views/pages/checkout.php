
<?php require_once APPROOT.'/views/inc/header.php' ?>


<section class="hd">
        <h3>checkout</h3>
         <p> <a  href="<?php echo URLROOT;?>/pages/index" >home</a> / checkout </p>
        </section>


        <div class="display-order">
            <?php if(isLoggedIn()):?>
        
                <?php  $grand_total = 0; ?>
                <?php foreach($data['cart'] as $cr): 
                    
                    $total_price=number_format($cr->price_pr * $cr->quntite);
                        $grand_total += $total_price;

                    ?>
                    
                    
                    <p> <?php echo $cr->nom_pr;?><span>($<?php echo $cr->price_pr.'/-'.' x '. $cr->quntite?>)</span>  </p>
                    
                    
                    <?php endforeach; ?>		
                    
                    <?php

                            if( empty($cr->nom_pr)){
                                echo '<p class="empty"> cart is empty</p>';
                            }

                    ?>
                    <div class="grand-total">
                    grand total : <span> $ <?php echo $grand_total; ?> /- </span>
                </div>

                <?php else:?>
                    <?php if(isset($_SESSION['cart'])): ?>


                                    <div class="grand-total">
                                        grand total : <span> $ <?php echo $data['gt']?> /- </span>
                                    </div>

                                    <?php foreach($_SESSION['cart'] as $key=>$value):   ?>

                                        <?php 
                                        
                                        
                                            foreach($data['cart'] as $crt){
                                                if($crt->id_pr== $value['product_id']){
                                                    echo '<p>'.$crt->nom_pr.'<span>($'.$crt->price_pr.'/-'.' x '. $value[$value['product_id']].')</span>  </p>';
                                                }
                                            }
                                        
                                        ?>

                    
                                          
                    
                    
                               <?php endforeach; ?>	

                        <?php else: ?> 
                            <?php

                               
                                    echo '<p class="empty"> cart is empty</p>';
                               

                                ?>

                    <?php endif;?>
            <?php endif;?>   
        </div>
        

<section class="checkout">

<form action=" <?php echo URLROOT;?>/orders/addOrder" method="POST">

    <h3>place your order</h3>

    <div class="flex">
        <div class="inputBox">
            <span>your name :</span>
            <?php if(isLoggedIn()):?>
            <input type="text" name="name" placeholder="enter your name" value="<?php  echo $_SESSION['user_name']; ?>">
            <?php else: ?> 
                <input type="text" name="name" placeholder="enter your name">
            <?php endif;?>   
        </div>
        <div class="inputBox">
            <span>your number :</span>
            <input type="number" name="number" min="0" placeholder="enter your number">
        </div>
        <div class="inputBox">
        
            <span>your email :</span>
            <?php if(isLoggedIn()):?>
            <input type="email" name="email" placeholder="enter your email" value="<?php  echo $_SESSION['user_email']; ?>">
            <?php else: ?> 
                <input type="email" name="email" placeholder="enter your email">
                <?php endif;?>   
        </div>
        <div class="inputBox">
            <span>payment method :</span>
            <select name="method">
                <option value="cash on delivery">cash on delivery</option>
                <option value="credit card">credit card</option>
                <option value="paypal">paypal</option>
                <option value="paytm">paytm</option>
            </select>
        </div>
        <div class="inputBox">
            <span>address line 01 :</span>
            <input type="text" name="flat" placeholder="e.g. flat no.">
        </div>
        <div class="inputBox">
            <span>address line 02 :</span>
            <input type="text" name="street" placeholder="e.g.  streen name">
        </div>
        <div class="inputBox">
            <span>city :</span>
            <input type="text" name="city" placeholder="e.g. kasr">
        </div>
        <div class="inputBox">
            <span>state :</span>
            <input type="text" name="state" placeholder="e.g. larach">
        </div>
        <div class="inputBox">
            <span>country :</span>
            <input type="text" name="country" placeholder="e.g. Moroco" value="Moroco">
        </div>
        <div class="inputBox">
            <span>pin code :</span>
            <input type="number" min="0" name="pin_code" placeholder="e.g. 123456">
        </div>
    </div>

    <input type="submit" name="order" value="order now" class="btn">

</form>

</section>

<?php require_once APPROOT.'/views/inc/footer.php' ?>