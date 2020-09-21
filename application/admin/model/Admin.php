<?php
namespace app\admin\model;
use think\Model;
/**
 * 
 */
class Admin extends Model
{
	public function add($data)
	{
		if(empty($data) || !is_array($data))
		{
			return false;
		}
		if($this->save($data))
		{
			db('auth_group_access')->insert(['uid'=>$this->id,'group_id'=>$data['position']]);
			return true;
		}
		else
		{
			return false;
		}
	}
	public function edit($data)
	{
		db('auth_group_access')->where('uid',$data['id'])->update(['group_id'=>$data['position']]);
		if(empty($data) || !is_array($data))
		{
			return false;
		}
		if($this->update($data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>