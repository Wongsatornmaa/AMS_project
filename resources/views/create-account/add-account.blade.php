@extends('layouts.app')



@section('content')
    <div class="container-fluid">
        <div class="pt-3">
            <div class="card border-dark mb-3">
                <div class="card-header h4">สร้างบัญชีผู้เช่า</div>
                <div class="card-body text-dark">
                    <div class="px-2">
                        <form class="justify-content-center" method="POST" action="{{ route('addAccount') }}"
                            id="submitForm">
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
                                        <input type="text" name="first_name" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text form-control text-addAc">นามสกุล</span>
                                        </div>
                                        <input type="text" name="last_name" class="form-control" placeholder="">
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
                                        <input type="tel" pattern="^[0-9-+\s()]*$" maxlength="10" name="phone"
                                            class="form-control" placeholder="กรุณากรอกเบอร์โทรศัพท์">
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
                                        <input type="password" name="password" minlength="6" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span
                                                class="input-group-text form-control text-addAc">ยืนยันรหัสผ่านอีกครั้ง</span>
                                        </div>
                                        <input type="password" name="confirm_password" minlength="6" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
                                            <span class="input-group-text form-control text-addAc">อีเมล</span>
                                        </div>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="example@mail.com">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <a href="{{ route('accountIndex') }}" class="btn btn-danger">ยกเลิก</a>
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
