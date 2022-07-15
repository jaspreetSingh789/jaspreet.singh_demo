@props(['course'])

<div class="h-10 bg-blue-100 flex leading-10">
    <a class="pl-20" href="{{ route('courses.edit',$course) }}">Course information</a>

    <a class="pl-20" href="{{ route('courses.assign.index',$course) }}">Trainers</a>

    @if($course->status->name == 'published')
    <a class="pl-20" href="{{ route('courses.enroll.index',$course) }}">Users</a>
    @endif
</div>