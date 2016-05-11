<?php

class FormController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	public function Insert()
	{
		$arr = Input::get('qty');
		$customergroup = Input::get('customergroup');
		$customerid = Input::get('customerid');
		$customername = Input::get('customername');
		$docgroup = Input::get('docgroup');
		$productgradesale = Input::get('productgradesale');
		$discount = Input::get('discount');
		$gp = Input::get('gp');
		$vicinity = Input::get('vicinity');
		$qty = array_filter($arr);
			/*foreach (Session::get('List') as $key => $v) {
				//echo $v['CustomerType'];
				DB::insert("insert into CHECK_SALESUMARYDAY (ID,saledete,customerid,productgroup,grade,customertype,buy,promotion,qty,price,note,type_doc) values ((select (MAX(id)+1) as id from CHECK_SALESUMARYDAY),to_date(?,'yyyy-mm-dd'),?,?,?,?,?,?,?,?,?,?)", 
					array(Input::get('date'),
						Input::get('customerid'),
						$v['ProductGroup'],
						$v['Grade'],
						iconv("utf-8", "tis-620",$v['CustomerType']),
						$v['Buy'],
						$v['Promotion'],
						$v['QTY'],
						$v['Price'],
						iconv("utf-8", "tis-620",$v['Note']),
						iconv("utf-8", "tis-620",$v['Type'])));
			}
			Session::forget('List_Num');
			Session::forget('List');
			echo "<script>alert('บันทึกข้อมูลเรียบร้อย');window.location = '".url('/')."';</script>";*/
		
	}	

}