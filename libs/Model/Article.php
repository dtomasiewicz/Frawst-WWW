<?php
	namespace Corelativ\Model;
	
	class Article extends \Corelativ\Model {
		
		public static function properties() {
			return array(
				'id'      => array('type' => self::FIELD_INT),
				'parent'  => array('type' => self::FIELD_INT),
				'slug'    => array('type' => self::FIELD_VARCHAR),
				'title'   => array('type' => self::FIELD_VARCHAR),
				'body'    => array('type' => self::FIELD_TEXT)
			);
		}
		
		public static function validation() {
			return array(
				'name' => array('required' => array('message' => 'Article must have a name.')),
				'body' => array('required' => array('message' => 'Article must have a body.')),
				'slug' => array('required' => array('message' => 'Article must have a slug.'))
			);
		}
		
		public static function findBySlug($slug) {
			return self::factory('Article')->find('slug = ?')->fetch($slug);
		}
		
	}