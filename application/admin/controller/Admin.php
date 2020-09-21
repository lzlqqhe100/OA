<?php
namespace app\admin\controller;
use app\admin\controller\Auth;
/**
 * 
 */
class Admin extends Common
{
	public function _initialize()
	{
		$auth = Auth::instance();
		$module = request()->module();
		$action = request()->action();
		$controller = request()->controller();
		if($auth->getGroups(session('uid'))[0]['group_id'] != 1)
		{
			if(!$auth->check($module.'/'.$controller.'/'.$action,session('uid')))
			{
				$this->error('没有权限',url(''));
			}
		}
	}
	public function index()
	{
		if(request()->isAjax())
		{	
			$auth=new Auth();
			$model = model('Admin');
			$_list = $model->select();
			foreach ($_list as $v) {
				if($v['position'])
				{
					$v['position'] = $auth->getGroups($v['id'])[0]["title"];
				}
			}
			$count = count($_list);
			$res = ["code"=>0,"msg"=>"","count"=>$count,"data"=>$_list];
			return json($res);
		}
		return view();
	}
	public function add()
	{
		$AuthGroupmodel = model('AuthGroup');
		$group = $AuthGroupmodel->where('status',1)->select();
		if(request()->isPost())
		{
			$data = input('post.');
			$model = model('Admin');
			$data['password'] = md5(md5($data['password']));
			$res = $model->add($data);
			if($res)
			{
				$this->success('添加成功！');
			}
			else
			{
				$this->error('添加失败！');
			}
		}
		$this->assign([
			'group'=>$group,
		]);
		return view();
	}
	public function edit()
	{
		$id = input('id');
		$model = model('Admin');
		$edit = $model->find($id);
		$group = $AuthGroupmodel->where('status',1)->select();
		if(request()->isPost())
		{
			$data = input('post.');
			$model = model('Admin');
			if($data['password'])
			{
				$data['password'] = md5(md5($data['password']));
			}
			else
			{
				unset($data['password']);
			}
			$res = $model->edit($data);
			if($res)
			{
				$this->success('修改成功！');
			}
			else
			{
				$this->error('修改失败！');
			}
		}
		$this->assign([
			'edit'=>$edit,
			'group'=>$group,
		]);
		return view();
	}
	public function del()
	{
		$id = input('id');
		$model = model('Admin');
		if($model->destroy($id))
		{
			$this->success('删除成功！');
		}
		else
		{
			$this->error('删除失败！');
		}
	}
}
?>