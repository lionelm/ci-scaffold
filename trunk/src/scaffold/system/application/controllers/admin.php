<?php

class Admin extends Controller {

    function Admin(){
        parent::Controller();
    }

    function index(){
        $this->load->library('scaffold');
        $this->scaffold->generate();
    }

}
