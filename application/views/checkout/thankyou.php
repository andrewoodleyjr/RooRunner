 <div class="container">
<br />
      <!-- Main hero unit for a primary marketing message or call to action -->

            <div class="hero-unit" id="general_div_maincontent" style="margin-left: 5%; width: 80%; margin-right: 5%; margin-top: 40px;" >

      <h1 style="color:#060">Thank You!</h1>
        <p>Your purchase was successful. Thank you for your purchase, below are the details regarding this transaction.</p>  

	<div style="width:100%" align="center">
       
        <div  style="border: solid black 2px; min-height: 130px;">
           <h2> <?php if(isset($name)){ echo $name; } ?></h2>
           <h3>Price:  $<?php if(isset($price)){echo number_format($price, 2); } ?></h3>         
           <h3>Transaction ID:  <?php if(isset($transaction_id)) { echo $transaction_id; } ?></h3>
           <p> <?php if(isset($description)) {echo $description; } ?></p>
           <a href="/manage/" class="btn btn-success btn-large" style="margin-bottom:20px;" >Return Home</a>
        </div>



		</div>
	</div>
</div>