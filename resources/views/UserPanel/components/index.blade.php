
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
    @if (Session()->has('message'))
        <div class=" alert alert-{{ Session('status') === 'success' ? 'success' : 'danger' }} text-center alert-dismissible fade show  float-center mt-3 "
            style="width: 30%;" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                {{-- main area ticketer panel --}}
                <div class="heading text-uppercase fs-3 text-uppercase fw-bold ">
                    <div class="row">
                        <div class="col-10">
                            Cart Item
                        </div>
                    </div>
                </div>
                <hr>
                <div class="container mt-4">
                    <div class="row ">
                        @if ($items)
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sr.</th>
                                            <th scope="col">Ticket Name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">pr/tc</th>
                                            <th scope="col">Totale Price</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                            $quentity = 1;
                                            $total = 0;
                                        @endphp
                                        @foreach ($items as $item)
                                            <tr>
                                                <th scope="row"> {{ $i++ }}</th>
                                                <td>{{ $item->ticket->TicketName }}</td>
                                                <td>{{ $item->Quentity }}</td>
                                                <td>{{ $item->ticket->TicketPrice }}<i
                                                        class="fa-sharp fa-solid fa-indian-rupee-sign  m-2"></i></td>
                                                <td>{{ ((int)($item->Quentity) * ($item->ticket->TicketPrice)) }}<i
                                                        class="fa-sharp fa-solid fa-indian-rupee-sign  m-2"></i></td>
                                                <td>
                                                    <a href="{{route('User.purchase',$item->id)}}" type="button" class="btn btn-outline-primary"><i
                                                            class="fa fa-shopping-cart"></i><span
                                                            class="m-2">Buy</span></a>
                                                </td>
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
