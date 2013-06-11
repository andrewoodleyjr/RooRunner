 <div class="container">
			<br />
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit" id="general_div_maincontent">
        <h2 >FAQs &amp; Tutorials</h2>
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#faqs" data-toggle="tab">FAQs</a>
          </li>
          <li><a href="#tutorials" data-toggle="tab">Tutorials</a></li>
        </ul>
        
        <div id="myTabContent" class="tab-content">
        
        <div class="row-fluid tab-pane active fade in" id="faqs" >
           
           <div class="span8">
				
                <div class="accordion" id="accordion2">
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                      Creating an App
                    </a>
                  </div>
                  <div id="collapseOne" class="accordion-body collapse" >
                    <div class="accordion-inner">
<h4>What is the review process for?</h4>
                     <p>Apple and Google hate incomplete apps therefore if your app is not complete it will be denied and removed from the markets. 
</p>

<h4>Why am I charged to edit my app information?</h4>
                     <p>Just to be clear, you are only charged to edit outside information which is the information that appears on the app store. You are not charged for editing your content which is the information inside of your app.

<br />
<br />
This is a service charge because we have to manually review and submit the information. 
</p>
      
<h4>Can I have more features and designs?</h4>
                     <p>Yes we are working hard to allow more custom app designs as well as features. If you insist contact us via email developer@shwcase.co.
</p>
      
              </div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                     Trends & Sales
                    </a>
                  </div>
                  <div id="collapseTwo" class="accordion-body collapse" >
                    <div class="accordion-inner">
                      <h4>Is this information in real time?</h4>
                     <p>Yes all information provided in your chart is collected and shown in real time.
</p>

<h4>Nothing shows up in my chart?</h4>
                     <p>Sorry, but that usually means you have no data. If you believe their is an error contact us via email developer@shwcase.co.
</p>

<h4>Can I make money from my app?</h4>
                     <p>Of course you will be able to, however we are currently setting up a reliable system to track sales for you.
</p>
                    </div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                    Billing
                    </a>
                  </div>
                  <div id="collapseThree" class="accordion-body collapse" >
                    <div class="accordion-inner">
                      <h4>Can I refund my credits?</h4>
                     <p>Sorry but we do not offer refunds for credits.
</p>

 <h4>How long does my credits last?</h4>
                     <p>Credits last indefinitely, they will always exist on your account until you use them.
</p>

 <h4>How long does my credits last?</h4>
                     <p>Credits last indefinitely, they will always exist on your account until you use them.
</p>
                    </div>
                  </div>
                </div>
              </div>
           
           
           </div>
           
           
           <div class="span4">
           <h3 >FAQs</h3>
              <p>Here you can view frequently asked questions about using Shwcase Connect.</p>
               <h4>Reminder:</h4>
                          <p>We also have video tutorials that show you how to properly use and get ahead using Shwcase. 
                          <br />
                          <br />
                         We can be reached via email developer@shwcase.co
          </p>
           
           </div>
        </div>
        
        <div class="row-fluid tab-pane fade" id="tutorials">
           
           <div class="span8">
			
               
            	
                <h3><?php if(isset($title)) echo $title; ?></h3>
                <div class="row" id="faq_carousel_playlist">
        <div class="carousel slide span13" id="myCarousel" data-interval="false">
            <div class="carousel-inner">
             
            <?php if(isset($playlist)) echo $playlist; ?>
              
            </div>
            <a data-slide="prev" href="#myCarousel" class="left carousel-control">‹</a>
            <a data-slide="next" href="#myCarousel" class="right carousel-control">›</a>
        </div>
    </div>         
           </div>
           
           
        
           <div class="span4">
           <h3 >Tutorials</h3>
           <p>
              Here you can view videos on how to use Showcase and take advantage of the mobile world.
            </p>
           
           </div>
        </div>
        
        
        
        </div>
        
      </div>
</div>