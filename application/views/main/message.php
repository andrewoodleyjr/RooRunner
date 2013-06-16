<div id="container">
    <!-- Content -->
        <div id="row">
            <div id="span12" align="center">
                <div class="form-wrapper form-wrapper-login">
                    <h2>Send Message</h2>
    <h3>Type below and click submit to send a message via email and text.</h3>
										<form action="/manage/sendmessage/<?php if(isset($id)) echo $id; ?>" method="post">
										<textarea maxlength="50" style="width:75%; height:75px"></textarea>
                                        <input type="submit" class="btn btn-large btn-primary" value="Send Message" style="width:75%" />
										</form>
                   </div>
            </div>		
		</div>
</div>