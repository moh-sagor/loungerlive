@extends('adminPanel.mainpage')
@section('main')
    <div class="container" style="padding-top: 10px;">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Manage Requests
            </div>
            <div class="row">
                <div class="col-md-9">
                </div>
                <div class="col-md-3 mt-1">
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Request.."
                        title="Type in a name or email">
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Request Date</th>
                            </tr>
                        </thead>
                        @foreach ($savedData->reverse() as $data)
                            <tbody>
                                <tr>
                                    <th>{{ $serialNumber }}</th>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->created_at->format('Y-m-d') }}
                                        <sup>{{ $data->created_at->diffForHumans() }}</sup>
                                    </td>
                                    @php
                                        $serialNumber++;
                                    @endphp
                                </tr>
                            </tbody>
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
