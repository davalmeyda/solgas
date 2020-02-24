<?php
    class ConexionBD {
		private $con;

		public function __construct() {
			if (!isset($this->con)) {
                $this->con = new \mysqli('localhost','root','','bdbalon');
                //$this->con = new \mysqli('localhost','azlxhgqn_balon','GxqpD.Pfkz+P','azlxhgqn_bdbalon');
				if (mysqli_connect_errno()) {
					trigger_error("Problemas en la conexion: " . mysqli_connect_errno(), E_USER_ERROR);
				}
			}
		}

        public function exe_data($query) { // Coge Id o lista datos!!
            $ret = array('STATUS' => '', 'ERROR' => '', 'ID' => '', 'DATA' => array());
            $this->con->set_charset("utf8");
            $this->con->autocommit(FALSE);
            $this->con->begin_transaction(MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
            $resp=FALSE;
            $resp = $this->con->query($query);
            $llaveprimaria = mysqli_insert_id($this->con);
            if($resp) {
                if($this->con->commit()) {
                    $ret['STATUS'] = 'OK';
                    if ($llaveprimaria == 0) {
                    	if(is_bool($resp) == false) {
	                        while ( $row = mysqli_fetch_array($resp)) {
	                            $ret['DATA'][] = $row;
	                        }
	                    }
                    } else {
                        $ret['ID'] = '' . $llaveprimaria;
                    }
                } else {
                    $ret['STATUS'] = 'ERROR';
                    $ret['ERROR'] = $this->con->error;
                }
            } else {
                $ret['STATUS'] = 'ERROR';
                $ret['ERROR'] = $this->con->error;
                $this->con->rollback();
            }
            unset($this->querys);        
            return $ret;
        }
	}
?>