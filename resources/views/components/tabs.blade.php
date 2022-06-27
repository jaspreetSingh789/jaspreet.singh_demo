@props(['trainer'])
<?php $user = $trainer ?>

<div class="w-full h-10 bg-blue-100 flex mb-2 leading-10">
    <a class="pl-20" href="">Personal information</a>
    @if($user->role_id == 3)
    <a class="pl-20" href="{{ route('teams.users.index',$user) }}">Employees</a>
    @endif

    @if($user->role_id == 4)
    <a class="pl-20" href="{{ route('users.teams.index',$user) }}">Trainers</a>
    @endif
</div>