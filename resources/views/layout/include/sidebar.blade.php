<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="/dashboard" @if(request()->segment(1)=='dashboard') class="active" @endif "><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                @if (auth()->user()->role=='admin')
                    <li><a href="/siswa" @if(request()->segment(1)=='siswa') class="active" @endif "><i class="lnr lnr-user"></i> <span>Siswa</span></a></li>
                @endif
            </ul>
        </nav>
    </div>
</div>