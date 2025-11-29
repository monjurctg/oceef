<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">{{ $title }}</h5>
        <p class="card-text">{{ $description }}</p>
        @if(isset($slot))
            <div>{{ $slot }}</div>
        @endif
    </div>
</div>
