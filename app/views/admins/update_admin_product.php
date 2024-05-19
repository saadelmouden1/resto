<?php require_once APPROOT.'/views/inca/header.php' ?>


<section class="add-products">

   <form action="<?php echo URLROOT;?>/products/updateProduct" method="POST" enctype="multipart/form-data">
      <h3>update product</h3>
      <input type="hidden" name="id_pr" value="<?php echo $data['prod']->id_pr ; ?>">
      <input type="text" class="box" required placeholder="enter product name" name="name" value="<?php echo $data['prod']->nom_pr ; ?>">
      <input type="number" min="0" class="box" required placeholder="enter product price" name="price" value="<?php echo $data['prod']->price_pr ; ?>">
      <textarea name="details" class="box" required placeholder="enter product details" cols="30" rows="10"><?php echo $data['prod']->details ; ?></textarea>
      <input type="file" accept="image/jpg, image/jpeg, image/png"  class="box" name="image" value="<?php echo $data['prod']->nom_pr ; ?>">
      
      <input type="submit" value="update" name="update pro" class="btn">
   </form>

</section>


<?php require_once APPROOT.'/views/inca/footer.php' ?>