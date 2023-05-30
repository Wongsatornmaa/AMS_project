<!-- need to remove -->
@php
$detail = asset('image/view-details.png');
$history = asset('image/history.png');
$contract = asset('image/book.png');
@endphp
<li class="nav-item">
    <a href="{{ route('homeUser') }}" class="nav-link">
        <i><img class="image-menu" src="{{ $detail }}"></i>
        <p>ดูรายละเอียดค่าห้องเช่า</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('roomHis') }}" class="nav-link">
        <i><img class="image-menu" src="{{ $history }}"></i>
        <p>ดูประวัติค่าห้อง</p>
    </a>
</li>

<!-- <li class="nav-item">
    <a href="{{ route('roomCon') }}" class="nav-link">
        <i><img class="image-menu" src="{{ $contract }}"></i>
        <p>ดูสัญญาห้องเช่า</p>
    </a>
</li> -->
