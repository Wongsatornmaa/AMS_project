@extends('layouts-user.app')
@php
    $line_qrcode = asset('image/qrcode-bot.png');
@endphp
@section('content')
<div class="container-fluid pt-3">
    <div class="">
        <div class="card-header rounded m-2 bg-light" style="border:none;">
            <h3>อัพโหลดหลักฐานการโอนเงิน</h3>
        </div>
        <div class="card-body rounded m-2 bg-light">
            <div class="row">
                <div class="col-4 offset-4">
                    <div class="pb-3" style="padding: 0px 130px">
                        <div class="text-left">Line: BOT_AMS</div>
                    </div>
                    <div class="form-group" style="background-color:white; width:255px; height:255px; border:1px solid; margin: auto;">
                        <img src="{{ $line_qrcode }}" style=" width:250px; height:250px;">
                    </div>
                    <div class="pt-3" style="padding: 0px 100px">
                        <div class="text-left" style="color:red">* กรุณาอัพโหลดหลักฐานการโอนเงินที่ช่องทางนี้</div>
                    </div>
                </div>
            </div>
            <a href="{{ route ('homeUser')}}" class="btn btn-secondary">ย้อนกลับ <!-- image --></a>
        </div>
    </div>
</div>
@endsection