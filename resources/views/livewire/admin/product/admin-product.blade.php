@section('body-class', '')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
            $('.summernote-desc-add').summernote({
                callbacks: {
                    onChange: function (contents, $editable) {
                    @this.set('desc', contents);
                    }
                }
            });
            $('.summernote-details-add').summernote({
                callbacks: {
                    onChange: function (contents) {
                    @this.set('details', contents);
                    }
                }
            });
            bsCustomFileInput.init();
            livewire.on('openModal', () => {
                $('#edit-product').modal('show');
                $('#summernote-desc-edit').summernote({
                    callbacks: {
                        onChange: function (contents, editable) {
                        @this.set('desc', contents);
                        }
                    }
                });
                $('#summernote-details-edit').summernote({
                    callbacks: {
                        onChange: function (contents, editable) {
                        @this.set('details', contents);
                        }
                    }
                });
            })
        });
    </script>
@endpush
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">You can Add, Edit and Remove Products From here</h3>
                            <button type="button" class="btn btn-success float-right" data-toggle="modal"
                                    data-target="#add-product">
                                Add New Product
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-hover mb-2 product-admin-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>image</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>description</th>
                                        <th>Details</th>
                                        <th>price</th>
                                        <th>Qty</th>
                                        <th class="text-nowrap">belongs To</th>
                                        <th class="text-nowrap">Stock Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td><img width="50" height="60" src="{{ asset($product->image) }}"
                                                     alt="product image"></td>
                                            <td><a target="_blank"
                                                   href="{{ route('product', $product->slug) }}">{{ $product->name }}</a>
                                            </td>
                                            <td>{{ $product->slug }}</td>
                                            <td><div class="td-desc" data-toggle="tooltip" data-html="true" title="{{ $product->desc }}">{!! $product->desc !!}</div></td>
                                            <td>
                                                <div class="td-desc" data-toggle="tooltip" data-html="true" title="{{ $product->details }}">{!! $product->details !!}</div>
                                            </td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>
                                                <a href="{{ route('category', $product->category->slug) }}"
                                                   target="_blank">{{ $product->category->name }}</a>
                                            </td>
                                            <td>{{ $product->stock_status }}</td>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <button wire:click="showEdit({{ $product->id }})"
                                                            class="btn btn-sm btn-outline-info"><i
                                                            class="fas fa-edit"></i>
                                                    </button>
                                                    <button wire:click="deleteProduct({{ $product->id }})"
                                                            class="btn btn-sm btn-outline-danger"><i
                                                            class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $products->links() }}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <div wire:ignore.self class="modal fade" id="add-product">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-secondary">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Product</h4>
                    <button wire:click="resetInputFields" type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" wire:submit.prevent="addProduct">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Name</span>
                                    </div>
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           autocomplete="off" id="name" placeholder="Enter name of the Product"
                                           wire:model="name">
                                </div>
                                @error('name')
                                <div class="bg-danger text-light">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Slug (Url)</span>
                                    </div>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                           id="slug"
                                           autocomplete="off" placeholder="Enter a slug (url) of product"
                                           wire:model="slug">
                                    <div class="input-group-append">
                                        <button wire:click.prevent="generateSlug" class="btn btn-sm btn-info">
                                            Generate
                                        </button>
                                    </div>
                                </div>
                                @error('slug')
                                <div class="bg-danger text-light">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Image</span></div>
                                    <div wire:ignore class="custom-file">
                                        <input type="file" wire:model="image"
                                               class="custom-file-input @error('image') is-invalid @enderror">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                    @if($image)
                                        <img width="40" height="38"
                                             src="{{ is_string($image) ?: $image->temporaryUrl() }}">
                                    @else
                                        <img width="40" height="38"
                                             src="{{ asset(config('custom.default.category')) }}">
                                    @endif
                                </div>
                                @error('image')
                                <div class="bg-danger text-light">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="desc">Description</label>
                                <div wire:ignore>
                                    <textarea wire:model="desc"
                                              class="summernote-desc-add @error('desc') is-invalid @enderror"></textarea>
                                </div>
                                @error('desc')
                                <div class="bg-danger text-light">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="desc">Details</label>
                                <div wire:ignore>
                                    <textarea wire:model="details"
                                              class="summernote-details-add @error('details') is-invalid @enderror"></textarea>
                                </div>
                                @error('details')
                                <div class="bg-danger text-light">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Price</span>
                                    </div>
                                    <input type="number" id="price"
                                           class="form-control @error('price') is-invalid @enderror" wire:model="price"
                                           min="1" step=".01">
                                </div>
                                @error('price')
                                <div class="bg-danger text-light">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">quantity</span>
                                    </div>
                                    <input type="number" id="quantity"
                                           class="form-control @error('quantity') is-invalid @enderror"
                                           wire:model="quantity"
                                           min="1">
                                </div>
                                @error('quantity')
                                <div class="bg-danger text-light">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Status</span>
                                    </div>
                                    <select name="stock_status" id="stock_status"
                                            class="form-control @error('stock_status') is-invalid @enderror"
                                            wire:model="stock_status">
                                        <option selected value="instock">instock</option>
                                        <option value="outstock">outstock</option>
                                    </select>
                                </div>
                                @error('stock_status')
                                <div class="bg-danger text-light">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Belongs To</span>
                                    </div>
                                    <select name="category_id" id="category_id"
                                            class="form-control @error('category_id') is-invalid @enderror"
                                            wire:model="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                <div class="bg-danger text-light">{{ $message }}</div> @enderror
                            </div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button wire:click="resetInputFields" type="button" class="btn btn-outline-light"
                            data-dismiss="modal">Close
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    @if($editableModal)
        <div wire:ignore.self class="modal fade" id="edit-product">
            <div class="modal-dialog modal-lg">
                <div class="modal-content bg-secondary">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Product</h4>
                        <button wire:click="resetInputFields" type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data" wire:submit.prevent="editProduct">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Name</span>
                                        </div>
                                        <input type="text" name="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               autocomplete="off" id="name" placeholder="Enter name of the Product"
                                               wire:model="name">
                                    </div>
                                    @error('name')
                                    <div class="bg-danger text-light">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Slug (Url)</span>
                                        </div>
                                        <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                               id="slug"
                                               autocomplete="off" placeholder="Enter a slug (url) of product"
                                               wire:model="slug">
                                        <div class="input-group-append">
                                            <button wire:click.prevent="generateSlug(true)" class="btn btn-sm btn-info">
                                                Generate
                                            </button>
                                        </div>
                                    </div>
                                    @error('slug')
                                    <div class="bg-danger text-light">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">Image</span>
                                        </div>
                                        <div wire:ignore class="custom-file">
                                            <input type="file" id="image" wire:model="image"
                                                   class="custom-file-input @error('image') is-invalid @enderror">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                        @if($image)
                                            <img width="40" height="38"
                                                 src="{{ $image->temporaryUrl() }}">
                                        @else
                                            <img width="40" height="38"
                                                 src="{{ asset($this->old_image ?? config('custom.default.category')) }}">
                                        @endif
                                    </div>
                                    @error('image')
                                    <div class="bg-danger text-light">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="desc">Description</label>
                                    <div wire:ignore>
                                    <textarea id="summernote-desc-edit" wire:model="desc"
                                              class="summernote @error('desc') is-invalid @enderror">
                                    </textarea>
                                    </div>
                                    @error('desc')
                                    <div class="bg-danger text-light">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="desc">Details</label>
                                    <div wire:ignore>
                                    <textarea id="summernote-details-edit" wire:model="details"
                                              class="summernote @error('details') is-invalid @enderror">
                                    </textarea>
                                    </div>
                                    @error('details')
                                    <div class="bg-danger text-light">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Price</span>
                                        </div>
                                        <input type="number" id="price"
                                               class="form-control @error('price') is-invalid @enderror"
                                               wire:model="price"
                                               min="1" step=".01">
                                    </div>
                                    @error('price')
                                    <div class="bg-danger text-light">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">quantity</span>
                                        </div>
                                        <input type="number" id="quantity"
                                               class="form-control @error('quantity') is-invalid @enderror"
                                               wire:model="quantity"
                                               min="1">
                                    </div>
                                    @error('quantity')
                                    <div class="bg-danger text-light">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Status</span>
                                        </div>
                                        <select name="stock_status" id="stock_status"
                                                class="form-control @error('stock_status') is-invalid @enderror"
                                                wire:model="stock_status">
                                            <option value="instock">instock</option>
                                            <option value="outstock">outstock</option>
                                        </select>
                                    </div>
                                    @error('stock_status')
                                    <div class="bg-danger text-light">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Belongs To</span>
                                        </div>
                                        <select name="category_id" id="category_id"
                                                class="form-control @error('category_id') is-invalid @enderror"
                                                wire:model="category_id">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id')
                                    <div class="bg-danger text-light">{{ $message }}</div> @enderror
                                </div>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button wire:click="resetInputFields" type="button" class="btn btn-outline-light"
                                data-dismiss="modal">Close
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endif


</div>

