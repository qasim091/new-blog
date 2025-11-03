<a href="{{ route('blog.show', $post->slug) }}" class="glass-card overflow-hidden group block">
    <div class="relative overflow-hidden">
        <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-56 object-cover transition-smooth group-hover:scale-110">
        <div class="absolute inset-0 bg-gradient-to-t from-background/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-smooth"></div>
    </div>

    <div class="p-6 space-y-4">
        <div class="flex items-center justify-between">
            <span class="glass-strong px-3 py-1 rounded-full text-xs font-bold shadow-[var(--shadow-subtle)]">
                {{ $post->category->name }}
            </span>
            <span class="text-xs text-muted-foreground font-medium">{{ $post->read_time }}</span>
        </div>

        <h3 class="text-xl font-bold group-hover:gradient-text transition-smooth leading-tight">
            {{ $post->title }}
        </h3>

        <p class="text-muted-foreground text-sm leading-relaxed line-clamp-3">
            {{ $post->excerpt }}
        </p>

        <div class="flex items-center gap-3 pt-2">
            @if($post->author)
            <img src="{{ $post->author->avatar }}" alt="{{ $post->author->name }}" class="w-8 h-8 rounded-full ring-2 ring-border">
            <div class="flex-1">
                <p class="text-sm font-semibold">{{ $post->author->name }}</p>
                <p class="text-xs text-muted-foreground">{{ $post->published_date->format('M d, Y') }}</p>
            </div>
            @else
            <div class="flex-1">
                <p class="text-xs text-muted-foreground">{{ $post->published_date->format('M d, Y') }}</p>
            </div>
            @endif
        </div>
    </div>
</a>
