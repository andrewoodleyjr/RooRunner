    <div class="container">
			<br />
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit" id="general_div_maincontent" style="margin-left: 5%; width: 80%; margin-right: 5%; margin-top: 40px;" >
          <h1 >Checkout</h1>
        <p>Here you can purchase the item previously selected. Provided below are the details regarding this transaction.</p>
	
	<?php 
             if(isset($error)){
        ?>
	        <div  id="c_ckeck" >
	            
	                <p style="color: red;">
	                <?php
	                echo $error;
	                ?>
	               </p>
	
	        </div>
	<?php
		};	//Fat300#@
	?>
	        
        <div class="row-fluid tab-pane active fade in" id="invoice" >
           
           <div class="span6">
				<div class="requested-invoice">
               	<h2> 
                    <?php  if(isset($name)){ echo $name; } ?>
                </h2>
                </div>
        	<h3>Description:</h3>  
                <p><?php  if(isset($description)) {echo $description; } ?></p>
           
           		
              <?php if(isset($total_price)){ ?>   
                <h3>Total</h3> <p>$<?php if(isset($total_price)){echo  number_format($total_price, 2); } ?></p>
       <?php } ?>
              
           </div>
           
           
           <div class="span5">
           	<form class="span12" action="/app/payment_process"   method="POST">	
                                    <label>First Name: </label>
                <input type="text" name="FIRST_NAME" value="<?php if(isset($FIRST_NAME)) echo $FIRST_NAME; ?>"   class="checkout_fields_100"/>
                <label>Last Name: </label>
                <input type="text" name="LAST_NAME" value="<?php if(isset($LAST_NAME)) echo $LAST_NAME; ?>"  class="checkout_fields_100"/>
                <br />

                <label>Card Type:  </label>
            <select  name="CARD_TYPE"  class="checkout_fields_100">
                <option value="Visa">Visa</option>
                <option value="MasterCard">MasterCard</option>
            </select>
            <label>Card Number:  </label>
            <input type="text" name="CARD_NUMBER"   class="checkout_fields_100"/>
                <label>Expiration Date: Month: 
                </label>
            <select  name="MONTH"   class="checkout_fields_100">
                <option value="1" >January</option>
                <option value="2" >February</option>
                <option value="3" >March</option>
                <option value="4" >April</option>
                <option value="5" >May</option>
                <option value="6" >June</option>
                <option value="7" >July</option>
                <option value="8" >August</option>
                <option value="9" >September</option>
                <option value="10" >October</option>
                <option value="11" >November</option>
                <option value="12" >December</option>
            </select>
                <label>Year: </label>
            <select name="YEAR"   class="checkout_fields_100">
                <?php if(isset($year)){echo $year;} ?>
            </select>
            
             <label>CVV2</label>
                <input type="text" name="CVV2"   class="checkout_fields_100"/>
                           <br />
                <input type="submit" name="submit_card" class="btn btn-success btn-large checkout_fields_100"  title="Name" >
        </form>
                
           </div> 
        </div>
     </div>
   </div>