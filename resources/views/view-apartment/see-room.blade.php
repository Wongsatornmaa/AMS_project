@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="pt-3">
            <div class="card border-dark">
                <div class="card-header">
                    <div class="col h3">รายละเอียดห้องเช่า {{ $room->number_room }}</div>
                </div>
                <div class="card-body text-dark">
                    <div class="ml-5 pb-2">
                        <h4>ข้อมูลสัญญาเช่า</h4>
                    </div>
                    <div class="form-row">
                        <div class="col-2"></div>
                        <div class="form-group col">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" for="fn_ln">ชื่อ - นามสกุลผู้เช่า</span>
                                </div>
                                <input type="text" class="form-control" id="fn_ln" value="-" disabled>
                            </div>
                        </div>
                        <div class="form-group col">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" for="citizen">บัตรประชาชน</span>
                                </div>
                                <input type="number" id="citizen" class="form-control" value="-" disabled>
                            </div>
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="form-row">
                        <div class="col-2"></div>
                        <div class="form-group col">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" for="amount_people">จำนวนผู้พักอาศัย</span>
                                </div>
                                <input type="text" id="amount_people" class="form-control" value="-" disabled>
                            </div>
                        </div>
                        <div class="form-group col">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" for="phone">เบอร์โทรศัพท์</span>
                                </div>
                                <input type="text" id="phone" class="form-control" value="-" disabled>
                            </div>
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="form-row">
                        <div class="col-2"></div>
                        <div class="form-group col">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" for="day_in">วันที่เริ่มทำสัญญา</span>
                                </div>
                                <input type="text" id="day_in" class="form-control" value="-" disabled>
                            </div>
                        </div>
                        <div class="form-group col">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" for="day-out">วันสิ้นสุดสัญญา</span>
                                </div>
                                <input type="text" id="day_out" class="form-control" value="-" disabled>
                            </div>
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="form-row">
                        <div class="col-2"></div>
                        <div class="form-group col">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" for="period">ระยะเวลาของสัญญา</span>
                                </div>
                                <input type="text" id="period" class="form-control" value="-" disabled>
                                <div class="input-group-append">
                                    <label class="input-group-text form-control" for="period">ปี</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col">
                            {{-- <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" for="blank">ระยะเวลาสัญญาที่เหลือ</span>
                                </div>
                                <input type="text" id="blank" class="form-control" value="" disabled>
                            </div> --}}
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <hr>
                    <div class="ml-5 mb-3">
                        <h4>ข้อมูลผู้ติดต่อกรณีฉุกเฉิน</h4>
                    </div>
                    <div class="form-row">
                        <div class="col-2"></div>
                        <div class="form-group col">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" for="emergency_name">ชื่อบุคคลติดต่อฉุกเฉิน</span>
                                </div>
                                <input type="text" id="emergency_name" class="form-control" value="-" disabled>
                            </div>
                        </div>
                        <div class="form-group col">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" for="relationship">ความสัมพันธ์</span>
                                </div>
                                <input type="text" id="relationship" class="form-control" value="-" disabled>
                            </div>
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="form-row">
                        <div class="col-2"></div>
                        <div class="form-group col">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" for="phone_relationship">เบอร์โทรศัพท์</span>
                                </div>
                                <input type="text" id="phone_relationship" class="form-control" value="-" disabled>
                            </div>
                        </div>
                        <div class="col">

                        </div>
                        <div class="col-2">

                        </div>
                    </div>
                    <a href="{{ route('viewAms') }}" type="button" class="btn btn-secondary">ย้อนกลับ</a>
                </div>
            </div>
        </div>
    </div>
@endsection
