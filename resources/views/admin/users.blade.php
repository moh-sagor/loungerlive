@extends('adminPanel.mainpage')
@section('main')
    <div class="container-fluid px-4" style="padding-top: 10px;">
        <div class="jumbotron text-center bg-secondary form-control mb-1">
            <h1 class="display-6">Manage Users</h1>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Manage users or Update Role
            </div>
            <div class="row">
                <div class="col-md-9">
                </div>
                <div class="col-md-3 mt-1 form-group">
                    <input class="form-control" type="text" id="myInput" onkeyup="myFunction()"
                        placeholder="Search for Users.." title="Type in a name">
                </div>
            </div>
            <div class="col-md-12">
                <div class="card-body">
                    @php
                        $serialNumber = 1;
                    @endphp
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>UserName</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($users as $user)
                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                @csrf
                                <tbody>
                                    <tr>
                                        <th>{{ $serialNumber }}</th>
                                        <td> <a href="{{ route('users.show', $user->username) }}"
                                                style="text-decoration: none">{{ $user->username }}</a></td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <select name="role_id" id="role" class="form-control">
                                                <option value="{{ $user->role->id }}" selected>
                                                    {{ ucfirst($user->role->name) }}</option>
                                                <option value="1">Admin</option>
                                                <option value="2">Author</option>
                                                <option value="3">Subscriber</option>
                                            </select>
                                        </td>
                                        <td>{{ $user->created_at->format('Y-m-d') }}
                                            <sup>{{ $user->created_at->diffForHumans() }}</sup>
                                        </td>


                                        <td>
                                            <div class="d-flex">
                                                <form action="{{ route('users.update', $user->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                                                </form>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="post"
                                                    class="ms-2">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger mt-2 delete-btn"
                                                        data-user-id="{{ $user->id }}">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                        @php
                                            $serialNumber++;
                                        @endphp
                                    </tr>
                                </tbody>
                            </form>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            var input, filter, table, tr, tdName, tdEmail, i, txtValueName, txtValueEmail;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                tdName = tr[i].getElementsByTagName("td")[1];
                tdEmail = tr[i].getElementsByTagName("td")[2];
                if (tdName || tdEmail) {
                    txtValueName = tdName.textContent || tdName.innerText;
                    txtValueEmail = tdEmail.textContent || tdEmail.innerText;
                    if (txtValueName.toUpperCase().indexOf(filter) > -1 ||
                        txtValueEmail.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection
