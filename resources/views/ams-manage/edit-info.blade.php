@extends('layouts.app')

@include('ams-manage.modal-addInfo')

@section('content')
    <div class="container-fluid">
        <div class="pt-3">
            <div class="card border-dark mb-3">
                <div class="card-header">แก้ไขอาคาร</div>
                <div class="card-body text-dark">
                    <form method="POST" action="{{ route('update', $buildingDetail->id) }}" id="submitForm">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ชื่ออาคาร</span>
                            </div>
                            <input type="text" name="building_name" class="form-control"
                            value="{{ !empty($buildingDetail->building_name) ? $buildingDetail->building_name : '-' }}"
                            readonly>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">เบอร์ติดต่อ</span>
                            </div>
                            <input type="text" name="phone" class="form-control"
                            value="{{ !empty($buildingDetail->phone) ? $buildingDetail->phone : '-' }}" >
                        </div>
                        <hr>
                        <h5>สร้างจำนวนห้องเช่า</h5>
                        <br>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">จำนวนชั้น</span>
                            </div>
                            <input type="text" name="floor_count" class="form-control"
                            value="{{ !empty($buildingDetail->floor_count) ? $buildingDetail->floor_count : '-' }}"
                            readonly>
                            <div class="input-group-append">
                                <span class="input-group-text">ชั้น</span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">จำนวนห้อง</span>
                            </div>
                            <input type="text" name="room_count" class="form-control"
                            value="{{ !empty($buildingDetail->room_count) ? $buildingDetail->room_count : '-' }}" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text">ห้อง/ชั้น</span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ค่าน้ำ</span>
                            </div>
                            <input type="text" name="price_water" class="form-control"
                            value="{{ !empty($buildingDetail->price_water) ? $buildingDetail->price_water : '-' }}">
                            <div class="input-group-append">
                                <span class="input-group-text">บาท/หน่วย</span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ค่าไฟ</span>
                            </div>
                            <input type="text" name="price_electric" class="form-control"
                            value="{{ !empty($buildingDetail->price_electric) ? $buildingDetail->price_electric : '-' }}">
                            <div class="input-group-append">
                                <span class="input-group-text">บาท/หน่วย</span>
                            </div>
                        </div>
                        <br><br>
                        <a href="{{ route('home') }}" class=" btn btn-secondary">ย้อนกลับ</a>
                        <button type="button" class="buttonAddInfo btn btn-success" data-toggle="modal"
                            data-target="#modalApprove">
                            บันทึก </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showModalApprove() {
            $('#modalApprove').modal('show');
        }

        function submitForm() {
            document.getElementById("submitForm").submit();
        }
    </script>
@endsection
