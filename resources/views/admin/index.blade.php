@extends('admin.layout')
@section('content')

    <div id="page-wrapper" class="gray-bg">
        <div class="wrapper wrapper-content animated fadeIn">

            <div class="p-w-md m-t-sm">



                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h3>最新车用气瓶登记信息</h3>

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <td>序号</td>
                                            <td>车牌号码</td>
                                            <td>充装介质</td>
                                            <td>安装单位</td>
                                            <td>安装日期</td>
                                        </tr>
                                        </thead>	
                                        <tbody>
					    
					    @foreach($res as $key=>$val)
						<tr>
						    <td>{{ $key }}</td>
						    <td>{{ $val->license_plate }}</td>
						    @if($val->product == 0)
							<td>未知</td>
						    @elseif($val->product == 1)
							<td>压缩天然气</td>
						    @elseif($val->product == 2)
							<td>液化天然气</td>
						    @elseif($val->product == 3)
							<td>液化石油气</td>
						    @endif
						    <td>{{ $val->install_unit }}</td>
						    <td>{{ date("Y-m-d",$val->install_date) }}</td>
						</tr>
					    @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
