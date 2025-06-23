<!-- Tabs -->
<div class="mb-6">
    <div class="border-b border-gray-200 dark:border-gray-700">
        <nav class="-mb-px flex flex-wrap space-x-8">
            <button id="tab-personal" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-blue-500 text-blue-600 dark:text-blue-400" data-target="personal-content">
                Informasi Pribadi
            </button>
            <button id="tab-academic" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300" data-target="academic-content">
                Data Akademik
            </button>
            <button id="tab-family" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300" data-target="family-content">
                Data Keluarga
            </button>
            <button id="tab-documents" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300" data-target="documents-content">
                Dokumen Pendukung
            </button>
        </nav>
    </div>
</div>

<!-- Tab Contents -->
<div id="personal-content" class="tab-content">
    <!-- Personal Information Content -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Informasi Pribadi</h2>
        <form id="personal-info-form" action="{{ route('mahasiswa.profile.update-personal-info') }}" method="POST" data-ajax="true">
            @csrf
            <!-- ... existing personal info form fields ... -->
        </form>
    </div>
</div>

<div id="academic-content" class="tab-content hidden">
    <div class="space-y-8">
        <!-- Education Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Pendidikan</h2>
                <button id="add-education-btn" class="px-3 py-1.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 text-sm flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Pendidikan
                </button>
            </div>

            <div id="education-list" class="space-y-4">
                @if($profile->educations->count() > 0)
                    @foreach($profile->educations as $education)
                        <div class="education-item border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <div class="flex justify-between">
                                <div class="space-y-2">
                                    <div>
                                        <h3 class="font-medium text-gray-800 dark:text-gray-200">{{ $education->institution_name }}</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $education->degree }} - {{ $education->field_of_study }}</p>
                                    </div>
                                    
                                    <div class="text-sm text-gray-500 dark:text-gray-500">
                                        <p>
                                            {{ $education->start_date->format('M Y') }} -
                                            @if($education->is_current)
                                                Sekarang
                                            @else
                                                {{ $education->end_date ? $education->end_date->format('M Y') : '' }}
                                            @endif
                                        </p>
                                    </div>

                                    @if($education->gpa)
                                        <div class="text-sm text-gray-600 dark:text-gray-400">
                                            <p>IPK: {{ $education->gpa }}</p>
                                        </div>
                                    @endif

                                    @if($education->description)
                                        <div class="text-sm text-gray-600 dark:text-gray-400">
                                            <p>{{ $education->description }}</p>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="flex space-x-2">
                                    <button class="edit-education-btn p-1.5 text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400" 
                                            data-id="{{ $education->id }}"
                                            data-institution="{{ $education->institution_name }}"
                                            data-degree="{{ $education->degree }}"
                                            data-field="{{ $education->field_of_study }}"
                                            data-start="{{ $education->start_date->format('Y-m-d') }}"
                                            data-end="{{ $education->end_date ? $education->end_date->format('Y-m-d') : '' }}"
                                            data-current="{{ $education->is_current }}"
                                            data-gpa="{{ $education->gpa }}"
                                            data-description="{{ $education->description }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button class="delete-education-btn p-1.5 text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400" data-id="{{ $education->id }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div id="no-education" class="text-center py-6 text-gray-500 dark:text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <p>Belum ada data pendidikan. Klik "Tambah Pendidikan" untuk menambahkan.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Experience Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <!-- ... existing experience section ... -->
        </div>

        <!-- Skills Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <!-- ... existing skills section ... -->
        </div>
    </div>
</div>

<div id="family-content" class="tab-content hidden">
    <!-- ... existing family content ... -->
</div>

<div id="documents-content" class="tab-content hidden">
    <!-- ... existing documents content ... -->
</div>

<!-- Education Modal -->
<div id="education-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" aria-modal="true">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="flex justify-between items-center mb-4">
            <h3 id="education-modal-title" class="text-lg font-medium text-gray-900 dark:text-gray-100">Tambah Pendidikan</h3>
            <button id="cancel-education" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="education-form" class="space-y-4">
            <input type="hidden" id="education-id" name="id">
            
            <div>
                <label for="institution_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Institusi</label>
                <input type="text" id="institution_name" name="institution_name" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
            </div>

            <div>
                <label for="degree" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gelar</label>
                <input type="text" id="degree" name="degree" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
            </div>

            <div>
                <label for="field_of_study" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bidang Studi</label>
                <input type="text" id="field_of_study" name="field_of_study" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Mulai</label>
                    <input type="date" id="start_date" name="start_date" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                </div>

                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Selesai</label>
                    <input type="date" id="end_date" name="end_date"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                </div>
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="is_current" name="is_current" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="is_current" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Masih Berlangsung</label>
            </div>

            <div>
                <label for="gpa" class="block text-sm font-medium text-gray-700 dark:text-gray-300">IPK</label>
                <input type="number" id="gpa" name="gpa" step="0.01" min="0" max="4"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                <textarea id="description" name="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm"></textarea>
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" id="cancel-education" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Experience Modal -->
<div id="experience-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" aria-modal="true">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="flex justify-between items-center mb-4">
            <h3 id="experience-modal-title" class="text-lg font-medium text-gray-900 dark:text-gray-100">Tambah Pengalaman</h3>
            <button id="cancel-experience" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="experience-form" class="space-y-4">
            <input type="hidden" id="experience-id" name="id">
            
            <div>
                <label for="position" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jabatan</label>
                <input type="text" id="position" name="position" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
            </div>

            <div>
                <label for="company_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Perusahaan</label>
                <input type="text" id="company_name" name="company_name" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Mulai</label>
                    <input type="date" id="start_date" name="start_date" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                </div>

                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Selesai</label>
                    <input type="date" id="end_date" name="end_date"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                </div>
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="is_current" name="is_current" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="is_current" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Masih Bekerja</label>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                <textarea id="description" name="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm"></textarea>
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" id="cancel-experience" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Certification Modal -->
<div id="certification-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" aria-modal="true">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="flex justify-between items-center mb-4">
            <h3 id="certification-modal-title" class="text-lg font-medium text-gray-900 dark:text-gray-100">Tambah Sertifikasi</h3>
            <button id="cancel-certification" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="certification-form" class="space-y-4">
            <input type="hidden" id="certification-id" name="id">
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Sertifikasi</label>
                <input type="text" id="name" name="name" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
            </div>

            <div>
                <label for="issuing_organization" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lembaga Penerbit</label>
                <input type="text" id="issuing_organization" name="issuing_organization" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="issue_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Terbit</label>
                    <input type="date" id="issue_date" name="issue_date" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                </div>

                <div>
                    <label for="expiration_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Kedaluwarsa</label>
                    <input type="date" id="expiration_date" name="expiration_date"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                </div>
            </div>

            <div>
                <label for="credential_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ID Kredensial</label>
                <input type="text" id="credential_id" name="credential_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
            </div>

            <div>
                <label for="credential_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">URL Kredensial</label>
                <input type="url" id="credential_url" name="credential_url"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" id="cancel-certification" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Award Modal -->
<div id="award-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" aria-modal="true">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="flex justify-between items-center mb-4">
            <h3 id="award-modal-title" class="text-lg font-medium text-gray-900 dark:text-gray-100">Tambah Penghargaan</h3>
            <button id="cancel-award" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="award-form" class="space-y-4">
            <input type="hidden" id="award-id" name="id">
            
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Judul Penghargaan</label>
                <input type="text" id="title" name="title" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
            </div>

            <div>
                <label for="issuer" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pemberi Penghargaan</label>
                <input type="text" id="issuer" name="issuer" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
            </div>

            <div>
                <label for="date_received" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Diterima</label>
                <input type="date" id="date_received" name="date_received" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                <textarea id="description" name="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm"></textarea>
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" id="cancel-award" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Skill Modal -->
<div id="skill-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" aria-modal="true">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="flex justify-between items-center mb-4">
            <h3 id="skill-modal-title" class="text-lg font-medium text-gray-900 dark:text-gray-100">Tambah Keahlian</h3>
            <button id="cancel-skill" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="skill-form" class="space-y-4">
            <input type="hidden" id="skill-id" name="id">
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Keahlian</label>
                <input type="text" id="name" name="name" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
            </div>

            <div>
                <label for="proficiency_level" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tingkat Keahlian</label>
                <select id="proficiency_level" name="proficiency_level" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
                    <option value="">Pilih Tingkat Keahlian</option>
                    <option value="beginner">Pemula</option>
                    <option value="intermediate">Menengah</option>
                    <option value="advanced">Lanjutan</option>
                    <option value="expert">Ahli</option>
                </select>
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" id="cancel-skill" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Additional Document Modal -->
<div id="additional-document-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" aria-modal="true">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="flex justify-between items-center mb-4">
            <h3 id="additional-document-modal-title" class="text-lg font-medium text-gray-900 dark:text-gray-100">Tambah Dokumen</h3>
            <button id="cancel-additional-document" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="additional-document-form" class="space-y-4">
            <input type="hidden" id="document-id" name="id">
            
            <div>
                <label for="document_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Dokumen</label>
                <input type="text" id="document_name" name="document_name" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
            </div>

            <div>
                <label for="document_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">File Dokumen</label>
                <input type="file" id="document_file" name="document_file" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" required
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200">
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: PDF, JPG, PNG, DOC, atau DOCX. Maks. 5MB</p>
            </div>

            <div>
                <label for="document_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                <textarea id="document_description" name="document_description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm"></textarea>
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" id="cancel-additional-document" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Progress bar initialization
    const progressBar = document.getElementById('completion-progress-bar');
    const completionPercentage = document.getElementById('completion-percentage');

    if (progressBar && completionPercentage) {
        const percentage = parseFloat(completionPercentage.textContent);
        progressBar.style.width = percentage + '%';

        // Add color classes based on percentage
        if (percentage >= 80) {
            progressBar.classList.add('bg-blue-600');
        } else if (percentage >= 50) {
            progressBar.classList.add('bg-blue-600');
        } else {
            progressBar.classList.add('bg-blue-600');
        }
    }

    // Tab switching functionality
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    function switchTab(targetId) {
        // Hide all tab contents
        tabContents.forEach(content => {
            content.classList.add('hidden');
        });

        // Remove active styles from all tab buttons
        tabButtons.forEach(button => {
            button.classList.remove('border-blue-500', 'text-blue-600', 'dark:text-blue-400');
            button.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300', 'dark:text-gray-400', 'dark:hover:text-gray-300');
        });

        // Show selected tab content
        const selectedContent = document.getElementById(targetId);
        if (selectedContent) {
            selectedContent.classList.remove('hidden');
        }

        // Add active styles to selected tab button
        const selectedButton = document.querySelector(`[data-target="${targetId}"]`);
        if (selectedButton) {
            selectedButton.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300', 'dark:text-gray-400', 'dark:hover:text-gray-300');
            selectedButton.classList.add('border-blue-500', 'text-blue-600', 'dark:text-blue-400');
        }
    }

    // Add click event listeners to tab buttons
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const targetId = button.getAttribute('data-target');
            switchTab(targetId);
        });
    });

    // Make tabs responsive
    function handleResponsiveTabs() {
        const nav = document.querySelector('nav');
        if (window.innerWidth < 640) {
            nav.classList.remove('space-x-8');
            nav.classList.add('space-x-4');
            tabButtons.forEach(button => {
                button.classList.add('text-xs');
                button.classList.remove('text-sm');
            });
        } else {
            nav.classList.remove('space-x-4');
            nav.classList.add('space-x-8');
            tabButtons.forEach(button => {
                button.classList.remove('text-xs');
                button.classList.add('text-sm');
            });
        }
    }

    // Initial call and add resize listener
    handleResponsiveTabs();
    window.addEventListener('resize', handleResponsiveTabs);

    // Education Form Handling
    const educationModal = document.getElementById('education-modal');
    const addEducationBtn = document.getElementById('add-education-btn');
    const cancelEducationBtn = document.getElementById('cancel-education');
    const educationForm = document.getElementById('education-form');
    const modalTitle = document.getElementById('education-modal-title');
    const isCurrentCheckbox = document.getElementById('is_current');
    const endDateInput = document.getElementById('end_date');

    // Show modal for adding new education
    addEducationBtn?.addEventListener('click', function() {
        modalTitle.textContent = 'Tambah Pendidikan';
        educationForm.reset();
        document.getElementById('education-id').value = '';
        educationModal.classList.remove('hidden');
    });

    // Hide modal
    cancelEducationBtn?.addEventListener('click', function() {
        educationModal.classList.add('hidden');
    });

    // Handle is_current checkbox
    isCurrentCheckbox?.addEventListener('change', function() {
        endDateInput.disabled = this.checked;
        if (this.checked) {
            endDateInput.value = '';
        }
    });

    // Handle edit button clicks
    document.querySelectorAll('.edit-education-btn').forEach(button => {
        button.addEventListener('click', function() {
            modalTitle.textContent = 'Edit Pendidikan';
            const id = this.dataset.id;
            document.getElementById('education-id').value = id;
            document.getElementById('institution_name').value = this.dataset.institution;
            document.getElementById('degree').value = this.dataset.degree;
            document.getElementById('field_of_study').value = this.dataset.field;
            document.getElementById('start_date').value = this.dataset.start;
            document.getElementById('end_date').value = this.dataset.end;
            document.getElementById('is_current').checked = this.dataset.current === '1';
            document.getElementById('gpa').value = this.dataset.gpa;
            document.getElementById('description').value = this.dataset.description;

            // Handle end date disabled state
            endDateInput.disabled = this.dataset.current === '1';
            
            educationModal.classList.remove('hidden');
        });
    });

    // Handle form submission
    educationForm?.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        try {
            const formData = new FormData(this);
            const id = formData.get('id');
            const url = id ? `/student/education/${id}` : '/student/education';
            const method = id ? 'PUT' : 'POST';

            // Add CSRF token
            formData.append('_token', '{{ csrf_token() }}');
            if (id) {
                formData.append('_method', 'PUT');
            }

            const response = await fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();
            
            if (data.success) {
                window.location.reload();
            } else {
                alert(data.message || 'Terjadi kesalahan. Silakan coba lagi.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan. Silakan coba lagi.');
        }
    });

    // Handle delete button clicks
    document.querySelectorAll('.delete-education-btn').forEach(button => {
        button.addEventListener('click', async function() {
            if (confirm('Apakah Anda yakin ingin menghapus data pendidikan ini?')) {
                try {
                    const id = this.dataset.id;
                    const response = await fetch(`/student/education/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const data = await response.json();
                    
                    if (data.success) {
                        this.closest('.education-item').remove();
                        
                        const educationList = document.getElementById('education-list');
                        if (educationList.children.length === 0) {
                            educationList.innerHTML = `
                                <div id="no-education" class="text-center py-6 text-gray-500 dark:text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                    <p>Belum ada data pendidikan. Klik "Tambah Pendidikan" untuk menambahkan.</p>
                                </div>
                            `;
                        }
                    } else {
                        alert(data.message || 'Terjadi kesalahan saat menghapus data.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus data.');
                }
            }
        });
    });

    // Document upload toggle
    const uploadButtons = document.querySelectorAll('[id^="upload-"]');

    // Guardian info toggle
    const hasGuardianCheckbox = document.getElementById('has_guardian');
    const guardianInfoForm = document.getElementById('guardian-info-form');

    if (hasGuardianCheckbox && guardianInfoForm) {
        hasGuardianCheckbox.addEventListener('change', () => {
            if (hasGuardianCheckbox.checked) {
                guardianInfoForm.classList.remove('hidden');
            } else {
                guardianInfoForm.classList.add('hidden');
            }
        });
    }

    // Additional document form toggle
    const addDocumentBtn = document.getElementById('add-additional-document-btn');
    const addDocumentForm = document.getElementById('add-additional-document-form');
    const cancelAddDocumentBtn = document.getElementById('cancel-add-document-btn');

    if (addDocumentBtn && addDocumentForm) {
        addDocumentBtn.addEventListener('click', () => {
            addDocumentForm.classList.remove('hidden');
            addDocumentBtn.classList.add('hidden');
        });
    }

    if (cancelAddDocumentBtn && addDocumentForm && addDocumentBtn) {
        cancelAddDocumentBtn.addEventListener('click', () => {
            addDocumentForm.classList.add('hidden');
            addDocumentBtn.classList.remove('hidden');
        });
    }

    // Delete document modal
    const deleteDocumentBtns = document.querySelectorAll('.delete-document-btn');
    const deleteAdditionalDocumentBtns = document.querySelectorAll('.delete-additional-document-btn');
    const deleteDocumentModal = document.getElementById('delete-document-modal');
    const confirmDeleteDocumentBtn = document.getElementById('confirm-delete-document');
    const cancelDeleteDocumentBtn = document.getElementById('cancel-delete-document');

    let documentToDelete = null;
    let documentType = null;

    deleteDocumentBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            documentType = btn.getAttribute('data-type');
            documentToDelete = null;
            deleteDocumentModal.classList.remove('hidden');
        });
    });

    deleteAdditionalDocumentBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            documentType = 'additional';
            documentToDelete = btn.getAttribute('data-id');
            deleteDocumentModal.classList.remove('hidden');
        });
    });

    if (cancelDeleteDocumentBtn && deleteDocumentModal) {
        cancelDeleteDocumentBtn.addEventListener('click', () => {
            deleteDocumentModal.classList.add('hidden');
            documentToDelete = null;
            documentType = null;
        });
    }

    if (confirmDeleteDocumentBtn) {
        confirmDeleteDocumentBtn.addEventListener('click', () => {
            // Here you would handle the document deletion via AJAX
            console.log(`Deleting document: ${documentType}, ID: ${documentToDelete}`);

            // After successful deletion, hide the modal
            deleteDocumentModal.classList.add('hidden');
            documentToDelete = null;
            documentType = null;
        });
    }

    // Form submissions with AJAX
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Here you would handle the form submission via AJAX
            console.log(`Form submitted: ${form.id}`);

            // Show success message (in a real app, this would be after successful AJAX)
            alert('Data berhasil disimpan!');
        });
    });

    // Dark mode toggle functionality
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const htmlElement = document.documentElement;

    if (darkModeToggle) {
        // Check for saved theme preference or use the system preference
        const savedTheme = localStorage.getItem('theme') ||
            (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

        // Apply the saved theme on page load
        if (savedTheme === 'dark') {
            htmlElement.classList.add('dark');
            darkModeToggle.checked = true;
        } else {
            htmlElement.classList.remove('dark');
            darkModeToggle.checked = false;
        }

        // Toggle dark mode when the switch is clicked
        darkModeToggle.addEventListener('change', function() {
            if (this.checked) {
                htmlElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                htmlElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            }
        });
    }

    // Profile image upload preview
    const profileImageInput = document.getElementById('profile_image');
    const profileImagePreview = document.getElementById('profile-image-preview');

    if (profileImageInput && profileImagePreview) {
        profileImageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    profileImagePreview.src = e.target.result;
                };

                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    // Form validation
    const personalInfoForm = document.getElementById('personal-info-form');

    if (personalInfoForm) {
        personalInfoForm.addEventListener('submit', function(e) {
            let isValid = true;

            // Required fields validation
            const requiredFields = this.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('border-red-500');

                    // Add error message if it doesn't exist
                    let errorMsg = field.parentNode.querySelector('.error-message');
                    if (!errorMsg) {
                        errorMsg = document.createElement('p');
                        errorMsg.className = 'error-message text-red-500 text-xs mt-1';
                        errorMsg.textContent = 'Bidang ini wajib diisi';
                        field.parentNode.appendChild(errorMsg);
                    }
                } else {
                    field.classList.remove('border-red-500');

                    // Remove error message if it exists
                    const errorMsg = field.parentNode.querySelector('.error-message');
                    if (errorMsg) {
                        errorMsg.remove();
                    }
                }
            });

            // Email validation
            const emailField = this.querySelector('input[type="email"]');
            if (emailField && emailField.value.trim()) {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(emailField.value.trim())) {
                    isValid = false;
                    emailField.classList.add('border-red-500');

                    // Add error message if it doesn't exist
                    let errorMsg = emailField.parentNode.querySelector('.error-message');
                    if (!errorMsg) {
                        errorMsg = document.createElement('p');
                        errorMsg.className = 'error-message text-red-500 text-xs mt-1';
                        errorMsg.textContent = 'Format email tidak valid';
                        emailField.parentNode.appendChild(errorMsg);
                    } else {
                        errorMsg.textContent = 'Format email tidak valid';
                    }
                }
            }

            // Phone number validation
            const phoneField = document.getElementById('phone');
            if (phoneField && phoneField.value.trim()) {
                const phonePattern = /^[0-9]{10,15}$/;
                if (!phonePattern.test(phoneField.value.replace(/\D/g, ''))) {
                    isValid = false;
                    phoneField.classList.add('border-red-500');

                    // Add error message if it doesn't exist
                    let errorMsg = phoneField.parentNode.querySelector('.error-message');
                    if (!errorMsg) {
                        errorMsg = document.createElement('p');
                        errorMsg.className = 'error-message text-red-500 text-xs mt-1';
                        errorMsg.textContent = 'Nomor telepon harus terdiri dari 10-15 digit';
                        phoneField.parentNode.appendChild(errorMsg);
                    } else {
                        errorMsg.textContent = 'Nomor telepon harus terdiri dari 10-15 digit';
                    }
                }
            }

            if (!isValid) {
                e.preventDefault();

                // Scroll to the first error
                const firstError = this.querySelector('.border-red-500');
                if (firstError) {
                    firstError.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    firstError.focus();
                }
            }
        });

        // Clear validation errors when input changes
        const formInputs = personalInfoForm.querySelectorAll('input, select, textarea');
        formInputs.forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('border-red-500');

                // Remove error message if it exists
                const errorMsg = this.parentNode.querySelector('.error-message');
                if (errorMsg) {
                    errorMsg.remove();
                }
            });
        });
    }

    // Password strength meter
    const newPasswordInput = document.getElementById('new_password');
    const passwordStrengthMeter = document.getElementById('password-strength-meter');
    const passwordStrengthText = document.getElementById('password-strength-text');

    if (newPasswordInput && passwordStrengthMeter && passwordStrengthText) {
        newPasswordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;

            // Length check
            if (password.length >= 8) {
                strength += 1;
            }

            // Contains lowercase letters
            if (/[a-z]/.test(password)) {
                strength += 1;
            }

            // Contains uppercase letters
            if (/[A-Z]/.test(password)) {
                strength += 1;
            }

            // Contains numbers
            if (/[0-9]/.test(password)) {
                strength += 1;
            }

            // Contains special characters
            if (/[^A-Za-z0-9]/.test(password)) {
                strength += 1;
            }

            // Update the strength meter
            passwordStrengthMeter.value = strength;

            // Update the strength text
            switch (strength) {
                case 0:
                case 1:
                    passwordStrengthText.textContent = 'Lemah';
                    passwordStrengthText.className = 'text-xs text-red-500';
                    break;
                case 2:
                case 3:
                    passwordStrengthText.textContent = 'Sedang';
                    passwordStrengthText.className = 'text-xs text-yellow-500';
                    break;
                case 4:
                case 5:
                    passwordStrengthText.textContent = 'Kuat';
                    passwordStrengthText.className = 'text-xs text-green-500';
                    break;
            }
        });
    }

    // Password confirmation validation
    const passwordConfirmInput = document.getElementById('new_password_confirmation');

    if (newPasswordInput && passwordConfirmInput) {
        passwordConfirmInput.addEventListener('input', function() {
            if (newPasswordInput.value !== this.value) {
                this.classList.add('border-red-500');

                // Add error message if it doesn't exist
                let errorMsg = this.parentNode.querySelector('.error-message');
                if (!errorMsg) {
                    errorMsg = document.createElement('p');
                    errorMsg.className = 'error-message text-red-500 text-xs mt-1';
                    errorMsg.textContent = 'Password tidak cocok';
                    this.parentNode.appendChild(errorMsg);
                }
            } else {
                this.classList.remove('border-red-500');

                // Remove error message if it exists
                const errorMsg = this.parentNode.querySelector('.error-message');
                if (errorMsg) {
                    errorMsg.remove();
                }
            }
        });
    }

    // AJAX form submissions with loading indicators
    const ajaxForms = document.querySelectorAll('form[data-ajax="true"]');

    ajaxForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Show loading indicator
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Menyimpan...
            `;

            // Create FormData object
            const formData = new FormData(this);

            // Send AJAX request
            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Reset button
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;

                    // Show success message
                    if (data.success) {
                        // Create success notification
                        const notification = document.createElement('div');
                        notification.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg transform transition-transform duration-300 ease-in-out';
                        notification.innerHTML = `
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>${data.message || 'Data berhasil disimpan!'}</span>
                            </div>
                        `;

                        document.body.appendChild(notification);

                        // Remove notification after 3 seconds
                        setTimeout(() => {
                            notification.classList.add('translate-y-full', 'opacity-0');
                            setTimeout(() => {
                                notification.remove();
                            }, 300);
                        }, 3000);

                        // Reload page if needed
                        if (data.reload) {
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        }
                    } else {
                        // Show error message
                        const notification = document.createElement('div');
                        notification.className = 'fixed bottom-4 right-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg';
                        notification.innerHTML = `
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span>${data.message || 'Terjadi kesalahan. Silakan coba lagi.'}</span>
                            </div>
                        `;

                        document.body.appendChild(notification);

                        // Remove notification after 3 seconds
                        setTimeout(() => {
                            notification.classList.add('translate-y-full', 'opacity-0');
                            setTimeout(() => {
                                notification.remove();
                            }, 300);
                        }, 3000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);

                    // Reset button
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;

                    // Show error message
                    const notification = document.createElement('div');
                    notification.className = 'fixed bottom-4 right-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg';
                    notification.innerHTML = `
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <span>Terjadi kesalahan. Silakan coba lagi.</span>
                        </div>
                    `;

                    document.body.appendChild(notification);

                    // Remove notification after 3 seconds
                    setTimeout(() => {
                        notification.classList.add('translate-y-full', 'opacity-0');
                        setTimeout(() => {
                            notification.remove();
                        }, 300);
                    }, 3000);
                });
        });
    });
});
</script>
@endpush 