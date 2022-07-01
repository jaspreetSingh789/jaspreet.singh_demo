@props(['course'])

<div class="h-10 bg-blue-100 flex leading-10">
    <a class="pl-20" href="{ route('courses.edit',$course) }">Course information</a>

    <a class="pl-20" href="">Trainers</a>

    <a class="pl-20" href="{{ route('courses.enroll.index',$course) }}">Users</a>

</div>