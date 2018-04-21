@extends('layouts.app')

@section('content')
<div class="flex items-center">
    <div class="md:w-1/2 md:mx-auto">
        <div class="rounded shadow mb-4">
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

        @foreach($tweets as $tweet)
            <div class="rounded shadow mb-4">
                <div class="font-medium text-lg text-brand-darker bg-brand-lighter p-3 rounded-t flex items-center">
                    <span><img class="w-8 h-8 mr-4" src="{{ $tweet->user->avatar }}"></span>
                    <span class="flex-1">{{ $tweet->user->name }}</span>
                    <span class="text-grey-darkest italic text-sm">{{ $tweet->created_at->diffForHumans() }}</span>
                </div>
                <div class="bg-white p-3 rounded-b">
                    <p class="text-grey-dark text-sm">
                        {{ $tweet->body }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
