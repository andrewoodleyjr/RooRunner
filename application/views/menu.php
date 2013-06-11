<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="http://www.shwcase.co/">Shwcase</a>
         <div class="nav-collapse collapse">
         
		 <?php if(isset($menu)){ ?>
         	<ul   class="nav pull-right ">
          <?php echo $menu;  ?>
		  	</ul>
		  <?php } else { ?>
          	<ul  class="nav pull-right">
              <li ><a href="/main/Register/">Register</a></li>
            </ul>
              <?php } ?>
             
          </div><!--/.nav-collapse-->
        </div>
      </div>
    </div>
