<style>
    .container {
        padding: 2rem 0rem;
    }

    h4 {
        margin: 2rem 0rem 1rem;
    }

    .table-image {

        td,
        th {
            vertical-align: middle;
        }
    }
</style>

<x-app-layout class="shadow">


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row ">
                <div class="col-12">
                    <div class="bg-white overflow-hidden shadow-xl  p-3">
                        <div class="row">
                            {{-- cart list heading --}}
                            <div class="col-12">
                                <h4 class="fs-4 text-muted">Owned Ticket Purchased List</h4>
                            </div>
                        </div>
                    </div>
                    @if ($tickets)
                        <div class="bg-white overflow-hidden shadow-sm mt-2 sm:rounded-lg p-6 ">
                            {{-- display all cart items --}}
                            <div class="container d-flex justify-content-center">
                                {{-- this table contains all the cart items with given field informations --}}
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-muted">
                                            <th scope="col">Sr.</th>
                                            <th scope="col">User Name</th>
                                            <th scope="col">Ticket Name</th>
                                            <th scope="col">Tc/pr</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total price</th>
                                        </tr>
                                    </thead>
                                    {{-- display the list of items to be in the cart --}}
                                    </tbody>
                                     @php
                                        $i = 1;
                                        $quentity = 1;
                                        $total = 0;
                                        $grandTotal = 0;
                                        $gandItemsTotal = 0;
                                    @endphp
                                    @foreach ($tickets as $item)
                                        @php
                                            $grandTotal += (int) $item->Quentity * $item->ticket->TicketPrice;
                                            $gandItemsTotal += (int) $item->Quentity;
                                        @endphp
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->ticket->TicketName }}</td>
                                            <td> {{ $item->ticket->TicketPrice }} ₹</td>
                                            <td>{{ $item->quantity }}
                                            </td>
                                            <td>{{ $item->totalPrice }} ₹</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
    </div>
</x-app-layout>
