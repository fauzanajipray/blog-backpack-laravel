{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> Users</a></li>
{{-- Menu Post --}}
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i> Posts</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('post') }}"><i class="nav-icon la la-list"></i> All posts</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('post/create') }}"><i class="nav-icon la la-plus"></i> Create post</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('category') }}"><i class="nav-icon la la-icons"></i> Categories</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('tag') }}"><i class="nav-icon la la-tags"></i> Tags</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('comment') }}"><i class="nav-icon la la-comment"></i> Comments</a></li>
    </ul>
</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('page') }}"><i class="nav-icon la la-file-text-o"></i> Pages</a></li>
{{-- Slider --}}
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i> Slider</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('slider') }}"><i class="nav-icon la la-list"></i> All Sliders</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('slider/create') }}"><i class="nav-icon la la-plus"></i> Create Slider</a></li>
    </ul>
</li>
{{-- Menu --}}
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i> Menu</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('menu-item') }}"><i class="nav-icon la la-list"></i> All Menu</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('menu-item/create') }}"><i class="nav-icon la la-plus"></i> Create Menu</a></li>
    </ul>
</li>
{{-- Settings --}}
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-cog"></i> Settings</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('setting') }}"><i class="nav-icon la la-cog"></i> <span>Settings</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('backup') }}"><i class="nav-icon la la-hdd-o"></i> <span>Backups</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('log') }}"><i class="nav-icon la la-terminal"></i> <span>Logs</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}"><i class="nav-icon la la-files-o"></i> <span>File manager</span></a></li>
    </ul>
</li>
