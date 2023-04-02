<x-app-layout class="shadow">
    {{-- alert section --}}
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <div class=" alert alert-danger text-center alert-dismissible fade show  float-center mt-3 "
                    style="width: 30%;" role="alert">
                    <li>{{ $error }}</li>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
        </ul>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- create ticketer panel --}}
                <div class="container p-6 center">
                    <div class="heading text-uppercase fs-3">
                        Create Ticket
                    </div>
                    <div class="form mt-3">
                        <form action="" method="post" class="needs-validation" novalidate>
                            @csrf
                            <hr>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <label for="validationCustom01" class="form-label">Ticket Name</label>
                                    <input type="text" class="form-control" name="TicketName" id="validationCustom01"
                                        placeholder="Enter the Ticket Name" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please Enter the Ticket's Name.
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="validationCustom01" class="form-label">Ticket Price</label>
                                    <input type="text" class="form-control" name="Ticketprice"
                                        id="validationCustom01" placeholder="Enter the Ticket Price " required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please Enter the Ticket's price.
                                    </div>
                                </div>
                                <div class=" col- 12 mb-3 mt-3">
                                    <label for="validationTextarea" class="form-label">Ticket Discription</label>
                                    <textarea class="form-control " name="TicketDiscription" rows="3" id="validationTextarea"
                                        placeholder="Enter the Discription of ticket" required></textarea>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter Discription about ticket.
                                    </div>
                                </div>
                                <div class="col-4 mt-3">
                                    <button class="btn btn-outline-primary" type="submit">Submit form</button>
                                </div>
                            </div>
                        </form>
                        {{-- create ticketer panel --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
