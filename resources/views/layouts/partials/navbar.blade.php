<div class="navbar">
    <div class="nav-left">
        <button class="btn-burger" onclick="toggleSidebar()">&#9776;</button>
        <strong>Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}</strong>
    </div>
    <div class="nav-right">
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</div>