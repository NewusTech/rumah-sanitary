<div>
    <div>
        <section class="section">
            <div class="section-header">
                <h1> {{ __('Kategori Tags  Produk') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('data-kategori-tags-produk') }}">{{ __('KategoriTagsProduk') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Tambah') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Nama Tags <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('kategoritagsproduk.title') is-invalid @enderror"
                                                wire:model="kategoritagsproduk.title">
                                            @error('kategoritagsproduk.title')
                                                <span class='invalid-feedback'>
                                                    <strong>{{ $message }} </strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Slug <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('kategoritagsproduk.slug') is-invalid @enderror"
                                                wire:model="kategoritagsproduk.slug">
                                            @error('kategoritagsproduk.slug')
                                                <span class='invalid-feedback'>
                                                    <strong>{{ $message }} </strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" wire:click.prevent="save">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


@push('scripts')
@endpush
