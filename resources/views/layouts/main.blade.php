@if (session('success'))
<div class="alert alert-success alert-dismissible in succes-login">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>{{ session('success') }}</strong>
</div>
@endif
<div class="messenger-box" id="mes-box">
   <div class="logo-mes">
      <img src="{{ asset('images/avatar-mes.png')}}" alt="">
   </div>
   <div class="close-mes" id="close">
      <i class="fa-solid fa-xmark"></i>
   </div>
   <div class="mes-box-content">
      <div class="name">HapoLearn</div>
      <div class="chat">HapoLearn xin chào bạn. Bạn có cần chúng tôi hỗ trợ gì không? </div>
      <div class="login-mes"><a href=""><i class="fa-brands fa-facebook-messenger"></i> Đăng Nhập vào HapoLearn</a></div>
      <div class="text-under">Chat với HapoLearn trong Messenger</div>
   </div>
</div>
<div class="messenger">
   <div class="messenger-btn">
      <img src="{{ asset('images/messenger.png')}}" alt="">
   </div>
</div>
<div class="main">
   <div class="main-content">
      <div class="list-items">
         @foreach ($courses as $course)
            <div class="items">
               <div class="img-items">
                  <a href=""><img src="{{$course->image}}" alt=""></a>
               </div>
               <div class="content-items">
                  <p class="title">{{$course->course_name}}</p>
                  <p class="content">{{$course->description}}</p>
                  <p class="btn-link">
                     <a href="#" >Take This Course</a>
                  </p>
               </div>
            </div>
         @endforeach
      </div>
   </div>
   <div class="main-content">
      <p class="big-tittle">
         Other courses
      </p>
      <div class="line-border"></div>
      <div class="list-items no-tranfer mt-45">
         @foreach ($courses_other as $course_other)
            <div class="items">
               <div class="img-items">
                  <a href=""><img src="{{$course_other->image}}" alt=""></a>
               </div>
               <div class="content-items">
                  <p class="title">{{$course_other->course_name}}</p>
                  <p class="content">{{$course_other->description}}</p>
                  <p class="btn-link">
                     <a href="#" >Take This Course</a>
                  </p>
               </div>
            </div>
         @endforeach
      </div>
      <div class="view-more-title">
         <a href="">View All Our Courses <i class="fa-solid fa-arrow-right"></i></a> 
      </div>
   </div>
   @include('layouts.why_hapo')
   @include('layouts.feedback')
   @include('layouts.course')
   @include('layouts.static')
</div>
