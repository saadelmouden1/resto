<?php require_once APPROOT.'/views/inc/header.php' ?>



<section class="hd">
        <h3>search</h3>
         <p> <a  href="<?php echo URLROOT;?>/pages/index" >home</a> / Search </p>
        </section>


<!-- menu section starts  -->

<section class="menu" id="menu">

    <h3 class="sub-heading "> search menu </h3>
    <h1 class="heading wt"> diches </h1>

    <div class="box-container">

    <?php foreach($data['prod'] as $mn):?>
        <div class="box">
            <div class="image">
                <img src="<?php echo URLROOT;?>/public/uploaded_img/<?php echo $mn->image ;?>" alt="">
                <a href="#" class="fas fa-heart"></a>
            </div>
            <div class="content">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3><?php echo $mn->nom_pr; ?></h3>
                <p><?php echo $mn->details; ?></p>
                <a href="<?php echo URLROOT;?>/carts/cart/<?php echo $mn->id_pr ;?>" class="btn">add to cart</a>
                <span class="price">$<?php echo $mn->price_pr; ?></span>
            </div>
        </div>

        

        <?php endforeach; ?> 




    </div>

      

</section>



<?php require_once APPROOT.'/views/inc/footer.php' ?>