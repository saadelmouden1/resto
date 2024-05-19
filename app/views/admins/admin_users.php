<?php require_once APPROOT.'/views/inca/header.php' ?>

<section class="users">
	<h1 class="title">users account</h1>
	<div class="box-container">

    <?php foreach($data['users'] as $us):?>
	

		  <div class="box">
         <p>user id : <span><?php echo $us->id_user; ?></span></p>
         <p>username : <span><?php echo $us->nom;?></span></p>
         <p>email : <span><?php echo $us->email; ?></span></p>
         <a href="<?php echo URLROOT;?>/admins/deleteUsers/<?php echo $us->id_user;?>" onclick="return confirm('delete this user?');" class="delete-btn">delete</a>
      </div>

      <?php endforeach;?>
		
	</div>

    </section>


<?php require_once APPROOT.'/views/inca/footer.php' ?>