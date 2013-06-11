<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of chart
 *
 * @author GOI LLC
 */
class model_chart extends CI_Model{
    //put your code here
    public function bigCharts($App_ID){
        
        $sql = "SELECT COUNT( DISTINCT (
                `id`
                ) ) AS 'USERS'
                FROM `phone_users`
                WHERE `App_ID` = '$App_ID'";
        $query  = $this->db->query($sql);
        $result = $query->result();
        if($result[0]->USERS >= 0):
            return true;
        else:
            return false;
        endif;
    }
}

?>
