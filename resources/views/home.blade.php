@extends('layouts.app')

@section('content')
<div class="flex items-center">
    <div class="md:w-1/2 md:mx-auto">
            </div>
            <div class="bg-white p-3 rounded-b">
                <p class="text-grey-dark text-sm">
                </p>
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
