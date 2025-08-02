<div class="sidebar">
    {{-- <h5 class="text-center">My App</h5> --}}

    <a href="{{getDashboardRedirectUrl()}}">Dashboard</a>
    @role('admin')
        <a href="{{ route('admin.hr.index') }}">Hr Management</a>
        <a href="{{ route('admin.roles.index') }}">Role Management</a>
        <a href="{{ route('admin.permissions.index') }}">Permission Management</a>
    @endrole

    <a href="{{ route(getRole().'.employee.index') }}">Employee Management</a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf @method('post')
    </form>

    <a href="#" onclick="event.preventDefault(); $('#logout-form').submit();">
        Logout
    </a>
</div>
