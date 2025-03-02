@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Support Ticket Information') }}</div>

                <div class="card-body">
                    <!-- <form method="POST" action="{{ route('SupportTicketCreate') }}"> -->
                        @csrf
                        <div class="row mb-3">
                            
                            <label for="ticket_number" class="col-md-4 col-form-label text-md-end">{{ __('Ticket Number') }}</label>

                            <div class="col-md-6">
                                <input id="ticket_number" type="text" class="form-control @error('name') is-invalid @enderror" name="ticket_number" value="{{ old('name') }}" required autocomplete="ticket_number" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-success" onclick="get_ticket_information()">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <br>
                                <div id="reply_messages"></div>
                            </div>
                        </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function get_ticket_information()
    {
        var ticket_number = $('#ticket_number').val();
        $.ajax({
            type: 'get',
            url: '{{route('SupportTicketNumberInfo')}}',
            data: {
                ticket_number: ticket_number
            },
            async: true,
            success: function (data) {
                $("#reply_messages").html(data);
            }
        });
    }

</script>

@endsection
