    <div class="container">
			<br />
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit" id="general_div_maincontent" >
        <h2>Banking &amp; Agreements</h2>
        <p>Here you can view your balance, add messaging credits, view current agreements, and view transaction history.</p>
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#invoice" data-toggle="tab">Invoice</a>
          </li>
          <li><a href="#history" data-toggle="tab">History</a></li>
         
        </ul>
        
        <div id="myTabContent" class="tab-content">
        
        <div class="row-fluid tab-pane active fade in" id="invoice">
            <form action="/banking/pdf/" method="POST" >
           <div class="span7">
				<div  class="banking_invoice_requestedinvoice">
               		Current Invoice : <span id="banking_invoice_invoicedate"> <?php echo date('F, Y'); ?></span>
               </div>
               <div class="row-fliud">
               
                    <div class="span3">
                        <select id="banking_invoice_month" name="month" >
                    		<option value="">Month</option>
                            <option value="01">January</option>
                            <option value="02">Feburary</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                		</select>
                    </div>
                    
                    <div class="span3">
                        <select id="banking_invoice_year" name="year" >
                        	<option value="">Year</option>
                    		<option value="2011">2011</option>
                            <option value="2012">2012</option>
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                            <option value="2013">2015</option>

                		</select>
                    </div>
                    
                    <div class="span2">
                        <button class="btn btn-success" id="banking_invoice_ajaxInvoiceTable" type="button">View</button>
                    </div>
               </div>
           
               <div >
               		
                    <table id="banking_invoice_table" class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Transaction ID</th>
                  <th>Details</th>
                  <th>Date</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>

                  <?php if(isset($invoice_table_tr)){ echo $invoice_table_tr; } ?>

              </tbody>
            </table>
                   <div  class="span2 pull-left">
            	<button class="btn btn-info" id="invoice_banking_printpdf" type="submit" >Print</button>
            </div>   
               </div>
           </div>
           
            </form>
           <div class="span4">
               <h3 >Balance</h3>
                <p>Here you can view current and past invoices and view your push notification credits as well as the amount owed on your account. </p>
                
				<!-- DIV HERE -->
                <div id="banking_invoice_push-balance" class="banking_invoice_bubble ">
                	Number Of Credits
                        <br />
                    <div class="banking_invoice_bubbleinsidetext">
                    <?php if(isset($credits))
                        
                        echo $credits; 
                        
                        else 
                            echo "0"; ?>
                        <br />
                    </div>
                    <a href="#banking_invoice_addcredits" role="button" class="btn btn-primary" data-toggle="modal" >Add Credits</a>
                    
                </div>
                <br />
                
              
               
              
           </div>
           
            <div class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Modal header</h3>
  </div>
  <div class="modal-body">
    <p>One fine body…</p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn">Close</a>
    <a href="#" class="btn btn-primary">Save changes</a>
  </div>
</div>

            
           <div id="banking_invoice_addcredits" style="margin-top: -9%;" class="modal hide fade" >
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Add Push Notifications Credits</h3>
              </div>
               
                           <form action="/checkout/"  method="POST"> 
                                    <div class="modal-body">
                                    <p>Add credits to send your fans and app users messages through email and app alerts. </p>

                                        <table id="push_table" class="table">
                                    <thead>
                                        <tr>
                                        <th>Alert Credits</th>
                                        <th>1000</th>
                                        <th>10,000</th>
                                        <th>100,000</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--<tr>
                                        <td>Per Credit</td>
                                        <td>.01&cent;</td>
                                        <td>.01&cent;</td>
                                        <td>.01&cent;</td>
                                        </tr>
                                        <tr>
                                        <td>Discount</td>
                                        <td>0%</td>
                                        <td>50%</td>
                                        <td>25%</td>
                                        </tr>
                                        <tr>-->
                                        <td>Total</td>
                                        <td>$10.00</td>
                                        <td>$75.00</td>
                                        <td>$500.00</td>
                                        </tr>
                                        <tr>
                                        <td>Select Option</td>
                                        <td><input type="radio" name="sales_item_id" value="1" ></td><!-- This is manually done -->
                                        <td><input type="radio" name="sales_item_id" value="2" ></td>
                                        <td><input type="radio" name="sales_item_id" value="3" ></td>
                                        </tr>
                                    </tbody>
                                    </table>
                                    </div>
               <div class="modal-footer">
                     <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                     <button type="submit" class="btn btn-primary" name="pre_sales" id="banking_invoice_modalbuyingpushcredits" >Buy</button>
               </div>
                           </form>

            </div>
        </div>
            

         
        
        <div class="row-fluid tab-pane fade" id="history">
           
           <div class="span9">
          
             <table  id="banking_history_table" class="table dTables">
              <thead>
                <tr>
                  <th id="banking_history_numberth"> &nbsp;&nbsp;#</th >
                  
                  <th>Transaction</th>
                  <th>Details</th>
                  <th>Date</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
                
<?php if(isset($htable)) echo $htable; ?>
              </tbody>
            </table>
            
           
            
           </div>

           <div class="span3">
				<h3>History</h3>
                <p>Here you can view transaction history of money added and owed on your account. </p>
                
                
                
                <div>
                    	<p>Start Date</p>
                    	<div class="input-prepend date" id="banking_history_startdate" data-date="<?php echo date('m/d/Y', strtotime('-1 month')); ?>" data-date-format="dd-mm-yyyy" >
                    	<span class="add-on">
                                <i class="icon-calendar">			  
                                </i>
                             </span>
                             <input id="banking_history_startdatejs" class="  banking_history_dateinput"  type="text" value="<?php echo date('m/d/Y', strtotime('-1 month')); ?>" readonly>
                             
                        </div>
                    </div>
                    
                    <div >
                    	<p>End Date</p>
                         <div class="input-prepend date" id="banking_history_enddate" data-date="<?php echo date('m/d/Y'); ?>" data-date-format="dd-mm-yyyy">
                            <span class="add-on"><i class="icon-calendar"></i></span>
                            <input id="banking_history_enddatejs" class="banking_history_dateinput "   type="text" value="<?php echo date('m/d/Y'); ?>" readonly>
                            
                         </div>
                    </div>
                    
                    <div >
                    
                    	<button class="btn btn-success" id="banking_history_ajaxhistorychange"  >View</button>
                        
                    </div>
                
               
           </div>
           
        </div>
        
       
        </div>
        
      </div>
</div>
