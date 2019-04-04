<?php

function check_session()
{


    if(!$this->session->userdata['username'])
    {
        redirect('login');
   }

}
?>