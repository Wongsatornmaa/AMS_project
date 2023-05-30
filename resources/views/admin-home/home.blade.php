@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="pt-3">
            @if (session('message'))
                <script>
                    submitAlert();

                    function submitAlert() {
                        Swal.fire('Save Success')
                    }
                </script>
            @endif
            <div class="card border-dark mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col h4">สร้างอาคารหอพัก</div>
                        <div class=" col-auto"><a href="{{ route('addInfo') }}" class="btn btn-primary">+
                                เพิ่มข้อมูลอาคาร</a></div>
                    </div>
                </div>
                <div class="card-body text-dark">
                    <table id="mytables" class="display" width="100%">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th scope="col">ชื่ออาคาร</th>
                                <th scope="col">จำนวนชั้น</th>
                                <th scope="col">จำนวนห้อง/ชั้น</th>
                                <th scope="col">ดำเนินการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buildingAll as $index => $building)
                                <tr class="text-center">
                                    <td scope="row">{{ $building->building_name }}</td>
                                    <td scope="row">{{ $building->floor_count }}</td>
                                    <td scope="row">{{ $building->room_count }}</td>
                                    <td scope="row"><a href="{{ route('editInfo', $building->id) }}"
                                            class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="currentColor" class="bi bi-pencil-square"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg></a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#mytables').DataTable({
            select: false,
            paging: true,
            searching: true,
            ordering: true,
            destroy: false,
            retrive: true,
            responsive: true
        });
    </script>
@endsection
