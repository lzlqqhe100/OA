<?php
namespace app\admin\controller;
/**
 * 
 */
class AuthGroup extends Common
{	
	public function index()
	{
		if(request()->isAjax())
		{
			$model = model('AuthGroup');
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
		$AuthRulemodel = model('AuthRule');
		$rule = $AuthRulemodel->where('status',1)->select();
		if(request()->isPost())
		{
			$data = input('post.');
			$model = model('AuthGroup');
			if(empty($data['status']))
			{
				$data['status'] = 0;
			}
			if(isset($data['rules']))
			{
				$data['rules'] = implode(',',$data['rules']);
			}
			else
			{
				$data['rules'] = '';
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
		$this->assign([
			'rule'=>$rule,
		]);
		return view();
	}
	public function edit()
	{
		$AuthRulemodel = model('AuthRule');
		$rule = $AuthRulemodel->where('status',1)->select();
		$id = input('id');
		$model = model('AuthGroup');
		$edit = $model->find($id);
		$edit['rules'] = explode(',',$edit['rules']);
		if(request()->isPost())
		{
			$data = input('post.');
			$model = model('AuthGroup');
			if(empty($data['status']))
			{
				$data['status'] = 0;
			}
			if(isset($data['rules']))
			{
				$data['rules'] = implode(',',$data['rules']);
			}
			else
			{
				$data['rules'] = '';
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
			'rule'=>$rule,
		]);
		return view();
	}
	public function del()
	{
		$id = input('id');
		$model = model('AuthGroup');
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