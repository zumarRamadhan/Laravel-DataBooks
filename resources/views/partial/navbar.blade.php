<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand ms-3" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/book/all">Book</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/publisher/all">Publisher</a>
          </li>
          @auth
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Welcome {{ auth()->user()->name }}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><form action="/logout" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item "><i class="bi bi-box-arrow-in-right"></i> Logout</button>
                </form></li>    
                @else
                <li><a class="dropdown-item nav-link {{ ($active === "login")? 'active' : '' }}" href="/login">Log In</a></li>
              </ul>
            </li>
            @endauth
        </ul>
      </div>
    </div>
  </nav>