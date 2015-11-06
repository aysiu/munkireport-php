<?php

/**
 * Messages class
 *
 * This is the central place to store messages about
 * a client.
 *
 * @package munkireport
 * @author AvB
 **/
class Messages_model extends Model
{
	function __construct($serial_number = '', $module = '')
    {
		parent::__construct('id', 'messages'); //primary key, tablename
        $this->rs['id'] = '';
        $this->rs['serial_number'] = ''; $this->rt['serial_number'] = 'VARCHAR(30)';
        $this->rs['type'] = ''; $this->rt['type'] = 'VARCHAR(10)';
        $this->rs['module'] = ''; $this->rt['module'] = 'VARCHAR(20)';
        $this->rs['msg'] = '';
        $this->rs['timestamp'] = time();
				
		// Create table if it does not exist
        $this->create_table();
        
        if($serial_number && $module)
        {
            $this->retrieve_one('serial_number=? AND module=?', array($serial_number, $module));
            $this->serial_number = $serial_number;
        }
        
        return $this;
    }

    /**
     * Reset messages
     *
     * @param string serial number
     * @param string optional module
     * @author 
     **/
    function reset($serial_number = '', $module = '')
    {
        $where_params = array($serial_number);
        $where_string = ' WHERE '. $this->enquote('serial_number').'=?';

        if($module)
        {
            $where_params[] = $module;
            $where_string .= ' AND '.$this->enquote('serial_number').'=?';
        }

        $sql = 'DELETE FROM '.$this->enquote( $this->tablename ).$where_string;
        $stmt = $this->prepare( $sql );

        return $stmt->execute($where_params);

    }

    /**
     * Add message
     *
     * @param string type
     * @param string type
     * @author AvB
     **/
    function danger($module, $msg)
    {

    }

} // END class 