<li class="nav-item dropdown">
    <a id="navbarDropdown"
       class="nav-link dropdown-toggle"
       href="#" role="button"
       data-toggle="dropdown"
       aria-haspopup="true"
       aria-expanded="false"
    >
        <!-- esto lo que hace es acceder los datos del logeado-->
      {{ auth()->user()->name }}<span class="caret"></span>
    </a>
    <!-- opcion para cerrar opcion-->
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{route('logout')}}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        >
            {{__("Cerrar sessión")}}
        </a>
        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</li>
