@include('package')
<nav class="navbar navbar-light bg-light shadow ">
    <div class="container-fluid">
        {{-- ticketlogo --}}
        <div class="h-12 w-16 bg-red-50 flex items-center justify-center rounded-full" style="margin-left:11%!important">
            {{-- ticket thumbinal image --}}
            <div class="rounded-circle fs-1 ml-4">
                <i class="fa-solid fa-ticket"></i>
            </div>

            <div class="fs-4 text-muted" style="position: absolute; left:2rem!important;">
                ({{ Auth::user()->name }})
            </div> 
        </div>

        <div class="dropdown" style="margin-right: 5rem!important;">
            <button class="btn btn-outline-secondary dropdown-toggle text-uppercase" type="button"
                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->UserType == 1 ? 'admin' : 'user' }} Option
            </button>

            <ul class="dropdown-menu text-uppercase " aria-labelledby="dropdownMenuButton1">
                @if (Auth::user()->UserType == 1)
                    <li><a class="dropdown-item disabled" href="#" tabindex="-1" aria-disabled="true">Manage
                            Account</a></li>
                    <li><a class="dropdown-item " href="{{ route('Admin.index') }}">Home</a></li>
                    <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
                    <li><a class="dropdown-item disabled" href="#" tabindex="-1" aria-disabled="true">Ticket's
                            Option</a></li>
                    <li><a class="dropdown-item" href="{{ route('Admin.ViewTicket') }}">Ticket</a></li>
                    <li><a class="dropdown-item disabled" href="#" tabindex="-1" aria-disabled="true">User's
                            Option</a></li>
                    <li><a class="dropdown-item"href="{{ route('Admin.ViewUser') }}">User</a></li>
                @else
                    <li><a class="dropdown-item disabled" href="#" tabindex="-1" aria-disabled="true">Manage
                            Account</a></li>
                    <li><a class="dropdown-item" href="{{ route('User.home') }}">Home</a></li>
                    <li><a class="dropdown-item" href="{{ route('User.index') }}">Cart List</a></li>
                    <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
                    <li><a class="dropdown-item disabled" href="#" tabindex="-1" aria-disabled="true">Own
                            Ticket</a></li>
                    <li><a class="dropdown-item" href="{{ route('User.ViewTicket') }}">Ticket</a></li>
                    <li><a class="dropdown-item" href="{{ route('User.SoldTicket') }}">Sold Ticket</a></li>
                    <li><a class="dropdown-item disabled" href="3" tabindex="-1" aria-disabled="true">Purchased
                            history</a></li>
                    <li><a class="dropdown-item"
                            href="{{ route('User.purchase_history', Auth::user()->id) }}">Purchased</a></li>
                @endif
                <li>
                    <hr class="dropdown-divider">
                </li>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Log Out</a></li>
                </form>
            </ul>

        </div>
    </div>
</nav>
