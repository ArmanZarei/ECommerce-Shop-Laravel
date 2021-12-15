@extends('admin.layouts.master')

@section('title')
    Comments
@endsection

@section('content')
    <div class="container-fluid p-4 rounded-2">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 bg-white rounded-2">
                    <div class="card-header bg-white d-flex align-items-center justify-content-between">
                        <h5 class="me-3">Comments</h5>
                    </div>
                    <div class="card-body">
                        <table class="table custom-table">
                            <thead>
                            <tr>
                                <th style="width: 2%;">#</th>
                                <th style="width: 8%;">PRODUCT</th>
                                <th style="width: 7%;">USER</th>
                                <th style="width: 25%;">CONTENT</th>
                                <th style="width: 5%;">STATUS</th>
                                <th style="width: 8%;">CREATED AT</th>
                                <th style="width: 5%;">ACTIONS</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($comments->isEmpty())
                                <tr>
                                    <td colspan="7" class="text-center pt-4 pb-4">No records found</td>
                                </tr>
                            @endif

                            @foreach($comments as $key => $comment)
                                @php($isPending = $comment->status == App\Models\Comment::STATUS_PENDING)
                                @php($isApproved = $comment->status == App\Models\Comment::STATUS_APPROVED)
                                @php($isRejected = $comment->status == App\Models\Comment::STATUS_REJECTED)
                                <tr>
                                    <td>{{ $comments->firstItem() + $key }}</td>
                                    <td>
                                        {{ $comment->product->name }}
                                    </td>
                                    <td>{{ $comment->user->name }}</td>
                                    <td class="p-4 text-jus">{{ $comment->text }}</td>
                                    <td>
                                        <div
                                            class="d-flex align-items-center {{ $isApproved ? "custom-text-primary" : ($isPending ? 'custom-text-warning' : "custom-text-danger") }}">
                                            <i class="fa fa-circle me-1" style="font-size: 8px"></i>
                                            <span
                                                class="custom-text-bold">{{ ucfirst(strtolower($comment->status)) }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $comment->created_at }}</td>
                                    <td>
                                        <div class="cell-actions d-flex align-items-center">
                                            <div class="d-flex rounded" style="background: #ecf0f1; padding: 5px 10px">
                                                <span class="mr-1">Mark as:</span>
                                                <div class="d-flex change-comment-status-actions">
                                                    <i data-cid="{{ $comment->id }}"
                                                       data-status="{{ App\Models\Comment::STATUS_PENDING }}"
                                                       class="fa fa-circle me-1 {{ $isPending ? 'status-selected' : '' }}"
                                                       style="font-size: 8px; color: #FFA800 !important;"></i>
                                                    <i data-cid="{{ $comment->id }}"
                                                       data-status="{{ App\Models\Comment::STATUS_APPROVED }}"
                                                       class="fa fa-circle me-1 {{ $isApproved ? 'status-selected' : '' }}"
                                                       style="font-size: 8px; color: #3699FF !important;"></i>
                                                    <i data-cid="{{ $comment->id }}"
                                                       data-status="{{ App\Models\Comment::STATUS_REJECTED }}"
                                                       class="fa fa-circle me-1 {{ $isRejected ? 'status-selected' : '' }}"
                                                       style="font-size: 8px; color: #F64E60 !important;"></i>
                                                </div>
                                            </div>
                                            <a class="ms-2"
                                               href="{{ route('front.product.show', $comment->product->id) }}"
                                               title="View Product"><i class="fad fa-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="custom-pagination mt-4">
                            {{ $comments->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const commentUpdateUrl = @json(route('admin.comments.update.status', 0));
        const csrfToken = @json(csrf_token());
        console.log(csrfToken)
        $(document).ready(function () {
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': csrfToken,
                    }
                });
            });

            $('.change-comment-status-actions i').on('click', function () {
                if ($(this).hasClass('status-selected'))
                    return;
                const commentId = $(this).data('cid');
                const status = $(this).data('status');
                $.post(commentUpdateUrl.replace(/0$/, commentId), {
                    '_method': 'put',
                    'status': status,
                }, () => location.reload());
            });
        });
    </script>
@endpush
