<x-app-layout class="shadow">
    <div class="py-12">
        <div class="max-w-7xl d-flex justify-content-center sm:px-6 lg:px-8" style="margin-left:30rem!important;">
            {{-- create ticketer panel --}}
            <div class="container p-6 ">
                @if ($user)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 ">
                        {{-- Ticket Box --}}
                        <div style="width:98%!important;height:20rem ! important; "
                            class="scale-100 p-6 bg-white from-gray-700/50 via-transparent rounded-lg m-2 shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div class="row">
                                <div class="col-6">
                                    {{-- User profile --}}
                                    <div class="h-16 w-16 bg-red-50 flex items-center justify-center rounded-full">
                                        {{-- ticket thumbinal image --}}
                                        <div class="rounded-circle " style="font-size:3rem !important">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    {{-- add to card option --}}
                                    <label for="name">Name</label>
                                    <h2 class="mx-4">{{ $user->name }}</h2>
                                </div>
                                <div class="col-10">
                                    <label for="emmail">Email</label>
                                    <h3 class="mx-4">{{ $user->email }}</h3>
                                </div>
                                <div class="col-6">
                                    <label for="phone"> phone</label>
                                    <h5 class="mx-4">{{ $user->phone }}</h5>
                                </div>
                                <div class="col-6">
                                    <label for="usertype">UserType</label>
                                     <h4>{{ $user->UserType == 1 ? 'Admin' : 'User' }}</h4>
                                </div>
                            </div>

                        </div>
                    </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
