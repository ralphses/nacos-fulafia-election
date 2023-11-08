<div id="myModal" class="modal" style="display: block;">
    <div class="modal-content">
        
        <!-- Modal Body with Success Message -->
        @if (session()->get('success') === 'Voter verified')
        {{-- <h4 class="modal-title">Success Message</h4> --}}
            <div class="modal-body">
                <p style="color: green;">{{ session()->get('success') }}</p>
                <!-- OK Button -->
                <button onclick="closeModal()" type="submit" class="btn w-100 btn-alt-success text-white" style="background-color: #198906">
                    Done
                </button>
            </div>
        @else
        {{-- <h4 class="modal-title" style="color: red">Failed!</h4> --}}
            <div class="modal-body">
                <p style="color: red;">{{ session()->get('success') }}</p>
                <!-- OK Button -->
                <button onclick="closeModal()" type="submit" class="btn w-100 btn-alt-success text-white"
                    style="background-color: red">
                    Done
                </button>
            </div>
        @endif
    </div>
</div>

<script>
    function closeModal() {
        var modal = document.getElementById('myModal');
        modal.style.display = 'none';
        window.location.href = '/verify';
    }

    function okButtonAction() {
        window.location.href = '/verify';
    }
</script>
