<?php
	namespace Frawst\Controller;
	
	abstract class Root extends \Frawst\Controller {
		public function __get($name) {
			if($f = \Corelativ\Mapper::factory($name)) {
				return $f;
			} else {
				return parent::__get($name);
			}
		}
	}