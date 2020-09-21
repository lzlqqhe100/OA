<?php
namespace app\admin\controller;
use app\admin\controller\Auth;
/**
 * 
 */
class AuthRule extends Common
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
			$model = model('AuthRule');
			$_list = $model->select();
			foreach ($_list as $v) {
				if($v['status'] == 1)
				{
					$v['status'] = '正常';
				}
				else
				{
					$v['status'] = '禁用';
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
		if(request()->isPost())
		{
			$data = input('post.');
			$model = model('AuthRule');
			if(empty($data['status']))
			{
				$data['status'] = 0;
			}
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
		return view();
	}
	public function edit()
	{
		$id = input('id');
		$model = model('AuthRule');
		$edit = $model->find($id);
		if(request()->isPost())
		{
			$data = input('post.');
			$model = model('AuthRule');
			if(empty($data['status']))
			{
				$data['status'] = 0;
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
		]);
		return view();
	}
	public function del()
	{
		$id = input('id');
		$model = model('AuthRule');
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