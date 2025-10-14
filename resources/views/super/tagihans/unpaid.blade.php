@extends('layouts.admin')
@section('title', 'Tagihan Belum Lunas')

@section('breadcrumb')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
            <li class="breadcrumb-item active">Tagihan Belum Lunas</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="card-title mb-0">Tagihan Belum Lunas</h6>
                        <div class="d-flex gap-2">
                            <a href="javascript:void(0)" id="btnExport" class="btn btn-outline-secondary btn-sm">Export
                                Excel</a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="unpaid-table" class="table w-100">
                            <thead>
                                <tr>
                                    <th>No Tagihan</th>
                                    <th>Pelanggan</th>
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Tgl Bayar</th>
                                    <th>Updated</th>
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

{{-- Modal Pembayaran (reuse dari modul Tagihan) --}}
@include('super.tagihans.partials.modal-pay')

@push('vendor-styles')
    <link rel="stylesheet" href="{{ asset('vendor/nobleui/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <style>
        /* aman untuk dropdown di tabel */
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

            // CSRF utk semua AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            function safeFeatherReplace() {
                if (window.feather && feather.icons) {
                    try {
                        feather.replace();
                    } catch (e) {}
                }
            }

            function toastOk(msg) {
                if (window.Swal) {
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        position: 'top-end',
                        timer: 1800,
                        showConfirmButton: false,
                        title: msg || 'Success'
                    });
                } else alert(msg || 'Success');
            }

            function toastErr(msg) {
                if (window.Swal) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: msg || 'Something went wrong'
                    });
                } else alert(msg || 'Error');
            }

            const DT_SEL = '#unpaid-table';
            const dt = $(DT_SEL).DataTable({
                processing: true,
                serverSide: true,
                ajax: @json(route('super.tagihans.unpaid.dt')),
                columns: [{
                        data: 'no_tagihan',
                        name: 'tagihans.no_tagihan'
                    },
                    {
                        data: 'nama_pelanggan',
                        name: 'pelanggans.nama'
                    },
                    {
                        data: 'nama_bulan',
                        name: 'bulans.bulan'
                    },
                    {
                        data: 'tahun',
                        name: 'tagihans.tahun'
                    },
                    {
                        data: 'jumlah_tagihan',
                        name: 'tagihans.jumlah_tagihan'
                    },
                    {
                        data: 'status',
                        name: 'tagihans.status'
                    },
                    {
                        data: 'tgl_bayar',
                        name: 'tagihans.tgl_bayar'
                    },
                    {
                        data: 'updated_at',
                        name: 'tagihans.updated_at'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [7, 'desc']
                ]
            }).on('draw.dt', safeFeatherReplace);

            // Export unpaid
            $('#btnExport').on('click', function() {
                window.location = @json(route('super.tagihans.unpaid.export'));
            });

            // === Modal Bayar ===
            const payModalEl = document.getElementById('payModal');
            const bsPayModal = new bootstrap.Modal(payModalEl);
            const $payForm = $('#payForm');
            const $btnPaySubmit = $('#btnPaySubmit');

            // buka modal dari dropdown actions (class: .btn-pay-item)
            $(document).on('click', '.btn-pay-item', function() {
                let p = {};
                try {
                    p = JSON.parse($(this).attr('data-payload') || '{}');
                } catch (e) {}
                $('#pay_tagihan_id').val(p.tagihan_id || '');
                $('#pay_amount').val(p.default_amount || '');
                $('#pay_paid_at').val((new Date()).toISOString().slice(0, 10));
                bsPayModal.show();
            });

            // submit pembayaran
            $payForm.on('submit', function(e) {
                e.preventDefault();
                const fd = new FormData($payForm[0]);
                $('#btnPaySubmit').prop('disabled', true).text('Saving...');
                $.ajax({
                        url: @json(route('super.tagihans.store')),
                        method: 'POST',
                        data: fd,
                        processData: false,
                        contentType: false
                    })
                    .done(res => {
                        toastOk(res.message || 'Payment recorded');
                        bsPayModal.hide();
                        $(DT_SEL).DataTable().ajax.reload(null, false);
                    })
                    .fail(xhr => toastErr(xhr.responseJSON?.message || 'Failed'))
                    .always(() => $('#btnPaySubmit').prop('disabled', false).text('Bayar'));
            });

        })(jQuery);
    </script>
@endpush
