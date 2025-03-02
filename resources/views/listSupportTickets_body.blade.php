<style>
.status-label {
    /* display: inline-block; */
    padding: 1px 8px;
    border-radius: 5px;
    font-weight: bold;
}

.status-pending {
    background-color: #ffc107; /* Yellow for pending status */
    color: #000;
}

.status-replied {
    background-color: #28a745; /* Green for replied status */
    color: #fff;
}
</style>

<!-- Add these lines in your head section or before closing body tag -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


<div class="table-responsive">
    <table id="supportTicketTable" class="table">
        <thead>
            <tr>
                <th>Ticket-No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile Number</th>
                <th>Problem Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                @php
                    $status = '';
                    if($ticket->status == 0)
                    {
                        $status = 'New Ticket';
                        $st = 'status-pending';
                    } else if($ticket->status == 1) {
                        $status = 'Replied';
                        $st = 'status-replied';
                    }
                @endphp
                <tr>
                    <td>{{ $ticket->ticketNumber }}</td>
                    <td>{{ $ticket->name }}</td>
                    <td>{{ $ticket->email }}</td>
                    <td>{{ $ticket->mobileNumber }}</td>
                    <td>{{ $ticket->problem_description }}</td>
                    <td><span class='status-label {{ $st }}'>{{ $status }}</span></td>
                    <td><a href="{{ route('SupportTicketReply', ['id' => $ticket->id]) }}">Reply</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function () {
        $('#supportTicketTable').DataTable({
            "searching": false
        });
    });
</script>