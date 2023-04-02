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
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                {{-- main area ticketer panel --}}
                <div class="heading text-uppercase fs-3 text-uppercase fw-bold ">
                    <div class="row">
                        <div class="col-10">
                            Purchased List
                        </div>
                    </div>
                </div>
                <hr>
                <div class="container mt-4">
                    <div class="row ">
                        @if ($purchased)
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sr.</th>
                                            <th scope="col">Ticket Name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Totale Price</th>
                                            <th scope="col">purchased date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                            $quentity = 1;
                                            $total = 0;
                                        @endphp
                                        @foreach ($purchased as $item)
                                            <tr>
                                                <th scope="row"> {{ $i++ }}</th>
                                                <td>
                                                    <span class="rounded-circle fs-2">
                                                        <i class="fa-solid fa-ticket"></i>
                                                        <span class="fs-4 ">{{ $item->ticket->TicketName }}</span>
                                                    </span>
                                                </td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->totalPrice }}<i
                                                        class="fa-sharp fa-solid fa-indian-rupee-sign  m-2"></i></td>
                                                <td>{{ $item->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @else
                        @endif
                        </table>
                    </div>
                </div>
            </div>
            {{-- main area ticketer panel --}}
        </div>
    </div>
    </div>
</x-app-layout>
