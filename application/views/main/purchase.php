<?php $bodyClass = 'internal'; 
$this->load->helper('stripe');
#var_dump($this->$stripe);
?>

<div class="container">
    <div class="row">
        <div class="span12">
            <div class="content-wrapper">
                <h2>Buy Tasks</h2>
                <h3>Unused tasks are refunded at the end of the festival!</h3>
                <form action="/manage/buytasks" method="post">
  <script src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
          data-key="<?php echo $this->config->item('public_key','stripe'); ?>"
          data-amount="5000" data-description="One year's subscription"></script>
</form>
            </div>
        </div><!-- /.span12 -->
    </div><!-- /.row -->
</div><!-- /.container -->

