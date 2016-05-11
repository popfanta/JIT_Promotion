<?php

class PMController extends BaseController {


	public function IndexAction()
	{
		$sql = "Select  T4.Employeeid,T4.Employeename,FORECASTSHIP,FORECASTSALE,T1.PromotionID, to_char(T1.PmDate,'DD/MM/YYYY') PmDate, to_char(StartDate,'DD/MM/YYYY') StartDate, to_char(EndDate,'DD/MM/YYYY') EndDate,  DeCode(DocGroup, 'PRO','".iconv('UTF-8','TIS-620','จัดรายการ')."','".iconv('UTF-8','TIS-620','ส่วนลด')."') As DocGroup,  
			 T1.CustomerID,   (Select ShortName From Customer Where CompanyID = T1.CompanyID And CustomerID = T1.CustomerID) As CustomerName,  
			 T3.ProductGrade, T3.Discount As Discount_GP,
			 Nvl( (Select Distinct Discount From ProductDiscountByPromotion Where CompanyID = T1.CompanyID And PromotionID = T1.PromotionID),0) As Discount_Detail,
			 T1.DiscountInformation, 
			 To_Char(Share_Jit) As Share_Jit, To_Char(Share_Customer) As Share_Customer, Conditional_Cash, T1.Vicinity,   T1.ProductWant,
			 T1.Remark, DeCode(T1.Status,1,'',3,'".iconv('UTF-8','TIS-620','แก้ไข')." PM') As StatusDocument 
			  From Promotion T1, PromotionDate T2, PromotionDetail T3,EMPLOYEE T4
			  Where T1.CompanyID = T2.CompanyID 
			  And T1.PromotionID = T2.PromotionID  
			  And T1.CompanyID = T3.CompanyID
			  And T1.PromotionID = T3.PromotionID
			  AND T1.AREASUP = T4.EMPLOYEEID
			  AND T1.CompanyID = T4.CompanyID
			  --And T1.Status In (1,3)
			  And T1.CompanyID = 'JIT'
			  And RefPromotionMain Is Null
			  And T1.Status <> 9
			      
			  And T1.Remark Like'#%'
			  And To_Char(T2.StartDate,'YYYYMMDD') >= '20160201'  And To_Char(T2.StartDate,'YYYYMMDD') <= '20161231'
			  Order By T1.PromotionID";
		$result = DB::select($sql);
		return View::make('index2')->with('result',$result);
	}	
	public function Confirm(){
		DB::statement("alter session set NLS_DATE_FORMAT = 'DD/MM/YYYY'");
		$pro = Promotion::where('promotionid',Input::get('id'))->where('companyid','JIT')->first();
		$pro->status = 0;
		$pro->appruserid = 'admin';
		$pro->apprdate = date('d/m/Y');
		$pro->apprtime = date('H:i:s');
		$pro->apprnote = iconv('UTF-8','TIS-620',Input::get('note'));
		$pro->save();
		DB::table('promotion')
            ->where('RefPromotionMain',Input::get('id'))
            ->where('companyid','JIT')
            ->update(array('apprnote' => iconv('UTF-8','TIS-620',Input::get('note')),'status' => 0,'appruserid'=>'admin','apprdate'=>date('d/m/Y'),'apprtime'=>date('H:i:s') ));
		return 'true';
	}
	public function Edit(){
		DB::statement("alter session set NLS_DATE_FORMAT = 'DD/MM/YYYY'");
		$pro = Promotion::where('promotionid',Input::get('id'))->where('companyid','JIT')->first();
		$pro->status = 2;
		$pro->apprnote = iconv('UTF-8','TIS-620',Input::get('note'));
		$pro->save();
		DB::table('promotion')
            ->where('RefPromotionMain',Input::get('id'))
            ->where('companyid','JIT')
            ->update(array('apprnote' => iconv('UTF-8','TIS-620',Input::get('note')),'status' => 2 ));
		return 'true';
	}
	public function Close(){
		DB::statement("alter session set NLS_DATE_FORMAT = 'DD/MM/YYYY'");
		$pro = Promotion::where('promotionid',Input::get('id'))->where('companyid','JIT')->first();
		$pro->status = 9;
		$pro->apprnote = iconv('UTF-8','TIS-620',Input::get('note'));
		$pro->save();
		DB::table('promotion')
            ->where('RefPromotionMain',Input::get('id'))
            ->where('companyid','JIT')
            ->update(array('apprnote' => iconv('UTF-8','TIS-620',Input::get('note')),'status' => 9 ));
		return 'true';
	}
}