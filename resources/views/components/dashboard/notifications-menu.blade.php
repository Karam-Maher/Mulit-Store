<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        @if ($newCount)
            <span class="badge badge-warning navbar-badge">{{ $newCount }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">{{ $newCount }} Notifications</span>
        <div class="dropdown-divider"></div>
        @foreach ($notifications as $notifiaction)
            <a href="{{ $notifiaction->data['url'] }}?notifications_id={{ $notifiaction->id }}"
                class="dropdown-item @if ($notifiaction->unreade()) text-bold @endif">
                <i class="{{ $notifiaction->data['icon'] }} mr-2"></i> {{ $notifiaction->data['body'] }}
                <span
                    class="float-right text-muted text-sm">{{ $notifiaction->created_at->longAbsoluteDiffForHumans() }}</span>
            </a>
            <div class="dropdown-divider"></div>
        @endforeach
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>
