@extends('layouts-user.app')

@section('content')
<div class="container-fluid pt-3">
    <div class="">
        <div class="card-header rounded m-2 bg-light" style="border:none;">
            <h3>ชำระเงินผ่านเงินผ่านธนาคาร</h3>
        </div>
        <div class="card-body rounded m-2 bg-light">
            <div class="row">
                <div class="col-3 offset-3">
                    <div class="card card-body card-bank">
                        <p>ธนาคาร กสิกรไทย</p>
                        <p>777-6-999555</p>
                        <p>บัญชี: นาย สมชาย สุขสวัสดิ์</p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card card-body card-bank">
                        <p>ธนาคาร กสิกรไทย</p>
                        <p>777-6-999555</p>
                        <p>บัญชี: นาย สมชาย สุขสวัสดิ์</p>
                    </div>
                </div>
                <div class="col-6 offset-3" style="margin: auto;">
                    <div class="row form-group">
                        <div class="col-2 form-group">ยอดรวม</div>
                        @php
                            $summary_oth = 0;
                        @endphp
                        @if ($payment['otherService'] != null)
                            @foreach ($payment['otherService'] as $service)
                                    @php
                                        $summary_oth += $service->price_other;
                                    @endphp
                            @endforeach
                        @endif
                        @if ($payment['bank'] != "[]")
                            @foreach ($payment['bank'] as $index => $bank)
                            @php
                                $bank->summary += $summary_oth;
                            @endphp
                                <div class="col-10 form-group">{{ number_format($bank->summary) }} บาท</div>
                            @endforeach
                            <div class="col-4 form-group">
                                <a href="{{ route ('line')}}" class="btn btn-outline-secondary form-group">อัพโหลดหลักฐานการโอนเงิน</a>
                            </div>
                        @else
                            <div class="col-10 form-group">0 บาท</div>
                        @endif
                        
                    </div>
                </div>
            </div>
            <a href="{{ route ('homeUser')}}" class="btn btn-secondary">ย้อนกลับ</a>
        </div>
    </div>
</div>
@endsection