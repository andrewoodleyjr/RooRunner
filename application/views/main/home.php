<?php $bodyClass = 'internal'; ?>

<div class="container">
    <div class="row">
        <div class="span12">
            <div class="content-wrapper">
                <h2>Hi <?php if(isset($name)) echo $name; ?></h2>
                <h3>
                    <!-- NOT SURE WHY THIS CONDITIONAL IS NOT WORKING PROPERLY? I HAVE NO TASKS AND I'M SEEING THE FIRST ECHO. -->
                    <?php 
                        if(isset($tasks)) { 
                            echo 'These are your RooRunner requests that are still unfilled.'; 
                        } else { 
                            echo 'You currently have no RooRunner requests. <a href="/manage/create/">Create One</a>';
                        }
                    ?>
                </h3>
                <p>Click on a request to view, update, or cancel.</p>
                <?php if(isset($tasks)) echo $tasks; ?>
            </div>
        </div><!-- /.span12 -->
    </div><!-- /.row -->
</div><!-- /.container -->

