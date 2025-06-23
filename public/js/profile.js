document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active state from all buttons
            tabButtons.forEach(btn => {
                btn.classList.remove('border-blue-500', 'text-blue-600', 'dark:text-blue-400');
                btn.classList.add('border-transparent', 'text-gray-500', 'dark:text-gray-400');
            });

            // Add active state to clicked button
            button.classList.remove('border-transparent', 'text-gray-500', 'dark:text-gray-400');
            button.classList.add('border-blue-500', 'text-blue-600', 'dark:text-blue-400');

            // Hide all tab contents
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });

            // Show the selected tab content
            const targetId = button.getAttribute('data-target');
            const targetContent = document.getElementById(targetId);
            if (targetContent) {
                targetContent.classList.remove('hidden');
            }
        });
    });

    // Education section functionality
    const educationModal = document.getElementById('education-modal');
    const addEducationBtn = document.getElementById('add-education-btn');
    const cancelEducationBtn = document.getElementById('cancel-education');
    const educationForm = document.getElementById('education-form');
    const modalTitle = document.getElementById('education-modal-title');
    const endDateInput = document.getElementById('end_date');
    const isCurrentCheckbox = document.getElementById('is_current');

    // Show modal when add button is clicked
    addEducationBtn?.addEventListener('click', function() {
        modalTitle.textContent = 'Tambah Pendidikan';
        educationForm.reset();
        document.getElementById('education-id').value = '';
        educationModal.classList.remove('hidden');
    });

    // Hide modal when cancel button is clicked
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
            const url = id ? `/mahasiswa/profile/education/${id}` : '/mahasiswa/profile/education';
            const method = id ? 'PUT' : 'POST';

            // Add CSRF token
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
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
                    const response = await fetch(`/mahasiswa/profile/education/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
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
            }
        });
    });

    // Experience section functionality
    const addExperienceBtn = document.getElementById('add-experience-btn');
    const experienceList = document.getElementById('experience-list');
    const noExperience = document.getElementById('no-experience');

    if (addExperienceBtn) {
        addExperienceBtn.addEventListener('click', () => {
            // Create and show the experience form modal
            const modal = createExperienceFormModal();
            document.body.appendChild(modal);
            // Ensure the modal is visible
            requestAnimationFrame(() => {
                modal.classList.remove('hidden');
            });
        });
    }

    // Skills section functionality
    const addSkillBtn = document.getElementById('add-skill-btn');
    const skillList = document.getElementById('skill-list');
    const noSkill = document.getElementById('no-skill');

    if (addSkillBtn) {
        addSkillBtn.addEventListener('click', () => {
            // Create and show the skill form modal
            const modal = createSkillFormModal();
            document.body.appendChild(modal);
            // Ensure the modal is visible
            requestAnimationFrame(() => {
                modal.classList.remove('hidden');
            });
        });
    }
});

// Helper function to create education form modal
function createEducationFormModal() {
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 z-50 overflow-y-auto hidden';
    modal.innerHTML = `
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75 dark:bg-gray-900 dark:opacity-90"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="education-form" class="p-6">
                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Tambah Pendidikan</h3>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label for="institution_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Institusi <span class="text-red-500">*</span></label>
                            <input type="text" id="institution_name" name="institution_name" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div>
                            <label for="degree" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenjang <span class="text-red-500">*</span></label>
                            <input type="text" id="degree" name="degree" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div>
                            <label for="field_of_study" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bidang Studi <span class="text-red-500">*</span></label>
                            <input type="text" id="field_of_study" name="field_of_study" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Mulai <span class="text-red-500">*</span></label>
                                <input type="date" id="start_date" name="start_date" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Selesai</label>
                                <input type="date" id="end_date" name="end_date" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>
                        </div>
                        <div>
                            <label for="gpa" class="block text-sm font-medium text-gray-700 dark:text-gray-300">IPK</label>
                            <input type="number" id="gpa" name="gpa" step="0.01" min="0" max="4" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                            <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"></textarea>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" class="px-4 py-2 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="this.closest('.fixed').remove()">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    `;

    // Add form submission handler
    const form = modal.querySelector('#education-form');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        
        try {
            const response = await fetch('/api/student/education', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(Object.fromEntries(formData))
            });

            if (response.ok) {
                const data = await response.json();
                // Add new education to the list
                const educationList = document.getElementById('education-list');
                const noEducation = document.getElementById('no-education');
                
                if (noEducation) {
                    noEducation.remove();
                }

                const educationItem = createEducationItem(data);
                educationList.appendChild(educationItem);
                
                // Close modal
                modal.remove();
            } else {
                throw new Error('Failed to save education');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menyimpan data pendidikan');
        }
    });

    return modal;
}

// Helper function to create experience form modal
function createExperienceFormModal() {
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 z-50 overflow-y-auto hidden';
    modal.innerHTML = `
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75 dark:bg-gray-900 dark:opacity-90"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="experience-form" class="p-6">
                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Tambah Pengalaman</h3>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jabatan <span class="text-red-500">*</span></label>
                            <input type="text" id="position" name="position" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Perusahaan <span class="text-red-500">*</span></label>
                            <input type="text" id="company_name" name="company_name" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Mulai <span class="text-red-500">*</span></label>
                                <input type="date" id="start_date" name="start_date" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Selesai</label>
                                <input type="date" id="end_date" name="end_date" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                            <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"></textarea>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" class="px-4 py-2 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="this.closest('.fixed').remove()">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    `;

    // Add form submission handler
    const form = modal.querySelector('#experience-form');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        
        try {
            const response = await fetch('/api/student/experience', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(Object.fromEntries(formData))
            });

            if (response.ok) {
                const data = await response.json();
                // Add new experience to the list
                const experienceList = document.getElementById('experience-list');
                const noExperience = document.getElementById('no-experience');
                
                if (noExperience) {
                    noExperience.remove();
                }

                const experienceItem = createExperienceItem(data);
                experienceList.appendChild(experienceItem);
                
                // Close modal
                modal.remove();
            } else {
                throw new Error('Failed to save experience');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menyimpan data pengalaman');
        }
    });

    return modal;
}

// Helper function to create skill form modal
function createSkillFormModal() {
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 z-50 overflow-y-auto hidden';
    modal.innerHTML = `
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75 dark:bg-gray-900 dark:opacity-90"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="skill-form" class="p-6">
                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Tambah Keahlian</h3>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Keahlian <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div>
                            <label for="proficiency_level" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tingkat Keahlian <span class="text-red-500">*</span></label>
                            <select id="proficiency_level" name="proficiency_level" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                                <option value="">Pilih Tingkat Keahlian</option>
                                <option value="beginner">Pemula</option>
                                <option value="intermediate">Menengah</option>
                                <option value="advanced">Lanjutan</option>
                                <option value="expert">Ahli</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" class="px-4 py-2 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="this.closest('.fixed').remove()">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    `;

    // Add form submission handler
    const form = modal.querySelector('#skill-form');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        
        try {
            const response = await fetch('/api/student/skill', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(Object.fromEntries(formData))
            });

            if (response.ok) {
                const data = await response.json();
                // Add new skill to the list
                const skillList = document.getElementById('skill-list');
                const noSkill = document.getElementById('no-skill');
                
                if (noSkill) {
                    noSkill.remove();
                }

                const skillItem = createSkillItem(data);
                skillList.appendChild(skillItem);
                
                // Close modal
                modal.remove();
            } else {
                throw new Error('Failed to save skill');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menyimpan data keahlian');
        }
    });

    return modal;
}

// Helper function to create education item element
function createEducationItem(education) {
    const div = document.createElement('div');
    div.className = 'education-item border border-gray-200 dark:border-gray-700 rounded-lg p-4';
    div.innerHTML = `
        <div class="flex justify-between">
            <div>
                <h3 class="font-medium text-gray-800 dark:text-gray-200">${education.institution_name}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">${education.degree} - ${education.field_of_study}</p>
                <p class="text-sm text-gray-500 dark:text-gray-500">
                    ${new Date(education.start_date).toLocaleDateString('id-ID', { month: 'short', year: 'numeric' })} -
                    ${education.is_current ? 'Sekarang' : (education.end_date ? new Date(education.end_date).toLocaleDateString('id-ID', { month: 'short', year: 'numeric' }) : '')}
                </p>
                ${education.gpa ? `<p class="text-sm text-gray-600 dark:text-gray-400 mt-1">IPK: ${education.gpa}</p>` : ''}
                ${education.description ? `<p class="text-sm text-gray-600 dark:text-gray-400 mt-1">${education.description}</p>` : ''}
            </div>
            <div class="flex space-x-2">
                <button class="edit-education-btn p-1.5 text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400" data-id="${education.id}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </button>
                <button class="delete-education-btn p-1.5 text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400" data-id="${education.id}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    `;
    return div;
}

// Helper function to create experience item element
function createExperienceItem(experience) {
    const div = document.createElement('div');
    div.className = 'experience-item border border-gray-200 dark:border-gray-700 rounded-lg p-4';
    div.innerHTML = `
        <div class="flex justify-between">
            <div>
                <h3 class="font-medium text-gray-800 dark:text-gray-200">${experience.position}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">${experience.company_name}</p>
                <p class="text-sm text-gray-500 dark:text-gray-500">
                    ${new Date(experience.start_date).toLocaleDateString('id-ID', { month: 'short', year: 'numeric' })} -
                    ${experience.is_current ? 'Sekarang' : (experience.end_date ? new Date(experience.end_date).toLocaleDateString('id-ID', { month: 'short', year: 'numeric' }) : '')}
                </p>
                ${experience.description ? `<p class="text-sm text-gray-600 dark:text-gray-400 mt-1">${experience.description}</p>` : ''}
            </div>
            <div class="flex space-x-2">
                <button class="edit-experience-btn p-1.5 text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400" data-id="${experience.id}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </button>
                <button class="delete-experience-btn p-1.5 text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400" data-id="${experience.id}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    `;
    return div;
}

// Helper function to create skill item element
function createSkillItem(skill) {
    const div = document.createElement('div');
    div.className = 'skill-item inline-flex items-center bg-gray-100 dark:bg-gray-700 rounded-full px-3 py-1';
    div.innerHTML = `
        <span class="text-sm text-gray-800 dark:text-gray-200">${skill.name}</span>
        <span class="ml-1 text-xs px-1.5 py-0.5 rounded-full 
            ${skill.proficiency_level === 'beginner' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' :
              skill.proficiency_level === 'intermediate' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' :
              skill.proficiency_level === 'advanced' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' :
              'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200'}">
            ${skill.proficiency_level.charAt(0).toUpperCase() + skill.proficiency_level.slice(1)}
        </span>
        <button class="delete-skill-btn ml-2 text-gray-400 hover:text-red-500" data-id="${skill.id}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    `;
    return div;
} 