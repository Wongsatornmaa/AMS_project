@extends('layouts-user.app')

@section('content')
    <div class="container-fluid pt-3">
        <div class="card border-dark">
            <form class="justify-content-center" method="POST" action="{{ route('updateAccountMember') }}" id="submitForm">
                @csrf
                <div class="card-header h4">
                    แก้ไขข้อมูลผู้เช่า
                </div>
                <div class="card-body">

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
                        <div class="col">
                            @error('date_of_birth')
                                <div class="text-red list-none">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-4">
                        @foreach ($userInfo['showInfo'] as $index => $data)
                            <div class="col-sm-4 form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text form-control form-label">ชื่อ</label>
                                    </div>
                                    <input type="text" class="form-control" name="first_name"
                                        value="{{ $data->first_name }}" required>
                                </div>
                            </div>

                            <div class="col-sm-4 form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text form-control form-label">นามสกุล</label>
                                    </div>
                                    <input type="text" class="form-control" name="last_name"
                                        value="{{ $data->last_name }}" required>
                                </div>
                            </div>

                            <div class="col-sm-4 form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text form-control form-label">วันเกิด</label>
                                    </div>
                                    <input type="date" class="form-control" name="date_of_birth"
                                        value="{{ $data->date_of_birth }}">
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
                        </div>
                    </div>
                    <div class="row g-3 form-group">
                        <div class="col-sm">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text form-control form-label">เบอร์โทรศัพท์</label>
                                </div>
                                <input type="tel" pattern="^[0-9-+\s()]*$" maxlength="10" class="form-control"
                                    name="phone" value="{{ $data->phone }}" placeholder="0123456789" required>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text form-control form-label">Facebook</label>
                                </div>
                                <input type="text" class="form-control" name="facebook" value="{{ $data->facebook }}">
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 form-group">
                        <div class="col-sm form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text form-control form-label">E-mail</label>
                                </div>
                                <input type="email" class="form-control" name="email" value="{{ $data->email }}">
                            </div>
                        </div>
                        <div class="col-sm form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text form-control form-label">Line</label>
                                </div>
                                <input type="text" class="form-control" name="line" value="{{ $data->line }}">
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="row g-2 form-group">

                        <div class="col">
                            <a class="btn btn-danger" href="{{ route('homeUser') }}">ยกเลิก</a>
                        </div>
                        <div class="col text-right">
                            <button type="submit" class="btn btn-success ">ยืนยัน</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
