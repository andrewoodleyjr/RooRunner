<?php $bodyClass = 'internal'; ?>

<div class="container">
    <div class="row">
        <div class="span12">
            <div class="content-wrapper">
                <h2>Request a RooRunner</h2>
                <h3>Tell us what you need!</h3>
                <?php if(isset($error['error'])){echo $error['error'];}?>
                <form action="/manage/createtask/" method="post">
                    <div class="control-group">
                        <label class="control-label" for="title">Give your request a title</label>
                        <div class="controls">
                            <input type="text" id="title" name="title" class="input-block-level" value="<?php if(isset($error['title2'])){echo $error['title2'];} ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="location">Where would you like to meet?</label>
                        <div class="controls">
                            <input type="text" id="location" name="location" class="input-block-level" value="<?php if(isset($error['location'])){echo $error['location'];} ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="reward">What will you reward your RooRunner?</label>
                        <div class="controls">
                            <input type="text" id="reward" name="reward" class="input-block-level" value="<?php if(isset($error['reward'])){echo $error['reward'];} ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="description">Describe what you need</label>
                        <div class="controls">
                            <textarea id="description" name="description" class="input-block-level"><?php if(isset($error['description'])){echo $error['description'];} ?></textarea>
                        </div>
                    </div>
                    <div class="button-row">
                        <button type="submit" id="submit_form" name="submit" class="btn btn-large btn-primary">Submit</button>
                    </div>
                </form>     
            </div>
        </div><!-- /.span12 -->
    </div><!-- /.row -->
</div><!-- /.container -->

