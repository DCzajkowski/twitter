@extends('layouts.app')

@section('content')
<div class="flex items-center">
    <div class="md:w-1/2 md:mx-auto">
        <div class="rounded shadow">
            <div class="font-medium text-lg text-brand-darker bg-brand-lighter p-3 rounded-t">
                <span>{{ '@' . $user->name }}</span>
            </div>
            <div class="bg-white p-3 rounded-b flex">
                <div class="flex-1">
                    <p class="text-grey-dark text-sm">
                        <img src="{{ $user->avatar }}">
                    </p>
                </div>
                <div class="">
                    @if(Auth::id() !== $user->id)
                        <form action="{{ (Auth::user()->follows($user)) ? route('unfollow') : route('follow') }}" method="post" accept-charset="utf-8">
                            @csrf
                            <input type="hidden" name="username" value="{{ $user->name }}">

                            @if(Auth::user()->follows($user))
                                @method('delete')
                                <button type="submit" class="py-2 px-4 border rounded border-grey-darker text-grey-darker">Unfollow</button>
                            @else
                                <button type="submit" class="py-2 px-4 border rounded border-blue text-blue">Follow</button>
                            @endif
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
