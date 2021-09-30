@section('body-class', '')
@push('scripts')
    <script src="{{ asset('assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
            livewire.on('openModal', () => {
                $('#edit-category').modal('show');
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
                    <h1>Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Categories</li>
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
                            <h3 class="card-title">You can Add, Edit and Remove category From here</h3>
                            <button type="button" class="btn btn-success float-right" data-toggle="modal"
                                    data-target="#add-category">
                                Add New Category
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-hover mb-2">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th class="text-nowrap">Created at</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td><a target="_blank"
                                                   href="{{ route('category', $category->slug) }}">{{ $category->name }}</a>
                                            </td>
                                            <td>{{ $category->slug }}</td>
                                            <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <div class="row justify-content-center">
                                                        <button wire:click="showEdit({{ $category->id }})"
                                                                class="btn btn-sm btn-outline-info"><i class="fas fa-edit"></i>
                                                        </button>
                                                    <button wire:click="deleteCategory({{ $category->id }})"
                                                            class="btn btn-sm btn-outline-danger"><i
                                                            class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $categories->links() }}
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
    <div wire:ignore.self class="modal fade" id="add-category">
        <div class="modal-dialog">
            <div class="modal-content bg-secondary">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Category</h4>
                    <button wire:click="resetInputFields" type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" wire:submit.prevent="addCategory">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       autocomplete="off" id="name" placeholder="Enter name of the category"
                                       wire:model="name">
                                @error('name')
                                <div class="bg-danger text-light">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug (Url)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                           id="slug"
                                           autocomplete="off" placeholder="Enter a slug (url) of category"
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
                                <label for="image">Category image</label>
                                <div class="input-group">
                                    <div wire:ignore class="custom-file">
                                        <input type="file"
                                               class="custom-file-input @error('image') is-invalid @enderror"
                                               id="image"
                                               wire:model="image">
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

    <div wire:ignore.self class="modal fade" id="edit-category">
        <div class="modal-dialog">
            <div class="modal-content bg-secondary">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Category</h4>
                    <button wire:click="resetInputFields" type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" wire:submit.prevent="editCategory">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       autocomplete="off" id="name" placeholder="Enter name of the category"
                                       wire:model="name">
                                @error('name')
                                <div class="bg-danger text-light">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug (Url)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                           id="slug"
                                           autocomplete="off" placeholder="Enter a slug (url) of category"
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
                                <label for="image">Category image</label>
                                <div class="input-group">
                                    <div wire:ignore class="custom-file">
                                        <input type="file"
                                               class="custom-file-input @error('image') is-invalid @enderror"
                                               id="image"
                                               wire:model="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                    @if($image)
                                        <img width="40" height="38"
                                             src="{{ $image->temporaryUrl() }}">
                                    @else
                                        <img width="40" height="38"
                                             src="{{ asset($this->new_image ?? config('custom.default.category')) }}">
                                    @endif
                                </div>
                                @error('image')
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
</div>

