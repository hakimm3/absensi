<li class="nav-item  {{ request()->is('user-management/*') ? 'menu-is-opening menu-open' : '' }}">
    <a href="#" class="nav-link  {{ request()->is('user-management/*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-cog"></i>
      <p>
        User Management
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('user-management.users.index') }}" class="nav-link {{ request()->is('user-management/users') ? 'active' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Master User</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('user-management.department.index') }}" class="nav-link {{ request()->is('user-management/department') ? 'active' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Master Department</p>
        </a>
      </li>
    </ul>
  </li>