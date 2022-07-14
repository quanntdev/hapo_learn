@extends('layouts.app')

@section('content')

<div class="container profile-templete">
    <div class="row">
        <div class="col-3 profile-first-info">
            <div class="group-avatar">
                <div class="avatar">
                    <img src="{{ asset('images/avatar-big.png') }}" alt="">
                </div>
                <div class="name">
                    Võ Hoài Nam
                </div>
                <div class="emial">
                    Nam@gmail.com
                </div>
            </div>
            <div class="group-avatar-2">
                <div class="item">
                    <div class="span-birth">
                        <div class="span-birth-image"><img src="{{ asset('images/d-o-b.png') }}" alt=""></div>
                        <p>19/09/2002</p>
                    </div>
                </div>
                <div class="item">
                    <div class="span-birth">
                        <div class="span-birth-image"><img src="{{ asset('images/call.png') }}" alt=""></div>
                        <p>1234567890</p>
                    </div>
                </div>
                <div class="item">
                    <div class="span-birth">
                        <div class="span-birth-image"><img src="{{ asset('images/home.png') }}" alt=""></div>
                        <p>Cầu Giấy , Hà Nội</p>
                    </div>
                </div>
                <div class="description">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolor architecto officiis odit eum. Voluptate saepe assumenda, corrupti veniam sequi soluta magni veritatis rerum totam incidunt.
                </div>
            </div>
        </div>
        <div class="col-9">

        </div>
    </div>
</div>

@endsection