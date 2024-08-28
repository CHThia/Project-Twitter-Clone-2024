{{-- Example of using For Loop and if Condition --}}

{{-- @foreach ($users as $user)
  <h1> {{ $user['name'] }} </h1>
  <h2> {{ $user['age']}} </h2>

  @if ($user['age'] < 18)
    <p> User is not allowed drive yet.</p>
  @endif
  
  <hr>
@endforeach

<br>

@copyright {{ date('Y') }} --}}


@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            @include('shared.success-message')
            @include('ideas.shared.submit-idea')
            <hr>
            @if (count($ideas) > 0)
                @foreach ($ideas as $idea)
                    <div class="mt-3">
                        @include('ideas.shared.idea-card')
                    </div>
                @endforeach
            @else
                <p style="color: rgb(211, 23, 23)">No results Found.</p>
            @endif

            {{-- Another Method to write the loop function --}}
            {{-- @forelse ($ideas as $idea)
                    <div class="mt-3">
                        @include('shared.idea-card')
                    </div>
                @empty
                  <p class="text-center mt-4 text-danger">No results Found.</p>
                @endforelse
            <div class="mt-4"> --}}

            <div class="mt-4">

                {{-- Retain search query during Pagination --}}
                {{ $ideas->withQueryString()->Links() }}

            </div>
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-box')
        </div>
    </div>
@endsection
