<?php

	function autoload($classe) {
		require 'classes/'.$classe.'.class.php';
	}
	spl_autoload_register('autoload');