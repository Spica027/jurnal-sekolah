<body>
    @if (request()->is('login/*','login','register','register/*'))
    @else
    <nav class="_nav">
        <a class="_nav-link{{ request()->is('jurnal/*','jurnal') ? ' _nav-link-active' : ''}}" href="/jurnal">
            <i class="material-icons">
                menu_book
            </i>
            <span class="_nav-text">Jurnal</span>
        </a>
        <a class="_nav-link{{ request()->is('siswa/*','siswa','guru/*','guru','data') ? ' _nav-link-active' : ''}}"
            href="/siswa" id="longpress" data-long-press-delay="300">
            <i class="material-icons" id="longpress" data-long-press-delay="300">
                person_search
            </i>
            <span class="_nav-text" id="longpress" data-long-press-delay="300">Data</span>
        </a>
        <a class="_nav-link{{ request()->is('profile/*','profile') ? ' _nav-link-active' : ''}}" href="/profile">
            <i class="material-icons">
                account_circle
            </i>
            <span class="_nav-text">Profile</span>
        </a>
    </nav>


    @endif
