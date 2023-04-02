<x-app-layout class="shadow ">

    <div class="py-12 mt-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6" style="background-color: #bbb!important">
                {{-- main area ticketer panel --}}
                <h1 class="fs-3">Admin panel</h1>
            </div>
        </div>
        {{-- Display on dashboard (Only for admin) titles --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2 mt-4">
            <div class="row ">
                <div class="col-4 ">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6"
                        style="background-color: #bbb!important">
                        {{-- diplay charts --}}
                        <h4>Total Ticket</h4>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm mt-2 sm:rounded-lg p-6 ">
                        {{-- total ticket count --}}
                        <div class="container d-flex justify-content-center">
                            @if ($ticket && !$ticket->isEmpty())
                                <span class="dot shadow-xl "
                                    style=" height:12rem;width: 12rem;background-color: #bbb;border-radius:50%;display: inline-block;">
                                    <span class="d-flex justify-content-center"
                                        style="font-size:3.5rem;margin-top:2.5rem;color:white;">{{ $ticket->count() }}</span>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6"
                        style="background-color: #bbb!important">
                        {{-- diplay charts --}}
                        <h4>Total Purchased Count</h4>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm mt-2 sm:rounded-lg p-6" style="overflow-y: scroll;">
                        {{-- diplay total purchased ticket --}}
                        @if ($purchased && !$purchased->isEmpty())
                            @php
                                $purchasedTicket = 0;
                                foreach ($purchased as $item) {
                                    $purchasedTicket += $item->quantity;
                                }
                                
                            @endphp

                            <div class="container d-flex justify-content-center">
                                <span class="dot shadow-xl"
                                    style=" height:12rem;width: 12rem;background-color: #bbb;border-radius:50%;display: inline-block;">
                                    <span class="d-flex justify-content-center"
                                        style="font-size:3.5rem;margin-top:2.5rem;color:white;">{{ $purchasedTicket }}</span>
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-4 ">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6"
                        style="background-color: #bbb!important">
                        {{-- diplay charts --}}
                        <h4>Total Amount</h4>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm mt-2 sm:rounded-lg p-6">
                        {{-- display total  purchased amount --}}
                        @if ($purchased && !$purchased->isEmpty())
                            @php
                                $totalMony = 0;
                                foreach ($purchased as $item) {
                                    $totalMony += $item->totalPrice;
                                }
                            @endphp
                            <div class="container d-flex justify-content-center">
                                <span class="dot shadow-xl"
                                    style=" height:12rem;width: 12rem;background-color: #bbb;border-radius:50%;display: inline-block;">
                                    <span class="d-flex justify-content-center"
                                        style="font-size:3rem;margin-top:3rem;color:white;">{{ $totalMony }} ₹</span>
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-3">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6" style="background-color: #bbb!important">
                {{-- main area ticketer panel --}}
                <h1 class="fs-3">Purchased User List</h1>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                {{-- display tables --}}
                @if ($userPurchased)
                    <div class="container mt-4">
                        <div class="row ">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sr.</th>
                                            <th scope="col">User name</th>
                                            <th scope="col">Tickets</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Total purchased</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($userPurchased as $item)
                                            @php
                                                $price = $item->totalPrice / $item->quantity;
                                            @endphp
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ $item->ticket->TicketName }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $price }} ₹ </td>
                                                <td>{{ $item->totalPrice }} ₹ </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{ $userPurchased->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>

</x-app-layout>
