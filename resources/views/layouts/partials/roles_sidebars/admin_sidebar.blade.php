<li>
    <a class="{{ request()->is('reports*') ? 'active' : '' }}" href="{{ route('reports.index') }}">
        <i data-acorn-icon="dashboard-1" class="d-inline-block"></i>
        <span class="label">Dashboard</span>
    </a>
</li>
<li>
    <a class="{{ request()->is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
        <i data-acorn-icon="user" class="d-inline-block"></i>
        <span class="label">Users Management</span>
    </a>
</li>
