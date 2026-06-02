@if ($errors->any())
    <div class="toast-container position-fixed top-0 end-0">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="https://cdn-icons-png.freepik.com/512/9255/9255700.png" height="10" width="10"  class="rounded me-2" alt="...">
                <strong class="me-auto">Validation</strong>
                <small>Now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ $errors->first() }}
            </div>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="toast-container position-fixed top-0 end-0">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="https://cdn-icons-png.freepik.com/512/9255/9255700.png" height="10" width="10" class="rounded me-2" alt="...">
                <strong class="me-auto">Registration</strong>
                <small>Now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{session('error')}}
            </div>
        </div>
    </div>
@endif

@if(session('success'))
    <div class="toast-container position-fixed top-0 end-0">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="https://cdn-icons-png.freepik.com/512/9255/9255700.png" height="10" width="10"  class="rounded me-2" alt="...">
                <strong class="me-auto">Registration</strong>
                <small>Now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{session('success')}}
            </div>
        </div>
    </div>
@endif
