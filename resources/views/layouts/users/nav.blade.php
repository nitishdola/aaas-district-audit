<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
        <a class="nav-link" href="{{ route('dmo.home') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Dashboard</span>
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="icon-layout menu-icon"></i>
            <span class="menu-title">Benefciary Audit</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('audit.beneficiary.fetch_data') }}">Get Data</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('audit.beneficiary.view_all_data') }}">View Data</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('audit.beneficiary.view_all_home_visits') }}">Home Visits</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('audit.beneficiary.view_all_telephonic_audits') }}">Tephonic Visits</a></li>

            
            
            </ul>
        </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Infrastructure Audit</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('audit.infrastructure.create') }}">Add</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('audit.infrastructure.index') }}">View All</a></li>
                </ul>
            </div>
        </li>
        
    </ul>
    </nav>