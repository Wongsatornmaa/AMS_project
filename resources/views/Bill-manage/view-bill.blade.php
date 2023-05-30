@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="pt-3">
            <div class="card border-dark">
                <div class="card-header">
                    <div class="row">
                        <div class="col">ดูค่าเช่าห้อง</div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" id="billForm" action="{{ route('saveBill', $billroomDetail->id) }}">
                        @csrf
                        <input type="hidden" name="bill_id" id="billId" value="{{ $billroomDetail->id }}">
                        <h3>ห้อง : {{ $billroomDetail->number_room }}</h3>
                        <h3>วันที่ : {{ $billroomDetail->date_bill }}</h3>
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="col-4 col-form-label" class="">
                                    <h5> รายการ</h5>
                                </label>
                            </div>
                            <div class="col-4">
                                <label for="col-4 col-form-label" class="">
                                    <h5> จำนวนเงิน(บาท)</h5>
                                </label>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="inputRent" class="col-sm-4 col-form-label">ค่าห้อง</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="inputRent" placeholder="ค่าห้อง"
                                    value="{{ !empty($billroomDetail->rent) ? $billroomDetail->rent : '-' }}" name="rent"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputWater" class="col-sm-4 col-form-label">ค่าน้ำเดือนที่แล้ว</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="inputWater" placeholder="ค่าน้ำ"
                                    value="{{ !empty($beforeDateBill->summary_water) ? $beforeDateBill->summary_water : '-' }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputWater" class="col-sm-4 col-form-label">ค่าน้ำเดือนปัจจุบัน {{ $billroomDetail->date_bill }}</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="inputWater" placeholder="ค่าน้ำ"
                                    value="{{ !empty($billroomDetail->summary_water) ? $billroomDetail->summary_water : '-' }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputElectric" class="col-sm-4 col-form-label">ค่าไฟเดือนที่แล้ว</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="inputElectric" placeholder="ค่าไฟ"
                                    value="{{ !empty($beforeDateBill->summary_electric) ? $beforeDateBill->summary_electric : '-' }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputElectric" class="col-sm-4 col-form-label">ค่าไฟเดือนปัจจุบัน {{ $billroomDetail->date_bill }}</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="inputElectric" placeholder="ค่าไฟ"
                                    value="{{ $billroomDetail->summary_electric }}" readonly>
                            </div>
                        </div>
                        {{-- dynamicForm --}}
                        <div class="all-service">
                            @if ($otherService != NULL)
                            <hr>
                            <p>รายการอื่นๆ</p>
                                @foreach ($otherService as $service)
                                    <div class="form-group row service">
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="inputService" placeholder="รายการ"
                                                name="inputService"
                                                value="{{ !empty($service->name_other) ? $service->name_other : '-' }}"
                                                readonly>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="inputPrice" placeholder="ราคา"
                                                name="inputPrice"
                                                value="{{ !empty($service->price_other) ? $service->price_other : '-' }}"
                                                readonly>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            
                        </div>
                        {{-- dynamicForm --}}
                        <br>
                        <div class="form-row">
                            <div class="form-group col text-left">
                                <a href="{{ route('bill') }}" class="btn btn-secondary">ย้อนกลับ</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            success: function(data) {

            },
            error: function(error) {
                console.log('error')
            }
        });
    </script>
@endsection
