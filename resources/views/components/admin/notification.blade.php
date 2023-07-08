<a class="nav-link" data-toggle="dropdown" href="#">
    <i class="far fa-bell"></i>
    <span    class=" unread-count badge badge-warning navbar-badge">{{ $unread }}</span> {{---- $notifications->count()---}}
</a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <span class="dropdown-header"><span class="unread-count">{{ $unread }}</span>{{ $unread }} Notifications</span>
    <div class="dropdown-divider"></div>
    <div id="notification-list">
    @foreach ($notifications as $notification)

    <a href=" {{$notifications->data['link'] }} ?nid={{$notification->id}}" class="dropdown-item">
        <i class="{{$notifications->data['icon']}} mr-2"></i>{{$notification->data['body']}}
        <span class="float-right text-muted text-sm">{{ $notification->created_at->difFormHumans(null,true,true) }}</span>
    </a>
    <div class="dropdown-divider"></div>

    @endforeach
</div>
    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
</div>
