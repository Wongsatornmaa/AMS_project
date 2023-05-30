<!-- need to remove -->
@php
$binoculars = asset('image/binoculars.png');
$account = asset('image/account.png');
$contract = asset('image/contract.png');
$project = asset('image/project.png');
@endphp
<li class="nav-item">
    <a href="{{ route('home')}}" class="nav-link">
        <i><img class="image-menu" src="{{ $contract }}"></i>
        <p>สร้างอาคารหอพัก</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('formAms')}} " class="nav-link">
        <i><img class="image-menu" src="{{ $project }}"></i>
        <p>กรอกสัญญาเช่าห้อง</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('bill')}}" class="nav-link">
        <i><img class="image-menu" src="{{ $project }}"></i>
        <p>จัดการค่าเช่าห้อง</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('viewAms')}} " class="nav-link">
        <i><img class="image-menu" src="{{ $binoculars }}"></i>
        <p>ดูห้องเช่า</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('accountIndex')}}" class="nav-link">
        <i><img class="image-menu" src="{{ $account }}"></i>
        <p>จัดการบัญชีผู้เช่า</p>
    </a>
</li>
