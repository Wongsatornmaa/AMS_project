@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="pt-3">
            <div class="card border-dark">
                <div class="card-header">
                    <div class="row">
                        <div class="col">แก้ไขค่าห้องเช่า</div>
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
                                    value="{{ !empty($billroomDetail->rent) ? $billroomDetail->rent : '-' }}"
                                    name="rent" readonly>
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
                            <label for="inputWater" class="col-sm-4 col-form-label">ค่าน้ำเดือนปัจจุบัน
                                {{ $billroomDetail->date_bill }}</label>
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
                            <label for="inputElectric" class="col-sm-4 col-form-label">ค่าไฟเดือนปัจจุบัน
                                {{ $billroomDetail->date_bill }}</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="inputElectric" placeholder="ค่าไฟ"
                                    value="{{ !empty($billroomDetail->summary_electric) ? $billroomDetail->summary_electric : '-' }}"
                                    readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-6">
                                <button type="button" class="btn btn-primary add-service">+ เพิ่มรายการอื่นๆ</button>
                            </div>
                        </div>
                        {{-- dynamicForm --}}
                        <div class="all-service">
                            @if ($billroomDetail != null)
                                <p>รายการอื่นๆ</p>
                                @if ($billroomDetail->other != null)
                                    @foreach ($billroomDetail->other as $service)
                                        <div class="form-group row service">
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="inputService"
                                                    placeholder="รายการ" name="inputService"
                                                    value="{{ !empty($service->name_other) ? $service->name_other : '-' }}">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="inputPrice" placeholder="ราคา"
                                                    name="inputPrice"
                                                    value="{{ !empty($service->price_other) ? $service->price_other : '-' }}">
                                            </div>
                                            <div class="col-sm-4">
                                                <button type="button" class="btn btn-danger delete-service">ลบ</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @else
                                <hr>
                                <p>รายการอื่นๆ</p>
                                @foreach ($billroomDetail->other as $service)
                                    <div class="form-group row service">
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="inputService" placeholder="รายการ"
                                                name="inputService"
                                                value="{{ !empty($service->name_other) ? $service->name_other : '-' }}">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="inputPrice" placeholder="ราคา"
                                                name="inputPrice"
                                                value="{{ !empty($service->price_other) ? $service->price_other : '-' }}">
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-danger delete-service">ลบ</button>
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
                            <div class="form-group col text-right">
                                <button type="button" class="btn btn-success" id="success">ยืนยัน</button>
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
        $('#billForm').on('click', '#success', function() {

            $('.all-service', function() {
                var allService = {
                    otherService: []
                };
                $(this).find('.service').each(function(index) {
                    let other = {
                        "name_other": $(this).find('input[name=inputService]').val(),
                        "price_other": $(this).find('input[name=inputPrice]').val()
                    }
                    allService.otherService[index] = other;

                });
                console.log(allService);
                let id = $('#billId').val();
                console.log(id);
                $.ajax({
                    type: "POST",
                    url: '/backoffice/save_bill/' + id,
                    data: allService,
                    // dataType: "json",
                    // contentType: "application/json",
                    success: function(response) {
                        console.log(response)
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Your work has been saved',
                            backdrop: false,
                            showConfirmButton: false,
                            timer: 1200
                        })
                    },
                    error: function() {
                        console.log('error')
                    }
                });
            });

        });
        $('#billForm').on('click', '.add-service', function() {
            // alert("ใช้ได้ครับ");
            let formService =
                '<div class="form-group row service">' +
                '<div class="col-sm-4">' +
                '<input type="text" class="form-control" id="inputService" placeholder="รายการ" name="inputService">' +
                '</div>' +
                '<div class="col-sm-4">' +
                '<input type="text" class="form-control" id="inputPassword" placeholder="ราคา" name="inputPrice"> ' +
                '</div>' +
                '<div class="col-sm-4">' +
                '<button type="button" class="btn btn-danger delete-service">ลบ</button>' +
                '</div>' +
                '</div>';
            $('.all-service').append(
                formService
            );
        });
        $('.all-service').on('click', '.delete-service', function() { //remove field
            console.log("del field")
            Swal.fire({
                title: 'Do you want to delete field?',
                showDenyButton: true,
                confirmButtonText: 'Delete',
                denyButtonText: `Cancel`,
                confirmButtonColor: '#dc3545',
                denyButtonColor: '#6c757d',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $(this).closest('div.service').remove();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Delete field success',
                        showConfirmButton: false,
                        backdrop: false,
                        timer: 1300
                    })
                } else if (result.isDenied) {

                }
            });
            return false; //prevent form submission
        });
    </script>
@endsection
