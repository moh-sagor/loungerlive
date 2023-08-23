@extends('adminPanel.mainpage')
@section('main')
    <div class="container" style="padding-top: 10px;">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Manage Requests
            </div>
            <div class="row">
                <div class="col-md-9 p-3">
                    <button type="button" class="btn btn-info position-relative ms-3">
                        Unread
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger ">
                            {{ $unreadCount++ }}
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary position-relative ms-4">
                        Read
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger ">
                            {{ $readCount++ }}
                        </span>
                    </button>
                </div>
                <div class="col-md-3 mt-1 form-group px-4">
                    <input class="form-control" type="text" id="myInput" onkeyup="myFunction()"
                        placeholder="Search for Request.." title="Type in a name or email">
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
                                <th>Status </th>
                                <th>Action</th>
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
                                    <td class="status" style="color: {{ $data->status === 'read' ? 'green' : 'red' }}">
                                        {{ $data->status }}
                                    </td>
                                    <td>
                                        <form class="d-inline-block mr-2" method="post"
                                            action="{{ route('emails.update-status', $data->id) }}">
                                            @csrf
                                            <input type="hidden" name="status"
                                                value="{{ $data->status === 'read' ? 'unread' : 'read' }}">
                                            <button type="submit" class="btn btn-primary">
                                                {{ $data->status === 'read' ? 'Unread' : 'Read' }}
                                            </button>
                                        </form>

                                        <form class="d-inline-block" method="post"
                                            action="{{ route('emails.delete-request', $data->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger delete-btn">Delete</button>
                                        </form>
                                    </td>
                                    @php
                                        $serialNumber++;
                                    @endphp
                                </tr>
                            </tbody>
                        @endforeach
                </div>
                </table>

            </div>
        </div>
    </div>
    <script>
        function toggleStatus(button, requestId, currentStatus) {
            var row = button.closest('tr');
            var statusCell = row.querySelector('.status');

            var newStatus = currentStatus === 'read' ? 'unread' : 'read';

            fetch(`/update-status/${requestId}`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        status: newStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        statusCell.textContent = newStatus;
                        button.textContent = newStatus === 'read' ? 'Unread' : 'Read';
                    }
                })
                .catch(error => {
                    console.error('Error updating status:', error);
                });
        }




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
