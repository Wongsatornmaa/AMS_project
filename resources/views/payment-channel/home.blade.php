@extends('layouts-user.app')

@section('content')
    <div class="container-fluid pt-3">
        <div class="card border-dark mb-3">
            <div class="card-header" style="border:none;">
                <h3>ดูรายละเอียดค่าห้องเช่า {{ $billInfo['showInfo']->number_room }}</h3>
            </div>
            <div class="card-body text-dark">
                <div class="row">
                    <div class="col-8 pr-4">
                        @php
                            $temp_ind = 0;
                            $summary_oth = 0;
                        @endphp
                        @foreach ($billInfo['bill'] as $index => $bill)
                            @php
                                $temp_ind += 1;
                            @endphp
                        @endforeach
                        @foreach ($billInfo['bill'] as $index => $bill)
                            @php
                                $day = substr("$bill->date_bill", 0, 2);
                                $month = substr("$bill->date_bill", 3, 2);
                                $year = substr("$bill->date_bill", 6, 4);
                                $intMonth = intval($month);
                                $strMonth = strval($intMonth);
                                $monthArray = ['', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
                                $monthThai = $monthArray[$strMonth];
                            @endphp
                            @if ($index == 1)
                                <h4>@php echo "$day $monthThai $year"; @endphp</h4><br>
                            @elseif($temp_ind == 1)
                                <h4>@php echo "$day $monthThai $year"; @endphp</h4><br>
                            @endif
                        @endforeach
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
                                    @if ($billInfo['bill'] == '[]'|| $bill->mitor_water == null || $bill->mitor_electric == null)
                                        <th>ครั้งก่อน</th>
                                        <th>ครั้งล่าสุด</th>
                                    @else
                                        @foreach ($billInfo['bill'] as $index => $bill)
                                            @php
                                                $month = substr("$bill->date_bill", 3, 2);
                                                $year = substr("$bill->date_bill", 6, 4);
                                                $intMonth = intval($month);
                                                $strMonth = strval($intMonth);
                                                $monthArray = ['', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
                                                $monthThai = $monthArray[$strMonth];
                                            @endphp

                                            @if ($temp_ind == 1)
                                                <th>ครั้งก่อน</th>
                                                <th>ครั้งล่าสุด (@php echo "$monthThai $year"; @endphp)</th>
                                            @else
                                                @if ($index == 0)
                                                    <th>ครั้งก่อน (@php echo "$monthThai $year"; @endphp)</th>
                                                @elseif($index == 1)
                                                    <th>ครั้งล่าสุด (@php echo "$monthThai $year"; @endphp)</th>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                </tr>
                            </thead>
                            @if ($billInfo['bill'] == '[]' || $bill->mitor_water == null || $bill->mitor_electric == null)
                                <td colspan="6" class='text-center'><b>ไม่พบข้อมูล</b></td>
                            @else
                                @foreach ($billInfo['bill'] as $index => $bill)
                                    @if ($index == 1 || $temp_ind == 1)
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
                                            @foreach ($billInfo['bill'] as $index => $bill)
                                                @if ($temp_ind == 1)
                                                    <td class='text-center'>-</td>
                                                    <td class='text-right'>{{ number_format($bill->mitor_water) }}</td>
                                                @else
                                                    <td class='text-right'>{{ number_format($bill->mitor_water) }}</td>
                                                @endif
                                            @endforeach
                                            @php
                                                $temp = 0;
                                                $num_mitor_water = 0;
                                            @endphp
                                            @foreach ($billInfo['bill'] as $index => $bill)
                                                @if ($temp_ind == 1)
                                                    @php
                                                        $num_mitor_water = $bill->mitor_water;
                                                    @endphp
                                                @else
                                                    @if ($index == 0)
                                                        @php
                                                            $temp = $bill->mitor_water;
                                                        @endphp
                                                    @endif
                                                    @if ($index == 1)
                                                        @php
                                                            $num_mitor_water = $bill->mitor_water - $temp;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endforeach
                                            <td class='text-right'>@php echo number_format($num_mitor_water); @endphp</td>
                                            <td class='text-right'>{{ number_format($bill->price_water) }}</td>
                                            <td class='text-right'>{{ number_format($bill->summary_water) }}</td>
                                        </tr>
                                        <tr>
                                            <td> - ค่าไฟ </td>
                                            @foreach ($billInfo['bill'] as $index => $bill)
                                                @if ($temp_ind == 1)
                                                    <td class='text-center'>-</td>
                                                    <td class='text-right'>{{ number_format($bill->mitor_electric) }}</td>
                                                @else
                                                    <td class='text-right'>{{ number_format($bill->mitor_electric) }}</td>
                                                @endif
                                            @endforeach
                                            @php
                                                $temp = 0;
                                                $num_mitor_electric = 0;
                                            @endphp
                                            @foreach ($billInfo['bill'] as $index => $bill)
                                                @if ($temp_ind == 1)
                                                    @php
                                                        $num_mitor_electric = $bill->mitor_electric;
                                                    @endphp
                                                @else
                                                    @if ($index == 0)
                                                        @php
                                                            $temp = $bill->mitor_electric;
                                                        @endphp
                                                    @endif
                                                    @if ($index == 1)
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
                                            @php
                                                $summary_oth += $service->price_other;
                                            @endphp
                                        </tr>
                                    @endforeach
                                @endif
                                @foreach ($billInfo['bill'] as $index => $bill)
                                    @php
                                        $bill->summary += $summary_oth;
                                    @endphp
                                    @if ($temp_ind == 1)
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
                            @endif
                        </table>
                    </div>

                    <div class="col-4 pl-4" style="border-left: 1px solid silver;">
                        <div></div>
                        <h4>ช่องทางชำระเงิน</h4><br>
                        @if ($billInfo['bill'] == '[]' || $bill->mitor_water == null || $bill->mitor_electric == null)
                            <div class="form-group"><a href="{{ route('qrCode') }}"
                                    class="btn btn-outline-secondary w-75 disabled" aria-disabled="true"
                                    style="background-color:silver">ชำระผ่าน QR Code payment</a></div>
                            <div class="form-group"><a href="{{ route('bank') }}"
                                    class="btn btn-outline-secondary w-75 disabled" aria-disabled="true"
                                    style="background-color:silver">โอนเงินผ่านธนาคาร</a></div>
                        @else
                            <div class="form-group"><a href="{{ route('qrCode') }}"
                                    class="btn btn-outline-secondary w-75">ชำระผ่าน QR Code payment</a></div>
                            <div class="form-group"><a href="{{ route('bank') }}"
                                    class="btn btn-outline-secondary w-75">โอนเงินผ่านธนาคาร</a></div>
                        @endif

                    </div>

                    <div class="col-12 pt-2">
                        <hr>
                        <h4>ข้อมูลสัญญาห้องเช่า</h4><br>

                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text form-control text-addAc">วันที่เริ่มสัญญา</span>
                                    </div>
                                    <input type="text" value="{{ $billInfo['showInfo']->day_in }}" class="form-control"
                                        disabled>
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text form-control text-addAc">วันสิ้นสุดสัญญา</span>
                                    </div>
                                    <input type="text" value="{{ $billInfo['showInfo']->day_out }}"
                                        class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text form-control text-addAc">ค่าเช่าต่อเดือน</span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ number_format($billInfo['showInfo']->rent) }}"
                                        aria-describedby="inputGroupPrepend" disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text form-control" id="inputGroupPrepend">บาท </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text form-control text-addAc">เงินประกัน</span>
                                    </div>
                                    <input type="text" class="form-control"
                                        value="{{ number_format($billInfo['showInfo']->deposit) }}" aria-describedby="inputGroupPrepend"
                                        disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text form-control" id="inputGroupPrepend">บาท </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text form-control text-addAc">จำนวนผู้อยู่อาศัย</span>
                                    </div>
                                    <input type="text" class="form-control"
                                        value="{{ $billInfo['showInfo']->amount_people }}"
                                        aria-describedby="inputGroupPrepend" disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text form-control" id="inputGroupPrepend">คน </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text form-control text-addAc">สัญญาเช่า</span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $billInfo['showInfo']->period }}" disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text form-control" id="inputGroupPrepend">ปี</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text form-control text-addAc">ค่าน้ำ/หน่วย</span>
                                    </div>
                                    <input type="text" class="form-control"
                                        value="{{ $billInfo['showInfo']->price_water }}"
                                        aria-describedby="inputGroupPrepend" disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text form-control" id="inputGroupPrepend">บาท </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text form-control text-addAc">ค่าไฟ/หน่วย</span>
                                    </div>
                                    <input type="text" class="form-control"
                                        value="{{ $billInfo['showInfo']->price_electric }}"
                                        aria-describedby="inputGroupPrepend" disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text form-control" id="inputGroupPrepend">บาท </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
