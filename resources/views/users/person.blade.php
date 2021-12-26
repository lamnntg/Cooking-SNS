{{-- <div class="card mt-3">
  <div class="card-body"> --}}
<div class="d-flex flex-row align-items-center mt-3">
    <a href="{{ route('users.show', ['name' => $person->name]) }}">
        <div class="profile-button-in-recipe-card">
            <div class="profile-button-in-recipe-card__border"></div>
            <div class="profile-button-in-recipe-card__picture">
                <img src="{{ $person->avatar ?? asset('images/default-user.png') }}" alt="User Picture">
            </div>
        </div>
    </a>
    <h2 class="h5 card-title m-0">
        <a href="{{ route('users.show', ['name' => $person->name]) }}"
            class="ms-3 text-dark text-decoration-none">{{ $person->name }}</a>
    </h2>
    @if (Auth::id() !== $person->id)
        <follow-button class="ms-auto" :initial-is-followed-by='@json($person->isFollowedBy(Auth::user()))'
            :authorized='@json(Auth::check())' endpoint="{{ route('users.follow', ['name' => $person->name]) }}">
        </follow-button>
    @endif
</div>
{{-- </div>
</div> --}}
