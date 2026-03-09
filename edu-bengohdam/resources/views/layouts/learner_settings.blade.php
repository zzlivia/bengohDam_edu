<div class="settings-sidebar p-3"> {{-- container for settings menu --}}
    <h6 class="fw-bold mb-3">Settings</h6> {{-- sidebar title --}}
    {{-- only registered user access to profile --}}
    @auth
    <a href="{{ route('settings.profile') }}" class="settings-link"> {{-- unregistered user cannot view the link --}}
        Profile
        <span class="float-end">›</span>
    </a>
    @endauth
    {{-- link to notifications --}}
    <a href="{{ route('settings.notifications') }}" class="settings-link">
        Notifications
        <span class="float-end">›</span>
    </a>
    {{-- link to preferences --}}
    <a href="{{ route('settings.preferences') }}" class="settings-link">
        Preferences
        <span class="float-end">›</span>
    </a>
</div>