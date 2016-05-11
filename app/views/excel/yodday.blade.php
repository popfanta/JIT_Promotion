<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
	.font8{
		font-size: 8px;
	}
	.font10{
		font-size: 10px;
	}
	.font11{
		font-size: 11px;
	}
	.font12{
		font-size: 12px;
	}
	.font14{
		font-size: 14px;
	}
	.text-right{
		text-align: right;
	}
	.text-center{
		text-align: center;
	}
	.blue{
		color: #0033FF;
	}
	.red{
		color: #FF3333;
	}
	.bold{
		font-weight: bold;
	}
	.borders > td{
		border-bottom: 1px solid #000000;
	}
	.font_Comic{
		font-family:Comic Sans MS;
	}
</style>
<table>
		<tr>
			<td>
				<?php 
					
				?>
			</td>
		</tr>
		<tr>
			<td class="bold">SUP</td>
			<td class="bold">กลุ่ม</td>
			<td class="bold">รหัสร้านค้า</td>
			<td class="bold">ชื่อร้านค้า</td>
			<td class="bold">Target</td>
			<td class="bold">จุดขาย</td>
			<td class="bold">สินค้า</td>
			<td class="bold">เกรด</td>
			<td class="bold">ส่วนลด</td>
			<td class="bold">โปรโมชั่น</td>
			<td></td>
			<td class="bold">Total</td>
			<td></td>
			@for($i=1;$i<=31;$i++)
				<td width="11"></td>
				<td width="11" class="bold" align="center">{{ $i }}</td>
				<td width="11"></td>
			@endfor
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td class="bold"></td>
			<td></td>
			@for($i=1;$i<=31;$i++)
				<td class="font8 red" align="center">ชิ้น</td>
				<td class="font8 red" align="center">ป้าย</td>
				<td class="font8 red" align="center">สุทธิ</td>
			@endfor
		</tr>
	@foreach($r as $k=>$v)
		<tr>
			<td class="font10">{{ $v->sup }}</td>
			<td class="font10">{{ $v->group_ }}</td>
			<td class="font10">{{ $v->customerid }}</td>
			<td class="font10">{{ iconv("tis-620","utf-8",$v->customername) }}</td>
			<td></td>
			<td class="font10">{{ iconv("tis-620","utf-8",$v->point) }}</td>
			<td class="font10">{{ $v->productgroup }}</td>
			<td class="font10">{{ $v->grade }}</td>
			<td class="font10">{{ $v->persent/100 }}</td>
			<td class="font10">{{ iconv("tis-620","utf-8",$v->promotion) }}</td>
			<td class="text-right font10">=SUMIF($N$2:$DB$2,$N$2,$N{{ $k+3 }}:$DB{{ $k+3 }})</td>
			<td class="text-right font10">=SUMIF($N$2:$DB$2,$O$2,$N{{ $k+3 }}:$DB{{ $k+3 }})</td>
			<td class="text-right font10">=SUMIF($N$2:$DB$2,$P$2,$N{{ $k+3 }}:$DB{{ $k+3 }})</td>

			@for($i=1;$i<=31;$i++)
				<?php 
					DB::statement("alter session set NLS_DATE_FORMAT = 'DDMMYYYY'");
					  $qty = CheckHeadNew::where('saledate',sprintf("%02s",$i).'012016')->where('promotion',$v->promotion)->where('point',$v->point)->where('customerid',$v->customerid)->where('grade',$v->grade)->where('group_',$v->group_)->sum('qty');
					  $price = CheckHeadNew::where('saledate',sprintf("%02s",$i).'012016')->where('promotion',$v->promotion)->where('point',$v->point)->where('customerid',$v->customerid)->where('grade',$v->grade)->where('group_',$v->group_)->sum('price');
					  $total = CheckHeadNew::where('saledate',sprintf("%02s",$i).'012016')->where('promotion',$v->promotion)->where('point',$v->point)->where('customerid',$v->customerid)->where('grade',$v->grade)->where('group_',$v->group_)->sum('total');
				?>
				<td class="text-right font10">{{ $qty }}</td>
				<td class="text-right font10 red">{{ $price }}</td>
				<td class="text-right font10 blue">{{ $total }}</td>
			@endfor
		</tr>
	@endforeach
</table>
