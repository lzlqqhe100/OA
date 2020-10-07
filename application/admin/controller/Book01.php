<?php
namespace app\admin\controller;
use app\admin\model\Book01 as Book01model;
use think\Controller;

/*
类名：Prosub
页面：提案提交
类型：公有
变量：无
参数：无
 */

class Book01 extends Common
{
    public function book01()
    {
        return view();
    }

    public function add()
    {
    	if(request()->isPost()){
    		$data = input('post.');
    		//$Bookmodel = new Book01model();
    		$Bookmodel = model('Book01');
    		$res = $Bookmodel->addmodel($data);
    		if($res){
    			$this->success('添加成功',url('list'));
    		}
    		else{
    			$this->error('添加失败');
    		}
    	}
    	return view();
    }

    public function list()
    {
    	# code...
    }

    public function getUserId($value='')
    {
    	# code...
    }
}
?>