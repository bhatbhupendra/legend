<style>
/* ==================== COMPACT MATCHING ADD PRODUCT MODAL ==================== */
:root {
    --tbl-bg: #ffffff;
    --tbl-header-bg: #1a1d23;
    --tbl-header-text: #ffffff;
    --tbl-border: #e2e6ea;
    --tbl-text: #1e2329;
    --tbl-muted: #6b7280;
    --tbl-accent: #4361ee;
    --tbl-accent-dark: #3651d4;
    --tbl-soft: #f8f9fb;
    --radius-sm: 6px;
    --radius-md: 10px;
    --radius-lg: 16px;
    --shadow-card: 0 10px 30px rgba(0, 0, 0, .14);
}

/* Bottom-right compact popup */
#addProductModal {
    padding: 0 16px 16px 0;
}

#addProductModal .modal-dialog {
    position: fixed;
    right: 16px;
    bottom: 16px;
    margin: 0;
    width: min(560px, calc(100vw - 24px));
    max-width: 560px;
    transform: none !important;
}

#addProductModal .modal-content {
    border: none;
    border-radius: var(--radius-lg);
    overflow: hidden;
    background: var(--tbl-bg);
    box-shadow: var(--shadow-card);
    font-family: 'Segoe UI', system-ui, sans-serif;
}

/* Header */
#addProductModal .modal-header {
    background: linear-gradient(135deg, #171a21 0%, #1f2430 100%);
    color: var(--tbl-header-text);
    border-bottom: 1px solid rgba(255, 255, 255, .06);
    padding: 12px 14px;
}

#addProductModal .modal-title {
    font-size: 14px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0;
}

#addProductModal .modal-title::before {
    content: "+";
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background: rgba(255, 255, 255, .12);
    color: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    font-weight: 700;
    flex-shrink: 0;
}

#addProductModal .btn-close {
    filter: invert(1) grayscale(100%) brightness(200%);
    opacity: .82;
}

#addProductModal .btn-close:hover {
    opacity: 1;
}

/* Body */
#addProductModal .modal-body {
    background: #fff;
    padding: 14px;
}

#addProductModal .row {
    --bs-gutter-x: 12px;
    --bs-gutter-y: 0;
}

/* Labels */
#addProductModal .form-label {
    font-size: 11px;
    font-weight: 700;
    color: var(--tbl-muted);
    text-transform: uppercase;
    letter-spacing: .45px;
    margin-bottom: 5px;
}

/* Inputs */
#addProductModal .form-control,
#addProductModal .form-select,
#addProductModal textarea.form-control {
    border: 1px solid #d7dce3;
    border-radius: 10px;
    background: #fbfcfe;
    color: var(--tbl-text);
    font-size: 13px;
    padding: 8px 10px;
    box-shadow: none;
    transition: border-color .18s, box-shadow .18s, background .18s;
}

#addProductModal .form-control::placeholder,
#addProductModal textarea.form-control::placeholder {
    color: #9ca3af;
}

#addProductModal .form-control:focus,
#addProductModal .form-select:focus,
#addProductModal textarea.form-control:focus {
    background: #fff;
    border-color: rgba(67, 97, 238, .55);
    box-shadow: 0 0 0 4px rgba(67, 97, 238, .10);
}

#addProductModal textarea.form-control {
    resize: vertical;
    min-height: 82px;
}

#addProductModal .mb-3 {
    margin-bottom: 10px !important;
}

/* Footer */
#addProductModal .modal-footer {
    background: var(--tbl-soft);
    border-top: 1px solid var(--tbl-border);
    padding: 10px 14px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    flex-wrap: wrap;
}

/* Buttons */
#addProductModal .btn {
    border-radius: 10px;
    font-size: 12.5px;
    font-weight: 700;
    padding: 7px 14px;
    transition: all .18s ease;
    border: 1px solid transparent;
}

#addProductModal .btn-light {
    background: #fff;
    border-color: #d1d5db;
    color: var(--tbl-text);
}

#addProductModal .btn-light:hover {
    background: #f3f4f6;
    border-color: #c7ccd4;
}

#addProductModal .btn-primary {
    background: var(--tbl-accent);
    border-color: var(--tbl-accent);
    color: #fff;
    box-shadow: 0 6px 18px rgba(67, 97, 238, .18);
}

#addProductModal .btn-primary:hover {
    background: var(--tbl-accent-dark);
    border-color: var(--tbl-accent-dark);
    transform: translateY(-1px);
}

/* Backdrop */
.modal-backdrop.show {
    opacity: .32;
}

/* Mobile */
@media (max-width: 767.98px) {
    #addProductModal {
        padding: 10px;
    }

    #addProductModal .modal-dialog {
        right: 10px;
        left: 10px;
        bottom: 10px;
        width: auto;
        max-width: none;
    }

    #addProductModal .modal-header,
    #addProductModal .modal-body,
    #addProductModal .modal-footer {
        padding-left: 12px;
        padding-right: 12px;
    }
}
</style>

<div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <div class="row">

                        <!-- Role ID -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Redirect ID(id)</label>
                            <input type="text" name="redirect_id" class="form-control" value="{{ old('redirect_id') }}"
                                placeholder="Enter Redirect ID" required>
                        </div>

                        <!-- SKU -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">SKU</label>
                            <input type="text" name="sku" class="form-control" value="{{ old('sku') }}"
                                placeholder="Enter product SKU" required>
                        </div>

                        <!-- Name EN -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name (English)</label>
                            <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}"
                                placeholder="Enter English product name" required>
                        </div>

                        <!-- Name JP -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name (Japanese)</label>
                            <input type="text" name="name_jp" class="form-control" value="{{ old('name_jp') }}"
                                placeholder="Enter Japanese product name">
                        </div>

                        <!-- Category -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Category</label>
                            <input type="text" name="category" class="form-control" value="{{ old('category') }}"
                                placeholder="Enter category">
                        </div>

                        <!-- Description -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="3" class="form-control"
                                placeholder="Write a short product description...">{{ old('description') }}</textarea>
                        </div>

                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Save Product
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>