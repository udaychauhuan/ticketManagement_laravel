<x-app-layout class="shadow">
    <div class="py-12">
        <div class="max-w-7xl d-flex justify-content-center sm:px-6 lg:px-8" style="margin-left:30rem!important;">
                {{-- create ticketer panel --}}
                <div class="container p-6 ">
                   @if ($ticket)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 ">
                        {{-- Ticket Box --}}
                            <div style="width:98%!important;height:20rem ! important; "
                                class="scale-100 p-6 bg-white from-gray-700/50 via-transparent rounded-lg m-2 shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                                <div class="row">
                                    <div class="col-10">
                                        {{-- ticketlogo --}}
                                        <div class="h-16 w-16 bg-red-50 flex items-center justify-center rounded-full">
                                            {{-- ticket thumbinal image --}}
                                            <div class="rounded-circle fs-1">
                                                <i class="fa-solid fa-ticket"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 m-auto">
                                        {{-- add to card option --}}
                                        <a href="#" class="text-muted"><i
                                                class="fa-solid fa-cart-shopping fs-3" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="Add to cart"></i></a>
                                    </div>
                                    <div class="col-10 ">
                                        {{-- ticket name --}}
                                        <h1 class="mt-6 text-uppercase text-xl font-semibold text-gray-900 fs-1">
                                            {{ $ticket->TicketName }}</h1>
                                    </div>
                                    <div class="col-10">
                                        {{-- Ticket dicsription --}}
                                        <p class="mt-4  text-capitalize text-gray-500 text-sm  leading-relaxed">
                                            {{ $ticket->TicketDiscription }}
                                        </p>
                                    </div>
                                    <div class="col-2 m-auto">
                                        {{-- Ticket price --}}
                                        <p class="d-flex">{{ $ticket->TicketPrice }}<span class="mx-1"><i
                                                    class="fa-sharp fa-solid fa-indian-rupee-sign"></i></span></p>

                                    </div>
                                </div>
                            </div>
                    </div>
                @endif
                </div>
        </div>
    </div>
</x-app-layout>

