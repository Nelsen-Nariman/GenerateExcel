<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Claim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8fbff;
            min-height: 100vh;
        }
        .card {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .card-header {
            background-color: #f8fbff;
            border-bottom: 1px solid #dee2e6;
        }
        .nav-tabs .nav-link.active {
            background-color: #2196f3;
            color: #fff;
        }
        .nav-tabs .nav-link {
            color: #2196f3;
        }
        .btn-primary {
            background-color: #2196f3;
            border-color: #2196f3;
        }
        .btn-primary:hover {
            background-color: #1976d2;
            border-color: #1976d2;
        }
        .form-label {
            color: #495057;
        }
        .input-group-text.currency-symbol {
            background-color: #f8fbff;
            color: #495057;
            border: 1px solid #ced4da;
        }
        .form-control:focus {
            border-color: #2196f3;
            box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.1);
        }
        .form-label {
        color: #495057;
        font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mb-4">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('closing.index') }}">Input Closing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('claim.index') }}">Input Claim</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Input Claim</h4>
                    </div>
                    <div class="card-body">
                        <form id="claimForm" action="{{ route('claim.generate-excel') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="nama_tertanggung" class="form-label">Nama Tertanggung</label>
                                <input type="text" class="form-control" id="nama_tertanggung" name="nama_tertanggung" required>
                            </div>

                            <div class="mb-3">
                                <label for="currency" class="form-label">Currency</label>
                                <select class="form-select" id="currency" name="currency" required>
                                    <option value="IDR">IDR</option>
                                    <option value="USD">USD</option>
                                    <option value="SGD">SGD</option>
                                    <option value="MYR">MYR</option>
                                    <option value="JPY">JPY</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="total_tagihan" class="form-label">Total Tagihan Rumah Sakit</label>
                                <div class="input-group">
                                    <span class="input-group-text currency-symbol">IDR</span>
                                    <input type="text" class="form-control currency-input" id="total_tagihan" name="total_tagihan" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="manfaat_tahunan" class="form-label">Manfaat Tahunan Terakhir</label>
                                <div class="input-group">
                                    <span class="input-group-text currency-symbol">IDR</span>
                                    <input type="text" class="form-control currency-input" id="manfaat_tahunan" name="manfaat_tahunan" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="booster" class="form-label">Booster Terakhir</label>
                                <div class="input-group">
                                    <span class="input-group-text currency-symbol">IDR</span>
                                    <input type="text" class="form-control currency-input" id="booster" name="booster" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Generate Excel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currencySelect = document.getElementById('currency');
            const currencySymbols = document.querySelectorAll('.currency-symbol');

            // Update currency symbols when currency changes
            currencySelect.addEventListener('change', function() {
                const selectedCurrency = this.value;
                currencySymbols.forEach(symbol => {
                    symbol.textContent = selectedCurrency;
                });
            });

            function formatCurrency(input) {
                let value = input.value.replace(/\D/g, '');
                value = new Intl.NumberFormat('id-ID').format(value);
                input.value = value;
            }

            // Add event listeners to currency inputs
            document.querySelectorAll('.currency-input').forEach(input => {
                input.addEventListener('input', function() {
                    formatCurrency(this);
                });
            });
        });
    </script>
</body>
</html>