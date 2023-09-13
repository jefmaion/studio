<ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
    @foreach($evolutions as $finished)
    <li class="media">
    <img alt="image" class="mr-3 rounded-circle" width="35" src="{{ avatar($finished->instructor->user->avatar) }}">
    <div class="media-body">
        
        <div class="media-title mb-1">{{ $finished->date->format('d/m/Y') }} - {{ $finished->typeText }}</div>
        <div class="text-time">Por <strong>{{ $finished->instructor->user->shortName }}</strong></div>
        <div class="media-description text-muted">{{ $finished->evolution }}</div>
        
    </div>
    </li>
    @endforeach
</ul>