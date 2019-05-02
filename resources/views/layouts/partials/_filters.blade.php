<ul class="nav justify-content-center mb-3">
    <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Filter by:</a>
    </li>
    <li class="nav-item">
        <a href="/tasks?by={{ auth()->user()->slug }}" class="nav-link">My Tasks</a>
    </li>
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            Assigned To <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            @foreach($assignedUsers as $user)
                <a href="/tasks?assigned={{ $user->slug }}" class="dropdown-item">{{ $user->name }}</a>
            @endforeach
        </div>
    </li>
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            Statuses <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            @foreach($statuses as $status)
                <a href="/tasks?status={{ $status->id }}" class="dropdown-item">{{ $status->name }}</a>
            @endforeach
        </div>
    </li>
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            Tags <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            @foreach($tags as $tag)
                <a href="/tasks?tag={{ $tag->id }}" class="dropdown-item">{{ $tag->name }}</a>
            @endforeach
        </div>
    </li>
</ul>