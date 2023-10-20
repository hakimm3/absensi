<li class="nav-item  {{ request()->is('employee/*') ? 'menu-is-opening menu-open' : '' }}">
    <a href="#" class="nav-link  {{ request()->is('employee/*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-users"></i>
      <p>
        Employee
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('employee.attendance.index') }}" class="nav-link {{ request()->is('employee/attendance') ? 'active' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Attendance</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('employee.minus-poin.index') }}" class="nav-link {{ request()->is('employee/mipo') ? 'active' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Minus Poin</p>
        </a>
      </li>
    </ul>
  </li>
  