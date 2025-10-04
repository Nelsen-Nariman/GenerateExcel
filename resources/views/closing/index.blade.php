<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Closing</title>
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
            font-weight: 600;
        }
        .input-group-text {
            background-color: #f8fbff;
            color: #495057;
            border: 1px solid #ced4da;
        }
        .form-control:focus {
            border-color: #2196f3;
            box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.1);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mb-4">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('closing.index') }}">Input Closing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('claim.index') }}">Input Claim</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Input Closing</h4>
                    </div>
                    <div class="card-body">
                        <form id="closingForm" action="{{ route('closing.generate-excel') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Tipe Klien</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipe_klien" id="individu" value="Individu" required checked>
                                        <label class="form-check-label" for="individu">Individu</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipe_klien" id="korporat" value="Korporat" required>
                                        <label class="form-check-label" for="korporat">Korporat</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="nama_pemegang_polis" class="form-label">Nama Pemegang Polis</label>
                                <input type="text" class="form-control" id="nama_pemegang_polis" name="nama_pemegang_polis" required>
                            </div>

                            <div class="mb-3">
                                <label for="tertanggung" class="form-label">Tertanggung</label>
                                <input type="text" class="form-control" id="tertanggung" name="tertanggung" required>
                            </div>

                            <div class="mb-3">
                                <label for="tertanggung_tambahan" class="form-label">Tertanggung Tambahan</label>
                                <input type="text" class="form-control" id="tertanggung_tambahan" name="tertanggung_tambahan">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tipe Plan</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipe_plan" id="tipe_x" value="X" required checked>
                                        <label class="form-check-label" for="tipe_x">X</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipe_plan" id="tipe_s" value="S" required>
                                        <label class="form-check-label" for="tipe_s">S</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Plan</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="plan" id="bronze_2" value="BRONZE II" required checked>
                                        <label class="form-check-label" for="bronze_2">BRONZE II</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="plan" id="bronze" value="BRONZE I" required>
                                        <label class="form-check-label" for="bronze">BRONZE I</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="plan" id="silver" value="SILVER" required>
                                        <label class="form-check-label" for="silver">SILVER</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="plan" id="gold" value="GOLD" required>
                                        <label class="form-check-label" for="gold">GOLD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="plan" id="titanium" value="TITANIUM" required>
                                        <label class="form-check-label" for="titanium">TITANIUM</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="plan" id="platinum" value="PLATINUM" required>
                                        <label class="form-check-label" for="platinum">PLATINUM</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tipe Klien</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipe_tanggungan" id="tanpa_tanggungan" value="Tanpa Tanggungan Mandiri" required checked>
                                        <label class="form-check-label" for="tanpa_tanggungan">Tanpa Tanggungan Mandiri</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipe_tanggungan" id="dengan_tanggungan" value="Dengan Tanggungan Mandiri" required>
                                        <label class="form-check-label" for="dengan_tanggungan">Dengan Tanggungan Mandiri</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="premi" class="form-label">Premi</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" class="form-control currency-input" id="premi" name="premi" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="premi_tertanggung_tambahan" class="form-label">Premi Tertanggung Tambahan</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" class="form-control currency-input" id="premi_tertanggung_tambahan" name="premi_tertanggung_tambahan">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="total_premi" class="form-label">Total Premi</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" class="form-control" id="total_premi" name="total_premi" readonly>
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
            function formatCurrency(input) {
                // Remove non-digit characters
                let value = input.value.replace(/\D/g, '');
                
                // Format number with thousand separator
                value = new Intl.NumberFormat('id-ID').format(value);
                
                // Update input value
                input.value = value;
            }

            function calculateTotal() {
                const premi = parseInt(document.getElementById('premi').value.replace(/\D/g, '') || 0);
                const premiTambahan = parseInt(document.getElementById('premi_tertanggung_tambahan').value.replace(/\D/g, '') || 0);
                const total = premi + premiTambahan;
                
                document.getElementById('total_premi').value = new Intl.NumberFormat('id-ID').format(total);
            }

            // Add event listeners to currency inputs
            document.querySelectorAll('.currency-input').forEach(input => {
                input.addEventListener('input', function() {
                    formatCurrency(this);
                    calculateTotal();
                });
            });

            // Get the plan elements
            const tipePlanInputs = document.querySelectorAll('input[name="tipe_plan"]');
            const platinumOption = document.querySelector('.form-check:has(#platinum)');

            // Add event listeners to tipe_plan radio buttons
            tipePlanInputs.forEach(input => {
                input.addEventListener('change', function() {
                    if (this.value === 'S') {
                        platinumOption.style.display = 'none';
                        // Uncheck platinum if it was selected
                        document.getElementById('platinum').checked = false;
                    } else {
                        platinumOption.style.display = 'inline-block';
                    }
                });
            });
        });
    </script>
</body>
</html>