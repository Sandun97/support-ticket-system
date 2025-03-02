@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reply Form') }}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('SupportTicketReplySave') }}">
                        @csrf

                        <input type="hidden" name="support_ticket_id" id="support_ticket_id" value="{{$ticketsId}}">

                        <div class="row mb-3">
                            <label for="reply_message" class="col-md-4 col-form-label text-md-end">{{ __('Customer Name : ') }}</label>
                            <div class="col-md-6">
                                <label for="reply_message" class="col-form-label text-md-end">{{ $ticket->name }}</label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="reply_message" class="col-md-4 col-form-label text-md-end">{{ __('Email : ') }}</label>
                            <div class="col-md-6">
                                <label for="reply_message" class="col-form-label text-md-end">{{ $ticket->email }}</label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="reply_message" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number : ') }}</label>
                            <div class="col-md-6">
                                <label for="reply_message" class="col-form-label text-md-end">{{ $ticket->mobileNumber }}</label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="reply_message" class="col-md-4 col-form-label text-md-end">{{ __('Problem Description : ') }}</label>
                            <div class="col-md-6">
                                <label for="reply_message" class="col-form-label text-md-end">{{ $ticket->problem_description }}</label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="reply_message" class="col-md-4 col-form-label text-md-end">{{ __('Reply Messsage : ') }}</label>

                            <div class="col-md-6">
                                <textarea id="reply_message" class="form-control @error('reply_message') is-invalid @enderror" name="reply_message" required rows="4" autocomplete="reply_message">{{ old('reply_message') }}</textarea>

                                @error('problem_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-warning">
                                    {{ __('Reply Submit') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection