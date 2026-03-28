@extends('layouts.admin')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="mb-0">Contact Message</h4>
                        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-soft-secondary">Back</a>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="text-muted">From</div>
                                    <div class="fw-semibold">{{ $contactMessage->name }}</div>
                                    <div>{{ $contactMessage->email }}</div>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <div class="text-muted">Received</div>
                                    <div class="fw-semibold">{{ $contactMessage->created_at?->format('d M Y, H:i') }}</div>
                                    <div class="mt-2">
                                        @if ($contactMessage->is_read)
                                            <span class="badge bg-secondary">Read</span>
                                        @else
                                            <span class="badge bg-success">New</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="mb-3">
                                <div class="text-muted">Subject</div>
                                <div class="fw-semibold">{{ $contactMessage->subject ?: '—' }}</div>
                            </div>

                            <div class="mb-3">
                                <div class="text-muted">Message</div>
                                <div class="border rounded p-3 bg-light-subtle" style="white-space: pre-wrap;">{{ $contactMessage->message }}</div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <form method="POST" action="{{ route('admin.contact-messages.mark', $contactMessage) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="is_read" value="{{ $contactMessage->is_read ? 0 : 1 }}">
                                    <button type="submit" class="btn btn-soft-primary">
                                        {{ $contactMessage->is_read ? 'Mark as unread' : 'Mark as read' }}
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('admin.contact-messages.destroy', $contactMessage) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-soft-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="text-muted">
                        IP: {{ $contactMessage->ip_address ?: '—' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

