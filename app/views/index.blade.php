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
    input[type='radio']{
      width: 15px;
    height: 15px;
    }
    </style>
@stop
@section('content')

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">------------</h3>
              <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
            @if (count($errors) > 0)
                <div class="row">
                  <div class="col-xs-12">
                    <div class="alert alert-danger alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      @foreach($errors->all() as $error)
                        <p><?php echo $error;?></p>
                      @endforeach
                    </div>
                  </div>
                </div>
              @endif
              <div class="row">
                <div class="col-md-12">
                    <table id="tb1" class="table table-bordered">
                     <thead>
                        <tr>
                          <th><a href="javascript:void(0)" class="conf">อนุมัติ</a></th>
                          <th><a href="javascript:void(0)" class="edit">แก้ไข</a></th>
                          <th><a href="javascript:void(0)" class="cenc">ไม่อนุมัติ</a></th>
                          <th>PromotionID</th>
                          <th>PMDate</th>
                          <th>DateStart</th>
                          <th>DateEnd</th>
                          <th>DocGroup</th>
                          <th></th>
                          <th>Grade</th>
                          <th>DiscountGP</th>
                          <th>DiscountDetail</th>
                          <th>DiscountInformation</th>
                          <th>ShareJit</th>
                          <th>ShareCustomer</th>
                          <th>ConditionalCash</th>
                          <th>Vicinity</th>
                          <th>ProductWant</th>
                          <th>Remark</th>
                          <th>StatusDocument</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($result as $k => $r)
                        <?php 
                          $max = Promotion::where('RefPromotionMain',$r->promotionid)->max('promotionid');
                        ?>
                        <tr>
                            <td class="text-center"><label><input type="radio" class="conf" name="{{ $r->promotionid }}"></label></td>
                            <td class="text-center"><label><input type="radio" class="edit" name="{{ $r->promotionid }}"></label></td>
                            <td class="text-center"><label><input type="radio" class="cenc" name="{{ $r->promotionid }}"></label></td>
                            <td>
                                @if($max!='')
                                  <b>{{ $r->promotionid }} - {{ $max }}</b>
                                @else
                                  {{ $r->promotionid }}
                                @endif
                            </td>
                            <td>{{ iconv('TIS-620','UTF-8',$r->pmdate) }}</td>
                            <td>{{ iconv('TIS-620','UTF-8',$r->startdate) }}</td>
                            <td>{{ iconv('TIS-620','UTF-8',$r->enddate) }}</td>
                            <td>
                              @if(trim(iconv('TIS-620','UTF-8',$r->docgroup))=='จัดรายการ')
                                <span class="label label-success">{{ iconv('TIS-620','UTF-8',$r->docgroup) }}</span>
                              @else
                                <span class="label label-danger">{{ iconv('TIS-620','UTF-8',$r->docgroup) }}</span>
                              @endif
                            </td>
                            <td>
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
                            </td>
                            <td>{{ iconv('TIS-620','UTF-8',$r->productgrade) }}</td>
                            <td class="text-right">{{ $r->discount_gp }}</td>
                            <td class="text-right">{{ $r->discount_detail }}</td>
                            <td>{{ iconv('TIS-620','UTF-8',$r->discountinformation) }}</td>
                            <td class="text-right">{{ $r->share_jit }}</td>
                            <td class="text-right">{{ $r->share_customer }}</td>
                            <td>{{ iconv('TIS-620','UTF-8',$r->conditional_cash) }}</td>
                            <td>{{ iconv('TIS-620','UTF-8',$r->vicinity) }}</td>
                            <td>{{ iconv('TIS-620','UTF-8',$r->productwant) }}</td>
                            <td>{{ iconv('TIS-620','UTF-8',$r->remark) }}</td>
                            <td>{{ $r->statusdocument }}</td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                </div>
              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
            </div><!-- /.box-footer-->
          </div><!-- /.box -->
          
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
          $('#date').datepicker({
              language:'th-en',
              format: "mm/yyyy",
              startView: "months", 
              minViewMode: "months"
            });
          var table = $('#tb1').DataTable( {
                scrollY:        "500px",
                scrollX:        true,
                scrollCollapse: true,
                paging:         false,
                ordering: false,
                fixedColumns:   {
                                leftColumns: 4,
                                rightColumns: 0
                                }
            });
          $('th a').click(function(){
            var cla = $(this).attr('class');
            $('td input[type="radio"][class="'+cla+'"]').prop("checked", true);
          });
        });
          

    </script>
@stop