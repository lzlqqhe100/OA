<?php
namespace app\admin\controller;
use think\Controller;
/**
 * 
 */
class Login extends Controller
{
	public function index()
	{
		return view();
	}
	public function login()
	{
		$data = input('post.');
		$username = $data['username'];
		$password = md5(md5($data['password']));
		$adminmodel = model('Admin');
		$admin = $adminmodel->where('username',$username)->find();
		if(empty($admin))
		{
			$this->error('用户名不存在！');
		}
		else
		{
			if($admin['password'] == $password)
			{
				session('uid',$admin['id']);
				session('username',$username);
				$this->success('登录成功！');
			}
			else
			{
				$this->error('密码错误！');
			}
		}
	}
	public function outlogin()
	{
		session('uid',NULL);
		session('username',NULL);
		$this->success('退出成功！',url('login/index'));
	}
}
?>