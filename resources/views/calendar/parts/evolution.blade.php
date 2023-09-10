<ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
    @foreach($evolutions as $finished)
    <li class="media">
    <img alt="image" class="mr-3 rounded-circle" width="35" src="http://127.0.0.1:8000/template/assets/img/users/user-3.png">
    <div class="media-body">
        
        <div class="media-title mb-1">{{ $finished->date->format('d/m/Y') }} - {{ $finished->typeText }}</div>
        <div class="text-time">Por <strong>{{ $finished->instructor->user->shortName }}</strong></div>
        <div class="media-description text-muted">{{ $finished->evolution }}</div>
        
    </div>
    </li>
    @endforeach
</ul>