<div class="container">
    <br />
    <!-- Main hero unit for a primary marketing message or call to action -->
    <div class="hero-unit" id="contain">
        <h1 >Cancellation App: <?php 
        if(isset($App_Name)) 
            { 
            echo $App_Name; 
            
            } 
            ?>
        </h1>
        <div class="errors" >
                <?php if(isset($error)){ echo $error; } ?>
            </div>
        <p>Please put the first and last name of the card that you use, to confirm.
        
        </p>  

        <div class="precancel_form_contianer">
            <form action="/checkout/cancel_app/<?php 
            if(isset($App_ID))
                {
                echo $App_ID;
                } 
            ?>" method="POST" >
                <label>First Name: </label> <input type="text" name="FIRST_NAME" />
                <label>Last Name: </label> <input type="text" name="LAST_NAME" />
                <br /><br />
                <button type="submit" class="btn btn-success" >Submit</button>
            </form>

        </div>
    </div>
</div>