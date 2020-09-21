<?php
namespace app\admin\controller;
use think\Controller;
/**
 * 
 */
class Common extends Controller
{
	protected function _initialize()
	{
		if(empty(session('username')))
		{
			$this->error('请先登录！',url('admin/login/index'));
		}
	}
}
?>