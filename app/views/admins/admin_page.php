<?php require_once APPROOT.'/views/inca/header.php' ?>



<section class="dashboard">

   <h1 class="title">dashboard</h1>

   <div class="box-container">

      <div class="box">
        
         <h3>$<?php echo $data['pending']; ?>/-</h3>
         <p>total pendings</p>
      </div>

      <div class="box">
        
         <h3>$<?php echo $data['completed']; ?>/-</h3>
         <p>completed paymets</p>
      </div>
      <div class="box">
    
         <h3><?php echo $data['numOrders']; ?></h3>
         <p>orders placed</p>
      </div>

      <div class="box">
        
         <h3><?php echo $data['numPro'];?></h3>
         <p>products added</p>
      </div>

      <div class="box">
        
         <h3><?php echo $data['numUsers'];?></h3>
         <p>total accounts</p>
      </div>

      <div class="box">
         
         <h3><?php echo $data['numMsgs']; ?></h3>
         <p>total messages</p>
      </div>


   </div>

</section>

<section class="hd">
        <h3>orders chart</h3>
         <p> <a  href="<?php echo URLROOT;?>/admins/admin_page" >home</a> / charts </p>
 </section>

<section class="charts_section" width="20%" >

<canvas id="myChart" width="50%" ></canvas>
</section>


<script>
const ctx = document.getElementById('myChart').getContext('2d');

const d = new Date();









function showSuggestion(){

            
		
                
var arr=[];

var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
        
        

        var vr= this.responseText;
        console.log(vr);

        let month = d.getMonth();
        console.log(month);
        var arr=[];

      var months=['January ', 'February ', 'March ', 'April', 'May', 'June',
                'July ','August',
'September ', 'October ','November','December '];
for(var i=0;i<=month;i++){
        arr[i]=months[i];
       }


        
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        // labels:months,

        
        
       
        labels: arr,
        datasets: [{
            label: 'Orders',
            data: vr.split(','),
            backgroundColor:'#ff8000',
             borderColor:"#666",
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

      
       
    }
}
xmlhttp.open("GET", "http://localhost:8081/resto/orders/chart", true);
xmlhttp.send();
}

showSuggestion()



</script>


<?php require_once APPROOT.'/views/inca/footer.php' ?>