@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Support Ticket List') }}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- <form method="POST" action="{{ route('SupportTicketCreate') }}"> -->
                        @csrf
                        <div class="row">
                            
                            <label for="search_name" class="col-md-9 col-form-label text-md-end">{{ __('Search Name') }}</label>
                            <div class="col-md-3">
                                <input id="search_name" type="text" class="form-control @error('search_name') is-invalid @enderror" name="search_name" onkeyup="get_ticket_information()">
                            </div>
                            <br><br><br>
                        </div>

                        <div class="row">
                            <div id="data-table-ticket-list">
                        </div>


                    

                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        get_ticket_information();
    });

    function get_ticket_information()
    {
        var search_name = $('#search_name').val();
        $.ajax({
            type: 'get',
            url: '{{route('SupportTicketList')}}',
            data: {
                search_name: search_name
            },
            async: true,
            success: function (data) {
                $("#data-table-ticket-list").html(data);
            }
        });
    }

</script>

@endsection
