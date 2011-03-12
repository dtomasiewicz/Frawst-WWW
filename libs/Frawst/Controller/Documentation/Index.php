<?php
	namespace Frawst\Controller\Documentation;
	
	class Index extends \Frawst\Controller\Documentation {
		public function get($articleSlug = '') {
			if($articleSlug && $article = $this->Article->findBySlug($articleSlug)) {
				return array('article' => $article);
			} else {
				return $this->Response->redirect('documentation/introduction');
			}
		}
	} 