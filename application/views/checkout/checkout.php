    <div class="container">
			<br />
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit" id="general_div_maincontent" >
          <h1 >Checkout</h1>
        <p>Here you can purchase the item previously selected. Provided below are the details regarding this transaction.</p>
	
	<?php 
             if(isset($error)){
        ?>
	        <div id="c_ckeck" >
	            
	                <p>
	                <?php
	                echo $error;
	                ?>
	               </p>
	
	        </div>
	<?php
		};	
	?>
	        
        <div class="row-fluid tab-pane active fade in" id="invoice" >
           
           <div class="span5">
				<div class="requested-invoice">
               	<h2> 
                    <?php  if(isset($name)){ echo $name; } ?>
                </h2>
                </div>
        	<p>Description:</p>  
                <p><?php  if(isset($description)) {echo $description; } ?></p>
           
           		
              <?php if(isset($total_price)){ ?>   
                <h3>Total</h3> <p>$<?php if(isset($total_price)){echo  number_format($total_price, 2); } ?></p>
       <?php } ?>
               <div class="alert alert-danger" style="display: none; margin-top: 20px;" id="error_card">
             </div>
           </div>
           
           
           <div class="span5">
                    <label>First Name: 
                <input id="FIRST_NAME" type="text" name="FIRST_NAME" value="<?php if(isset($FIRST_NAME)) echo $FIRST_NAME; ?>"   class="checkout_fields_100"/></label>
                <label>Last Name:
                <input id="LAST_NAME" type="text" name="LAST_NAME" value="<?php if(isset($LAST_NAME)) echo $LAST_NAME; ?>"  class="checkout_fields_100"/> </label>
              
                <label>Card Type:  
            <select id="CARD_TYPE" name="CARD_TYPE"  class="checkout_fields_100">
                <option value="Visa">Visa</option>
                <option value="MasterCard">MasterCard</option>
            </select></label>
            <label>Card Number:  
            <input id="CARD_NUMBER" type="text" name="CARD_NUMBER"   class="checkout_fields_100"/></label>
                <label>Expiration Date:</label>
                <label> Month: 
               
            <select id="MONTH"  name="MONTH"   class="checkout_fields_100">
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
            </select> </label>
                <label>Year: &nbsp;&nbsp;
            <select id="YEAR" name="YEAR"   class="checkout_fields_100">
                <?php if(isset($year)){echo $year;} ?>
            </select></label>
            
             <label>CVV2: &nbsp;
                <input id="CVV2" type="text" name="CVV2"   class="checkout_fields_100"/></label>
                           
                <br />
               
             <button id="<?php 
             if(!isset($special)) {
                  echo "submit_card"; 
             }
             else{
                  echo $special;
             }
                 ?>" class="btn btn-success btn-large checkout_fields_100"  >Submit</button>
            
           </div> 
        </div>
     </div>
   </div>