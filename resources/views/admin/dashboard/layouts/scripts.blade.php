<script src="{{asset('assets/admin/assets/modules/jquery.min.js')}}"></script>
<script src="{{asset('assets/admin/assets/modules/popper.js')}}"></script>
<script src="{{asset('assets/admin/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/admin/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
<script src="{{asset('assets/admin/assets/js/stisla.js')}}"></script>

<!-- JS Libraies -->
<script src="{{asset('assets/admin/assets/modules/summernote/summernote-bs4.js')}}"></script>


<!-- Template JS File -->
<script src="{{asset('assets/admin/assets/js/scripts.js')}}"></script>

{{-- Upload Preview --}}
<script src="{{asset('assets/admin/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js')}}"></script>
@stack('js')

{{-- Upload Preview --}}

<script>
    $.uploadPreview({
        input_field: "#image-upload-avatar",   // Default: .image-upload
        preview_box: "#image-preview-avatar",  // Default: .image-preview
        label_field: "#image-upload-avatar",    // Default: .image-label
        label_default: "Choose File",   // Default: Choose File
        label_selected: "Change File",  // Default: Change File
        no_label: false,                // Default: false
        success_callback: null          // Default: null
    });
</script>
