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
                             User List
                        </div>
                        {{-- create ticket --}}
                        <div class="col-2">
                            <a href="{{ route('Admin.CreatUser') }}" class="btn btn-outline-success">Add</a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="container mt-4">
                    <div class="row ">
                        @if ($users)
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sr.</th>
                                            <th scope="col">User name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">phone</th>
                                            <th scope="col">User Type</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($users as $user)
                                            <tr>
                                                <th scope="row"> {{ $i++ }}</th>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->UserType == 1 ? 'admin':'user' }}</td>
                                                <td>
                                                    <a href="{{route('Admin.ViewOneUser',$user->id)}}"  type="button" class="btn btn-outline-primary"><i
                                                            class="far fa-eye"></i></a>
                                                    @if (auth()->user()->id != $user->id)

                                                    <a href="{{route('Admin.EditUser',$user->id)}}" type="button" class="btn btn-outline-success"><i
                                                            class="fas fa-edit"></i></a>
                                                    <a href="{{route('Admin.DeletetUser',$user->id)}}" type="button" class="btn btn-outline-danger"><i
                                                            class="far fa-trash-alt"></i></a>
                                                    @endif
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



