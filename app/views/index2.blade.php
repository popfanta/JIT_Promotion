@extends('main')
@section('header')
    {{ HTML::style('TemplateAdmin/plugins/datepicker/datepicker3.css') }}
    {{ HTML::style('TemplateAdmin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css') }}
    {{ HTML::style('TemplateAdmin/plugins/datatables/dataTables.bootstrap.css') }}
    {{-- HTML::style('TemplateAdmin/plugins/datatables/extensions/FixedColumns/css/fixedColumns.dataTables.css') --}}
    {{-- HTML::style('TemplateAdmin/plugins/datatables/extensions/FixedColumns/css/fixedColumns.foundation.css') --}}
    {{-- HTML::style('TemplateAdmin/plugins/datatables/extensions/FixedColumns/css/fixedColumns.jqueryui.css') --}}
  <style type="text/css">
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
      padding: 8px;
      font-size: 12px;
      background: #FFF;
      white-space: nowrap;
    }
    .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
        border: 1px solid #ddd !important;
    }
    .table tr:nth-child(odd) td{
    }
    .table tr:nth-child(even) td{
      background-color: #F1F1F1 !important;
    }
    .table{
      margin-top: 20px;
    }
    .btn-warning,.btn-danger{
      margin-left: 10px;
    }
    </style>
@stop
@section('content')

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          @foreach($result as $k=>$r)
          <?php 
             $max = Promotion::where('RefPromotionMain',$r->promotionid)->max('promotionid');
          ?>
          <div class="box" id="{{ $r->promotionid }}">
            <div class="box-header with-border">
              <h3 class="box-title"><strong>
              @if($max!='')
                   {{ $r->promotionid }} - {{ $max }}
              @else
                  {{ $r->promotionid }}
               @endif
               </strong>
               </h3>
              <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                    <strong>PMDate</strong> : {{ iconv('TIS-620','UTF-8',$r->pmdate) }}<br/>
                    <strong>DocGroup</strong> : 
                    @if(trim(iconv('TIS-620','UTF-8',$r->docgroup))=='จัดรายการ')
                       <span class="label label-success">{{ iconv('TIS-620','UTF-8',$r->docgroup) }}</span>
                    @else
                       <span class="label label-danger">{{ iconv('TIS-620','UTF-8',$r->docgroup) }}</span>
                    @endif
                </div>
                <div class="col-md-4">
                    <strong>StartDate-EndDate</strong> : {{ iconv('TIS-620','UTF-8',$r->startdate) }} - {{ iconv('TIS-620','UTF-8',$r->enddate) }} <br/>
                    <strong>Customer</strong> : 
                    @if($max!='')
                      <?php 
                        $group = DB::select("  Select * From CustomerGroup Where Inital In (Select Group14 From Customer Where CompanyID = 'JIT' And CustomerID='".$r->customerid."')");
                      ?>
                      @foreach($group as $g)
                         {{ $g->inital.' | '.iconv('TIS-620','UTF-8',$g->customername) }}
                      @endforeach
                     @else
                      {{ $r->customerid.' | '.iconv('TIS-620','UTF-8',$r->customername) }}
                     @endif
                </div>
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Grade</th>
                            <th>ForecastShip</th>
                            <th>ForecastSale</th>
                            <th>DiscountGP</th>
                            <th>DiscountDetail</th>
                            <th>DiscountInformation</th>
                        </tr>
                        <tr>
                          <td>{{ iconv('TIS-620','UTF-8',$r->productgrade) }}</td>
                          <td class="text-right">{{ $r->forecastship }}</td>
                          <td class="text-right">{{ $r->forecastsale }}</td>
                          <td class="text-right">{{ $r->discount_gp }}</td>
                          <td class="text-right">{{ $r->discount_detail }}</td>
                          <td>{{ iconv('TIS-620','UTF-8',$r->discountinformation) }}</td>       
                        </tr>
                      </table>
                  </div>
                </div>
                <div class="col-md-12">
                    <dl class="dl-horizontal">
                      <dt>%แชร์ค่าใช้จ่าย</dt>
                      <dd>{{ $r->share_jit }} : {{ $r->share_customer }}</dd>
                      <dt>เงื่อนไขคิดแชร์</dt>
                      <dd>{{ iconv('TIS-620','UTF-8',$r->conditional_cash) }}</dd>
                      <dt>Area Supervise</dt>
                      <dd>{{ iconv('TIS-620','UTF-8',$r->employeeid) }} | {{ iconv('TIS-620','UTF-8',$r->employeename) }}</dd>
                      <dt>พื้นที่จัดรายการ</dt>
                      <dd>{{ iconv('TIS-620','UTF-8',$r->vicinity) }}</dd>
                      <dt>Remark</dt>
                      <dd>{{ iconv('TIS-620','UTF-8',$r->remark) }}</dd>
                      <dt>StatusDocument</dt>
                      <dd>{{ $r->statusdocument }}</dd>
                      <dt>หมายเหตุ</dt>
                      <dd><textarea class="form-control" id="txt-{{ $r->promotionid }}" rows="2" style="width: 40%;"></textarea></dd>
                    </dl>
                </div>
              </div>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
              <button type="button" class="btn btn-success btn-flat">อนุมัติ</button>
              <button type="button" class="btn btn-warning btn-flat">แก้ไข</button>
              <button type="button" class="btn btn-danger btn-flat">ไม่อนุมัติ</button>
            </div>
          </div><!-- /.box -->
          @endforeach
        </section><!-- /.content -->
@stop
@section('footer')
    {{ HTML::script('TemplateAdmin/plugins/datepicker/bootstrap-datepicker.js') }}
    {{ HTML::script('TemplateAdmin/plugins/datepicker/bootstrap-datepicker-thai.js') }}
    {{ HTML::script('TemplateAdmin/plugins/datepicker/locales/bootstrap-datepicker.th.js?var=01') }}

    {{ HTML::script('TemplateAdmin/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}
    {{ HTML::script('TemplateAdmin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5_new.js') }}
    {{ HTML::script('TemplateAdmin/plugins/datatables/jquery.dataTables.min.js') }}
     {{ HTML::script('TemplateAdmin/plugins/datatables/extensions/FixedColumns/js/dataTables.fixedColumns.js') }}
    {{ HTML::script('TemplateAdmin/plugins/datatables/dataTables.bootstrap.min.js') }}
    <script type="text/javascript">
      $(function () {
          $('.btn-success').click(function(){
            var obj = $(this).parent().parent();
            var id_confirm = $(this).parent().parent().attr('id');
            $.post( "{{ url('Confirm') }}", { id:id_confirm,note:$('#txt-'+id_confirm).val() }, function( data ) {
              if(data.trim()=='true'){
                $('#'+id_confirm).slideUp("normal", function() { $(this).remove(); } );
              }
              else{
                alert(data);
              }
            });
          });
          $('.btn-warning').click(function(){
            var obj = $(this).parent().parent();
            var id_confirm = $(this).parent().parent().attr('id');
            $.post( "{{ url('Edit') }}", { id:id_confirm,note:$('#txt-'+id_confirm).val() }, function( data ) {
              if(data.trim()=='true'){
                $('#'+id_confirm).slideUp("normal", function() { $(this).remove(); } );
              }
              else{
                alert(data);
              }
            });
          });
          $('.btn-danger').click(function(){
            var obj = $(this).parent().parent();
            var id_confirm = $(this).parent().parent().attr('id');
            $.post( "{{ url('Close') }}", { id:id_confirm,note:$('#txt-'+id_confirm).val() }, function( data ) {
              if(data.trim()=='true'){
                $('#'+id_confirm).slideUp("normal", function() { $(this).remove(); } );
              }
              else{
                alert(data);
              }
            });
          });
        });
          

    </script>
@stop