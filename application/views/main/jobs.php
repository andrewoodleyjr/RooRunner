 <div class="container">
	<div class="row">
		<div class="span12">
			<div class="form-wrapper form-wrapper-login" >
				<h1>All Jobs</h1>
				<h3 class="byline"><?php if(isset($tasks)) echo 'Below are all the bargins and tasks on the market'; ?></h3>
				<?php if(isset($tasks)) echo $tasks; ?>
             </div>
        </div>
    </div>
</div>