@extends('layouts-user.app')

@section('content')
<div class="container-fluid pt-3">
    <div class="">
        <div class="card-header rounded m-2 bg-light" style="border:none;">
            <h3>ดูสัญญาห้องเช่า</h3>
        </div>
        @foreach ($userInfo['showInfo'] as $index => $data)
        <div class="card-body rounded m-2 bg-light">
        <h3>ห้อง: {{$data->number_room}} </h3>
        
        <div class="row g-3">
         <div class="col">
         <label class="form-label">วันที่เริ่มสัญญา</label>
            <input type="date" value="{{$data->day_in}}" class="form-control" disabled>
        </div>
        <div class="col">
        <label class="form-label">วันสิ้นสุดสัญญา</label>
            <input type="date" value="{{$data->day_out}}" class="form-control" disabled>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">ค่าเช่าต่อเดือน</label>
                <div class="input-group has-validation">
                     <input type="text" class="form-control" value="{{$data->rent}}" aria-describedby="inputGroupPrepend" disabled>
                     <span class="input-group-text" id="inputGroupPrepend">บาท </span>
                </div>
                
                
            </div>

            <div class="col-md-6">
                <label class="form-label">เงินประกัน</label>
                <div class="input-group has-validation">
                     <input type="text" class="form-control" value="{{$data->deposit}}" aria-describedby="inputGroupPrepend" disabled>
                     <span class="input-group-text" id="inputGroupPrepend">บาท </span>
                </div>
                
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">จำนวนผู้อยู่อาศัย</label>
                <div class="input-group has-validation">
                    <input type="text" class="form-control" value="{{$data->amount_people}}" aria-describedby="inputGroupPrepend" disabled>
                    <span class="input-group-text" id="inputGroupPrepend">คน </span>
               </div>
                
            </div>

            {{-- <div class="col-md-6">
                <label class="form-label">สัญญาเช่า</label>
                <input type="text" value="6 เดือน" class="form-control" disabled>
                
            </div> --}}
        </div>

        <div class="row g-6">
            <div class="col-md-3">
                <label class="form-label">ค่าน้ำ</label>
                <div class="input-group has-validation">
                     <input type="text" class="form-control" value="{{$data->price_water}}"  aria-describedby="inputGroupPrepend" disabled>
                     <span class="input-group-text" id="inputGroupPrepend">บาท </span>
                </div>
                
                
            </div>

            <div class="col-md-3">
                <label class="form-label">ค่าไฟ</label>
                <div class="input-group has-validation">
                     <input type="text" class="form-control" value="{{$data->price_electric}}" aria-describedby="inputGroupPrepend" disabled>
                     <span class="input-group-text" id="inputGroupPrepend">บาท </span>
                </div>
                
            </div>
        </div>
        @endforeach
    </div>
    <a href="{{ route ('homeUser')}}" class="btn btn-secondary">ย้อนกลับ <!-- image --></a>
</div>
@endsection