<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scaffold extends Controller {

    function Scaffolder(){
        $this->_ci_scaffolding = TRUE;
        parent::Controller();
    }


    /**
	 * Run Scaffolding
	 *
	 * @access	private
	 * @return	void
	 */	
	function _ci_scaffolding()
	{
		if ($this->_ci_scaffolding === FALSE OR $this->_ci_scaff_table === FALSE)
		{
			show_404('Scaffolding unavailable');
		}
		
		require_once(APPPATH . 'scaffolder/scaffolder'.EXT);
        $this->_show_header();
        if(array_key_exists('table', $_POST) && trim($_POST['table']) != ""){
            $table = $_POST['table'];
            $fields = $this->_getFields($table);
		    $scaffolder = new Scaffolder();
    		$scaffolder->generate($table, $fields);
        } else {
            $this->_showTables();
        }
	}

    function _getDriver(){
        //TODO: Load driver based on user database
        require_once(APPPATH . 'scaffolder/drivers/mysql'.EXT);
        return new MysqlDriver();
    }

    function _getFields($table){
        $driver = $this->_getDriver();
        return $driver->getFields($table);
    }

    function _getTables(){
        $driver = $this->_getDriver();
        return $driver->getTables();
    }

    function _showTables(){
        $tables = $this->_getTables();
        $this->_show_form($tables);
    }
    
    function _tablesAsOptions($tables){
        $options = array('' => 'Select');
        foreach($tables as $table){
            $options[$table] = $table;
        }
        return $options;
    }

    function _show_form($tables){
        $this->load->helper('form');
        echo form_open($this->uri->uri_string(), array("method" => "post"));
        echo form_label('Table: ', 'table');
        echo form_dropdown('table', $this->_tablesAsOptions($tables), array(), 'id="table"');
        echo form_submit('', 'Submit');
        echo form_close();
    }

    function _show_header(){
        $this->load->helper('html');
        echo heading('Scaffolder');
    }
}
