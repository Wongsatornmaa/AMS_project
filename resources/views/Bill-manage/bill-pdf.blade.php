    <!DOCTYPE html>
    <html lang="th/en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css">
            @font-face {
                font-family: 'THSarabunNew';
                font-style: normal;
                font-weight: normal;
                src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
            }

            @font-face {
                font-family: 'THSarabunNew';
                font-style: normal;
                font-weight: bold;
                src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
            }

            @font-face {
                font-family: 'THSarabunNew';
                font-style: italic;
                font-weight: normal;
                src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
            }

            @font-face {
                font-family: 'THSarabunNew';
                font-style: italic;
                font-weight: bold;
                src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
            }

            ,
            table {
                border-collapse: collapse;
            }

            ,
            th,
            td {
                border: 1px solid;
            }

            ,
            body {
                font-family: "THSarabunNew";
            }

        </style>
    </head>

    <body>
        @php
            $summary = 0;
            
        @endphp
        <h1>ห้อง: {{ $data['billAll']->number_room }}</h1>

        <table style="width: 100%">
            <tr>
                <th scope="col" rowspan="2">รายการ</th>
                <th scope="col" colspan="2">เลขมิเตอร์</th>
                <th scope="col" rowspan="2">จำนวนมิเตอร์(หน่วย)</th>
                <th scope="col" rowspan="2">ราคา/หน่วย</th>
                <th scope="col" rowspan="2">จำนวนเงิน(บาท)</th>
            </tr>
            <tr>
                <td>เดือนที่แล้ว:
                    {{ !empty($data['beforeDateBill']->date_bill) ? $data['beforeDateBill']->date_bill : '-' }}</td>
                <td>เดือนล่าสุด: {{ $data['billAll']->date_bill }}</td>
            </tr>
            <tr>
                <td>ค่าเช่าห้อง</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>{{ $data['billAll']->rent }}</td>
                @php
                $summary += $data['billAll']->rent;
            @endphp

            </tr>
            <tr>
                <td class="text-center">ค่าน้ำ</td>
                <td>{{ !empty($data['beforeDateBill']->mitor_water) ? $data['beforeDateBill']->mitor_water : '-' }}
                </td>
                <td>{{ $data['billAll']->mitor_water }}</td>
                <td>{{ $data['billAll']->amount_water }}</td>
                <td>{{ $data['billAll']->price_water }}</td>
                <td>{{ $data['billAll']->summary_water }}</td>
                @php
                    $summary += $data['billAll']->summary_water;
                @endphp
            </tr>
            <tr>
                <td>ค่าไฟ</td>
                <td>{{ !empty($data['beforeDateBill']->mitor_electric) ? $data['beforeDateBill']->mitor_electric : '-' }}
                </td>
                <td>{{ $data['billAll']->mitor_electric }}</td>
                <td>{{ $data['billAll']->amount_electric }}</td>
                <td>{{ $data['billAll']->price_electric }}</td>
                <td>{{ $data['billAll']->summary_electric }}</td>
                @php
                    $summary += $data['billAll']->summary_electric;
                @endphp
            </tr>
            <tr>
                <td colspan="6">รายการอื่นๆ</td>
                {{-- @if ($data['otherService'] != null)
                    @foreach ($data['otherService'] as $service)
                        <td colspan>{{ $service->name_other }}</td>
                        <td>{{ $service->price_other }}</td>
                    @endforeach
                @endif --}}
            </tr>
            @if ($data['otherService'] != null)
                @foreach ($data['otherService'] as $service)
                    <tr>
                        <td colspan="5">{{ $service->name_other }}</td>
                        <td>{{ $service->price_other }}</td>
                        @php
                            $summary += $service->price_other;
                        @endphp
                    </tr>
                @endforeach
            @endif
            <tr>
                <td colspan="5">ยอดรวม</td>
                <td>{{  $summary }}</td>
            </tr>
        </table>

    </body>

    </html>
