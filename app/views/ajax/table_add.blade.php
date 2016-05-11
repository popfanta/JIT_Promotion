<table class="table table-bordered">
	<tr>
		<th>จุดขาย</th>
		<th>สินค้า</th>
		<th>เกรด</th>
		<th>ส่วนลด</th>
		<th>โปรโมชั่น</th>
		<th>จำนวนชิ้น</th>
		<th>ราคาป้าย</th>
		<th>ราคาสุทธิ</th>
		<th></th>
	</tr>
	@foreach(Session::get('List') as $key => $v)
		@if($v['Type']=='ปกติ')
			<tr>
				<td>{{ $v['CustomerType'] }}</td>
				<td>{{ $v['ProductGroup'] }}</td>
				<td>{{ $v['Grade'] }}</td>
				<td>{{ $v['Note'] }}</td>
				<td><span class="label label-success">{{ $v['Type'] }}</span></td>
				<td>{{ $v['QTY'] }}</td>
				<td class="text-right">{{ $v['Price'] }}</td>
				<td class="text-right">{{ $v['Price'] }}</td>
				<td class="text-center"><a href="javascript:void(0);" id="Delete-{{ $key }}" class="delete btn btn-danger btn-xs"><i class="fa fa-fw fa-remove"></i></a></td>
			</tr>
		@elseif($v['Type']=='เปอร์เซ็นท์')
			<tr>
				<td>{{ $v['CustomerType'] }}</td>
				<td>{{ $v['ProductGroup'] }}</td>
				<td>{{ $v['Grade'] }}</td>
				<td>{{ $v['Promotion'] }}%</td>
				<td><span class="label label-primary">ซื้อ {{ $v['Buy'] }} ชิ้นขึ้นไป</span></td>
				<td>{{ $v['QTY'] }}</td>
				<td class="text-right">{{ $v['Price'] }}</td>
				<td class="text-right">{{ $v['Price']-($v['Price']*($v['Promotion']/100)) }}</td>
				<td class="text-center"><a href="javascript:void(0);" id="Delete-{{ $key }}" class="delete btn btn-danger btn-xs"><i class="fa fa-fw fa-remove"></i></a></td>
			</tr>
		@elseif($v['Type']=='แถม')
			<tr>
				<td>{{ $v['CustomerType'] }}</td>
				<td>{{ $v['ProductGroup'] }}</td>
				<td>{{ $v['Grade'] }}</td>
				<td></td>
				<td><span class="label label-warning">ซื้อ {{ $v['Buy'] }} ชิ้น แถม {{ $v['Promotion'] }} ชิ้น</span></td>
				<td>{{ $v['QTY'] }}</td>
				<td class="text-right">{{ $v['Price'] }}</td>
				<td class="text-right">{{ $v['Price'] }}</td>
				<td class="text-center"><a href="javascript:void(0);" id="Delete-{{ $key }}" class="delete btn btn-danger btn-xs"><i class="fa fa-fw fa-remove"></i></a></td>
			</tr>
		@elseif($v['Type']=='ตัวแถม')
			<tr>
				<td>{{ $v['CustomerType'] }}</td>
				<td>{{ $v['ProductGroup'] }}</td>
				<td>{{ $v['Grade'] }}</td>
				<td></td>
				<td><span class="label label-warning">แถม</span></td>
				<td>{{ $v['QTY'] }}</td>
				<td class="text-right">{{ $v['Price'] }}</td>
				<td class="text-right">0</td>
				<td class="text-center"></td>
			</tr>
		@endif

	@endforeach
</table>
