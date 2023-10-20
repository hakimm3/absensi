<li class="nav-item  {{ request()->is('setting/*') ? 'menu-is-opening menu-open' : '' }}">
    <a href="#" class="nav-link  {{ request()->is('setting/*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-cog"></i>
      <p>
        Setting
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('setting.mipo.index') }}" class="nav-link {{ request()->is('setting/mipo') ? 'active' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Minus Poin</p>
        </a>
      </li>
    </ul>
  </li>