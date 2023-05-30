@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="pt-3">
            <div class="card border-dark">
                <div class="card-header">
                    <div class="row">
                        <div class="col h4">
                            กรอกสัญญาห้องเช่า
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('createMemberInfo') }}" id="submitForm">
                        @csrf
                        <h5>ข้อมูลการเช่า</h5>
                        <div class="row">
                            <div class="col">
                                @error('building')
                                    <div class="text-red list-none">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                @error('number_room')
                                    <div class="text-red list-none">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text form-control" for="buildingId">ตึก *</label>
                                    </div>
                                    <select name="building" class="custom-select" id="buildingId">
                                        <option selected>เลือกตึก</option>
                                        @foreach ($building as $index => $building)
                                            <option value="{{ $building->id }}">{{ $building->building_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text form-control" for="roomNumber">ห้อง *</label>
                                    </div>
                                    <select name="number_room" class="custom-select" id="roomNumber">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                @error('day_in')
                                    <div class="text-red list-none">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                @error('day_out')
                                    <div class="text-red list-none">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                @error('period')
                                    <div class="text-red list-none">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="dayIn">วันเริ่มทำสัญญา *</label>
                                    </div>
                                    <input type="date" class="form-control" id="dayIn" name="day_in" placeholder="">
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="dayOut">วันสิ้นสุดสัญญา *</label>
                                    </div>
                                    <input type="date" class="form-control" id="dayOut" name="day_out" placeholder="">
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text form-control" for="period">ระยะเวลาสัญญาเช่า
                                            *</label>
                                    </div>
                                    <input type="text" class="form-control" id="period" name="period" placeholder="">
                                    <div class="input-group-append">
                                        <label class="input-group-text form-control" for="period">ปี</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                @error('rent')
                                    <div class="text-red list-none">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                @error('deposit')
                                    <div class="text-red list-none">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="rent">ค่าเช่าห้องต่อเดือน *</label>
                                    </div>
                                    <input type="text" class="form-control" id="rent" name="rent" placeholder="x,xxx">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="rent">บาท</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="deposit">เงินประกันค่าห้อง *</label>
                                    </div>
                                    <input type="text" class="form-control" id="deposit" name="deposit"
                                        placeholder="x,xxx">
                                    <div class="input-group-append">
                                        <span class="input-group-text">บาท</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text form-control" for="mitorWater">ค่าน้ำหน่วยละ</label>
                                    </div>
                                    <input type="text" class="form-control" id="mitorWater" name="mitor_water" value=""
                                        placeholder="xxx" disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text">บาท</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text form-control"
                                            for="mitorElectric">ค่าไฟหน่วยละ</label>
                                    </div>
                                    <input type="text" class="form-control" id="mitorElectric" name="mitor_electric"
                                        placeholder="xxx" disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text">บาท</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                @error('amount-people')
                                    <div class="text-red list-none">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col"></div>
                            <div class="col"></div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text form-control" for="amountPeople">จำนวนผู้อาศัย
                                            *</label>
                                    </div>
                                    <select class="custom-select" id="amountPeople" name="amount_people">
                                        <option>เลือกจำนวนผู้อยู่อาศัย</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                    <div class="input-group-append">
                                        <label class="input-group-text form-control" for="amountPeople">คน</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col">

                            </div>
                            <div class="form-group col">

                            </div>

                        </div>
                        <hr>
                        <h5>ข้อมูลผู้เช่า</h5>
                        <div class="row">
                            <div class="col">
                                @error('first_name')
                                    <div class="text-red list-none">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                @error('last_name')
                                    <div class="text-red list-none">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text form-control" for="firstName">ชื่อ *</label>
                                    </div>
                                    <input type="text" class="form-control" id="firstName" name="first_name"
                                        placeholder="ชื่อจริง">
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text form-control" for="lastName">นามสกุล *</label>
                                    </div>
                                    <input type="text" class="form-control" id="lastName" name="last_name"
                                        placeholder="นามสกุล">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                @error('phone')
                                    <div class="text-red list-none">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                @error('citizen')
                                    <div class="text-red list-none">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text form-control" for="phoneNumber">เบอร์โทรศัพท์
                                            *</label>
                                    </div>
                                    <input type="text" class="form-control" id="phoneNumber" name="phone"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        placeholder="" maxlength="10" minlength="10">
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text form-control" for="citizen">เลขบัตรประชาชน *</label>
                                    </div>
                                    <input type="text" class="form-control" id="citizen"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        name="citizen" placeholder="" maxlength="13" minlength="13">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                @error('date_of_birth')
                                    <div class="text-red list-none">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                @error('email')
                                    <div class="text-red list-none">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text form-control" for="date_of_birth">วันเกิด</label>
                                    </div>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text form-control" for="email">Email</label>
                                    </div>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="example@example.com">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                @error('line')
                                    <div class="text-red list-none">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                @error('facebook')
                                    <div class="text-red list-none">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text form-control" for="line">Line</label>
                                    </div>
                                    <input type="text" class="form-control" id="line" name="line" placeholder="">
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text form-control" for="Facebook">Facebook</label>
                                    </div>
                                    <input type="text" class="form-control" id="Facebook" name="facebook" placeholder="">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h5>ข้อมูลผู้ติดต่อกรณีฉุกเฉิน</h5>
                        <div class="row">
                            <div class="col">
                                @error('name_emergency')
                                    <div class="text-red list-none">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                @error('relation')
                                    <div class="text-red list-none">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                @error('phone_relationtion')
                                    <div class="text-red list-none">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="nameEmergen">ชื่อบุคคลติดต่อฉุกเฉิน</label>
                                    </div>
                                    <input type="text" class="form-control" id="nameEmergen" name="name_emergency"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="relation">ความสัมพันธ์</label>
                                    </div>
                                    <input type="text" class="form-control" id="relation" name="relation" placeholder="">
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="phoneRela">เบอร์โทรศัพท์</label>
                                    </div>
                                    <input type="text" class="form-control" id="phoneRela"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        name="phone_relationtion" placeholder="" maxlength="10" minlength="10">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="description">หมายเหตุ</label>
                                    </div>
                                    <textarea type="text" class="form-control" id="description" name="description" placeholder=""> </textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="form-group col">
                                <a href="{{ route('viewAms') }}" type="button" class="btn btn-danger">ยกเลิก</a>
                            </div>
                            <div class="form-group col text-right">
                                <button type="submit" class="btn btn-success">ยืนยัน</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#buildingId").on('change', function() {
            let building_id = {
                building_id: this.value
            };
            $.ajax({
                url: '/backoffice/getRoom',
                type: 'GET',
                data: building_id,
                success: function(response) {
                    console.log(response["room"])
                    console.log(response["mitor"])
                    console.log(response["mitor"].price_water)
                    let optionRoom = "";
                    optionRoom += "<option selected>เลือกหมายเลขห้องเช่า</option>"
                    response["room"].forEach(element => {
                        console.log(element)
                        if (element.status == 0) {
                            optionRoom += "<option value='" + element.number_room + "'>" +
                                element.number_room + "</option>"
                        }
                    });
                    $("#roomNumber").html(optionRoom)
                    $('#mitorWater').attr('value', response["mitor"].price_water)
                    $('#mitorElectric').attr('value', response["mitor"].price_electric)
                    // $("#mitorWater", function() {
                    //     $(this).val(response["mitor"].price_water)
                    // })
                },
                error: function(error) {
                    console.log('error')
                }
            });
        });
        $("#roomNumber").on('change', function() {
            let room_number = {
                room_number: this.value
            };
            console.log(room_number)
            $.ajax({
                url: '/backoffice/getDeposit',
                type: 'GET',
                data: room_number,
                success: function(response) {
                    console.log(response.deposit)
                    $('#deposit').attr('value', response.deposit)
                },
                error: function(error) {
                    console.log('error')
                }
            });
        });
    </script>
@endsection
