<?php
class CheckDetail extends Eloquent {

    protected $table = 'CHECK_SALESUMARYDAY_DETAIL';
    protected $primaryKey = 'docid';
    public $timestamps = false;

    public static function GetVender($vender){
    	switch ($vender) {
		    case '84778':
		        return "006830";
		        break;
		    case '84975':
		        return  "007111','007390";
		        break;
		}
    }

    public static function GetDataProduct($vender='',$barcode='',$color='',$size='',$cup=''){
    	$strSql='';
    	$condition='';
    	$txtProduct= array(0 => 'Error',1 => 'Error',2 => 'Error',3 => 'Error' );
    	if(trim($color)=='999'){
    		$condition = " AND group1 = '".trim($color)."'";
    	}
    	else{
    		if(trim($color)!=''){
    			$color = sprintf("%03s",trim($color))."<br/>";
    		}else{
    			$color = " ";
    		}

    		if(trim($size)!=''){
    			$size = trim($size);
    		}else{
    			$size = " ";
    		}

    		if(trim($cup)!=''){
    			$cup = trim($cup);
    		}else{
    			$cup = " ";
    		}
    		$condition = " And Group1 = '" . $color . "' 
    					   And Nvl(Group2,' ') = '" . $size . "'
    					   And Nvl(Group3,' ') = '" . $cup . "' ";
    	}
    	$strSql=" Select ProductID, FactStyle, Group9, Group11, Price " 
               . " From Product " 
               . " Where CompanyID = 'JIT' " 
               . " And Status <> 9 " 
               . " And ProductID In (Select Distinct ProductID From CustomerBarCode " 
               . " Where CompanyID = 'JIT' " 
               . " And CustomerID In ('" . $vender . "') " 
               . $condition 
               . " And (CustomerBarCodeID Like '%" . substr($barcode, -8) . "' Or CustomerBarCodeID = '" . sprintf("%08s",trim($barcode)) . "') " 
               . " )";
		  $result = DB::select($strSql);
  		if(count($result)>0){
  			$result = (array) $result[0];
  			$txtProduct= array(0 => $result['productid'],1 => $result['factstyle'],2 => $result['group9'],3 => $result['group11'],4 => $result['price'] );
  		}
		  return $txtProduct;
    }

    public static function GetDataProduct_Lotus($vender='',$barcode='',$color='',$size='',$cup=''){
    	$strSql='';
    	$condition='';
    	$txtProduct= array(0 => 'Error',1 => 'Error',2 => 'Error',3 => 'Error' );
    	if(trim($color)=='999'){
    		$condition = " AND group1 = '".trim($color)."'";
    	}
    	else{
    		if(trim($color)!=''){
    			$color = sprintf("%03s",trim($color));
    		}else{
    			$color = " ";
    		}

    		if(trim($size)!=''){
    			$size = trim($size);
    		}else{
    			$size = " ";
    		}

    		if(trim($cup)!=''){
    			$cup = trim($cup);
    		}else{
    			$cup = " ";
    		}
    		$condition = " And Group1 = '" . $color . "' 
    					   And Nvl(Group2,' ') = '" . $size . "'
    					   And Nvl(Group3,' ') = '" . $cup . "' ";
    	}
    	$strSql=" Select ProductID, FactStyle, Group9, Group11, Price " 
               . " From Product " 
               . " Where CompanyID = 'JIT' " 
               . " And Status <> 9 " 
               . " And ProductID In (Select Distinct ProductID From CustomerBarCode_Lotus " 
               . " Where CompanyID = 'JIT' " 
               . " And CustomerID In ('" . $vender . "') " 
               . $condition 
               . " And (CustomerBarCodeID Like '%" . substr($barcode, -8) . "' Or CustomerBarCodeID = '" . sprintf("%08s",trim($barcode)) . "') " 
               . " )";

  		$result = DB::select($strSql);
  		
  		if(count($result)>0){
  			$result = (array) $result[0];
  			$txtProduct= array(0 => $result['productid'],1 => $result['factstyle'],2 => $result['group9'],3 => $result['group11'],4 => $result['price'] );
  		}
  		return $txtProduct;
    }

    public static function GetDataCustomer($vender,$where_house){
    	$txtCustomer= array(0 => 'Error',1 => 'Error',1 => 'Error');
    	$strSql = " Select CustomerID, ShortName,group11 " 
               . " From Customer " 
               . " Where CompanyID  = 'JIT' " 
               . " And Status <> 9 " 
               . " And Group14 = 'LT' " 
               . " And Group16 In ('" . trim($vender) . "') " 
               . " And (RTrim(Group8) = '" . sprintf("%04s",trim($where_house)) . "' Or RTrim(Group8) = '" . sprintf("%03s",trim($where_house)) . "')";
    	$result = DB::select($strSql);

  		if(count($result)>0){
  			$result = (array) $result[0];
        if($result['customerid']=='007112'){
          echo $strSql;
          exit();
        }
  			$txtCustomer= array(0 => $result['customerid'],1 => $result['shortname'],2 => $result['group11']);
  		}
  		return $txtCustomer;
    }
    public static function GetMainCustomer($cus_id,$customer){
      $strSql = " Select CustomerID, ShortName" 
               . " From Customer " 
               . " Where CompanyID  = 'JIT' " 
               . " And CustomerID ='".$cus_id."' And Status <> 9 " ;
      $result = DB::select($strSql);
      try {
         $result = (array) $result[0];
         $txtCustomer= array(0 => $result['customerid'],1 => $result['shortname']);
      } catch (Exception $e) {
          echo $customer."-----".$cus_id;exit();
      }
      
    }
}