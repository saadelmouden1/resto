<?php require_once APPROOT.'/views/inca/header.php' ?>

<section class="messages">
   <h1 class="title">message</h1>
   <div class="box-container">
   <?php foreach($data['messages'] as $ms):?>
         <div class="box">
         <?php if($ms->user_id): ?>
         <p>user id : <span><?php echo $ms->user_id ;?></span> </p>
         <?php  endif ; ?>
         <p>name : <span><?php echo $ms->name; ?></span> </p>
         <p>number : <span><?php echo  $ms->number;  ?></span> </p>
         <p>email : <span><?php echo  $ms->email; ?></span> </p>
         <p>message : <span><?php echo  $ms->message;  ?></span> </p>
         <a href="<?php echo URLROOT;?>/messages/deteleMessage/<?php echo $ms->id_ms; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete</a>
      </div>

      <?php endforeach;?>
      
                <?php
                if( empty($ms->email )){
                echo '<p class="empty"> there is no message!</p>';
            }

            ?>


   </div>
   



   
   </section>

<?php require_once APPROOT.'/views/inca/footer.php' ?>