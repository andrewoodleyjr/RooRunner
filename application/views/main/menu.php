<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="/"><img src="/img/layout/logo.png" alt="RooRunner"></a>
            <div class="nav-collapse collapse">
                <ul class="nav pull-right ">
                    <?php if(isset($usertype) && ($usertype == 1)) echo '<li><a href="/manage/jobs/">Available Runs</a></li>'; ?>
                    <li><a href="/manage/create/">Request a RooRunner</a></li>
                    <li><a href="/manage/current/">Manage your RooRunner Requests</a></li>
                    <li><a href="/manage/message_runners/">Message your RooRunners</a></li>
                    <li><a href="/manage/profile/">Your Profile</a></li>
                    
                    
                    <li><a href="/logout/">Logout</a></li>
                </ul>
            </div><!--/.nav-collapse-->
        </div><!-- /.container -->
    </div><!-- /.navbar-inner -->
</div><!-- /.navbar -->