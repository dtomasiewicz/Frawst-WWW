<?php
	namespace Frawst\Controller;
	
	class Feedback extends \Frawst\Controller\Root {
		public function get() {
			return array('feedback' => $this->Session->feedback());
		}
	}