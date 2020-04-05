<div class="col-12 mt-2">
    <div class="profile-info">
        <div class="profile-info-item">
            <h4 class="font-weight-bold fs26 text-white mb-0">{{$user->name}}</h4>
            <p class="text-muted">ID: {{$user->id}}</p>
        </div>
        <div class="profile-info-item">
            <p class="text-white">{{$user->story}}</p>
        </div>
        <div class="profile-info-item my-2 d-flex">
            <div class="w-50 text-muted">
                <svg class="fs20">
                    <use xlink:href="#i-location"></use>
                </svg>
                <span>{{ $user->local }}</span>
            </div>
            <div class="w-50 text-muted">
                <svg class="fs20">
                    <use xlink:href="#i-time"></use>
                </svg>
                <span>Đã tham gia từ {{ $user->created_at->format('d-m-Y') }}</span>
            </div>
        </div>
        <div class="profile-info-item my-2 text-white d-inline-flex">
            <div class="mr-3">
                <span>{{ $user->following->count() }}</span>
                <span class="text-muted">Theo dõi</span>
            </div>
            <div>
                <span>{{ $user->follower->count() }}</span>
                <span class="text-muted">Người theo dõi</span>
            </div>
        </div>
        <div class="profile-info-item text-muted d-flex align-items-center">
            @foreach($user->sameFollow()['avatars'] as $follower)
                <span class="follower-item overflow-hidden rounded-circle mr-n2">
                                    <img class="img_reponsive" alt="{{ $follower->following->name }}"
                                         src="{{ $follower->following->avatar }}">
                                </span>
            @endforeach
            <span class="fs12 ml-3">
                                <span class="our-follow-name">
                                    <span>Được theo dõi bởi</span>
                                    @foreach($user->sameFollow()['avatars'] as $name )
                                        {{ $name->following->name }}
                                    @endforeach
                                </span>
                                <span class="d-none">và {{ $user->sameFollow()['count'] }} người khác</span>
                            </span>
        </div>
    </div>
</div>
