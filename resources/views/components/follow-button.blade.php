@unless(current_user()->is($user))
    <form
        class="ml-2"
        action="{{ route('follow', $user ) }}"
        method="post"
    >
        @csrf

        <button
            class="btn btn-outline-primary font-weight-bold text-primary br30"
        >
            {{ current_user()->isFollowing($user) ? 'Unfollow Me' : 'Follow Me'}}
        </button>

    </form>
@endunless
