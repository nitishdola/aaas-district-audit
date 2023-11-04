<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
    <a class="nav-link " href="{{ route('admin.home') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
    </a>
    </li><!-- End Dashboard Nav -->


    <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-check2-circle"></i><span>Audits</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
        <a href="{{ route('admin.audit.infrastructure.index') }}">
            <i class="bi bi-circle"></i><span>Infrastructure Audit</span>
        </a>
        </li>
        <li>
        <a href="{{ route('admin.audit.home_visit.index') }}">
            <i class="bi bi-circle"></i><span>Home Visit</span>
        </a>
        </li>

        <li>
        <a href="{{ route('admin.audit.telephonic_audit.index') }}">
            <i class="bi bi-circle"></i><span>Telephonic Audit</span>
        </a>
        </li>
    </ul>
    </li><!-- End Components Nav -->


    <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#dmo-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-person-bounding-box"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="dmo-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
        <a href="{{ route('admin.dmo.index') }}">
        <i class="bi bi-list-ol"></i> View DMOs</span>
        </a>
        </li>
        <li>
        <a href="{{ route('admin.dmo.create') }}">
            <i class="bi bi-node-plus-fill"></i> Add new DMO</span>
        </a>
        </li>
    </ul>
    </li><!-- End Components Nav -->


    <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#dmo-act-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-person-bounding-box"></i><span>DMO Daily Activity</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="dmo-act-nav" class="nav-content collapse " data-bs-parent="#dmo-act-nav">
        <li>
        <a href="{{ route('admin.daily_activity.view_users') }}">
        <i class="bi bi-list-ol"></i> View Activity</span>
        </a>
        </li>
    </ul>
    </li><!-- End Components Nav -->

    

</ul>