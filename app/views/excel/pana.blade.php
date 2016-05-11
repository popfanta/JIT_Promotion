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
	.white{
		color: #FFFFFF;
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
<?php 
	$dowMap = array('อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัส', 'ศุกร์', 'เสาร์');
	$month_thai = CheckHead::MonthToThai($month);
	$count_r = (count($r)*3)+6;
?>
<table border="1">
	<tr class="borders">
		<td>x</td>
		<td class="font_Comic font14" width="4"></td>
		<td class="font10 font_Comic">สรุปยอดรายวันประจำเดือน</td>
		<td class="font11 white">{{ cal_days_in_month( CAL_GREGORIAN , $month,$year) }}</td>
		<td class="font8 font_Comic text-center"colspan="2"></td>
		@for($i=1;$i<32;$i++)
			<td class="text-center font_Comic font8 red bold" width="12">{{ $dowMap[date("w", mktime(0, 0, 0, $month,$i, $year))] }}</td>
		@endfor
	</tr>
	<tr class="borders">
		<td>x</td>
		<td class="font_Comic font8 text-center">เป้า</td>
		<td class="font12 font_Comic red bold text-center">{{ $month_thai }} {{ $year+543 }}</td>
		<td class="font11 font_Comic text-right">สรุปยอดถึงวันที่</td>
		<td class="font8 font_Comic red font8" width="3">{{ $maxdate }}</td>
		<td class="font8 font_Comic text-center"></td>
		@for($i=1;$i<32;$i++)
			<td class="text-center" ></td>
		@endfor
	</tr>
	<tr class="borders">
		<td>x</td>
		<td class="font_Comic font8 text-center">หมาย</td>
		<td class="font11 font_Comic blue text-center bold">=SUM(D6:D{{ $count_r-1 }})</td>
		<td class="font11 font_Comic"></td>
		<td class="font8 font_Comic text-center"colspan="2"></td>
		@for($i=1;$i<32;$i++)
			<td class="text-center" ></td>
		@endfor
	</tr>
	<tr class="borders">
		<td>x</td>
		<td class="font_Comic font14">ยอดขายตามประเภท</td>
		<td></td>
		<td class="font11 font_Comic text-center">เป้าหมายรวม</td>
		<td class="font8 font_Comic text-center"colspan="2">จำนวน</td>
		@for($i=1;$i<32;$i++)
			<td class="text-center bold">{{ $i }}</td>
		@endfor
		<td width="13" class="font10 font_Comic text-center">ยอดขายสะสม</td>
		<td width="13" class="font10 font_Comic text-center">เป้าหมายสะสม</td>
		<td width="8" class="font10 font_Comic text-center">%วัน</td>
		<td width="8" class="font10 font_Comic text-center">%เดือน</td>
		<td width="8" class="font10 font_Comic text-center">ส่วน</td>
	</tr>
	<tr class="borders">
		<td></td>
		<td class="font_Comic font14"></td>
		<td class="font12 font_Comic red"></td>
		<td class="font11 font_Comic"></td>
		<td class="font8 font_Comic text-center"colspan="2"></td>
		@for($i=1;$i<32;$i++)
			<td class="text-center" ></td>
		@endfor
	</tr>
	<?php 
		$row = 6;
	?>
	@foreach($r as $k => $v)
	<tr class="borders">
		<td>x</td>
		<td class="font8">{{$v->group_}}</td>
		<td></td>
		<td rowspan="3" class="font8 text-right red bold">{{ $v->target }}</td>
		<td></td>
		<td class="font10">ชิ้น</td>
		@for($i=1;$i<32;$i++)
			<td class="text-right blue">{{ $v->{'qty'.$i} }}</td>
		@endfor
		<td class="text-right blue">=SUM(G{{ $row }}:AK{{ $row }})</td>
		<td></td>
		<td class="text-center font8 blue bold" valign="middle" rowspan="3">=IF(AM{{ $row+1 }}=0,"",AL{{ $row+1 }}/AM{{ $row+1 }})</td>
		<td class="text-center font8 red bold" valign="middle" rowspan="3">=IF(D{{ $row }}=0,"",AL{{ $row+1 }}/D{{ $row }})</td>
		<td class="text-center font8 bold" valign="middle" rowspan="3">=IF(AL{{ $row+1 }}=0,"",AL{{ $row+1 }}/$AL${{ $count_r+1 }})</td>
	</tr>
	<tr>
		<td>x</td>
		<td class="font8">{{$v->group_}}</td>
		<td></td>
		<td></td>
		<td></td>
		<td class="font10">ป้าย</td>
		@for($i=1;$i<32;$i++)
			<td class="text-right">{{ $v->{'priceday'.$i} }}</td>
		@endfor
		<td class="text-right">=SUM(G{{ $row+1 }}:AK{{ $row+1 }})</td>
		<td class="font10 text-right red bold">=$D{{ $row }}*$E$2/$D$1</td>
	</tr>
	<tr>
		<td>x</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td class="font10">สุทธิ</td>
		@for($i=1;$i<32;$i++)
			<td class="text-right red">{{ $v->{'totalday'.$i} }}</td>
		@endfor
		<td class="text-right red">=SUM(G{{ $row+2 }}:AK{{ $row+2 }})</td>
		<td></td>
	</tr>
	<?php $row = $row+3;?>
	@endforeach
	
	<tr class="borders">
		<td>x</td>
		<td class="font8"></td>
		<td></td>
		<td rowspan="3" class="font8 text-right red bold">=SUM(D6:D{{ $count_r-1 }})</td>
		<td></td>
		<td class="font10">ชิ้น</td>
		@for ($i=2; $colums[$i] != 'AM'; $i=$i+1)
			<td class="text-right blue">=SUMIF($F$6:$F${{ $count_r-1 }},$F{{ $count_r }},{{ $colums[$i] }}$6:{{ $colums[$i] }}${{ $count_r-1 }})</td>
		@endfor
		<td class="text-right blue"></td>
	</tr>
	<tr>
		<td>x</td>
		<td class="font8"></td>
		<td></td>
		<td></td>
		<td></td>
		<td class="font10">ป้าย</td>
		@for($i=2; $colums[$i] != 'AM'; $i=$i+1)
			<td class="text-right">=SUMIF($F$6:$F${{ $count_r-1 }},$F{{ $count_r+1 }},{{ $colums[$i] }}$6:{{ $colums[$i] }}${{ $count_r-1 }})</td>
		@endfor
		<td class="font10 text-right red bold">=$C3*$E$2/$D$1</td>
		<td class=""></td>
		<td class=""></td>
		<td class="font8 text-right bold">=SUM(AP6:AP{{ $count_r-1 }})</td>
	</tr>
	<tr>
		<td>x</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td class="font10">สุทธิ</td>
		@for($i=2; $colums[$i] != 'AM'; $i=$i+1)
			<td class="text-right red">=SUMIF($F$6:$F${{ $count_r-1 }},$F{{ $count_r+2 }},{{ $colums[$i] }}$6:{{ $colums[$i] }}${{ $count_r-1 }})</td>
		@endfor
		<td class="text-right red"></td>
	</tr>





<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td colspan="2"></td>
		@for($i=1;$i<32;$i++)
			<td></td>
		@endfor
		<td></td>
		<td></td>
</tr>








	<tr class="borders">
		<td></td>
		<td class="font_Comic font14">ยอดขายตาม Area Supervisor</td>
		<td></td>
		<td class="font11 font_Comic text-center"></td>
		<td class="font8 font_Comic text-center"colspan="2"></td>
		@for($i=1;$i<32;$i++)
			<td class="text-center bold">{{ $i }}</td>
		@endfor
		<td class="font10 font_Comic text-center">ยอดขายสะสม</td>
		<td class="font10 font_Comic text-center">เป้าหมายสะสม</td>
		<td width="8" class="font10 font_Comic text-center">% วัน</td>
		<td width="8" class="font10 font_Comic text-center">% เดือน</td>
		<td width="8" class="font10 font_Comic text-center">ส่วน</td>
	</tr>
	<tr class="borders">
		<td></td>
		<td class="font_Comic font14"></td>
		<td class="font12 font_Comic red"></td>
		<td class="font11 font_Comic"></td>
		<td class="font8 font_Comic text-center"colspan="2"></td>
		@for($i=1;$i<32;$i++)
			<td class="text-center" ></td>
		@endfor
	</tr>
	<?php $row = $count_r+6;?>
	@foreach($s as $k => $v)
	<tr class="borders">
		<td></td>
		<td class="font8">{{$v->sup}}</td>
		<td></td>
		<td rowspan="3" class="font8 text-right red bold">{{ $v->target }}</td>
		<td></td>
		<td class="font10">ชิ้น</td>
		@for($i=1;$i<32;$i++)
			<td class="text-right blue">{{ $v->{'qty'.$i} }}</td>
		@endfor
		<td class="text-right blue">=SUM(G{{ $row }}:AK{{ $row }})</td>
		<td></td>
		<td class="text-center font8 blue bold" valign="middle" rowspan="3">=IF(AM{{ $row+1 }}=0,"",AL{{ $row+1 }}/AM{{ $row+1 }})</td>
		<td class="text-center font8 red bold" valign="middle" rowspan="3">=IF(D{{ $row }}=0,"",AL{{ $row+1 }}/D{{ $row }})</td>
		<td class="text-center font8 bold" valign="middle" rowspan="3">=IF(AL{{ $row+1 }}=0,"",AL{{ $row+1 }}/$AL${{ $count_r+1 }})</td>
	</tr>
	<tr>
		<td></td>
		<td class="font8">{{$v->sup}}</td>
		<td></td>
		<td></td>
		<td></td>
		<td class="font10">ป้าย</td>
		@for($i=1;$i<32;$i++)
			<td class="text-right">{{ $v->{'priceday'.$i} }}</td>
		@endfor
		<td class="text-right">=SUM(G{{ $row+1 }}:AK{{ $row+1 }})</td>
		<td class="font11 text-right red bold">=$D{{ $row }}*$E$2/$D$1</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td class="font10">สุทธิ</td>
		@for($i=1;$i<32;$i++)
			<td class="text-right red">{{ $v->{'totalday'.$i} }}</td>
		@endfor
		<td class="text-right red">=SUM(G{{ $row+2 }}:AK{{ $row+2 }})</td>
	</tr>
	<?php $row=$row+3;?>
	@endforeach
	<?php 
		$count_s = $count_r+6;
		$count_r = (count($s)*3)+($count_s);
	?>
	<tr class="borders">
		<td></td>
		<td class="font8"></td>
		<td></td>
		<td rowspan="3" class="font8 text-right red bold">=SUM(D{{ $count_s }}:D{{ $count_r-1 }})</td>
		<td></td>
		<td class="font10">ชิ้น</td>
		@for ($i=2; $colums[$i] != 'AM'; $i=$i+1)
			<td class="text-right blue">=SUMIF($F${{ $count_s }}:$F${{ $count_r-1 }},$F{{ $count_r }},{{ $colums[$i] }}${{ $count_s }}:{{ $colums[$i] }}${{ $count_r-1 }})</td>
		@endfor
		<td class="text-right blue"></td>
	</tr>
	<tr>
		<td></td>
		<td class="font8"></td>
		<td></td>
		<td></td>
		<td></td>
		<td class="font10">ป้าย</td>
		@for($i=2; $colums[$i] != 'AM'; $i=$i+1)
			<td class="text-right">=SUMIF($F${{ $count_s }}:$F${{ $count_r-1 }},$F{{ $count_r+1 }},{{ $colums[$i] }}${{ $count_s }}:{{ $colums[$i] }}${{ $count_r-1 }})</td>
		@endfor
		<td class="text-right"></td>
		<td class=""></td>
		<td class=""></td>
		<td class="font8 text-right bold">=SUM(AP{{ $count_s }}:AP{{ $count_r-1 }})</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td class="font10">สุทธิ</td>
		@for($i=2; $colums[$i] != 'AM'; $i=$i+1)
			<td class="text-right red">=SUMIF($F${{ $count_s }}:$F${{ $count_r-1 }},$F{{ $count_r+2 }},{{ $colums[$i] }}${{ $count_s }}:{{ $colums[$i] }}${{ $count_r-1 }})</td>
		@endfor
		<td class="text-right red"></td>
	</tr>

</table>