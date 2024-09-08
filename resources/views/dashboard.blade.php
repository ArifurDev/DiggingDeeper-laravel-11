<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (auth()->user()->email == 'admin@example.com')
                    @foreach (auth()->user()->unreadNotifications  as $notification)
                        <div class="bg-red-500 p-4 mb-4">
                            <p>{{ $notification->data['message'] .'['. $notification->created_at->diffForHumans() .']' }}
                                <form action="{{ route('notificatin.read',$notification->id) }}" method="POST">
                                    @csrf
                                    <button type="submit">markAsRead</button>
                                </form>
                            </p>

                        </div>
                    @endforeach
                @endif

                </div>
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
