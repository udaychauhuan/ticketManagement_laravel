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

    {{-- alert section --}}
    @if (Session()->has('message'))
        <div class=" alert alert-{{ Session('status') === 'success' ? 'success' : 'danger' }} text-center alert-dismissible fade show  float-center mt-3 "
            style="width: 30%;" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($items)
                <form action="{{ route('User.purchase') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row ">
                        <div class="col-8">
                            <div class="bg-white overflow-hidden shadow-xl  p-3">
                                <div class="row">
                                    {{-- cart list heading --}}
                                    <div class="col-10">
                                        <h4 class="fs-4 text-muted">Cart List</h4>
                                    </div>
                                    {{-- all clear cart option --}}
                                    <div class="col-2">
                                        <a href="{{ route('User.clearAll') }}" class="btn btn-light text-primary">Clear
                                            All</a></td>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white overflow-hidden shadow-sm mt-2 sm:rounded-lg p-6 ">
                                {{-- display all cart items --}}
                                <div class="container d-flex justify-content-center">
                                    {{-- this table contains all the cart items with given field informations --}}
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-muted">
                                                <th scope="col">Sr.</th>
                                                <th scope="col">Ticket Name</th>
                                                <th scope="col">Tc/pr</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Total price</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        {{-- display the list of items to be in the cart --}}
                                        </tbody>
                                        @php
                                            $i = 1;
                                            $j = 0;
                                            $quentity = 1;
                                            $total = 0;
                                            $grandTotal = 0;
                                            $gandItemsTotal = 0;
                                        @endphp
                                        @foreach ($items as $item)
                                            @php
                                                $grandTotal += (int) $item->Quentity * $item->ticket->TicketPrice;
                                                $gandItemsTotal += (int) $item->Quentity;
                                                $j = $j+1; 
                                            @endphp
                                            <tr id="{{$j}}">
                                                <input type="hidden" name="cartId[]" value="{{ $item->id }}">
                                                <td>{{ $i++ }}</td>
                                                <input type="hidden" name="ticketId[]" id="ticket{{$j}}" value="{{ $item->ticket->id }}">
                                                <td>{{ $item->ticket->TicketName }}</td>
                                                <td class="ticketPrice" > {{ $item->ticket->TicketPrice }} ₹
                                                    {{-- just for jquery --}}
                                                    <input type="hidden"
                                                        value="{{ $item->ticket->TicketPrice }}" id="input{{$j}}1">
                                                </td>
                                                <td><input type="text" id="input{{$j}}" name="quantity[]"
                                                        value="{{ $item->Quentity }}" class="ticketQuantity" >
                                                </td>
                                                <td class="ticketTotal" id="input{{$j}}2">{{ (int) $item->Quentity * $item->ticket->TicketPrice }} ₹</td>
                                                <input type="hidden" name="totalPrice[]" 
                                                    value="{{ (int) $item->Quentity * $item->ticket->TicketPrice }}">
                                                <td><a href="{{ route('User.removePurchase', $item->id) }}"
                                                        class="btn btn-light text-primary">remove</a></td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $items->links() }}
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="bg-white overflow-hidden shadow-xl p-3 fixe-top">
                                <h4 class="fs-5 text-muted">price details</h4>
                            </div>
                            <div class="bg-white overflow-hidden shadow-sm mt-2 sm:rounded-lg p-6"
                                style="overflow-y: scroll;">
                                {{-- diplay total price detaiils here --}}
                                <div class="container justify-content-center">
                                    {{-- display  here is the total price and total no of items  --}}
                                    <ul class="list-group ">
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto p-2">
                                                <h5 class="text-muted  fw-bold ">ToTal Amount</h5>
                                                total of the tickets
                                            </div>
                                            <span class=" mt-3 fs-5  text-success fw-bold" id="grandTotalValue">{{ $grandTotal }} ₹</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto p-2">
                                                <h5 class="text-muted text-uppercase fw-bold ">ToTal Items</h5>
                                                total of no. of tickets
                                            </div>
                                            <span class=" mt-3 fs-5 text-success fw-bold" id="totalQuantityValue">{{ $gandItemsTotal }}</span>
                                        </li>
                                    </ul>
                                    <div class="d-flex mt-3  ">
                                        <hr>
                                        {{-- button to purchased all items in the cart list --}}
                                        <button type="submit" class="m-auto btn btn-warning "> Purchase All</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @else
            @endif
        </div>
    </div>
    </div>
</x-app-layout>
{{-- script --}}
 <script src="{{asset('js/main.js')}}"></script>
 <script>

    $(document).ready(function(){

        $(window).keydown(function(e){
            if(e.keyCode==13){
                e.preventDefault()
                return false;
            }
        })
        
    })

    $(".ticketQuantity").on('input',function(){
        //Ticket Quantity ID
        temp=$(this).attr("id")
        id1=temp.substring(5,temp.length)
        //Ticket Price ID
        id2="#input"+id1+"1"
        //Ticket Price
        ticketPrice=$(id2).val()      
        //Ticket Quantity  
        quantity=$(this).val()

        //Total Price ID
        id3="#input"+id1+"2"
        //Total Price
        totalPrice=ticketPrice*quantity
        //Setting Data
        $(id3).html(totalPrice+' ₹')
        changeTotalAmountItems()

        //user/addtocart/add/{id}
        ticketID="#ticket"+id1
        $.ajax({
            url:'/user/addtocart/add/'+$(ticketID).val()+"/"+quantity,
            data:{'quantity':quantity},
            success:function(e){
            }
        })

    })

    function changeTotalAmountItems(){

        grandTotal1=0
        totalQuantity=0
        $("table > tbody > tr").each(function(e){
        
            id10=$(this).attr('id')
            totalQuantity=totalQuantity+Number($("#input"+id10).val())
            grandTotal1=grandTotal1+Number($("#input"+id10+2).html().split(" ₹")[0])


        })
        $("#grandTotalValue").html(grandTotal1+" ₹")
        $("#totalQuantityValue").html(totalQuantity)

    }

 </script>
