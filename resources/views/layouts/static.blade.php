<div class="stactistic">
    <p class="big-tittle">
       Stactistic
    </p>
    <div class="line-border"></div>
    <div class="list-statistic">
        <div class="list-item">
            <div class="list-items-title">
               Courses
            </div>
            <div class="list-item-number">
                {{$course->count()}}
            </div>
        </div>
        <div class="list-item">
            <div class="list-items-title">
                Lessons
            </div>
            <div class="list-item-number">
                {{$lesson->count()}}
            </div>
        </div>
        <div class="list-item">
            <div class="list-items-title">
                Learner
            </div>
            <div class="list-item-number">
                {{$user->count()}}
           </div>
        </div>
    </div>
</div>
