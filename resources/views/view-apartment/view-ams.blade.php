@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <table>
            <tr>
                <td>
                    <div class="card text-dark bg-light mb-3 mt-3 mr-3">
                        <div class="card-body">
                            <h5 class="card-title">จำนวนห้องที่ว่าง : {{ $roomInfo['countEmptyRoom']->emptyRoom }}</h5>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="card text-dark bg-light mb-3 mt-3">
                        <div class="card-body">
                            <h5 class="card-title">จำนวนห้องที่ไม่ว่าง : {{ $roomInfo['countRoom']->numRoom }}</h5>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <div class="card border-dark mb-3">
            <div class="card-header">
                <div class="row">
                    <div class="col h4">ดูห้องเช่า</div>
                </div>
            </div>
            <div class="card-body text-dark">
                <table id="all_room_info" class="display" width="100%">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th scope="col">ห้อง</th>
                            <th scope="col">สถานะห้องเช่า</th>
                            <th scope="col">ชื่อผู้เช่า</th>
                            <th scope="col">วันเริ่มทำสัญญา</th>
                            <th scope="col">วันสิ้นสุดสัญญา</th>
                            <th scope="col">ดูเพิ่มเติม</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roomInfo['showAllRoom'] as $index => $allRoomInfo)
                            <tr class="text-center">
                                <td class="text-center">{{ $allRoomInfo->number_room }}</td>
                                @if ($allRoomInfo->roomStatus == '0')
                                    <td scope="row" class="text-center text-success">ว่าง</td>
                                    <td scope="row" class="text-center">-</td>
                                    <td scope="row" class="text-center">-</td>
                                    <td scope="row" class="text-center">-</td>
                                    <td scope="row" class="text-center">
                                        <div class="row">
                                            <div class="col"></div>
                                            <div class="col text-left"><a href="{{ route('seeDetail', $allRoomInfo->number_room) }}"
                                                class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="currentColor" class="bi bi-search"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                                </svg></a></div>
                                        </div>
                                    </td>
                                @else
                                    <td scope="row" class="text-center text-warning">ไม่ว่าง</td>
                                    <td scope="row" class="text-center">
                                        {{ $allRoomInfo->first_name . ' ' . $allRoomInfo->last_name }}</td>
                                    <td scope="row" class="text-center">{{ $allRoomInfo->day_in }}</td>
                                    <td scope="row" class="text-center">{{ $allRoomInfo->day_out }}</td>
                                    <td scope="row" class="text-center">
                                        <div class="row">
                                           
                                            <div class="col text-right"><a class="btn btn-warning"
                                                href="{{ route('viewEditAms', $allRoomInfo->id) }}"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg></a>
                                                
                                            </div>
                                            <div class="col text-left">
                                                <a href="{{ route('seeDetail', $allRoomInfo->number_room) }}"
                                                    class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="16" height="16" fill="currentColor" class="bi bi-search"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                                    </svg></a>
                                            </div>
                                        </div>

                                    </td>
                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#all_room_info').DataTable({
                select: false,
                paging: true,
                searching: true,
                ordering: true,
                destroy: false,
                retrive: true,
                responsive: true
            });
        });
    </script>
@endsection
