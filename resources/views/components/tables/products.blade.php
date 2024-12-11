@props(['products' => []])
<div class="table-responsive">
    <table class="table table-hover table-bordered table-sm align-middle shadow-sm">
        <thead class="table-light">
            <tr>
                <th scope="col" class="text-center">
                    <i class="bi bi-box me-2"></i>Product Name
                </th>
                <th scope="col" class="text-center">
                    <i class="bi bi-tag me-2"></i>Category
                </th>
                <th scope="col" class="text-center">
                    <i class="bi bi-upc me-2"></i>Barcode
                </th>
                <th scope="col" class="text-center">
                    <i class="bi bi-stack me-2"></i>Quantity
                </th>
                <th scope="col" class="text-center">
                    <i class="bi bi-calendar-date me-2"></i>Expiry Date
                </th>
                <th scope="col" class="text-center">
                    <i class="bi bi-cash-coin me-2"></i>Cost
                </th>
                <th scope="col" class="text-center">
                    <i class="bi bi-currency-dollar me-2"></i>Price
                </th>
                <th scope="col" class="text-center">
                    <i class="bi bi-tools me-2"></i>Actions
                </th>
            </tr>

        </thead>
        <tbody>
            @foreach ($products as $product)
                @php
                    $days = $product->expiry_date
                        ? (int) \Carbon\Carbon::now()->diffInDays($product->expiry_date, false)
                        : null;
                @endphp
                <tr
                    class="@if ($product->quantity <= 0) table-danger @elseif ($days <= 0) table-warning @endif">
                    <td class="text-center fw-bold">{{ $product->name }}</td>
                    <td class="text-center">
                        @if ($product->category && $product->category->name)
                            <a href="{{ route('products.index', ['category' => $product->category->id]) }}"
                                class="text-decoration-none text-dark rounded px-2 py-1 bg-light border border-muted">
                                {{ $product->category->name }}
                            </a>
                        @else
                            <span class="text-muted">Uncategorized</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($product->barcode)
                            <span class="badge bg-info text-dark fs-6">
                                <i class="bi bi-upc me-1"></i>{{ $product->barcode }}
                            </span>
                        @else
                            <span class="badge bg-secondary">N/A</span>
                        @endif
                    </td>
                    <td
                        class="text-center fw-bold @if ($product->quantity > 10) text-success
                        @elseif($product->quantity > 0) text-warning
                        @else text-danger @endif">
                        {{ $product->quantity }}
                    </td>
                    <td
                        class="text-center p-1 @if ($days > 0) bg-success
                        @elseif ($days == 0) bg-warning
                        @else bg-danger @endif text-white rounded">
                        {{ $product->expiry_date ? $product->expiry_date->format('d M Y') : 'N/A' }}
                        @if ($product->expiry_date)
                            <br>
                            <small class="text-muted fs-7">
                                @if ($days > 0)
                                    {{ $days }} days until expiry
                                @elseif($days == 0)
                                    Expiring today
                                @else
                                    Expired {{ abs($days) }} days ago
                                @endif
                            </small>
                        @endif
                    </td>
                    <td class="text-center">
                        <span class="fs-6 text-muted">
                            <i class="bi bi-currency-dollar"></i>
                            {{ number_format($product->cost , 2) }}
                        </span>
                    </td>
                    <td class="text-center">
                        <span class="fs-6 text-success fw-bold">
                            <i class="bi bi-currency-dollar"></i>
                            {{ number_format($product->price , 2) }}
                        </span>
                    </td>
                    <td class="text-center d-flex bg-white">
                        <div>
                            <!-- Sale Button -->
                            <button {{ !$product->quantity ? 'disabled' : '' }} class="btn btn-primary btn-sm d-flex align-items-center gap-1 me-1"
                                data-bs-toggle="modal" data-bs-target="#saleModal{{ $product->id }}">
                                <i class="bi bi-cash"></i> Sale
                            </button>

                            <!-- Sale Modal -->
                            <div class="modal fade" id="saleModal{{ $product->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route('sales.create', $product) }}">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Sale {{ $product->name }}</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Price per unit:</strong> ${{ $product->price }}</p>
                                                <p><strong>Available stock:</strong> {{ $product->quantity }}</p>
                                                <input type="number" name="quantity" class="form-control"
                                                    placeholder="Enter quantity">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Confirm Sale</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="btn-group" role="group" aria-label="Product Actions">
                            <a href="{{ route('products.show', $product) }}" class="btn btn-outline-info btn-sm"
                                title="View Product">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-warning btn-sm"
                                title="Edit Product">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="{{ route('products.destroy', $product) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete Product"
                                    onclick="return confirm('Are you sure you want to delete this product?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>

                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
