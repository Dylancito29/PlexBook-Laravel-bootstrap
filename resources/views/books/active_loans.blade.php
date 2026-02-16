@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="text-primary fw-bold"><i class="bi bi-clipboard-data"></i> Manage Loans</h1>
            <p class="text-muted mb-0">Track active loans and process returns.</p>
        </div>
        
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3">ID</th>
                            <th class="py-3">User</th>
                            <th class="py-3">Book</th>
                            <th class="py-3">Loan Date</th>
                            <th class="py-3">Due Date</th>
                            <th class="py-3">Status</th>
                            <th class="pe-4 py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($loans as $loan)
                            <tr>
                                <td class="ps-4 fw-bold text-muted">#{{ $loan->id }}</td>
                                
                                <!-- User Info -->
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 35px; height: 35px;">
                                            {{ substr(optional($loan->user)->name ?? 'U', 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ optional($loan->user)->name ?? 'Unknown User' }}</div>
                                            <div class="small text-muted" style="font-size: 0.8rem;">{{ optional($loan->user)->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Book Info -->
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($loan->book)
                                            <img src="{{ $loan->book->cover_url }}" class="rounded shadow-sm" style="width: 40px; height: 60px; object-fit: cover;">
                                            <div>
                                                <span class="d-block fw-bold text-dark">{{ Str::limit($loan->book->title, 30) }}</span>
                                                <span class="small text-muted">{{ optional($loan->book->category)->name }}</span>
                                            </div>
                                        @else
                                            <span class="text-danger fst-italic"><i class="bi bi-exclamation-circle"></i> Book Deleted</span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Dates -->
                                <td class="text-muted">{{ \Carbon\Carbon::parse($loan->loan_date)->format('M d, Y') }}</td>
                                <td>
                                    @php
                                        // Check if the loan is overdue
                                        $returnDate = \Carbon\Carbon::parse($loan->return_date);
                                        $isOverdue = $returnDate->isPast() && $loan->status == 'active';
                                    @endphp
                                    
                                    <span class="{{ $isOverdue ? 'text-danger fw-bold' : 'text-dark' }}">
                                        {{ $returnDate->format('M d, Y') }}
                                        @if($isOverdue)
                                            <i class="bi bi-exclamation-triangle-fill ms-1" title="Overdue!"></i>
                                        @endif
                                    </span>
                                </td>

                                <!-- Status Badge -->
                                <td>
                                    @if($loan->status == 'active')
                                        @if($isOverdue)
                                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger">Overdue</span>
                                        @else
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success">Active</span>
                                        @endif
                                    @elseif($loan->status == 'returned')
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary">Returned</span>
                                    @else
                                        <span class="badge bg-light text-dark border">{{ ucfirst($loan->status) }}</span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="pe-4 text-end">
                                    @if($loan->status == 'active')
                                        <form action="{{ route('loans.return', $loan->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Mark as Returned" onclick="return confirm('Are you sure you want to mark this book as returned?')">
                                                <i class="bi bi-check-circle me-1"></i> Return Book
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted small"><i class="bi bi-check2-all"></i> Completed</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    No active loans found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="d-flex justify-content-center mt-4">
        {{ $loans->links() }}
    </div>
</div>
@endsection
