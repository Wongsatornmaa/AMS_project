@extends('layouts-user.app')
@include('payment-channel.lib.PromptPayQR')
@section('content')
<?Php
    //use App\Lib\PromptPayQR;
    //require_once("app/lib/PromptPayQR.php");
    //require_once('app/QRPayment.blade.php');
?>
<div class="container-fluid pt-3">
    <div class="">
        <div class="card-header rounded m-2 bg-light" style="border:none;">
            <h3>ชำระเงินผ่าน QR Code payment</h3>
        </div>
        <div class="card-body rounded m-2 bg-light">
            <div class="row">
                <div class="col-4 offset-4">
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
                    @if ($payment['qrcode'] != "[]")
                        <div class="form-group" style="background-color:white; width:275px; height:275px; border:1px solid; margin: auto;">
                            <!--QR Code payment -->
                            @foreach ($payment['qrcode'] as $index => $qrcode)
                            @php
                                $qrcode->summary += $summary_oth;
                            @endphp
                                <?php 
                                    $QRPayment = new PromptPayQR(); // new object
                                    $QRPayment->size = 6; // Set QR code size to 8
                                    $QRPayment->id = '0930278109'; // PromptPay ID
                                    $QRPayment->amount = $qrcode->summary;
                                    echo '<img src="' . $QRPayment->generate() . '" />';
                                ?>
                            @endforeach
                        </div>
                    @endif
                    <div class="pt-3" style="padding: 0px 120px">
                        <div class="row form-group">
                            <div class="col-6">ยอดรวม</div>
                            @if ($payment['qrcode'] != "[]")
                                @foreach ($payment['qrcode'] as $index => $qrcode)
                                    <div class="col-6 text-right">{{ number_format($qrcode->summary) }} บาท</div>
                                @endforeach
                            @else
                                <div class="col-6 text-right">0 บาท</div>
                            @endif
                        </div>
                        <div class="row form-group">
                            <div class="col-6">บัญชี</div>
                            <div class="col-6 text-right">ธณัช จินตกานนท์</div>
                        </div>
                        <div class="row form-group">
                            @if ($payment['qrcode'] != "[]")
                                <div class="form-group" style="margin: auto;">
                                    <a href="{{ route ('line')}}" class="btn btn-outline-secondary w-100">อัพโหลดหลักฐานการโอนเงิน</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route ('homeUser')}}" class="btn btn-secondary">ย้อนกลับ <!-- image --></a>
        </div>
    </div>
</div>
@endsection