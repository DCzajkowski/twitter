@extends('layouts.app')

@section('content')
<div class="flex items-center">
    <div class="md:w-1/2 md:mx-auto">
        <div class="rounded shadow mb-8">
            <div class="font-medium text-lg text-brand-darker bg-brand-lighter p-3 rounded-t flex items-center">
            </div>
            <div class="bg-white p-3 rounded-b">
                <p class="text-grey-dark text-sm">
                    <form action="{{ route('tweets.store') }}" method="post" accept-charset="utf-8">
                        @csrf
                        <textarea class="w-full h-16 rounded border p-2 mb-4" name="body" placeholder="What are you doing today?"></textarea>
                        <div class="flex justify-end">
                            <button class="rounded border border-blue text-blue px-4 py-2" type="submit">Tweet</button>
                        </div>
                    </form>
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
