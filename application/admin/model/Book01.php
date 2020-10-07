<?php
namespace app\admin\model;
use think\Model;
/**
 * 
 */
class Book01 extends Model
{
	
	public function addmodel($data='')
	{
		if(empty($data) || !is_array($data)){
			return false;
		}
		if($this->save($data)){
			return true;
		}
		else{
			return false;
		}
	}
}
?>