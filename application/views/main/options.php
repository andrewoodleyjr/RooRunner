<?php $bodyClass = 'internal'; ?>

<div class="container">
    <div class="row">
        <div class="span12">
            <div class="content-wrapper">
                <h2>Hi <?php if(isset($name)) echo $name; ?></h2>
                <h3>What would you like to do?</h3>
                <?php if($usertype == 1) echo '<div class="control-group">
                    <a href="/manage/jobs/" class="btn btn-large btn-primary btn-block">Avialable Runs</a>
                </div>'; ?>
                
                <div class="control-group">
                    <a href="/manage/create/" class="btn btn-large btn-primary btn-block">Request a RooRunner</a>
                </div>
                <div class="control-group">
                    <a href="/manage/current/" class="btn btn-large btn-primary btn-block">Manage your RooRunner Requests</a>
                </div>
                <div class="control-group">
                    <a href="/manage/message_runners/" class="btn btn-large btn-primary btn-block">Message your RooRunners</a>
                </div>
            </div>
        </div><!-- /.span12 -->
    </div><!-- /.row -->
</div><!-- /.container -->
