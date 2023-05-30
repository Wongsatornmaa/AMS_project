@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="pt-3">
            <div class="card border-dark mb-3">
                <div class="card-header h4">แก้ไขบัญชีผู้เช่า</div>
                <div class="card-body text-dark">
                    <div class="px-2">
                        <form action="{{ route('updateAccount', $usermemberDetail->id) }}" method="POST"
                            class="justify-content-center">
                            @csrf
                            
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
                                            <span class="input-group-text form-control text-addAc">ชื่อ</span>
                                        </div>
                                        <input type="text" class="form-control" name="first_name"
                                            value="{{ $usermemberDetail->first_name }}">
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text form-control text-addAc">นามสกุล</span>
                                        </div>
                                        <input type="text" name="last_name" class="form-control"
                                            value="{{ $usermemberDetail->last_name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    @error('phone')
                                        <div class="text-red list-none">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text form-control text-addAc">Username
                                                (เบอร์โทรศัพท์)</span>
                                        </div>
                                        <input type="text" class="form-control" name="phone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            value="{{ $usermemberDetail->phone }}" maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    @error('password')
                                        <div class="text-red list-none">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    @error('confirm_password')
                                        <div class="text-red list-none">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text form-control text-addAc">รหัสผ่าน
                                                (อย่างน้อย 6
                                                ตัวอักษร)</span>
                                        </div>
                                        <input type="password" name="password" minlength="6" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span
                                                class="input-group-text form-control text-addAc">ยืนยันรหัสผ่านอีกครั้ง</span>
                                        </div>
                                        <input type="password" name="password_confirmation" minlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text form-control text-addAc">อีเมล</span>
                                        </div>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ $usermemberDetail->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text form-control" for="buildingId">สถานะ</label>
                                        </div>
                                        <select name="status" class="custom-select" id="status">
                                            @if ($usermemberDetail->status == '1')
                                                <option value="1" selected>กำลังใช้งาน</option>
                                                <option value="0">ปิดการใช้งาน</option>
                                            @else
                                                <option value="1">กำลังใช้งาน</option>
                                                <option value="0" selected>ปิดการใช้งาน</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('accountIndex') }}" class=" btn btn-danger">ยกเลิก</a>
                                </div>
                                <div class="col text-right">
                                    <button type="submit" class="btn btn-success ">ยืนยัน</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
