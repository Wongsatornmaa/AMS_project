@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="pt-3">
            <div class="card border-dark">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4>แก้ไขข้อมูลสัญญาห้องเช่า</h4>
                        </div>
                    </div>
                </div>

                {{-- @if ($errors->any())
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif --}}
                <div class="card-body">
                    <form method="POST" action="{{ route('updateAms', $userMemberDetail->id) }}">
                        @csrf
                        <h5>ข้อมูลสัญญาเช่า</h5>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span for="day_in" class="input-group-text form-control">วันเริ่มทำสัญญา</span>
                                    </div>
                                    <input type="date" class="form-control" name="day_in"
                                        value="{{ old('day_in', !empty($userMemberDetail->day_in) ? $userMemberDetail->day_in : '') }}"
                                        disabled>
                                </div>
                            </div>

                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span for="day_out" class="input-group-text form-control">วันสิ้นสุดสัญญา</span>
                                    </div>
                                    <input type="date" class="form-control" name="day_out"
                                        value="{{ old('day_out', !empty($userMemberDetail->day_out) ? $userMemberDetail->day_out : '') }}"
                                        disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span for="amount_people" class="input-group-text form-control">จำนวนผู้อาศัย</span>
                                    </div>
                                    <input type="number" class="form-control" name="amount_people"
                                        value="{{ old('amount_people', !empty($userMemberDetail->amount_people) ? $userMemberDetail->amount_people : '') }}"
                                        step="any" maxlength="3" disabled>
                                    <div class="input-group-append">
                                        <label class="input-group-text form-control" for="amountPeople">คน</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span for="period" class="input-group-text form-control">ระยะเวลาสัญญาเช่า</span>
                                    </div>
                                    <input type="text" class="form-control" name="period"
                                        value="{{ old('period', !empty($userMemberDetail->period) ? $userMemberDetail->period : '') }}" disabled>
                                    <div class="input-group-append">
                                        <label class="input-group-text form-control" for="period">ปี</label>
                                    </div>
                                </div>
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
                                        <span for="first_name" class="input-group-text form-control">ชื่อ *</span>
                                    </div>
                                    <input type="text" class="form-control" name="first_name"
                                        value="{{ old('first_name', !empty($userMemberDetail->first_name) ? $userMemberDetail->first_name : '') }}">
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span for="last_name" class="input-group-text form-control">นามสกุล *</span>
                                    </div>
                                    <input type="text" class="form-control" name="last_name"
                                        value="{{ old('last_name', !empty($userMemberDetail->last_name) ? $userMemberDetail->last_name : '') }}">
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
                                        <span for="phone" class="input-group-text">เบอร์โทรศัพท์ *</span>
                                    </div>
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ old('phone', !empty($userMemberDetail->phone) ? $userMemberDetail->phone : '') }}"
                                        step="any"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        placeholder="" maxlength="10" minlength="10">
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span for="citizen" class="input-group-text">เลขบัตรประชาชน *</span>
                                    </div>
                                    <input type="text" class="form-control" name="citizen"
                                        value="{{ old('citizen', !empty($userMemberDetail->citizen) ? $userMemberDetail->citizen : '') }}"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        placeholder="" maxlength="13" minlength="13">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span for="line" class="input-group-text form-control">Line</span>
                                    </div>
                                    <input type="text" class="form-control" name="line"
                                        value="{{ old('line', !empty($userMemberDetail->line) ? $userMemberDetail->line : '') }}">
                                </div>
                            </div>

                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span for="facebook" class="input-group-text">Facebook</span>
                                    </div>
                                    <input type="text" class="form-control" name="facebook"
                                        value="{{ old('facebook', !empty($userMemberDetail->facebook) ? $userMemberDetail->facebook : '') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                @error('email')
                                    <div class="text-red list-none">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                @error('date_of_birth')
                                    <div class="text-red list-none">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span for="email" class="input-group-text">Email</span>
                                    </div>
                                    <input type="text" class="form-control" name="email"
                                        value="{{ old('email', !empty($userMemberDetail->email) ? $userMemberDetail->email : '') }}">
                                </div>
                            </div>

                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span for="date_of_birth" class="input-group-text">วันเกิด</span>
                                    </div>
                                    <input type="date" class="form-control" name="date_of_birth"
                                        value="{{ old('date_of_birth', !empty($userMemberDetail->date_of_birth) ? $userMemberDetail->date_of_birth : '') }}">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <h5>ข้อมูลผู้ติดต่อกรณีฉุกเฉิน</h5>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span for="emergency_name" class="input-group-text">ชื่อบุคคลติดต่อฉุกเฉิน</span>
                                    </div>
                                    <input type="text" class="form-control" name="emergency_name"
                                        value="{{ old('emergency_name', !empty($userMemberDetail->emergency_name) ? $userMemberDetail->emergency_name : '') }}">
                                </div>
                            </div>

                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text form-control" for="relationship">ความสัมพันธ์</span>
                                    </div>
                                    <input type="text" class="form-control" name="relationship"
                                        value="{{ old('relationship', !empty($userMemberDetail->relationship) ? $userMemberDetail->relationship : '') }}">
                                </div>
                            </div>
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span for="phone_relationship" class="input-group-text">เบอร์โทรศัพท์</span>
                                    </div>
                                    <input type="number" class="form-control" name="phone_relationship"
                                        value="{{ old('phone_relationship',!empty($userMemberDetail->phone_relationship) ? $userMemberDetail->phone_relationship : '') }}"
                                        step="any">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span for="description" class="input-group-text">หมายเหตุ</span>
                                    </div>
                                    <textarea type="text" class="form-control" name="description"
                                        value="{{ old('description', !empty($userMemberDetail->description) ? $userMemberDetail->description : '') }}"> </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <a class="btn btn-danger" href="{{ route('viewAms') }}">ยกเลิก</a>
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
@endsection
