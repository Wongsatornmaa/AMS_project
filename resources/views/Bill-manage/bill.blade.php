@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="pt-3">
            <div class="card border-dark mb-3">
                <div class="card border-dark mb-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col h4">จัดการค่าห้องเช่า</div>
                        </div>
                    </div>
                    <div class="card-body text-dark">
                        <div class="row">
                            <div class="col-3">
                                <p>เลือกปี</p>
                                <select id="selectYear" class="form-control form-control-sm">
                                    @php
                                        foreach ($data['yearBill'] as $index => $years) {
                                            echo '<option value="'.$years->year.'"> '.($years->year+543).' </option>';
                                        }
                                    @endphp
                                </select>
                            </div>
                            <div class="col-3">
                                <p>เลือกเดือน</p>
                                <select id="selectMonth" class="form-control form-control-sm" name="month">
                                    @php
                                        $month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                        foreach ($month as $index => $countMonth) {
                                            $index += 1;
                                            $numMonth = date('m', strtotime($countMonth));
                                            echo "<option value='$numMonth'> {$countMonth} </option>";
                                        }
                                    @endphp
                                </select>
                            </div>
                            <div class="col-3">
                                <p>เลือกอาคาร</p>
                                <select id="selectBuilding" class="form-control form-control-sm">
                                    @php
                                        foreach ($data['buildingAll'] as $index => $building) {
                                            echo "<option value='$index'> {$building->building_name} </option>";
                                        }
                                    @endphp
                                </select>
                            </div>
                            <div class="col-3"><br><button id="search" type="button"
                                    class="btn btn-primary mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg></button></div>
                        </div>
                        <br>
                        <div class="card-body text-dark">
                            <table id="mytables" class="display" width="100%">
                                <thead class="thead-dark">
                                    <tr class="text-center">
                                        <th scope="col">เลขห้อง</th>
                                        <th scope="col">เลขมิเตอร์น้ำ</th>
                                        <th scope="col">เลขมิเตอร์ไฟ</th>
                                        <th scope="col">ดำเนินการ</th>
                                        <th scope="col">พิมพ์ใบเสร็จ</th>
                                    </tr>
                                </thead>
                                <tbody id="billBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
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
        $('#mytables').DataTable({
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
            let month = $('#selectMonth').find(":selected").val();
            let building = $('#selectBuilding').find(":selected").text();
            let data = {
                year: year,
                month: month,
                building_name: building
            }
            $.ajax({
                type: "GET",
                url: "/backoffice/getBill",
                data: data,
                success: function(response) {
                    console.log({
                        response
                    })
                    let table = "";
                    response["billRoom"].forEach(bill => {
                        console.log(bill)
                        table += "<tr class=\"text-center\">" +
                            "<td scope=\"row\">" + bill.number_room + "</td>";
                        let water = '';
                        if (bill.mitor_water != null) {
                            water = bill.mitor_water;
                        }
                        table +=
                            "<td scope=\"row\"><input class=\"input-water\" min=\"0.000001\" value=\"" +
                            water + "\" type=\"text\" bill-id=\"" + bill.id + "\" ></td>";
                        let electric = '';
                        if (bill.mitor_electric != null) {
                            electric = bill.mitor_electric;
                        }
                        table +=
                            "<td scope=\"row\"><input class=\"input-electric\" min=\"0.000001\" value=\"" +
                            electric + "\" type=\"text\" bill-id=\"" + bill.id + "\" ></td>";
                        let base = "editBill/" + bill.id;
                        table += "<td scope=\"row\"><div class=\"row\"><div class=\"col-4\"></div><div class=\"col-2\"><a href=\"" + base +
                            "\" class=\"btn btn-warning\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-pencil-square\" viewBox=\"0 0 16 16\">" +
                            '<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>' +
                            '<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>' +
                            '</svg></a></div>';
                        let view = "viewBill/" + bill.id;
                        table += "<div class=\"col-2\"><a href =\"" + view +
                            "\"++ class=\"btn btn-primary\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-search\" viewBox=\"0 0 16 16\">" +
                            '<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>' +
                            "</svg></a></td>";
                        let url = "pdf/" + bill.id;
                        table += "<td scope=\"row\"><a href=\"" + url +
                            "\" class=\"btn btn-success\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-file-earmark-pdf\" viewBox=\"0 0 16 16\">" +
                            '<path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>' +
                            '<path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>' +
                            '</svg></a></div></div></td>' +
                            "</tr>"
                    });
                    $("#billBody").html(table)
                },
                error: function(error) {
                    console.log('error')
                }
            });
        })
        $("#mytables").on('change', ".input-water", function() {
            let bill_id = $(this).attr("bill-id")
            let water = this.value;

            let data = {
                id: bill_id,
                mitor_water: water
            }

            $.ajax({
                type: 'POST',
                url: '/backoffice/updateBill',
                data: data,
                success: function(response) {
                    console.log(response)
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        backdrop: false,
                        timer: 1200
                    })
                },
                error: function() {
                    console.log('error')
                }
            });
        })
        $("#mytables").on('change', ".input-electric", function() {
            let bill_id = $(this).attr("bill-id")
            let electric = this.value;

            let data = {
                id: bill_id,
                mitor_electric: electric
            }

            $.ajax({
                type: 'POST',
                url: '/backoffice/updateBill',
                data: data,
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
        })
    </script>
@endsection
