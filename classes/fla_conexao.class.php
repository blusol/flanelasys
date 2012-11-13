<?php
class fla_conexao extends PDO {
	private $dsn = 'mysql:dbname=flanelasys;host=127.0.0.1';
	private $user = 'root';
	private $password = '@d3n0r8r@nd1';
        private $handle;

	function __construct () {
		try {
                    if ($this->handle == null) {
                            $dbh = parent::__construct($this->dsn , $this->user , $this->password);                    
                            $this->handle = $dbh;
                             $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            return $this->handle;
                    }
		}
		catch ( PDOException $e ) {
			echo 'Connection failed: ' . $e->getMessage( ); return false;
                        return false;
		}
	}

	function __destruct( ) {
		$this->handle = NULL;
	}

}
?>
