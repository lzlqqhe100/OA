<?php
namespace app\admin\controller;
use app\admin\controller\Auth;
/**
 * 
 */
class Mymes extends Common
{
	public function index()
	{
		$user = db('admin')->find(session('uid'));
		$authgroup = db('auth_group')->where('status',1)->select();
		$auth = Auth::instance();
		$group = $auth->getGroups(session('uid'))[0];
		$this->assign([
			'user'=>$user,
			'authgroup'=>$authgroup,
			'group'=>$group,
		]);
		return view();
	}
	public function change()
	{
		$data = input('post.');
		$adminmodel = model('Admin');
		if($data['password'])
		{
			md5(md5($data['password']));
		}
		else
		{
			unset($data['password']);
		}
		$res = $adminmodel->update($data);
		if($res)
		{
			$this->success('更新成功！');
		}
		else
		{
			$this->error('更新失败！');
		}
	}
}
?>