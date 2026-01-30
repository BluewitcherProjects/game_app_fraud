<div class="menubar-area">
    <div class="toolbar-inner menubar-nav">
        <a href="{{ route('user.home') }}" class="nav-link ">
            <img src="{{ asset('assets/app/img/home'.(Request::is('user/dashboard') == true ? 'active' : '').'.png') }}">
            <label>Home</label>
        </a>
        <a href="{{ route('user.salary') }}" class="nav-link ">
            <img src="{{ asset('assets/app/img/tasks.png') }}">
            <label>Task</label>
        </a>

        <!-- Center Big Support Button -->
        <div class="center-button">
            <a class="menu" href="{{ $general->cs }}" target="_blank">
                <img src="{{ asset('assets/app/img/service-3.png') }}" alt="Support">
            </a>
        </div>

        <a href="{{ route('user.company') }}" class="nav-link ">
            <img src="{{ asset('assets/app/img/blog-'.(Request::is('user/company') == true ? 'active' : '').'.png') }}">
            <label>About</label>
        </a>
        <a href="{{ route('user.profile.setting') }}" class="nav-link ">
            <img src="{{ asset('assets/app/img/account-'.(Request::is('user/profile-setting') == true ? 'active' : '').'.png') }}">
            <label>Profile</label>
        </a>
    </div>
</div>
<!-- Menubar -->



<style>
    .menubar-area {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background: #ffffff;
        padding: 12px 0 10px 0;
        z-index: 999;
        border-radius: 0;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.15);
    }

    .toolbar-inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        padding: 0 25px;
    }

    .nav-link {
        flex: 1;
        text-align: center;
        position: relative;
    }

    .nav-link img {
        width: 30px;
        height: 30px;
    }

    .nav-link label {
        display: block;
        font-size: 11px;
        font-weight: 600;
        margin-top: 1px;
        color: #888888;
    }

    .nav-link.active label {
        color: #058c43;
    }

    .nav-link.active:after {
        content: "";
        position: absolute;
        bottom: -11px;
        left: 50%;
        transform: translateX(-50%);
        width: 24px;
        height: 5px;
        background: #340166;
        border-radius: 3px;
    }

    .center-button {
        position: sticky;
        top: -32px;
        left: 50%;
        transform: translateX(-50%);
        background: #ffffff;
        border-radius: 50%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        padding: 8px;
        z-index: 10;
        margin-top: -55px;
    }

    .menubar-area .toolbar-inner {
        padding-left: 7px;
        padding-right: 7px;
        display: flex;
        max-width: 1000px;
        margin-right: auto;
        margin-left: auto;
        align-items: center;
    }

    .center-button img {
        width: 55px;
        height: 55px;
    }

    a {
        text-decoration: none;
    }

    a:hover,
    a:focus,
    a.active {
        text-decoration: none;
        outline: none;
    }
</style>
