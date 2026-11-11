<div id="navigation" class="is-fixed">
    <a href="#" class="navigation-trigger">Menu<span></span></a>
    <nav id="main-navigation">
        <ul>
            <li><a href="{{ route('home') }}#home" class="{{ ($active ?? '') === 'home' ? 'active' : '' }}"><span class="material-icons">home</span>home</a></li>
            <li><a href="{{ route('home') }}#about" class="{{ ($active ?? '') === 'about' ? 'active' : '' }}"><span class="material-icons">article</span>about</a></li>
            <li><a href="{{ route('home') }}#services" class="{{ ($active ?? '') === 'services' ? 'active' : '' }}"><span class="material-icons">build</span>services</a></li>
            <li><a href="{{ route('home') }}#work" class="{{ ($active ?? '') === 'work' ? 'active' : '' }}"><span class="material-icons">cases</span>portfolio</a></li>
            <li><a href="{{ route('home') }}#contact" class="{{ ($active ?? '') === 'contact' ? 'active' : '' }}"><span class="material-icons">email</span>contact</a></li>
            <li><a href="{{ route('blogs') }}" class="{{ ($active ?? '') === 'blog' ? 'active' : '' }}"><span class="material-icons">topic</span>blog</a></li>
        </ul>
    </nav>
</div>
