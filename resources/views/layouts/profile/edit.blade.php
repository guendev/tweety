@extends('layouts.master')
@section('content')
    <div class="col-6 bg-dark-2 px-1">
        <div class="site-content px-2">
            <form
                method="POST"
                action="{{ route('updateProfile', $user) }}"
            >
                @csrf
                <div class="form-row">
                    <div class="col-md-8 mb-3">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            id="name"
                            value="{{ $user->name }}"
                            required
                        >
                    </div>


                    <div class="col-md-4 mb-3">
                        <label for="user_name">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="user_name">@</span>
                            </div>
                            <input
                                type="text"
                                class="form-control"
                                name="username"
                                id="user_name"
                                value="{{ $user->user_name }}"
                                required
                            >
                        </div>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-md-9 mb-3">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            id="email"
                            value="{{ $user->email }}"
                            required
                        >
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="story">Sex</label>
                        <select class="custom-select" id="story" required>
                            <option selected disabled value="">Choose...</option>
                            <option value="1">Nam</option>
                            <option value="2">Nữ</option>
                            <option value="3">LGBT</option>
                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <label for="story">Story</label>
                    <textarea
                        type="text"
                        class="form-control"
                        id="story"
                    >{{ $user->story }}</textarea>
                </div>
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" id="avatar" required>
                    <label class="custom-file-label" for="avatar">Choose file...</label>
                </div>
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" id="cover" required>
                    <label class="custom-file-label" for="cover">Choose file...</label>
                </div>


                <div class="form-row">
                    <div class="col-12 mb-3">
                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            id="password"
                            required
                        >
                    </div>

                    <div class="col-12 mb-3">
                        <input
                            class="form-control"
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            required
                        >
                    </div>

                </div>



                <button class="btn btn-primary" type="submit">Submit form</button>
            </form>
        </div>
    </div>
@endsection
