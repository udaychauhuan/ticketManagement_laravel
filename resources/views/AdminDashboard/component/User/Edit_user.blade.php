<x-app-layout class="shadow">
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
                        Edit User
                    </div>
                    <div class="form mt-3">
                        <form action="{{ route('Admin.EditUser',$user->id) }}" method="post" class="needs-validation"
                            novalidate>
                            @csrf
                            <hr>
                            <div class="row mt-3">
                                <div class="col-6 mb-3">
                                    <label for="validationCustom01" class="form-label">User name</label>
                                    <input type="text" class="form-control" name="UserName" value="{{$user->name}}" id="validationCustom01"
                                        placeholder="Enter user name ." required autocomplete="off">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please Enter the User's Name.
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="validationCustom01" class="form-label">Phone no.</label>
                                    <input type="text" class="form-control" name="UserPhone"  value="{{$user->phone}} "id="validationCustom01"
                                        placeholder="Enter user phone no." required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please Enter User's Phone Numeber
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="validationCustom01" class="form-label">Email</label>
                                    <input type="text" class="form-control" name="Useremail" value="{{$user->email }}" id="validationCustom01"
                                        placeholder="Enter User email" required autocomplete="off">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please Enter the User's Email.
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="validationCustom04" class="form-label">Select UserType</label>
                                    <select class="form-select" id="validationCustom04" name="UserType"   required>
                                        <option selected value="{{$user->UserType}}">{{$user->UserType == 1 ? 'Admin':'User'}}</option>
                                        <option value="0">User</option>
                                        <option value="1">Admin</option>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please select a valid state.
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-outline-primary" type="submit">Submit form</button>
                                </div>
                            </div>
                        </form>
                        {{-- create ticketer panel --}}
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
