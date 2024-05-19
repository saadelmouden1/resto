<?php require_once APPROOT.'/views/inca/header.php' ?>

<section class="placed-orders">
	<h1 class="title">place orders</h1>
   <form action=" <?php echo URLROOT;?>/admins/admin_orders" method="post">
   <div class="flex">
   <div class="inputBox">

   <select name="flt">
               
               <option value="pending">pending</option>
               <option value="completed">completed</option>
            </select>
   </div>
   


<input type="submit" name="sr"  value="search"  class="btn">

</div>
</form>

	<div class="box-container">

		
    <?php foreach($data['orders'] as $rd):?>
	<div class="box">
         <?php if($rd->user_id): ?>
         <p> user id : <span><?php echo $rd->user_id ; ?></span> </p>
         <?php  endif ; ?>
         <p> placed on : <span><?php echo $rd->place_on ; ?></span> </p>
         <p> name : <span><?php echo $rd->name ; ?></span> </p>
         <p> number : <span><?php echo $rd->number; ?></span> </p>
         <p> email : <span><?php echo $rd->email ; ?></span> </p>
         <p> address : <span><?php echo $rd->place ; ?></span> </p>
         <p> total products : <span><?php echo $rd->total_pr ; ?></span> </p>
         <p> total price : <span>$<?php echo $rd->total_price ; ?>/-</span> </p>
         <p> payment method : <span><?php echo $rd->method ;?></span> </p>
         <form action="<?php echo URLROOT;?>/orders/updateOrders" method="post">
            <input type="hidden" name="order_id" value="<?php echo $rd->id_ord ; ?>">
            <select name="upd">
               <option disabled selected><?php echo $rd->payment_status; ?></option>
               <option value="pending">pending</option>
               <option value="completed">completed</option>
            </select>
            <input type="submit" name="update_order" value="update" class="option-btn">
            <a href="<?php echo URLROOT;?>/orders/deleteOrders/<?php echo $rd->id_ord ; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
         </form>
      </div>
      <?php endforeach;?>

      <?php

					if( empty($rd->email)){
						echo '<p class="empty"> orders table is empty</p>';
					}

        	?>
		
	</div>
	
</section>


<?php require_once APPROOT.'/views/inca/footer.php' ?>