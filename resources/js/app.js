import './bootstrap';
import $ from 'jquery';

// Make jQuery available globally
window.$ = window.jQuery = $;

// Admin Dashboard functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips and other UI components
    initializeUI();

    // Initialize form validation
    initializeFormValidation();

    // Initialize file upload handlers
    initializeFileUploads();
});

function initializeUI() {
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);

    // Confirm delete actions
    $('.delete-confirm').on('click', function(e) {
        if (!confirm('Are you sure you want to delete this item?')) {
            e.preventDefault();
        }
    });

    // Toggle password visibility
    $('.toggle-password').on('click', function() {
        const input = $(this).siblings('input');
        const type = input.attr('type') === 'password' ? 'text' : 'password';
        input.attr('type', type);
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    });
}

function initializeFormValidation() {
    // Add custom validation styles
    $('form').on('submit', function() {
        $(this).find('.is-invalid').removeClass('is-invalid');
        $(this).find('.invalid-feedback').remove();
    });

    // Real-time validation for required fields
    $('input[required], textarea[required], select[required]').on('blur', function() {
        if (!$(this).val()) {
            $(this).addClass('border-red-500');
        } else {
            $(this).removeClass('border-red-500').addClass('border-green-500');
        }
    });
}

function initializeFileUploads() {
    // Image preview functionality
    $('input[type="file"][accept*="image"]').on('change', function() {
        const file = this.files[0];
        const preview = $(this).siblings('.image-preview');

        if (file && preview.length) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.html(`<img src="${e.target.result}" class="max-w-full h-auto rounded-lg shadow-md">`);
            };
            reader.readAsDataURL(file);
        }
    });

    // Drag and drop file upload
    $('.file-drop-zone').on('dragover', function(e) {
        e.preventDefault();
        $(this).addClass('border-blue-500 bg-blue-50');
    }).on('dragleave', function(e) {
        e.preventDefault();
        $(this).removeClass('border-blue-500 bg-blue-50');
    }).on('drop', function(e) {
        e.preventDefault();
        $(this).removeClass('border-blue-500 bg-blue-50');

        const files = e.originalEvent.dataTransfer.files;
        const input = $(this).find('input[type="file"]')[0];
        input.files = files;
        $(input).trigger('change');
    });
}
