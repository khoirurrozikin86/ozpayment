@extends('layouts.admin')
@section('title', 'Pembayaran')

@section('breadcrumb')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
            <li class="breadcrumb-item active">Pembayaran</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex flex-wrap gap-2 align-items-end mb-3">
                        <div>
                            <label class="form-label">Date From</label>
                            <input type="date" class="form-control form-control-sm" id="f_date_from">
                        </div>
                        <div>
                            <label class="form-label">Date To</label>
                            <input type="date" class="form-control form-control-sm" id="f_date_to">
                        </div>
                        <div>
                            <label class="form-label">User</label>
                            <select id="f_user_id" class="form-select form-select-sm">
                                <option value="">— All —</option>
                                @foreach ($users as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-grow-1">
                            <label class="form-label">Keyword</label>
                            <input type="text" class="form-control form-control-sm" id="f_kw"
                                placeholder="no tagihan / pelanggan / method / ref">
                        </div>
                        <div>
                            <button class="btn btn-primary btn-sm" id="btnFilter">Apply</button>
                            <button class="btn btn-outline-secondary btn-sm" id="btnReset">Reset</button>
                        </div>
                        <div class="ms-auto">
                            <a href="javascript:void(0)" id="btnExport" class="btn btn-outline-secondary btn-sm">Export
                                Excel</a>
                        </div>
                    </div>

                    <div class="row g-3 mb-2">
                        <div class="col-sm-4">
                            <div class="p-3 bg-light rounded-2">
                                <div class="small text-muted">Total Transaksi</div>
                                <div id="sum_tx" class="fs-5 fw-semibold">0</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="p-3 bg-light rounded-2">
                                <div class="small text-muted">Total Amount</div>
                                <div id="sum_amount" class="fs-5 fw-semibold">0.00</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="p-3 bg-light rounded-2">
                                <div class="small text-muted">Avg Amount</div>
                                <div id="avg_amount" class="fs-5 fw-semibold">0.00</div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="payments-table" class="table w-100">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Paid At</th>
                                    <th>Amount</th>
                                    <th>No Tagihan</th>
                                    <th>ID Pelanggan</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Method</th>
                                    <th>Ref No</th>
                                    <th>User</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('vendor-styles')
    <link rel="stylesheet" href="{{ asset('vendor/nobleui/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <style>
        .dataTables_wrapper .dropdown {
            position: static;
        }

        .dataTables_wrapper .dropdown-menu {
            z-index: 2000;
        }
    </style>
@endpush
@push('vendor-scripts')
    <script src="{{ asset('vendor/nobleui/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/nobleui/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('scripts')
    <script>
        (function($) {
            'use strict';
            const DT_SEL = '#payments-table';

            function safeFeatherReplace() {
                if (window.feather && feather.icons) {
                    try {
                        feather.replace();
                    } catch (e) {}
                }
            }

            function gatherFilters() {
                return {
                    date_from: $('#f_date_from').val() || '',
                    date_to: $('#f_date_to').val() || '',
                    user_id: $('#f_user_id').val() || '',
                    kw: $('#f_kw').val() || '',
                };
            }

            function loadSummary() {
                const f = gatherFilters();
                $.get(@json(route('super.payments.summary')), f)
                    .done(res => {
                        $('#sum_tx').text(res.tx_count ?? 0);
                        $('#sum_amount').text(parseFloat(res.total_amount ?? 0).toFixed(2));
                        $('#avg_amount').text(parseFloat(res.avg_amount ?? 0).toFixed(2));
                    });
            }

            const dt = $(DT_SEL).DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: @json(route('super.payments.dt')),
                    data: function(d) {
                        const f = gatherFilters();
                        Object.assign(d, f);
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'pembayarans.id'
                    },
                    {
                        data: 'paid_at',
                        name: 'pembayarans.paid_at'
                    },
                    {
                        data: 'amount',
                        name: 'pembayarans.amount'
                    },
                    {
                        data: 'no_tagihan',
                        name: 'tagihans.no_tagihan'
                    },
                    {
                        data: 'id_pelanggan',
                        name: 'tagihans.id_pelanggan'
                    },
                    {
                        data: 'nama_pelanggan',
                        name: 'pelanggans.nama'
                    },
                    {
                        data: 'method',
                        name: 'pembayarans.method'
                    },
                    {
                        data: 'ref_no',
                        name: 'pembayarans.ref_no'
                    },
                    {
                        data: 'user_name',
                        name: 'users.name'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [1, 'desc']
                ]
            }).on('draw.dt', safeFeatherReplace);

            $('#btnFilter').on('click', function() {
                dt.ajax.reload();
                loadSummary();
            });
            $('#btnReset').on('click', function() {
                $('#f_date_from').val('');
                $('#f_date_to').val('');
                $('#f_user_id').val('');
                $('#f_kw').val('');
                dt.ajax.reload();
                loadSummary();
            });

            $('#btnExport').on('click', function() {
                const f = gatherFilters();
                const q = $.param(f);
                window.location = @json(route('super.payments.export')) + '?' + q;
            });

            // delete payment (pakai partial class default)
            $(document).on('click', '.btn-delete-role', function() {
                const url = $(this).data('url');
                const token = $('meta[name="csrf-token"]').attr('content');

                const ask = window.Swal ? Swal.fire({
                    icon: 'warning',
                    title: 'Delete?',
                    showCancelButton: true
                }).then(r => r.isConfirmed) : Promise.resolve(confirm('Delete?'));
                ask.then(ok => {
                    if (!ok) return;
                    $.post(url, {
                        _method: 'DELETE',
                        _token: token
                    }).done(() => {
                        if (window.Swal) {
                            Swal.fire({
                                toast: true,
                                icon: 'success',
                                title: 'Deleted',
                                timer: 1600,
                                showConfirmButton: false
                            });
                        }
                        dt.ajax.reload(null, false);
                        loadSummary();
                    });
                });
            });

            // initial load summary
            loadSummary();
        })(jQuery);
    </script>
@endpush
