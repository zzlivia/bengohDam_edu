<div class="settings-sidebar p-3">

<h6 class="fw-bold mb-3">Settings</h6>

{{-- PROFILE (REGISTERED USERS ONLY) --}}
@auth
<a href="{{ route('settings.profile') }}" class="settings-link">
    Profile
    <span class="float-end">›</span>
</a>
@endauth


{{-- NOTIFICATIONS --}}
<a href="{{ route('settings.notifications') }}" class="settings-link">
    Notifications
    <span class="float-end">›</span>
</a>


{{-- PREFERENCES --}}
<a href="{{ route('settings.preferences') }}" class="settings-link">
    Preferences
    <span class="float-end">›</span>
</a>

</div>