@extends('layouts-user.app')

@section('content')
<div class="container-fluid pt-3">
    <div class="card border-dark mb-3">
        <div class="card-header">
            <h3>ดูประวัติค่าห้องเช่า</h3>
        </div>
        <div class="card-body text-dark">
            @php
                $temp_ind=0;
                $summary_oth = 0;
            @endphp
            @foreach ($billInfo['detailBill'] as $index => $bill)
                @php
                    $temp_ind += 1;
                @endphp
            @endforeach
            @foreach ($billInfo['detailBill'] as $index => $bill)
                    @php
                        $day = substr("$bill->date_bill",0,2);
                        $month = substr("$bill->date_bill",3,2);
                        $year = substr("$bill->date_bill",6,4);
                        $intMonth = intval($month);
                        $strMonth = strval($intMonth);
                        $monthArray = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม",
                        "มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
                        $monthThai = $monthArray[$strMonth];
                    @endphp
                @if($index == 1)
                    <h4>@php echo "$day $monthThai $year"; @endphp</h4><br>
                @elseif($temp_ind == 1)
                    <h4>@php echo "$day $monthThai $year"; @endphp</h4><br>
                @endif
            @endforeach
            <div class="form-group">
                <table class="table-bill">
                    <thead>
                        <tr>
                            <th rowspan="2" style="width:20%">รายการ</th>
                            <th colspan="2">เลขมิเตอร์ (หน่วย)</th>
                            <th rowspan="2">จำนวนมิเตอร์ <br> (หน่วย)</th>
                            <th rowspan="2">ราคา/หน่วย</th>
                            <th rowspan="2" style="width:20%">จำนวนเงิน (บาท)</th>
                        </tr>
                        <tr>
                            @foreach ($billInfo['detailBill'] as $index => $bill)
                                @php
                                    $month = substr("$bill->date_bill",3,2);
                                    $year = substr("$bill->date_bill",6,4);
                                    $intMonth = intval($month);
                                    $strMonth = strval($intMonth);
                                    $monthArray = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม",
                                    "มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
                                    $monthThai = $monthArray[$strMonth];
                                @endphp
                                @if($temp_ind == 1)
                                    <th>ครั้งก่อน</th>
                                    <th>ครั้งล่าสุด (@php echo "$monthThai $year"; @endphp)</th>
                                @else
                                    @if($index == 0)
                                        <th>ครั้งก่อน (@php echo "$monthThai $year"; @endphp)</th>
                                    @elseif($index == 1)
                                        <th>ครั้งล่าสุด (@php echo "$monthThai $year"; @endphp)</th>
                                    @endif
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($billInfo['detailBill'] as $index => $bill)
                            @if($index == 1 || $temp_ind == 1)
                                <tr>
                                    <td> - ค่าเช่า </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class='text-right'>{{ number_format($bill->rent) }}</td>
                                </tr>
                                <tr>
                                    <td> - ค่าน้ำ </td>
                                    @foreach ($billInfo['detailBill'] as $index => $bill)
                                        @if($temp_ind == 1)
                                            <td class='text-center'>-</td>
                                            <td class='text-right'>{{ number_format($bill->mitor_water) }}</td>
                                        @else 
                                            <td class='text-right'>{{ $bill->mitor_water }}</td>
                                        @endif
                                    @endforeach
                                    @php
                                        $temp = 0;
                                        $num_mitor_water = 0;
                                    @endphp
                                    @foreach ($billInfo['detailBill'] as $index => $bill)
                                        @if($temp_ind == 1)
                                            @php
                                                $num_mitor_water = $bill->mitor_water;
                                            @endphp
                                        @else
                                            @if($index == 0)
                                                @php
                                                    $temp = $bill->mitor_water;
                                                @endphp
                                            @endif
                                            @if($index == 1) 
                                                @php
                                                    $num_mitor_water = $bill->mitor_water - $temp;
                                                @endphp
                                            @endif
                                        @endif
                                    @endforeach
                                    <td class='text-right'>@php echo "$num_mitor_water"; @endphp</td> 
                                    <td class='text-right'>{{ $bill->price_water }}</td>
                                    <td class='text-right'>{{ $bill->summary_water }}</td>
                                </tr>
                                <tr>
                                    <td> - ค่าไฟ </td>
                                    @foreach ($billInfo['detailBill'] as $index => $bill)
                                        @if($temp_ind == 1)
                                            <td class='text-center'>-</td>
                                            <td class='text-right'>{{ $bill->mitor_electric }}</td>
                                        @else 
                                            <td class='text-right'>{{ $bill->mitor_electric }}</td>
                                        @endif
                                    @endforeach
                                    @php
                                        $temp = 0;
                                        $num_mitor_electric = 0;
                                    @endphp
                                    @foreach ($billInfo['detailBill'] as $index => $bill)
                                        @if($temp_ind == 1)
                                            @php
                                                $num_mitor_electric = $bill->mitor_electric;
                                            @endphp
                                        @else
                                            @if($index == 0)
                                                @php
                                                    $temp = $bill->mitor_electric;
                                                @endphp
                                            @endif
                                            @if($index == 1) 
                                                @php
                                                    $num_mitor_electric = $bill->mitor_electric - $temp;
                                                @endphp
                                            @endif
                                        @endif
                                    @endforeach
                                    <td class='text-right'>@php echo number_format($num_mitor_electric); @endphp</td>
                                    <td class='text-right'>{{ number_format($bill->price_electric) }}</td>
                                    <td class='text-right'>{{ number_format($bill->summary_electric) }}</td>
                                </tr>
                           @endif 
                        @endforeach
                        <!-- <tr style="border: 1px solid #707070;">
                            <td colspan="6">รายการอื่นๆ</td>
                        </tr> -->
                        @if ($billInfo['otherService'] != null)
                            @foreach ($billInfo['otherService'] as $service)
                                <tr>
                                    <td>- {{ $service->name_other }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class='text-right'>{{ number_format($service->price_other) }}</td>
                                </tr>
                                @php
                                    $summary_oth += $service->price_other;
                                @endphp
                            @endforeach
                        @endif
                        @foreach ($billInfo['detailBill'] as $index => $bill)
                            @php
                                $bill->summary += $summary_oth;
                            @endphp
                            @if($temp_ind == 1)
                                <tr>
                                    <td colspan="5">ยอดรวม</td>
                                    <td class='text-right'>{{ number_format($bill->summary) }}</td>
                                </tr>
                            @elseif($index == 1)
                                <tr>
                                    <td colspan="5">ยอดรวม</td>
                                    <td class='text-right'>{{ number_format($bill->summary) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route ('roomHis')}}" class="btn btn-secondary">ย้อนกลับ</a>
        </div>
    </div>
</div>
@endsection