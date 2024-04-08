<div class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell"></i>
        <span class="label label-warning">{{ $notifications->count() }}</span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">You have {{ $notifications->count() }} notifications</li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
                @foreach($notifications as $notification)
                <li>
                    <a href="#">
                        <i class="fa fa-users text-aqua"></i> {{ $notification->message }}
                    </a>
                </li>
                @endforeach
            </ul>
        </li>
        <li class="footer"><a href="#">View all</a></li>
    </ul>
</div>
