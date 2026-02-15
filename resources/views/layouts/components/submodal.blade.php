<div id="crudSubModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-60 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto no-scrollbar">
        
        <div id="subModalContent">
            <!-- FORM AKAN DILoad DI SINI SECARA AJAX -->
        </div>

    </div>
</div>

<script>
    function closeCrudSubModal() {
        document.getElementById("crudSubModal").classList.add("hidden");
    }
</script>
