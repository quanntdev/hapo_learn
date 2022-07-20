<div class="feed-back">
   <p class="big-tittle">
      Feedback
   </p>
   <div class="line-border"></div>
   <p class="feed-back-slogan">
      What other students turned professionals have to say about us after learning with us and reaching their goals
   </p>
   <div class="list-feedback owl-carousel owl-theme">
      @foreach ($comments as $comment)
      <div class="item-feed">
         <div class="content-feed">
            <div class="line-d"></div>
            {{ $comment->comment }}
         </div>
         <div class="user-feed">
            <div class="avatar">
               <img src="{{ $comment->user->avatar }}" alt="">
            </div>
            <div class="info">
               <div class="name">
                  {{ $comment->user->name }}
               </div>
               <div class="skill">
                  {{ $comment->course->course_name }}
               </div>
               <div class="star">
                 @for

                  $star = $comment->star;

                  @endfor
                  @for ($i = 0; $i < $star; $i++)
                  <span class="fa fa-star checked"></span>
                  @endfor
                  @for ($i = $star; $i < 5; $i++)
                  <span class="fa fa-star"></span>
                  @endfor
               </div>
            </div>
         </div>
      </div>
      @endforeach
   </div>
</div>
