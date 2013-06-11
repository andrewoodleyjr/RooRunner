<div class="container">
    <br />
    <!-- Main hero unit for a primary marketing message or call to action -->
    <div class="hero-unit" id="contain" >
        <h1 >Cancellation Receipt </h1>
        <p></p>  

        <div class="cancel_form_contianer">
        <div  id="container_form_cancel">
            <h3>Transaction ID: <?Php if(isset($transaction)){ echo $transaction; } ?></h3>
           <p> 
               <?php 
               if(isset($Monthly_Fee) && $Monthly_Fee != false) 
               {
               echo "Your new Monthly Fee : $" . $Monthly_Fee; 
               } 
                    else
               {
               echo "Your payments have been canceled";
               }
               ?>
           </p>
           <a href="/manage/" class="btn btn-success btn-large" >Return Home</a>
        </div>


        </div>
    </div>
</div>
