<!DOCTYPE html>
<html>
<?php 
	$month = CheckHead::GetMonthThai();
?>
<style type="text/css">
	.header td{
		font-weight: bold;
	}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table>
	<tr class="header">
		<td colspan="10" align="center" style="font-size:10px;color:#EA0201;">เปรียบเทียบเป้าหมายปี</td>
		@foreach($month as $k => $v)
			<td colspan="3" align="center" style="font-size:10px;color:#3b78e7;">{{ $v }}</td>
			<td width="6" align="center" style="font-size:10px;color:#3b78e7;background-color:#FEF2C0;">ด.{{ $k }}</td>
		@endforeach
	</tr>
	<tr class="header">
		<td rowspan="2" valign="middle" align="center">กลุ่ม</td>
		<td rowspan="2" valign="middle" align="center">สถานะ</td>
		<td rowspan="2" valign="middle" align="center">กลุ่ม</td>
		<td rowspan="3" widtd="6" valign="middle" align="center">SUP</td>
		<td colspan="2" rowspan="2" valign="middle" align="center">รหัสร้านค้า</td>
		<td colspan="2" rowspan="3" align="center" valign="middle">ชื่อร้านค้า</td>
		<td rowspan="3" width="11" valign="middle" align="center">Stock Limit</td>
		<td rowspan="3" width="9" valign="middle" align="center">จุดขาย</td>
		@foreach($month as $k => $v)
			<td rowspan="2" width="12" align="center">เป้าหมาย</td>
			<td colspan="2" align="center" style="color:#3b78e7;">ยอดขาย</td>
			<td width="9" align="center" style="color:#EA0201;">%</td>
		@endforeach
	</tr>
	<tr class="header">
		<td widtd="6"></td>
		<td widtd="6"></td>
		<td widtd="6"></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		@foreach($month as $k => $v)
			<td></td>
			<td width="10" align="center" style="color:#3b78e7;">ป้าย</td>
			<td width="10" align="center" style="color:#3b78e7;">สุทธิ</td>
			<td rowspan="2" ></td>
		@endforeach
	</tr>
	<tr class="header">
		<td align="center">เก่า</td>
		<td align="center">48</td>
		<td align="center">ใหม่</td>
		<td></td>
		<td width="10" align="center">A</td>
		<td width="10" align="center">Pro</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<?php 
		$colums = array('K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'
						 ,'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN'
						 ,'AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF');
		$c=0;
		?>
		@foreach($month as $k => $v)
			<td>=SUBTOTAL(9,{{ $colums[$c] }}5:{{ $colums[$c] }}1036)</td>
			<?php $c=$c+1;?>
			<td>=SUBTOTAL(9,{{ $colums[$c] }}5:{{ $colums[$c] }}1036)</td>
			<?php $c=$c+1;?>
			<td>=SUBTOTAL(9,{{ $colums[$c] }}5:{{ $colums[$c] }}1036)</td>
			<?php $c=$c+1;?>
			<td></td>
			<?php $c=$c+1;?>
		@endforeach
	</tr>
	<?php 
		$i=5;
		$cid='';
	?>
	@foreach($r as $k=>$v)
	<tr>
		<td>{{ $v->group_ }}</td>
		<td></td>
		<td>{{ $v->group_ }}</td>
		<td>{{ $v->sup }}</td>
		<td>{{ $v->customerid }}</td>
		<td>{{ $v->group11 }}</td>
		<td colspan="2" width="20">{{ iconv("tis-620","utf-8",$v->customername) }}</td>
		<td></td>
		<td> {{ iconv("tis-620","utf-8",$v->point) }}</td>
		<?php $c=0;?>
		@foreach($month as $key => $m)
			<td>
				{{ ((iconv("tis-620","utf-8",$v->point)=='เคาน์เตอร์' || iconv("tis-620","utf-8",$v->point)=='แกรนด์เซลล์') && $cid!=$v->customerid ? $v->{'month'.$key} : '') }}
			</td>
			<td>{{ $v->{'price'.$key} }}</td>
			<td>{{ $v->{'total'.$key} }}</td>
			<?php $fcolumn=$colums[$c]; $c=$c+1;  $lcolumn=$colums[$c]; ?>
			<td>=IF(OR({{ $fcolumn }}{{ $i }}=0,{{ $lcolumn }}{{ $i }}=0),"",{{ $lcolumn }}{{ $i }}/{{ $fcolumn }}{{ $i }})</td>
			<?php $c=$c+3;?>
		@endforeach
	</tr>
	<?php 
		  $i=$i+1;
		  $cid=$v->customerid;
	?>
	@endforeach
</table>
</html>