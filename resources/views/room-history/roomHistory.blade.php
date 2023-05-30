@extends('layouts-user.app')

@section('content')
<div class="container-fluid pt-3">
    <div class="card border-dark mb-3">
        <div class="card-header">
        @foreach ($billInfo['showAllBill'] as $index => $bill)
            <h3>ดูประวัติค่าห้องเช่า {{$bill->number_room}}</h3>
            @break
        @endforeach
        </div>
        <div class="card-body text-dark">
            <select id="selectYear" class="form-select" style="width:100px;">
                @php
                    foreach ($billInfo['yearBill'] as $index => $year) { 
                        echo "<option value='$year->year'> ".($year->year+543)."</option>";
                    }
                @endphp 
                
            </select>
            <button id="search" class="btn btn-primary btn-sm" role="button">ค้นหา</button>
            <table id="myTable" class="display" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th>ลำดับ</th>
                        <th>เดือน</th>
                        <th>ค่าเช่าห้อง</th>
                        <th>ค่าน้ำ (บาท)</th>
                        <th>ค่าไฟ (บาท)</th>
                        <th>ค่าใช้จ่ายอื่นๆ (บาท)</th>
                        <th>ยอดรวม (บาท)</th>
                        <th>ดูเพิ่มเติม</th>
                    </tr>
                </thead>
                <tbody id="billBody">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#search').click();
    });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var tables = $('#myTable').DataTable({
            select: false,
            paging: true,
            searching: true,
            ordering: true,
            destroy: false,
            retrive: true,
            responsive: true
        });

        $('#search').on('click', function() {
            let year = $('#selectYear').find(":selected").val();
            let data = {
                year: year,
            }

            $.ajax({
                type: "GET",
                url: "/getHis",
                data: data,
                success: function(response) {
                    console.log(response);
                    let table = "";
                    let index = 0;
                    let j = 0;
                    let price_oth = [];
                    let obj = [];
                    response["otherService"].forEach(service => {
                        obj[j] = (jQuery.parseJSON(service.other)?jQuery.parseJSON(service.other):"-");
                        //console.log(obj[j]);
                        price_oth[j] = obj[j][0].price_other;
                        //console.log(j,price_oth[j]);
                        //console.log(obj[j][0]);
                        //price_oth[j] = jQuery.parseJSON(obj[j]);
                        //console.log(obj.price_other);
                        j++;
                    })
                    
                    j=0;
                    console.log(response["otherService"].length);
                    //console.log(obj[1][0].price_other);
                    //console.log(price_oth);
                    response["showAllBill"].forEach(bill => {
                        index++;
                        let month = bill.date_bill;
                        let strMonth = month.substring(5, 7);
                        let intMonth = parseInt(strMonth);
                        let arrMonth = ["", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน",
                            "พฤษภาคม",
                            "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม",
                            "พฤศจิกายน", "ธันวาคม"
                        ];
                        let monthThai = arrMonth[intMonth];
                       
                        let intSum = parseInt(bill.summary);
                        let intPri = parseInt(price_oth[j]);
                        let total = intSum+intPri;
                        table += "<tr><td>" + index + "</td>" +
                            "<td>" + monthThai + "</td>" +
                            (bill.rent ? "<td class='text-right'>" + bill.rent.toLocaleString("en-US") : "<td class='text-center'>-") + "</td>" +
                            (bill.summary_water ? "<td class='text-right'>" + bill.summary_water.toLocaleString("en-US") : "<td class='text-center'>-") + "</td>" +
                            (bill.summary_electric ? "<td class='text-right'>" + bill.summary_electric.toLocaleString("en-US") : "<td class='text-center'>-") + "</td>" +
                            (price_oth[j] ? "<td class='text-right'>" + price_oth[j].toLocaleString("en-US") : "<td class='text-center'>-") + "</td>" +
                            (bill.summary ? "<td class='text-right'>" + total.toLocaleString("en-US") : "<td class='text-center'>-") + "</td>" +
                            "<td class='text-center'><a href=\"/detailHis/" + bill.bill_id + "\" class=\"btn btn-primary btn-sm\" role=\"button\"> " +
                                "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" " +
                                    "class=\"bi bi-search\" viewBox=\"0 0 16 16\"> "+
                                    "<path d=\"M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z\" /> "+
                                "</svg>" +
                            "</a></td></tr>"
                        j++;
                    })
                    $("#billBody").html(table)
                    $('#myTable').DataTable().data.reload();
                },
                error: function(error) {
                    console.log('error')
                }
            });
        });
   
</script>
@endsection