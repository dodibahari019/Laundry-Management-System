<div id="DetailCrudModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-4xl max-w-4xl w-full max-h-[90vh] overflow-y-auto no-scrollbar">
        <div id="detailModalContent">
            <!-- FORM AKAN DILoad DI SINI SECARA AJAX -->
        </div>

    </div>
</div>

<script>
    function closeDetailCrudModal() {
        document.getElementById("DetailCrudModal").classList.add("hidden");
    }
</script>
