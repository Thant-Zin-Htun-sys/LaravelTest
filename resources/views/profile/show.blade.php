<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            {{-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-semibold mb-4">🎥 Your Rated Movies & Genres</h3>
                    @if($ratedMovies->isEmpty())
                        <p class="text-gray-600">You haven't rated any movies yet.</p>
                    @else
                        <ul class="list-group">
                            @foreach($ratedMovies as $rating)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $rating->movie->title }}</strong>
                                        <span class="text-muted">({{ $rating->movie->genre->name }})</span>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">{{ $rating->rating }}/5</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div> --}}

        </div>
    </div>
</x-app-layout>
