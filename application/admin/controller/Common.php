<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\controller\Auth;
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
		$auth = Auth::instance();
		$module = request()->module();
		$action = request()->action();
		$controller = request()->controller();
		if($auth->getGroups(session('uid'))[0]['group_id'] != 1)
		{
			if($module.'/'.$controller.'/'.$action != 'admin/Index/index')
			{
				if(!$auth->check($module.'/'.$controller.'/'.$action,session('uid')))
				{
					$this->error('没有权限',url(''));
				}
			}
		}	
	}
}
?>