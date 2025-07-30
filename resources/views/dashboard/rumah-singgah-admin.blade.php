@extends('dashboard.layouts-admin.admin')
@section('title', 'Rumah Singgah - Dinas Sosial Kota Majalengka')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-900">Rumah Singgah Dinas Sosial</h1>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
    <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 relative">
        <span class="block sm:inline">{{ session('success') }}</span>
        <button onclick="closeAlert('success-alert')" class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
            </svg>
        </button>
    </div>
    @endif

    <!-- Alert Errors -->
    @if($errors->any())
    <div id="error-alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 relative">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button onclick="closeAlert('error-alert')" class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
            </svg>
        </button>
    </div>
    @endif

    <!-- Tab Navigation -->
    <div class="mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8">
                <button id="edit-tab" class="tab-button border-b-2 border-blue-500 py-2 px-1 text-sm font-medium text-blue-600" onclick="switchTab('edit')">
                    Edit Rumah Singgah
                </button>
                <button id="preview-tab" class="tab-button border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700" onclick="switchTab('preview')">
                    Preview
                </button>
            </nav>
        </div>
    </div>

    <!-- Edit Tab Content -->
    <div id="edit-content" class="tab-content">
        <div class="bg-white shadow-md rounded-lg p-6 max-w-6xl mx-auto">
            <form action="{{ route('rumah-singgah.update') }}" method="POST" enctype="multipart/form-data" id="rumah-singgah-form">
                @csrf
                @method('PUT')

                <!-- Accordion Sections -->
                <div class="space-y-4">

                    <!-- Basic Information Section -->
                    <div class="border border-gray-200 rounded-lg">
                        <button type="button" class="w-full px-4 py-3 text-left bg-gray-50 hover:bg-gray-100 rounded-t-lg focus:outline-none" onclick="toggleAccordion('basic-info')">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-900">Informasi Dasar</h3>
                                <svg class="w-5 h-5 transform transition-transform" id="basic-info-icon" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div id="basic-info-content" class="p-4 space-y-6">
                            <!-- Gambar/Logo -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Gambar Rumah Singgah</label>
                                <div class="flex items-start space-x-4">
                                    <div>
                                        @if($rumahSinggah && $rumahSinggah->gambar)
                                        <img id="current-gambar" src="{{ asset('storage/' . $rumahSinggah->gambar) }}" alt="Gambar Rumah Singgah" class="w-32 h-32 object-cover rounded mb-2">
                                        @else
                                        <div id="current-gambar" class="w-32 h-32 bg-gray-200 rounded mb-2 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                            </svg>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <input type="file" name="gambar" id="gambar-input" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*" />
                                        <small class="text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Isi/Deskripsi -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Deskripsi Rumah Singgah</label>
                                <textarea name="isi" id="isi-input" rows="8" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500" required placeholder="Masukkan deskripsi lengkap tentang rumah singgah...">{{ old('isi', $rumahSinggah->isi ?? '') }}</textarea>
                                <small class="text-gray-500">Jelaskan fasilitas, tujuan, dan layanan yang tersedia di rumah singgah</small>
                            </div>

                            <!-- Lokasi -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Lokasi Rumah Singgah</label>
                                <textarea name="lokasi" id="lokasi-input" rows="4" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500" required placeholder="Masukkan alamat lengkap dan informasi lokasi...">{{ old('lokasi', $rumahSinggah->lokasi ?? '') }}</textarea>
                                <small class="text-gray-500">Cantumkan alamat lengkap, cara akses, dan petunjuk arah jika perlu</small>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Section -->
                    <div class="border border-gray-200 rounded-lg">
                        <button type="button" class="w-full px-4 py-3 text-left bg-gray-50 hover:bg-gray-100 focus:outline-none" onclick="toggleAccordion('gallery')">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-900">Galeri Foto</h3>
                                <svg class="w-5 h-5 transform transition-transform" id="gallery-icon" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div id="gallery-content" class="p-4 hidden">
                            <div class="mb-4">
                                <label class="block text-gray-700 font-semibold mb-2">Upload Foto Galeri</label>
                                <input type="file" name="galeri[]" multiple accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                <small class="text-gray-500">Pilih beberapa foto sekaligus. Format: JPG, PNG, GIF. Maksimal 2MB per file</small>
                            </div>

                            <!-- Display existing gallery -->
                            @if($rumahSinggah && $rumahSinggah->galeri && count($rumahSinggah->galeri) > 0)
                            <div class="mb-4">
                                <label class="block text-gray-700 font-semibold mb-2">Galeri Saat Ini:</label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    @foreach($rumahSinggah->galeri as $index => $image)
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $image) }}" alt="Gallery Image" class="w-full h-32 object-cover rounded">
                                    </div>
                                    @endforeach
                                </div>
                                <small class="text-gray-500 mt-2 block">Upload foto baru akan ditambahkan ke galeri yang sudah ada</small>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Facilities Section -->
                    <div class="border border-gray-200 rounded-lg">
                        <button type="button" class="w-full px-4 py-3 text-left bg-gray-50 hover:bg-gray-100 focus:outline-none" onclick="toggleAccordion('facilities')">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-900">Fasilitas</h3>
                                <svg class="w-5 h-5 transform transition-transform" id="facilities-icon" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div id="facilities-content" class="p-4 hidden">
                            <div id="facilities-container">
                                @if($rumahSinggah && $rumahSinggah->fasilitas && count($rumahSinggah->fasilitas) > 0)
                                @foreach($rumahSinggah->fasilitas as $index => $fasilitas)
                                <div class="flex items-center mb-2 facility-item">
                                    <input type="text" name="fasilitas[]" value="{{ $fasilitas }}" class="flex-1 border border-gray-300 rounded px-3 py-2 mr-2" placeholder="Nama fasilitas">
                                    <button type="button" onclick="removeFacility(this)" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600">Hapus</button>
                                </div>
                                @endforeach
                                @else
                                <div class="flex items-center mb-2 facility-item">
                                    <input type="text" name="fasilitas[]" class="flex-1 border border-gray-300 rounded px-3 py-2 mr-2" placeholder="Nama fasilitas">
                                    <button type="button" onclick="removeFacility(this)" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600">Hapus</button>
                                </div>
                                @endif
                            </div>
                            <button type="button" onclick="addFacility()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mt-2">Tambah Fasilitas</button>
                        </div>
                    </div>

                    <!-- Guest Criteria Section -->
                    <div class="border border-gray-200 rounded-lg">
                        <button type="button" class="w-full px-4 py-3 text-left bg-gray-50 hover:bg-gray-100 focus:outline-none" onclick="toggleAccordion('criteria')">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-900">Kriteria Tamu</h3>
                                <svg class="w-5 h-5 transform transition-transform" id="criteria-icon" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div id="criteria-content" class="p-4 hidden">
                            <div id="criteria-container">
                                @if($rumahSinggah && $rumahSinggah->kriteria_tamu && count($rumahSinggah->kriteria_tamu) > 0)
                                @foreach($rumahSinggah->kriteria_tamu as $index => $kriteria)
                                <div class="flex items-center mb-2 criteria-item">
                                    <input type="text" name="kriteria_tamu[]" value="{{ $kriteria }}" class="flex-1 border border-gray-300 rounded px-3 py-2 mr-2" placeholder="Kriteria tamu">
                                    <button type="button" onclick="removeCriteria(this)" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600">Hapus</button>
                                </div>
                                @endforeach
                                @else
                                <div class="flex items-center mb-2 criteria-item">
                                    <input type="text" name="kriteria_tamu[]" class="flex-1 border border-gray-300 rounded px-3 py-2 mr-2" placeholder="Kriteria tamu">
                                    <button type="button" onclick="removeCriteria(this)" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600">Hapus</button>
                                </div>
                                @endif
                            </div>
                            <button type="button" onclick="addCriteria()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mt-2">Tambah Kriteria</button>
                        </div>
                    </div>

                    <!-- Video Section -->
                    <div class="border border-gray-200 rounded-lg">
                        <button type="button" class="w-full px-4 py-3 text-left bg-gray-50 hover:bg-gray-100 focus:outline-none" onclick="toggleAccordion('video')">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-900">Video Rumah Singgah</h3>
                                <svg class="w-5 h-5 transform transition-transform" id="video-icon" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div id="video-content" class="p-4 hidden">
                            <div class="mb-4">
                                @if($rumahSinggah && $rumahSinggah->video)
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-semibold mb-2">Video Saat Ini:</label>
                                    <video controls class="w-full max-w-md h-48 bg-gray-100 rounded">
                                        <source src="{{ asset('storage/' . $rumahSinggah->video) }}" type="video/mp4">
                                        Browser Anda tidak mendukung video.
                                    </video>
                                </div>
                                @endif
                                <label class="block text-gray-700 font-semibold mb-2">Upload Video Baru</label>
                                <input type="file" name="video" accept="video/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                <small class="text-gray-500">Format: MP4, AVI, MOV, WMV. Maksimal 50MB</small>
                            </div>
                        </div>
                    </div>

                    <!-- Service Flow Section -->
                    <div class="border border-gray-200 rounded-lg">
                        <button type="button" class="w-full px-4 py-3 text-left bg-gray-50 hover:bg-gray-100 focus:outline-none" onclick="toggleAccordion('flow')">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-900">Alur Pelayanan</h3>
                                <svg class="w-5 h-5 transform transition-transform" id="flow-icon" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div id="flow-content" class="p-4 hidden">
                            <div class="mb-4">
                                @if($rumahSinggah && $rumahSinggah->alur_pelayanan)
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-semibold mb-2">Diagram Alur Saat Ini:</label>
                                    <img src="{{ asset('storage/' . $rumahSinggah->alur_pelayanan) }}" alt="Alur Pelayanan" class="max-w-full h-auto rounded border">
                                </div>
                                @endif
                                <label class="block text-gray-700 font-semibold mb-2">Upload Diagram Alur Pelayanan</label>
                                <input type="file" name="alur_pelayanan" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                <small class="text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Section -->
                    <div class="border border-gray-200 rounded-lg">
                        <button type="button" class="w-full px-4 py-3 text-left bg-gray-50 hover:bg-gray-100 focus:outline-none" onclick="toggleAccordion('contact')">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-900">Informasi Kontak</h3>
                                <svg class="w-5 h-5 transform transition-transform" id="contact-icon" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div id="contact-content" class="p-4 hidden space-y-4">
                            <!-- Alamat Lengkap -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" id="alamat-input" rows="3" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500" placeholder="Masukkan alamat lengkap rumah singgah...">{{ old('alamat_lengkap', $rumahSinggah->alamat_lengkap ?? '') }}</textarea>
                            </div>

                            <!-- WhatsApp -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">WhatsApp</label>
                                <input type="text" name="whatsapp" id="whatsapp-input" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500" placeholder="+62 812-3456-7890" value="{{ old('whatsapp', $rumahSinggah->whatsapp ?? '') }}">
                            </div>

                            <!-- Telepon -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Telepon</label>
                                <input type="text" name="telepon" id="telepon-input" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500" placeholder="(0778) 123-4567" value="{{ old('telepon', $rumahSinggah->telepon ?? '') }}">
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Email</label>
                                <input type="email" name="email" id="email-input" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500" placeholder="rumahsinggah@majalengkakab.go.id" value="{{ old('email', $rumahSinggah->email ?? '') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Operating Hours Section -->
                    <div class="border border-gray-200 rounded-lg">
                        <button type="button" class="w-full px-4 py-3 text-left bg-gray-50 hover:bg-gray-100 focus:outline-none" onclick="toggleAccordion('hours')">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-900">Jam Operasional</h3>
                                <svg class="w-5 h-5 transform transition-transform" id="hours-icon" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div id="hours-content" class="p-4 hidden space-y-4">
                            <!-- Senin - Jumat -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Senin - Jumat</label>
                                <input type="text" name="jam_operasional_senin_jumat" id="jam-senin-jumat-input" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500" placeholder="08:00 - 17:00 WIB" value="{{ old('jam_operasional_senin_jumat', ($rumahSinggah && $rumahSinggah->jam_operasional) ? $rumahSinggah->jam_operasional['senin_jumat'] ?? '08:00 - 17:00 WIB' : '08:00 - 17:00 WIB') }}">
                            </div>

                            <!-- Sabtu -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Sabtu</label>
                                <input type="text" name="jam_operasional_sabtu" id="jam-sabtu-input" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500" placeholder="08:00 - 12:00 WIB" value="{{ old('jam_operasional_sabtu', ($rumahSinggah && $rumahSinggah->jam_operasional) ? $rumahSinggah->jam_operasional['sabtu'] ?? '08:00 - 12:00 WIB' : '08:00 - 12:00 WIB') }}">
                            </div>

                            <!-- Emergency -->
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Emergency</label>
                                <input type="text" name="jam_operasional_emergency" id="jam-emergency-input" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500" placeholder="24 Jam" value="{{ old('jam_operasional_emergency', ($rumahSinggah && $rumahSinggah->jam_operasional) ? $rumahSinggah->jam_operasional['emergency'] ?? '24 Jam' : '24 Jam') }}">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex justify-between mt-8">
                    <button type="button" onclick="switchTab('preview')" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-2 rounded shadow">
                        Preview
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                        Simpan Rumah Singgah
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Preview Tab Content -->
    <div id="preview-content" class="tab-content hidden">
        <div class="bg-white shadow-md rounded-lg p-8 max-w-6xl mx-auto">
            <!-- Preview Content -->
            <div class="space-y-8">
                <!-- Hero Section Preview -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-6">Rumah Singgah Hegar Majalengka</h1>
                        <div id="preview-isi" class="text-gray-600 text-lg mb-8 leading-relaxed">
                            {{ ($rumahSinggah && $rumahSinggah->isi) ? $rumahSinggah->isi : 'Deskripsi rumah singgah akan ditampilkan di sini...' }}
                        </div>
                    </div>
                    @if($rumahSinggah && $rumahSinggah->gambar)
                    <div id="preview-gambar-section">
                        <div id="preview-gambar">
                            <img src="{{ asset('storage/' . $rumahSinggah->gambar) }}" alt="Rumah Singgah Hegar Majalengka" class="w-full h-96 object-cover rounded-lg shadow-lg">
                        </div>
                    </div>
                    @else
                    <div id="preview-gambar-section" style="display: none;">
                        <div id="preview-gambar"></div>
                    </div>
                    @endif
                </div>

                <!-- Gallery Preview -->
                @if($rumahSinggah && $rumahSinggah->galeri && count($rumahSinggah->galeri) > 0)
                <div id="preview-gallery-section">
                    <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">Galeri Rumah Singgah</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($rumahSinggah->galeri as $image)
                        <div class="text-center">
                            <img src="{{ asset('storage/' . $image) }}" alt="Gallery Image" class="w-full h-64 object-cover rounded-lg shadow-md mb-4">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Facilities Preview -->
                @if($rumahSinggah && $rumahSinggah->fasilitas && count($rumahSinggah->fasilitas) > 0)
                <div id="preview-facilities-section">
                    <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Fasilitas</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($rumahSinggah->fasilitas as $fasilitas)
                        <div class="text-center">
                            <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-orange-500 text-2xl">🏠</span>
                            </div>
                            <p class="text-gray-700">{{ $fasilitas }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Guest Criteria Preview -->
                @if($rumahSinggah && $rumahSinggah->kriteria_tamu && count($rumahSinggah->kriteria_tamu) > 0)
                <div id="preview-criteria-section" class="bg-gray-50 py-16 -mx-8">
                    <div class="px-8">
                        <div class="bg-white rounded-lg shadow-md p-8">
                            <h2 class="text-3xl font-bold text-gray-900 mb-8">Kriteria Tamu</h2>
                            <ul class="space-y-4 text-gray-700">
                                @foreach($rumahSinggah->kriteria_tamu as $kriteria)
                                <li class="flex items-start">
                                    <span class="text-green-500 mr-3 mt-1">•</span>
                                    <span>{{ $kriteria }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Video Preview -->
                @if($rumahSinggah && $rumahSinggah->video)
                <div id="preview-video-section">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">Video Rumah Singgah Hegar</h2>
                        <p class="text-gray-600">Display video fasilitas pada Rumah Singgah Hegar Majalengka</p>
                    </div>
                    <div class="bg-gray-200 rounded-lg overflow-hidden shadow-lg">
                        <video controls class="w-full aspect-video">
                            <source src="{{ asset('storage/' . $rumahSinggah->video) }}" type="video/mp4">
                            Browser Anda tidak mendukung video.
                        </video>
                    </div>
                </div>
                @endif

                <!-- Service Flow Preview -->
                @if($rumahSinggah && $rumahSinggah->alur_pelayanan)
                <div id="preview-flow-section" class="bg-pink-50 py-16 -mx-8">
                    <div class="px-8">
                        <div class="text-center mb-12">
                            <h2 class="text-3xl font-bold text-gray-900 mb-4">Alur Pelayanan</h2>
                            <p class="text-gray-600">Berikut Bagan Alur Pelayanan pada Rumah Singgah Hegar Majalengka</p>
                        </div>
                        <div class="bg-white rounded-lg shadow-lg p-8">
                            <img src="{{ asset('storage/' . $rumahSinggah->alur_pelayanan) }}" alt="Alur Pelayanan" class="w-full h-auto rounded">
                        </div>
                    </div>
                </div>
                @endif

                <!-- Contact Preview -->
                <div class="bg-white rounded-lg shadow-md p-8">
                    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-12">
                        <!-- Alamat -->
                        <div class="lg:w-1/2">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">📍 Alamat Rumah Singgah Hegar</h3>
                            <h4 class="font-semibold text-gray-800 mb-2">Rumah Singgah Hegar Majalengka</h4>
                            <div id="preview-alamat" class="text-gray-600">
                                {{ ($rumahSinggah && $rumahSinggah->alamat_lengkap) ? $rumahSinggah->alamat_lengkap : 'Alamat lengkap akan ditampilkan di sini...' }}
                            </div>
                        </div>

                        <!-- Kontak -->
                        <div class="lg:w-1/2 space-y-4">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">📞 Informasi Kontak</h3>

                            <div class="flex items-center">
                                <span class="text-green-500 mr-3">📱</span>
                                <div>
                                    <p class="font-semibold text-gray-800">WhatsApp</p>
                                    <div id="preview-whatsapp" class="text-gray-600">
                                        {{ ($rumahSinggah && $rumahSinggah->whatsapp) ? $rumahSinggah->whatsapp : '+62 812-3456-7890' }}
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <span class="text-blue-500 mr-3">☎️</span>
                                <div>
                                    <p class="font-semibold text-gray-800">Telepon</p>
                                    <div id="preview-telepon" class="text-gray-600">
                                        {{ ($rumahSinggah && $rumahSinggah->telepon) ? $rumahSinggah->telepon : '(0778) 123-4567' }}
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <span class="text-red-500 mr-3">✉️</span>
                                <div>
                                    <p class="font-semibold text-gray-800">Email</p>
                                    <div id="preview-email" class="text-gray-600">
                                        {{ ($rumahSinggah && $rumahSinggah->email) ? $rumahSinggah->email : 'rumahsinggah@majalengkakab.go.id' }}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                                <p class="text-sm text-blue-800">
                                    <strong>Jam Operasional:</strong><br>
                                    <span id="preview-jam-senin-jumat">Senin - Jumat: {{ ($rumahSinggah && $rumahSinggah->jam_operasional) ? $rumahSinggah->jam_operasional['senin_jumat'] ?? '08:00 - 17:00 WIB' : '08:00 - 17:00 WIB' }}</span><br>
                                    <span id="preview-jam-sabtu">Sabtu: {{ ($rumahSinggah && $rumahSinggah->jam_operasional) ? $rumahSinggah->jam_operasional['sabtu'] ?? '08:00 - 12:00 WIB' : '08:00 - 12:00 WIB' }}</span><br>
                                    <span id="preview-jam-emergency">Emergency: {{ ($rumahSinggah && $rumahSinggah->jam_operasional) ? $rumahSinggah->jam_operasional['emergency'] ?? '24 Jam' : '24 Jam' }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview Actions -->
            <div class="mt-8 text-center">
                <button type="button" onclick="switchTab('edit')" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                    Kembali ke Edit
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto hide alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        // Auto hide success alert
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            setTimeout(function() {
                successAlert.style.transition = 'opacity 0.5s ease-out';
                successAlert.style.opacity = '0';
                setTimeout(function() {
                    successAlert.remove();
                }, 500);
            }, 5000);
        }

        // Auto hide error alert
        const errorAlert = document.getElementById('error-alert');
        if (errorAlert) {
            setTimeout(function() {
                errorAlert.style.transition = 'opacity 0.5s ease-out';
                errorAlert.style.opacity = '0';
                setTimeout(function() {
                    errorAlert.remove();
                }, 500);
            }, 8000);
        }
    });

    // Function to manually close alerts
    function closeAlert(alertId) {
        const alert = document.getElementById(alertId);
        if (alert) {
            alert.style.transition = 'opacity 0.3s ease-out';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 300);
        }
    }

    // Accordion toggle function
    function toggleAccordion(sectionId) {
        const content = document.getElementById(sectionId + '-content');
        const icon = document.getElementById(sectionId + '-icon');

        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
        } else {
            content.classList.add('hidden');
            icon.style.transform = 'rotate(0deg)';
        }
    }

    // Tab switching function
    function switchTab(tab) {
        const editTab = document.getElementById('edit-tab');
        const previewTab = document.getElementById('preview-tab');
        const editContent = document.getElementById('edit-content');
        const previewContent = document.getElementById('preview-content');

        if (tab === 'edit') {
            // Active edit tab
            editTab.className = 'tab-button border-b-2 border-blue-500 py-2 px-1 text-sm font-medium text-blue-600';
            previewTab.className = 'tab-button border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700';

            // Show edit content
            editContent.classList.remove('hidden');
            previewContent.classList.add('hidden');
        } else {
            // Active preview tab
            previewTab.className = 'tab-button border-b-2 border-blue-500 py-2 px-1 text-sm font-medium text-blue-600';
            editTab.className = 'tab-button border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700';

            // Update preview content
            updatePreview();

            // Show preview content
            editContent.classList.add('hidden');
            previewContent.classList.remove('hidden');
        }
    }

    // Update preview content
    function updatePreview() {
        // Update isi
        const isiInput = document.getElementById('isi-input').value;
        document.getElementById('preview-isi').textContent = isiInput || 'Deskripsi rumah singgah akan ditampilkan di sini...';

        // Update alamat
        const alamatInput = document.getElementById('alamat-input').value;
        document.getElementById('preview-alamat').textContent = alamatInput || 'Alamat lengkap akan ditampilkan di sini...';

        // Update whatsapp
        const whatsappInput = document.getElementById('whatsapp-input').value;
        document.getElementById('preview-whatsapp').textContent = whatsappInput || '+62 812-3456-7890';

        // Update telepon
        const teleponInput = document.getElementById('telepon-input').value;
        document.getElementById('preview-telepon').textContent = teleponInput || '(0778) 123-4567';

        // Update email
        const emailInput = document.getElementById('email-input').value;
        document.getElementById('preview-email').textContent = emailInput || 'rumahsinggah@majalengkakab.go.id';

        // Update jam operasional
        const jamSeninJumatInput = document.getElementById('jam-senin-jumat-input').value;
        const jamSabtuInput = document.getElementById('jam-sabtu-input').value;
        const jamEmergencyInput = document.getElementById('jam-emergency-input').value;

        document.getElementById('preview-jam-senin-jumat').textContent = 'Senin - Jumat: ' + (jamSeninJumatInput || '08:00 - 17:00 WIB');
        document.getElementById('preview-jam-sabtu').textContent = 'Sabtu: ' + (jamSabtuInput || '08:00 - 12:00 WIB');
        document.getElementById('preview-jam-emergency').textContent = 'Emergency: ' + (jamEmergencyInput || '24 Jam');
    }

    // Preview gambar saat file dipilih
    document.getElementById('gambar-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewGambarSection = document.getElementById('preview-gambar-section');
        const previewGambar = document.getElementById('preview-gambar');
        const currentGambar = document.getElementById('current-gambar');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Update current gambar di edit tab
                currentGambar.innerHTML = `<img src="${e.target.result}" alt="Gambar Rumah Singgah" class="w-32 h-32 object-cover rounded">`;

                // Update preview gambar
                previewGambar.innerHTML = `<img src="${e.target.result}" alt="Rumah Singgah Hegar Majalengka" class="w-full h-96 object-cover rounded-lg shadow-lg">`;
                previewGambarSection.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    // Functions for facilities
    function addFacility() {
        const container = document.getElementById('facilities-container');
        const newItem = document.createElement('div');
        newItem.className = 'flex items-center mb-2 facility-item';
        newItem.innerHTML = `
            <input type="text" name="fasilitas[]" class="flex-1 border border-gray-300 rounded px-3 py-2 mr-2" placeholder="Nama fasilitas">
            <button type="button" onclick="removeFacility(this)" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600">Hapus</button>
        `;
        container.appendChild(newItem);
    }

    function removeFacility(button) {
        button.parentElement.remove();
    }

    // Functions for guest criteria
    function addCriteria() {
        const container = document.getElementById('criteria-container');
        const newItem = document.createElement('div');
        newItem.className = 'flex items-center mb-2 criteria-item';
        newItem.innerHTML = `
            <input type="text" name="kriteria_tamu[]" class="flex-1 border border-gray-300 rounded px-3 py-2 mr-2" placeholder="Kriteria tamu">
            <button type="button" onclick="removeCriteria(this)" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600">Hapus</button>
        `;
        container.appendChild(newItem);
    }

    function removeCriteria(button) {
        button.parentElement.remove();
    }

    // Real-time preview update saat mengetik
    document.getElementById('isi-input').addEventListener('input', updatePreview);
    document.getElementById('alamat-input').addEventListener('input', updatePreview);
    document.getElementById('whatsapp-input').addEventListener('input', updatePreview);
    document.getElementById('telepon-input').addEventListener('input', updatePreview);
    document.getElementById('email-input').addEventListener('input', updatePreview);
    document.getElementById('jam-senin-jumat-input').addEventListener('input', updatePreview);
    document.getElementById('jam-sabtu-input').addEventListener('input', updatePreview);
    document.getElementById('jam-emergency-input').addEventListener('input', updatePreview);
</script>
@endsection