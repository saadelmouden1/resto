<?php require_once APPROOT.'/views/inca/header.php' ?>

<section class="add-products">

   <form action="<?php echo URLROOT;?>/products/addProduct" method="POST" enctype="multipart/form-data">
      <h3>add new product</h3>
      <input type="text" class="box" required placeholder="enter product name" name="name">
      <input type="number" min="0" class="box" required placeholder="enter product price" name="price">
      <textarea name="details" class="box" required placeholder="enter product details" cols="30" rows="10"></textarea>
      <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
      <input type="submit" value="add product" name="add_product" class="btn">
   </form>

</section>

<section class="show-products">


   <div class="box-container">

   <?php foreach($data['menu'] as $mn):?>
      <div class="box">
         <div class="price">$<?php echo $mn->price_pr ; ?>/-</div>
         <img class="image" src="<?php echo URLROOT;?>/public/uploaded_img/<?php echo $mn->image ;?>" alt="">
         <div class="name"><?php echo $mn->nom_pr; ?></div>
         <div class="details"><?php echo $mn->details; ?></div>
         <a href="<?php echo URLROOT;?>/products/getUpdatedProduct/<?php echo $mn->id_pr; ?>" class="option-btn">update</a>
         <a href="<?php echo URLROOT;?>/products/deletProduct/<?php echo $mn->id_pr; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
     
      <?php endforeach;?>
   </div>
   

</section>

<?php require_once APPROOT.'/views/inca/footer.php' ?>