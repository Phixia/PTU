<?php
class pta_move extends pta_db_class {
	public function __construct($id = NULL, $data = NULL) {
		if($data != NULL) {
			foreach($data as $key => $value) {
				$this->$key = $value;
			}
		} else {
			parent::__construct($id);
		}
	}
}