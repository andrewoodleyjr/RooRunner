<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cron
 *
 * @author GOI LLC
 */
class cron extends CI_Controller{
   
    public function runCron($pass){
        if($pass != 'OIZsap8A86AwYmZzPdO6Ai8OHwk7Wy24'):
            throw new Exception("You don't have access to the system.");
        endif;
        
        $this->load->model('model_cron');
        if($this->model_cron->sendemails()):
            $this->output->set_output("Good");
        else:
            $this->output->set_output("Bad");
        endif;
        
    }
    
    
}

?>
