@extends('layouts.app')

@include('ams-manage.modal-addInfo')

@section('content')
    <div class="container-fluid">
        <div class="pt-3">
            <div class="card border-dark mb-3">
                <div class="card-header h4">สร้างอาคาร</div>
                <div class="card-body text-dark">
                    <form method="POST" action="{{ route('saveInfo') }}" id="submitForm">
                        @csrf
                        @error('building_name')
                            <div class="text-red list-none">{{ $message }}</div>
                        @enderror
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">ชื่ออาคาร</label>
                            </div>
                            <select class="custom-select" name="building_name">
                                @php
                                    foreach (range('A', 'Z') as $column) {
                                        echo "<option value='$column'>  $column </option>";
                                    }
                                @endphp
                            </select>
                        </div>
                        @error('phone')
                            <div class="text-red list-none">{{ $message }}</div>
                        @enderror
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">เบอร์ติดต่อ</span>
                            </div>
                            <input type="text" class="form-control" name="phone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                        </div>
                        <hr>
                        <h5>สร้างจำนวนห้องเช่า</h5>
                        <br>
                        @error('floor_count')
                            <div class="text-red list-none">{{ $message }}</div>
                        @enderror
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">จำนวนชั้น</span>
                            </div>
                            <input type="text" class="form-control" name="floor_count" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                            <div class="input-group-append">
                                <span class="input-group-text">ชั้น</span>
                            </div>
                        </div>
                        @error('room_count')
                            <div class="text-red list-none">{{ $message }}</div>
                        @enderror
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">จำนวนห้อง</span>
                            </div>
                            <input type="text" class="form-control" name="room_count" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                            <div class="input-group-append">
                                <span class="input-group-text">ห้อง/ชั้น</span>
                            </div>
                        </div>
                        @error('price_water')
                            <div class="text-red list-none">{{ $message }}</div>
                        @enderror
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ค่าน้ำ</span>
                            </div>
                            <input type="text" class="form-control" name="price_water" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                            <div class="input-group-append">
                                <span class="input-group-text">บาท/หน่วย</span>
                            </div>
                        </div>
                        @error('price_electric')
                            <div class="text-red list-none">{{ $message }}</div>
                        @enderror
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ค่าไฟ</span>
                            </div>
                            <input type="text" class="form-control" name="price_electric" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                            <div class="input-group-append">
                                <span class="input-group-text">บาท/หน่วย</span>
                            </div>
                        </div>
                        @error('deposit')
                            <div class="text-red list-none">{{ $message }}</div>
                        @enderror
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> เงินประกันค่าห้อง</span>
                            </div>
                            <input type="text" class="form-control" name="deposit" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                            <div class="input-group-append">
                                <span class="input-group-text">บาท/ห้อง</span>
                            </div>
                        </div>
                        <br><br>
                        <a href="{{ route('home') }}" class=" btn btn-secondary">ย้อนกลับ</a>
                        {{-- <input type="submit" name="submit" value="บันทึก" class=" buttonAddInfo btn btn-success" onclick="showModalApprove()"> --}}
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
